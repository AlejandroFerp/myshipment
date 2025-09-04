<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalAuthorization;
use Illuminate\Http\Request;

class EnvironmentalAuthorizationController extends Controller
{
    public function index()
    {
        $envAuths = EnvironmentalAuthorization::all();
        return view('environmental_authorizations.index', compact('envAuths'));
    }

    public function create()
    {
        // Traer todos los modelos relacionados para los picklists
        $autorizaciones = \App\Models\Autorizacion::all();
        $centers = \App\Models\Centro::all();
        $autonomicCommunities = \App\Models\AutonomicCommunity::all();
        $typeOfAuthorizations = \App\Models\Autorizacion::all();
        $wastes = \App\Models\Waste::all();

        return view('autorizaciones_medioambientales.create', compact(
            'autorizaciones',
            'centers',
            'autonomicCommunities',
            'typeOfAuthorizations',
            'wastes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'autorizacion_id' => 'required|exists:autorizaciones,id',
            'center_id' => 'required|exists:centers,id',
            'code' => 'required|unique:environmental_authorizations,code',
            'autonomic_community_id' => 'required|exists:autonomic_communities,id',
            'type_of_authorization_id' => 'required|exists:type_of_authorizations,id',
            'waste_id' => 'required|exists:wastes,id',
            'lers' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:10240', // max 10MB
        ]);

        $data = $request->all();

        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
        }

        EnvironmentalAuthorization::create($data);

        return redirect()->route('environmental_authorizations.index')
                         ->with('success', 'Environmental Authorization Added Successfully');
    }
}
