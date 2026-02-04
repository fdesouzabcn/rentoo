<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Owner;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('owner')
            ->withCount('contracts')
            ->orderBy('city','asc')
            ->get();
        if (request()->is('api/*')){
            return response()->json([
                'total' => $properties->count(),
                'properties' => $properties
            ]);
        }
        return view ('properties.index', compact('properties'));
    }

    public function create(Request $request)
    {
        $owners = Owner::orderBy('name', 'asc')->get();
        $selectedOwnerId = $request->query('owner_id');
        return view('properties.create', compact('owners', 'selectedOwnerId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|uuid|exists:owners,id',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',
            'cadastral_reference' => 'required|string|max:100|regex:/^[A-Z0-9]{20}$/i|unique:properties,cadastral_reference',
            'surface_area' => 'required|numeric|min:10|max:9999.99',
            'bedrooms' => 'required|integer|min:0|max:255',
            'bathrooms' => 'required|integer|min:0|max:255',
            'description' => 'nullable|string|max:1000',
            'energy_certificate_rating' => 'required|in:A,B,C,D,E,F,G',
            'energy_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'energy_certificate_expiry' => 'required|date|after:today',
            'habitability_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'habitability_certificate_expiry' => 'required|date|after:today',
            'last_rent_amount' => 'nullable|numeric|min:0|max:999999.99',
            'ibi_annual_amount' => 'nullable|numeric|min:0|max:999999.99',
            'community_fees_monthly' => 'nullable|numeric|min:0|max:999999.99',
            'garbage_fees_annual' => 'nullable|numeric|min:0|max:999999.99',
        ]);
        $property = Property::create($validated);
        return redirect()->route('properties.show', $property)
            ->with('success', 'Propiedad creada exitosamente');
    }

    public function show(Property $property)
    {
        $property->load ('owner','contracts');
        if (request()->is('api/*')){
            return response()->json([
            'property' => $property,
            'owner' => $property->owner,
            'contracts_count' => $property->contracts->count()
            ]);
        }
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $owners = Owner::orderBy('name', 'asc')->get();
        return view('properties.edit', compact('property', 'owners'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'owner_id' => 'required|uuid|exists:owners,id',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',
            'cadastral_reference' => 'required|string|max:100|regex:/^[A-Z0-9]{20}$/i|unique:properties,cadastral_reference,' . $property->id,
            'surface_area' => 'required|numeric|min:10|max:9999.99',
            'bedrooms' => 'required|integer|min:0|max:255',
            'bathrooms' => 'required|integer|min:0|max:255',
            'description' => 'nullable|string|max:1000',
            'energy_certificate_rating' => 'required|in:A,B,C,D,E,F,G',
            'energy_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'energy_certificate_expiry' => 'required|date|after:today',
            'habitability_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'habitability_certificate_expiry' => 'required|date|after:today',
            'last_rent_amount' => 'nullable|numeric|min:0|max:999999.99',
            'ibi_annual_amount' => 'nullable|numeric|min:0|max:999999.99',
            'community_fees_monthly' => 'nullable|numeric|min:0|max:999999.99',
            'garbage_fees_annual' => 'nullable|numeric|min:0|max:999999.99',
        ]);
        $property->update($validated);
        return redirect()->route('properties.show', $property)
            ->with('success', 'Propiedad actualizada exitosamente');
    }

    public function destroy(Property $property)
    {
        $contractsCount = $property->contracts()->count();
        if ($contractsCount > 0) {
            return redirect()->back()
                ->with('error', "No se puede eliminar esta propiedad porque tiene {$contractsCount} " .
                       ($contractsCount === 1 ? 'contrato' : 'contratos') . ". Por favor, elimínelo" .
                       ($contractsCount === 1 ? '' : 's') . " primero.");
        }
        $propertyAddress = $property->address;
        $property->delete();
        return redirect()->route('properties.index')
            ->with('success', "Propiedad '{$propertyAddress}' eliminada exitosamente");
    }
}
