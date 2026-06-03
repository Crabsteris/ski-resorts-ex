<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Resort;


class AdminResortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resorts = Resort::with('country')->get();

        return view('admin.resorts.index', compact('resorts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();

        return view('admin.resorts.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Resort::create(
            $request->validate([
                'country_id' => 'required|exists:countries,id',
                'name' => 'required|string|max:255',
                'description' => 'required',
            ])
        );

        return redirect()->route('admin.resorts.index')->with('success', 'Resort created successfully!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Resort $resort)
    {
        return view('admin.resorts.show', compact('resort'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resort $resort)
    {
        $countries = Country::all();
        return view('admin.resorts.edit', compact('resort', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resort $resort)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $resort->update($validated);

        return redirect()->route('admin.resorts.index')->with('success', 'Resort updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resort $resort)
    {
        $resort->delete();

        return redirect()->route('admin.resorts.index')->with('success', 'Resort deleted successfully!');
    }
}
