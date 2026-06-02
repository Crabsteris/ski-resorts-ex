<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resort_id' => 'required|exists:resorts,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'resort_id' => $validated['resort_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Review added.');
    }

    public function destroy(Review $review)
    {
        if (
            auth()->id() !== $review->user_id &&
            auth()->user()->role !== 'admin'
        ) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}
