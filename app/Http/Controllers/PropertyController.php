<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Find all properties from database, ordered by city then address
        $properties = Property::with('owner')
            ->orderBy('city')
            ->orderBy('address')
            ->get();

        // Return as JSON for now - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'total' => $properties->count(),
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Create will be implemented later'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            // Foreign key
            'owner_id' => 'required|uuid|exists:owners,id',

            // Property address
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',

            // Property details
            'cadastral_reference' => 'required|string|max:100|regex:/^[A-Z0-9]{20}$/i|unique:properties,cadastral_reference',
            'surface_area' => 'required|numeric|min:10|max:9999.99',
            'bedrooms' => 'required|integer|min:0|max:255',
            'bathrooms' => 'required|integer|min:0|max:255',
            'description' => 'nullable|string|max:1000',

            // Certificates
            'energy_certificate_rating' => 'required|in:A,B,C,D,E,F,G',
            'energy_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'energy_certificate_expiry' => 'required|date|after:today',
            'habitability_certificate_number' => 'required|string|max:50|regex:/^[A-Z0-9]+$/i',
            'habitability_certificate_expiry' => 'required|date|after:today',

            // Financial details
            'last_rent_amount' => 'nullable|numeric|min:0|max:999999.99',
            'ibi_annual_amount' => 'nullable|numeric|min:0|max:999999.99',
            'community_fees_monthly' => 'nullable|numeric|min:0|max:999999.99',
            'garbage_fees_annual' => 'nullable|numeric|min:0|max:999999.99',
        ]);

        // Create the property
        $property = Property::create($validated);

        // Load owner relationship for response
        $property->load('owner');

        // Return success response with created property
        return response()->json([
            'message' => 'Property created successfully',
            'property' => $property
        ], 201); // Created
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        // Load owners and contracts relationship
        $property->load ('owner','contracts');

        // Return as JSON for now - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'property' => $property,
            'owner' => $property->owner,
            'contracts_count' => $property->contracts->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Edit logic will be implemented later',
            'property' => $property
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Validate incoming request data
        // Note: unique validation must ignore current property's record
        $validated = $request->validate([
            // Foreign key (FK)
            'owner_id' => 'required|uuid|exists:owners,id',

            // Property address
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',

            // Property details
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

        // Update the property
        $property->update($validated);

        // Load owner relationship for response
        $property->load('owner');

        // Return success response with updated property
        return response()->json([
            'message' => 'Property updated successfully',
            'property' => $property->fresh(['owner']) // Reload to get updated data
        ], 200); // OK - successful
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        // Check if property has contracts (cascade delete protection)
        $contractsCount = $property->contracts()->count();

        if ($contractsCount > 0) {
            return response()->json([
                'message' => 'Cannot delete property with existing contracts',
                'error' => "This property has {$contractsCount} contract" . ($contractsCount === 1 ? '' : 's') . ". Please delete them first.",
                'contracts_count' => $contractsCount
            ], 409); // 409 Business Logic - Conflict
        }

        // Safe to delete - no dependent records
        $propertyAddress = $property->address;
        $property->delete();

        return response()->json([
            'message' => 'Property deleted successfully',
            'deleted_property' => $propertyAddress
        ], 200); // OK - successful
    }
}
