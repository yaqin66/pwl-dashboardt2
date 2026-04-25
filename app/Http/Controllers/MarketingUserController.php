<?php

namespace App\Http\Controllers;

use App\Models\MarketingUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarketingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketingUsers = MarketingUser::latest()->get();
        return view('marketing.index', compact('marketingUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marketing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:marketing_users',
            'phone' => 'nullable|string|max:20',
            'area' => 'nullable|string|max:255',
            'posisi' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        MarketingUser::create($validated);

        return redirect()->route('marketing.index')->with('success', 'User Marketing berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MarketingUser $marketing)
    {
        return view('marketing.show', compact('marketing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MarketingUser $marketing)
    {
        return view('marketing.edit', compact('marketing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MarketingUser $marketing)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('marketing_users')->ignore($marketing->id)],
            'phone' => 'nullable|string|max:20',
            'area' => 'nullable|string|max:255',
            'posisi' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $marketing->update($validated);

        return redirect()->route('marketing.index')->with('success', 'User Marketing berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MarketingUser $marketing)
    {
        $marketing->delete();
        return redirect()->route('marketing.index')->with('success', 'User Marketing berhasil dihapus!');
    }
}
