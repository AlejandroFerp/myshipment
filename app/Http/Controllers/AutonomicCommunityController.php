<?php

namespace App\Http\Controllers;

use App\Models\AutonomicCommunity;
use App\Models\Direccion;
use Illuminate\Http\Request;

class AutonomicCommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $autonomicCommunities = AutonomicCommunity::with('address')->get();
        return view('autonomic_communities.index', compact('autonomicCommunities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $direcciones = Direccion::all();
        return view('autonomic_communities.create', compact('direcciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:autonomic_communities,code',
            'address_id' => 'nullable|exists:direccions,id',
        ]);

        AutonomicCommunity::create($validated);

        return redirect()->route('autonomic_communities.index')
                         ->with('success', 'Autonomic Community Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutonomicCommunity $autonomicCommunity)
    {
        $direcciones = Direccion::all();
        return view('autonomic_communities.edit', compact('autonomicCommunity', 'direcciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AutonomicCommunity $autonomicCommunity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => "required|string|max:50|unique:autonomic_communities,code,{$autonomicCommunity->id}",
            'address_id' => 'nullable|exists:direccions,id',
        ]);

        $autonomicCommunity->update($validated);

        return redirect()->route('autonomic_communities.index')
                         ->with('success', 'Autonomic Community Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutonomicCommunity $autonomicCommunity)
    {
        $autonomicCommunity->delete();

        return redirect()->route('autonomic_communities.index')
                         ->with('success', 'Autonomic Community Deleted Successfully');
    }
}
