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
        //Find all owners from database, ordered by name
        $owners = Owner::orderBy('name','asc')->get();

        // Return as JSON for now - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'total' => $owners->count(),
            'owners' => $owners
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
     * Display the specified resource (a specific owner data).
     */
    public function show(Owner $owner)
    {
        // Load owners properties
        $owner->load ('properties');

        // Return as JSON for now - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'owner' => $owner,
            'properties_count' => $owner->properties->count()
        ]);
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
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Update logic will be implemented later',
            'owner_id' => $owner->id,
            'received_data' => $request->all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
        'message' => 'Delete logic will be implemented later',
        'owner_id' => $owner->id
        ]);
    }
}
