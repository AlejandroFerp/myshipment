<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Http\Request;

class WastesController extends Controller
{
    public function index()
    {
        $wastes = Waste::all();
        return view('wastes.index', compact('wastes'));
    }

    public function create()
    {
        return view('wastes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lers' => 'nullable|string|max:50',
            'code' => 'required|string|max:50|unique:wastes,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Waste::create($validated);

        return redirect()->route('wastes.index')
                         ->with('success', 'Waste Added Successfully');
    }

    public function edit(Waste $waste)
    {
        return view('wastes.edit', compact('waste'));
    }

    public function update(Request $request, Waste $waste)
    {
        $validated = $request->validate([
            'lers' => 'nullable|string|max:50',
            'code' => "required|string|max:50|unique:wastes,code,{$waste->id}",
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $waste->update($validated);

        return redirect()->route('wastes.index')
                         ->with('success', 'Waste Updated Successfully');
    }

    public function destroy(Waste $waste)
    {
        $waste->delete();
        return redirect()->route('wastes.index')
                         ->with('success', 'Waste Deleted Successfully');
    }
}
