<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with('property.owner')
            ->orderBy('status')
            ->orderByDesc('start_date')
            ->get();

        // Return as JSON for now - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'total' => $contracts->count(),
            'contracts' => $contracts
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
    public function show(Contract $contract)
    {
        // Load property and owner relationship
        $contract->load ('property.owner');

        // Return as JSON for now - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'contract' => $contract,
            'property' => $contract->property,
            'owner' => $contract->property->owner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Edit form will be implemented later',
            'contract' => $contract
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Update logic will be implemented later',
            'contract_id' => $contract->id,
            'received_data' => $request->all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        // Return a JSON placeholder - It will be implemented later with the views - (TO BE UPDATED LATER)
        return response()->json([
            'message' => 'Delete logic will be implemented later',
            'contract_id' => $contract->id
        ]);
    }
}
