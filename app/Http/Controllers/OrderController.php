<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        $cart = Auth::user()->cart;
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cart->load('items.product');
        
        return view('orders.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet,cod',
        ]);

        $cart = Auth::user()->cart;
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cart->load('items.product');
        $totalAmount = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total' => $totalAmount,
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price ?? $item->product->price,
                ]);
            }

            $cart->items()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Order placed successfully! Order number: ' . $order->order_number);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    public function index()
    {
        $orders = Auth::user()->orders()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->with('items.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
