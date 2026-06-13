<?php

namespace App\Http\Controllers;

use App\Models\Resort;

class ResortController extends Controller
{
    public function index()
    {
        $resorts = Resort::select('id', 'country_id', 'name', 'description', 'image')
            ->with('country:id,name')
            ->latest()
            ->paginate(9);

        return view('resorts.index', compact('resorts'));
    }

    public function show(Resort $resort)
    {
        $resort->load([
            'country:id,name',
            'reviews.user:id,name'
        ]);

        return view('resorts.show', compact('resort'));
    }
}