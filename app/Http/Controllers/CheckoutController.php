<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cart->load('items.product');

        return view('checkout.index', compact('cart'));
    }

    /**
     * Process checkout and dummy payment
     */
    public function process(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cart->load('items.product');

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => Order::generateOrderNumber(),
            'total' => $cart->total,
            'status' => 'completed',
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        // Create order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Mark cart as completed and create new active cart
        $cart->update(['status' => 'completed']);
        Cart::create([
            'user_id' => $user->id,
            'status' => 'active',
        ]);

        // Send invoice email
        try {
            Mail::to($user->email)->send(new InvoiceMail($order));
        } catch (\Exception $e) {
            // Log email error but don't fail the order
            \Log::error('Failed to send invoice email: ' . $e->getMessage());
        }

        return redirect()->route('checkout.success', $order->id);
    }

    /**
     * Show success page
     */
    public function success($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}
