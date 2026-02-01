@extends('layouts.app')

@section('title', $property->address . ' - Propiedades - Rentoo')

@section('content')
    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('properties.index') }}"
           class="inline-flex items-center px-4 py-2 bg-slate-600 text-white font-medium rounded-lg hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a Propiedades
        </a>

        {{-- Add Edit and Delete buttons --}}

    </div>

    {{-- Property Details Card --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        {{-- Header with Icon --}}
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-200">
            <div class="flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full shrink-0">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">{{ $property->address }}</h1>
                <p class="text-slate-600 mt-1">{{ $property->city }}, {{ $property->province }}</p>
            </div>
        </div>

        {{-- Property Information Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Basic Information --}}
            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Información Básica
                </h2>

                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-600">Dirección</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $property->address }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Ciudad</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $property->city }} ({{ $property->postal_code }})</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Provincia</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $property->province }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Referencia Catastral</dt>
                        <dd class="text-sm text-slate-900 mt-1 font-mono">{{ $property->cadastral_reference }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Physical Characteristics --}}
            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                    Características
                </h2>

                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-600">Superficie</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ number_format($property->surface_area, 2, ',', '.') }} m²</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Habitaciones</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $property->bedrooms }} {{ $property->bedrooms === 1 ? 'habitación' : 'habitaciones' }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Baños</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $property->bathrooms }} {{ $property->bathrooms === 1 ? 'baño' : 'baños' }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Planta</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $property->floor }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- Owner Information Card --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Propietario
        </h2>

        <div class="border border-slate-200 rounded-lg p-6 bg-slate-50">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-slate-900 text-lg mb-3">{{ $property->owner->name }}</h3>
                    <dl class="space-y-2">
                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                            <span class="text-slate-600 font-mono">{{ $property->owner->dni }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $property->owner->email }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                                {{ $property->owner->email }}
                            </a>
                        </div>

                        <div class="flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ $property->owner->phone }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                                {{ $property->owner->phone }}
                            </a>
                        </div>
                    </dl>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('owners.show', $property->owner) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                        Ver Perfil Completo
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Certificates and Legal --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Certificados y Documentación
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Energy Certificate --}}
            <div class="border border-slate-200 rounded-lg p-4">
                <h3 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <span class="flex items-center justify-center w-8 h-8 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </span>
                    Certificado Energético
                </h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-xs font-medium text-slate-600">Número</dt>
                        <dd class="text-sm text-slate-900 font-mono">{{ $property->energy_certificate_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-600">Calificación</dt>
                        <dd class="text-sm">
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 font-bold rounded">
                                {{ $property->energy_certificate_rating }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-600">Vencimiento</dt>
                        <dd class="text-sm text-slate-900">{{ $property->energy_certificate_expiry->format('d/m/Y') }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Habitability Certificate --}}
            <div class="border border-slate-200 rounded-lg p-4">
                <h3 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </span>
                    Cédula de Habitabilidad
                </h3>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-xs font-medium text-slate-600">Número</dt>
                        <dd class="text-sm text-slate-900 font-mono">{{ $property->habitability_certificate_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-slate-600">Vencimiento</dt>
                        <dd class="text-sm text-slate-900">{{ $property->habitability_certificate_expiry->format('d/m/Y') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- Financial Information --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Información Financiera
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <dt class="text-sm font-medium text-slate-600 mb-1">IBI Anual</dt>
                <dd class="text-2xl font-bold text-slate-900">{{ number_format($property->ibi_annual_amount, 2, ',', '.') }} €</dd>
            </div>

            <div>
                <dt class="text-sm font-medium text-slate-600 mb-1">Gastos de Comunidad (mensual)</dt>
                <dd class="text-2xl font-bold text-slate-900">{{ number_format($property->community_fees_monthly, 2, ',', '.') }} €</dd>
            </div>

            <div>
                <dt class="text-sm font-medium text-slate-600 mb-1">Tasa de Basura (anual)</dt>
                <dd class="text-2xl font-bold text-slate-900">{{ number_format($property->garbage_fees_annual, 2, ',', '.') }} €</dd>
            </div>
        </div>
    </div>

    {{-- Contracts Section --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Contratos ({{ $property->contracts->count() }})
        </h2>

        @forelse($property->contracts as $contract)
            @if($loop->first)
                <div class="space-y-4">
            @endif

            {{-- Contract Card --}}
            <div class="border border-slate-200 rounded-lg p-6 hover:border-blue-300 hover:shadow-md transition-all">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <h3 class="font-semibold text-slate-900 text-lg">
                                Contrato con {{ $contract->tenant1_name }}
                                @if($contract->tenant2_name)
                                    y {{ $contract->tenant2_name }}
                                @endif
                            </h3>

                            {{-- Status Badge --}}
                            <x-status-badge :status="$contract->status" />
                            {{-- @if($contract->status === 'draft')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                    BORRADOR
                                </span>
                            @elseif($contract->status === 'active')
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    ACTIVO
                                </span>
                            @elseif($contract->status === 'finalized')
                                <span class="px-3 py-1 bg-gray-200 text-gray-800 text-xs font-semibold rounded-full">
                                    FINALIZADO
                                </span>
                            @endif --}}
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-slate-600">Inicio:</span>
                                <span class="text-slate-900 font-medium">{{ $contract->start_date?->format('d/m/Y') ?? 'No especificado' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-600">Fin:</span>
                                <span class="text-slate-900 font-medium">{{ $contract->end_date?->format('d/m/Y') ?? 'Indefinido' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-600">Renta mensual:</span>
                                <span class="text-slate-900 font-bold">{{ number_format($contract->monthly_rent, 2, ',', '.') }} €</span>
                            </div>
                            <div>
                                <span class="text-slate-600">Fianza:</span>
                                <span class="text-slate-900 font-medium">{{ number_format($contract->legal_deposit, 2, ',', '.') }} €</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contracts.show', $contract) }}"
                       class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors whitespace-nowrap">
                        Ver Contrato
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            @if($loop->last)
                </div>
            @endif
        @empty
            {{-- Empty State --}}
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>

                <p class="text-slate-600 italic">
                    Esta propiedad no tiene contratos registrados
                </p>
            </div>
        @endforelse
    </div>
@endsection
