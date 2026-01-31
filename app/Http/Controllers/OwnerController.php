<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource (all owners in DB).
     */
    public function index()
    {
        //Find all owners from database, ordered by name, with properties count
        $owners = Owner::withCount('properties')
            ->orderBy('name', 'asc')
            ->get();

        // API route - return JSON
        if (request()->is('api/*')) {
            return response()->json([
                'total' => $owners->count(),
                'owners' => $owners
            ]);
        }

        // Web route - return Blade view
        return view('owners.index', compact('owners'));
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
     * Store a newly created resource (POST) in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'dni' => 'required|string|regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i|unique:owners,dni',
            'email' => 'required|email|max:100|unique:owners,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',
        ]);

        // Create the owner (DNI will be auto-uppercased by model mutator)
        $owner = Owner::create($validated);

        // Return success response with created owner
        return response()->json([
            'message' => 'Owner created successfully',
            'owner' => $owner
        ], 201); // 201 New Record - OK
    }

    /**
     * Display the specified resource (a specific owner data).
     */
    public function show(Owner $owner)
    {
        // Load owners properties
        $owner->load ('properties');

        // API route - return JSON
        if (request()->is('api/*')) {
            return response()->json([
                'owner' => $owner,
                'properties_count' => $owner->properties->count()
            ]);
        }

        // Web route - return Blade view
        return view('owners.show', compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Edit logic will be implemented later',
            'owner' => $owner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        // Validate incoming request data
        // Note: unique validation must ignore current owner's record
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'dni' => 'required|string|regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i|unique:owners,dni,' . $owner->id,
            'email' => 'required|email|max:100|unique:owners,email,' . $owner->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',
        ]);

        // Update the owner (DNI will be auto-uppercased by model mutator)
        $owner->update($validated);

        // Return success response with updated owner
        return response()->json([
            'message' => 'Owner updated successfully',
            'owner' => $owner->fresh() // Reload to get updated data
        ], 200); //Updated record - OK
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        // Check if owner has properties (cascade delete protection)
        $propertiesCount = $owner->properties()->count();

        if ($propertiesCount > 0) {
            return response()->json([
                'message' => 'Cannot delete owner with existing properties',
                'error' => "This owner has {$propertiesCount} propert" . ($propertiesCount === 1 ? 'y' : 'ies') . ". Please delete or reassign them first.",
                'properties_count' => $propertiesCount
            ], 409); // 409 Business Logic - Conflict
        }

        // Safe to delete - no dependent records
        $ownerName = $owner->name;
        $owner->delete();

        return response()->json([
            'message' => 'Owner deleted successfully',
            'deleted_owner' => $ownerName
        ], 200); //Deleted record- OK
    }
}
