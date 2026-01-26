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
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Store logic will be implemented later',
            'received_data' => $request->all()
        ]);
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
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Update logic will be implemented later',
            'property_id' => $property->id,
            'received_data' => $request->all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
        'message' => 'Delete logic will be implemented later',
        'property_id' => $property->id
        ]);
    }
}
