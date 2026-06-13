<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Services\AuditLogger;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Wishlist::with('resort')
            ->where('user_id', auth()->id())
            ->get();

        return view('wishlist.index', compact('items'));
    }

    public function store(Request $request)
    {
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'resort_id' => $request->resort_id,
        ]);
        AuditLogger::log(
            'add_wishlist',
            'Added a resort to wishlist'
        );

        return back();
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403);
        }

        $wishlist->delete();

        AuditLogger::log(
            'remove_wishlist',
            'Removed a resort from wishlist'
        );
        return back();
    }
}
