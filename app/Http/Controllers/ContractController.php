<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Property;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('property.owner')
            ->orderBy('status')
            ->orderByDesc('start_date')
            ->get();
        if (request()->is('api/*')){
            return response()->json([
                'total' => $contracts->count(),
                'contracts' => $contracts
            ]);
        }
        return view ('contracts.index', compact('contracts'));
    }

    public function create(Request $request)
    {
        $properties = Property::with('owner')
            ->orderBy('address', 'asc')
            ->get();
        $selectedPropertyId = $request->query('property_id');
        return view('contracts.create', compact('properties', 'selectedPropertyId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|uuid|exists:properties,id',
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
        $contract = Contract::create($validated);
        return redirect()->route('contracts.show', $contract)
            ->with('success', 'Contrato creado exitosamente');
    }

    public function show(Contract $contract)
    {
        $contract->load ('property.owner');
        if (request()->is('*api/*')){
            return response()->json([
                'contract' => $contract,
                'property' => $contract->property,
                'owner' => $contract->property->owner
            ]);
        }
        return view ('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $properties = Property::with('owner')
            ->orderBy('address', 'asc')
            ->get();
        $contract->load('property.owner');
        return view('contracts.edit', compact('contract', 'properties'));
    }

    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'property_id' => 'required|uuid|exists:properties,id',
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
        $contract->update($validated);
        return redirect()->route('contracts.show', $contract)
            ->with('success', 'Contrato actualizado exitosamente');
    }

    public function destroy(Contract $contract)
    {
        $contractId = $contract->id;
        $contract->delete();
        return redirect()->route('contracts.index')
            ->with('success', 'Contrato borrador eliminado exitosamente');
    }
}
