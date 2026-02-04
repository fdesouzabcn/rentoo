<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::withCount('properties')
            ->orderBy('name', 'asc')
            ->get();
        if (request()->is('api/*')) {
            return response()->json([
                'total' => $owners->count(),
                'owners' => $owners
            ]);
        }
        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'dni' => [
            'required',
            'string',
            'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
            'unique:owners,dni'
            ],
            'email' => 'required|email|max:100|unique:owners,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',
        ]);
        $owner = Owner::create($validated);
        return redirect()->route('owners.show', $owner)
        ->with('success', 'Propietario creado exitosamente');
    }

    public function show(Owner $owner)
    {
        $owner->load ('properties');
        if (request()->is('api/*')) {
            return response()->json([
                'owner' => $owner,
                'properties_count' => $owner->properties->count()
            ]);
        }
        return view('owners.show', compact('owner'));
    }

    public function edit(Owner $owner)
{
    return view('owners.edit', compact('owner'));
}

    public function update(Request $request, Owner $owner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'dni' => [
            'required',
            'string',
            'regex:/^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
            'unique:owners,dni,' . $owner->id
            ],
            'email' => 'required|email|max:100|unique:owners,email,' . $owner->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:100',
        ]);
        $owner->update($validated);
        return redirect()->route('owners.show', $owner)
            ->with('success', 'Propietario actualizado exitosamente');
    }

    public function destroy(Owner $owner)
    {
        $propertiesCount = $owner->properties()->count();
        if ($propertiesCount > 0) {
            return redirect()->back()
                ->with('error', "No se puede eliminar este propietario porque tiene {$propertiesCount} " .
                       ($propertiesCount === 1 ? 'propiedad' : 'propiedades') . " registrada" .
                       ($propertiesCount === 1 ? '' : 's') . ". Por favor, elimínelas primero.");
        }
        $ownerName = $owner->name;
        $owner->delete();
        return redirect()->route('owners.index')
            ->with('success', "Propietario '{$ownerName}' eliminado exitosamente");
    }
}
