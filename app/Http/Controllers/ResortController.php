<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resort;

class ResortController extends Controller
{
    public function index()
    {
        $resorts = Resort::with('country')->get();

        return view('resorts.index', compact('resorts'));
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
