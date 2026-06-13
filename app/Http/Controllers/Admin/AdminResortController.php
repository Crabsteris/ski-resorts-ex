<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Resort;
use Illuminate\Support\Facades\Storage;
use App\Services\AuditLogger;


class AdminResortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resorts = Resort::with('country')
            ->latest()
            ->get();

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
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('resorts', 'public');
        }

        $resort = Resort::create($validated);

        AuditLogger::log(
            'create_resort',
            'Created resort: ' . $resort->name
        );

        return redirect()
            ->route('admin.resorts.index')
            ->with('success', 'Resort created successfully!');
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
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($resort->image) {
                Storage::disk('public')->delete($resort->image);
            }

            $validated['image'] = $request->file('image')->store('resorts', 'public');
        }

        $resort->update($validated);

        AuditLogger::log(
            'update_resort',
            'Updated resort: ' . $resort->name
        );

        return redirect()
            ->route('admin.resorts.index')
            ->with('success', 'Resort updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resort $resort)
    {
        $resortName = $resort->name;

        $resort->delete();

        AuditLogger::log(
            'delete_resort',
            'Soft deleted resort: ' . $resortName
        );

        return redirect()
            ->route('admin.resorts.index')
            ->with('success', 'Resort moved to trash successfully!');
    }
    public function trash()
    {
        $resorts = Resort::onlyTrashed()
            ->with('country')
            ->latest('deleted_at')
            ->get();

        return view('admin.resorts.trash', compact('resorts'));
    }
    public function restore($id)
    {
        $resort = Resort::onlyTrashed()
            ->findOrFail($id);

        $resort->restore();

        AuditLogger::log(
            'restore_resort',
            'Restored resort: ' . $resort->name
        );

        return redirect()
            ->route('admin.resorts.trash')
            ->with('success', 'Resort restored successfully!');
    }
}
