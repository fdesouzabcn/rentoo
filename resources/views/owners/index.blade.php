@extends('layouts.app')

@section('title', 'Propietarios - Rentoo')

@section('content')
    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Propietarios</h1>
            <p class="text-slate-600 mt-1">
                {{ $owners->count() }} {{ $owners->count() === 1 ? 'propietario registrado' : 'propietarios registrados' }}
            </p>
        </div>

        {{-- Future: Add "Nuevo Propietario" button/CTA--}}
    </div>

    {{-- Owners Grid --}}
    @forelse($owners as $owner)
        @if($loop->first)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

        <x-owner-card :owner="$owner" />

        @if($loop->last)
            </div>
        @endif
    @empty
        {{-- Empty State --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>

            <h3 class="text-xl font-semibold text-slate-900 mb-2">
                No hay propietarios registrados
            </h3>

            <p class="text-slate-600 mb-6">
                Comienza agregando el primer propietario al sistema
            </p>

            {{-- Uncomment when create form exists --}}
            {{--
            <a href="{{ route('owners.create') }}"
               class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Propietario
            </a>
            --}}
        </div>
    @endforelse
@endsection
