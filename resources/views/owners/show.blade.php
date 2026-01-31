@extends('layouts.app')

@section('title', $owner->name . ' - Propietarios - Rentoo')

@section('content')
    {{-- Action Buttons --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('owners.index') }}"
           class="inline-flex items-center px-4 py-2 bg-slate-600 text-white font-medium rounded-lg hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver a Propietarios
        </a>

        {{-- Edit and Delete buttons --}}
        {{--
        <a href="{{ route('owners.edit', $owner) }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Editar
        </a>

        <button onclick="confirmDelete()"
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Eliminar
        </button>
        --}}
    </div>

    {{-- Owner Profile Card --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        {{-- Header with Icon --}}
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-200">
            <div class="flex items-center justify-center w-20 h-20 bg-green-100 rounded-full shrink-0">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">{{ $owner->name }}</h1>
                <p class="text-slate-600 mt-1">Información del Propietario</p>
            </div>
        </div>

        {{-- Information Sections --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Personal Information --}}
            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Información Personal
                </h2>

                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-600">Nombre Completo</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $owner->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">DNI/NIE/TIE</dt>
                        <dd class="text-base text-slate-900 mt-1 font-mono">{{ $owner->dni }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Correo Electrónico</dt>
                        <dd class="text-base text-slate-900 mt-1">
                            <a href="mailto:{{ $owner->email }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                                {{ $owner->email }}
                            </a>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Teléfono</dt>
                        <dd class="text-base text-slate-900 mt-1">
                            <a href="tel:{{ $owner->phone }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                                {{ $owner->phone }}
                            </a>
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Address Information --}}
            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Dirección
                </h2>

                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-slate-600">Calle</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $owner->address }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Ciudad</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $owner->city }} ({{ $owner->postal_code }})</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-slate-600">Provincia</dt>
                        <dd class="text-base text-slate-900 mt-1">{{ $owner->province }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    {{-- Properties Section --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Propiedades ({{ $owner->properties->count() }})
        </h2>

        @forelse($owner->properties as $property)
            @if($loop->first)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @endif

            {{-- Property Card --}}
            <div class="border border-slate-200 rounded-lg p-6 hover:border-green-300 hover:shadow-md transition-all">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <h3 class="font-semibold text-slate-900">{{ $property->address }}</h3>
                    </div>
                </div>

                <p class="text-sm text-slate-600 mb-3">
                    {{ $property->city }}, {{ $property->province }}
                </p>

                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                        </svg>
                        {{ number_format($property->surface_area, 0) }} m²
                    </span>

                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        {{ $property->bedrooms }} {{ $property->bedrooms === 1 ? 'habitación' : 'habitaciones' }}
                    </span>

                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                        {{ $property->bathrooms }} {{ $property->bathrooms === 1 ? 'baño' : 'baños' }}
                    </span>
                </div>

                <a href="{{ route('properties.show', $property) }}"
                   class="inline-flex items-center text-sm text-green-600 hover:text-green-700 font-medium">
                    Ver Detalles
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            @if($loop->last)
                </div>
            @endif
        @empty
            {{-- Empty State --}}
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>

                <p class="text-slate-600 italic">
                    Este propietario no tiene propiedades registradas
                </p>

                {{--
                <a href="{{ route('properties.create', ['owner_id' => $owner->id]) }}"
                   class="inline-flex items-center mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear Propiedad
                </a>
                --}}
            </div>
        @endforelse
    </div>
@endsection
