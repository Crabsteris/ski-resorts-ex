<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;



class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        $reviews = Review::with('resort')
            ->where('user_id', $user->id)
            ->get();

        return view(
            'users.profile',
            compact('user', 'reviews')
        );
    }
}
