<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::active()->ordered()->get();
        return view('social-links.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('social-links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        SocialLink::create($validated);

        return redirect()->route('social-links.index')
            ->with('success', 'Red social agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialLink $socialLink)
    {
        return view('social-links.show', compact('socialLink'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink)
    {
        return view('social-links.edit', compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $socialLink->update($validated);

        return redirect()->route('social-links.index')
            ->with('success', 'Red social actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('social-links.index')
            ->with('success', 'Red social eliminada correctamente');
    }

    /**
     * Display public links page (Linktree style)
     */
    public function links()
    {
        $socialLinks = SocialLink::active()->ordered()->get();
        return view('links', compact('socialLinks'));
    }
}
