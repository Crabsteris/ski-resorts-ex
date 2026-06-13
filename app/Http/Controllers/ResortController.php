<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resort;
use App\Models\Country;

class ResortController extends Controller
{
    public function index(Request $request)
    {
        $query = Resort::select('id', 'country_id', 'name', 'description', 'image')
            ->with('country:id,name');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        $resorts = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $countries = Country::orderBy('name')->get();

        return view('resorts.index', compact('resorts', 'countries'));
    }

    public function show(Resort $resort)
    {
        $resort->load([
            'country',
            'reviews.user'
        ]);

        return view('resorts.show', compact('resort'));
    }
}