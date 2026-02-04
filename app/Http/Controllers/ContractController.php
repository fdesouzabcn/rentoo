<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Property;
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

         // Api route - return JSON
        if (request()->is('api/*')){
            return response()->json([
                'total' => $contracts->count(),
                'contracts' => $contracts
            ]);
        }

        // Web route - return Blade view
        return view ('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Get all properties with their owners for dropdown
        $properties = Property::with('owner')
            ->orderBy('address', 'asc')
            ->get();

        // Check if property_id was passed via query string (?property_id=xxx)
        $selectedPropertyId = $request->query('property_id');

        return view('contracts.create', compact('properties', 'selectedPropertyId'));
    }
// ========================================================================================================
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            // Foreign key (FK)
            'property_id' => 'required|uuid|exists:properties,id',

            // Contract Specific Details
            'status' => 'required|in:draft,active,finalized',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',

            'monthly_rent' => 'required|numeric|min:0|max:999999.99',
            'legal_deposit' => 'required|numeric|min:0|max:999999.99',
            'additional_deposit' => 'nullable|numeric|min:0|max:999999.99',

            'tenant_pays_ibi' => 'boolean',
            'tenant_pays_community_fees' => 'boolean',
            'tenant_pays_garbage_fees' => 'boolean',

            'irpa_value' => 'nullable|numeric|min:0|max:999999.99',
            'is_tensioned_area' => 'boolean',

            // Tenants
            'tenant1_name' => 'required|string|max:100',
            'tenant1_dni' => [
                'required',
                'string',
                'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i'
            ],
            'tenant1_email' => 'required|email|max:100',
            'tenant1_phone' => 'required|string|max:20',
            'tenant2_name' => 'nullable|string|max:100',
            'tenant2_dni' => [
                'nullable',
                'string',
                'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                'required_with:tenant2_name'
            ],
            'tenant2_email' => 'nullable|email|max:100',
            'tenant2_phone' => 'nullable|string|max:20',
        ]);

        // Create the contract (tenant DNIs will be auto-uppercased)
        $contract = Contract::create($validated);

        // Redirect to show page with success message
        return redirect()->route('contracts.show', $contract)
            ->with('success', 'Contrato creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        // Load property and owner relationship
        $contract->load ('property.owner');

        // Api route - return JSON
        if (request()->is('*api/*')){
            return response()->json([
                'contract' => $contract,
                'property' => $contract->property,
                'owner' => $contract->property->owner
            ]);
        }

        // Web route - return Blade view
        return view ('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        // Get all properties with their owners for dropdown
        $properties = Property::with('owner')
            ->orderBy('address', 'asc')
            ->get();

        // Load the contract's property and owner relationship
        $contract->load('property.owner');

        return view('contracts.edit', compact('contract', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        // Validate incoming request data
        $validated = $request->validate([
            // Foreign key
            'property_id' => 'required|uuid|exists:properties,id',

            // Contract Specific Details
            'status' => 'required|in:draft,active,finalized',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',

            'monthly_rent' => 'required|numeric|min:0|max:999999.99',
            'legal_deposit' => 'required|numeric|min:0|max:999999.99',
            'additional_deposit' => 'nullable|numeric|min:0|max:999999.99',

            'tenant_pays_ibi' => 'boolean',
            'tenant_pays_community_fees' => 'boolean',
            'tenant_pays_garbage_fees' => 'boolean',

            'irpa_value' => 'nullable|numeric|min:0|max:999999.99',
            'is_tensioned_area' => 'boolean',

            // Tenants
            'tenant1_name' => 'required|string|max:100',
            'tenant1_dni' => [
                'required',
                'string',
                'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i'
            ],
            'tenant1_email' => 'required|email|max:100',
            'tenant1_phone' => 'required|string|max:20',

            'tenant2_name' => 'nullable|string|max:100',
            'tenant2_dni' => [
                'nullable',
                'string',
                'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
                'required_with:tenant2_name'
            ],
            'tenant2_email' => 'nullable|email|max:100',
            'tenant2_phone' => 'nullable|string|max:20',
        ]);

        // Update the contract
        $contract->update($validated);

        // Redirect to show page with success message
        return redirect()->route('contracts.show', $contract)
            ->with('success', 'Contrato actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        // Safe to delete
        $contractId = $contract->id;
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contrato borrador eliminado exitosamente');
    }
}
