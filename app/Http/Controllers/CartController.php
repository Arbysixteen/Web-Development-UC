<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get or create active cart for current user
     */
    private function getCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 'active',
            ]);
        }

        return $cart;
    }

    /**
     * Display cart contents
     */
    public function index()
    {
        $cart = $this->getCart();
        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $cart = $this->getCart();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Check if product already in cart
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            $product = Product::find($productId);
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        $product = Product::find($productId);

        return redirect()->back()->with('success', $product->name . ' added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();
        $cartItem = $cart->items()->findOrFail($itemId);

        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart
     */
    public function remove($itemId)
    {
        $cart = $this->getCart();
        $cartItem = $cart->items()->findOrFail($itemId);
        $productName = $cartItem->product->name;

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', $productName . ' removed from cart.');
    }
}
