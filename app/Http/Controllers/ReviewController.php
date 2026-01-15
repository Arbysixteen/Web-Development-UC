<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
            ],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]
        );

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
