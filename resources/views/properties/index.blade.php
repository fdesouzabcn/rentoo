@extends('layouts.app')

@section('title', 'Propiedades - Rentoo')

@section('content')
    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Propiedades</h1>
            <p class="text-slate-600 mt-1">
                {{ $properties->count() }} {{ $properties->count() === 1 ? 'propiedad registrada' : 'propiedades registradas' }}
            </p>
        </div>

        {{-- Add "Crear Nueva Propiedad" button --}}
    </div>

    {{-- Properties Grid --}}
    @forelse($properties as $property)
        @if($loop->first)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

        <x-property-card :property="$property" />

        @if($loop->last)
            </div>
        @endif
    @empty
        {{-- Empty State --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>

            <h3 class="text-xl font-semibold text-slate-900 mb-2">
                No hay propiedades registradas
            </h3>

            <p class="text-slate-600 mb-6">
                Comienza agregando la primera propiedad al sistema
            </p>

            {{-- Uncomment when create form exists --}}
            {{--
            <a href="{{ route('properties.create') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Propiedad
            </a>
            --}}
        </div>
    @endforelse
@endsection
