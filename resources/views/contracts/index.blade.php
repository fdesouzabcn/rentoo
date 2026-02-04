@extends('layouts.app')

@section('title', 'Contratos - Rentoo')

@section('content')
    {{-- Flash Messages --}}
    <x-flash-message />

    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Contratos</h1>
            <p class="text-slate-600 mt-1">
                {{ $contracts->count() }} {{ $contracts->count() === 1 ? 'contrato registrado' : 'contratos registrados' }}
            </p>
        </div>

    {{-- Create New Button --}}
    <a href="{{ route('contracts.create') }}"
       class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors shadow-sm hover:shadow-md">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Crear Nuevo Contrato
    </a>
    </div>

    {{-- Contracts Table --}}
    @if($contracts->isNotEmpty())
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Propiedad
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Propietario
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Inquilino(s)
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Inicio
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Renta
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-600 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($contracts as $contract)
                            <tr class="hover:bg-slate-50 transition-colors">
                                {{-- Property --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-slate-900">
                                        {{ $contract->property->address }}
                                    </div>
                                    <div class="text-xs text-slate-600">
                                        {{ $contract->property->city }}
                                    </div>
                                </td>

                                {{-- Owner --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm text-slate-900">
                                        {{ $contract->property->owner->name }}
                                    </div>
                                </td>

                                {{-- Tenant(s) --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm text-slate-900">
                                        {{ $contract->tenant1_name }}
                                    </div>
                                    @if($contract->tenant2_name)
                                        <div class="text-sm text-slate-900">
                                            {{ $contract->tenant2_name }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Start Date --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm text-slate-900">
                                        {{ $contract->start_date->format('d/m/Y') }}
                                    </div>
                                </td>

                                {{-- Monthly Rent --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-slate-900">
                                        {{ number_format($contract->monthly_rent, 2, ',', '.') }} €
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    <x-status-badge :status="$contract->status" />
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('contracts.show', $contract) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-700 transition-colors">
                                        Ver
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <h3 class="text-xl font-semibold text-slate-900 mb-2">
                No hay contratos registrados
            </h3>

            <p class="text-slate-600 mb-6">
                Comienza creando el primer contrato de alquiler
            </p>
        </div>
    @endif
@endsection
