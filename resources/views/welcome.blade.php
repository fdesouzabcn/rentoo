@extends('layouts.app')

@section('title', 'Rentoo - Sistema de Gestión de Alquileres')

@section('content')
    {{-- Hero Section --}}
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6">
            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </div>

        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
            Bienvenido a Rentoo
        </h1>

        <p class="text-xl text-slate-600 max-w-fit mx-auto mb-8">
            Sistema integral de gestión de alquileres residenciales para propietarios en España
        </p>

        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm text-blue-800 font-medium">
                Cumplimiento con LAU y normativa catalana de vivienda
            </span>
        </div>
    </div>

    {{-- Features Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

        {{-- Propietarios Card --}}
        <x-feature-card
            title="Propietarios"
            description="Gestiona la información completa de los propietarios: datos personales, DNI/NIE/TIE, datos de contacto y direcciones fiscales."
            color="green"
            route="owners.index"
            button-text="Ver Propietarios">

            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </x-slot>

            <x-slot name="checklist">
                <x-check-list-item color="green">
                    Validación de DNI/NIE/TIE español
                </x-check-list-item>
                <x-check-list-item color="green">
                    Gestión de múltiples propiedades
                </x-check-list-item>
                <x-check-list-item color="green">
                    Perfiles completos y actualizables
                </x-check-list-item>
            </x-slot>
        </x-feature-card>

        {{-- Propiedades Card --}}
        <x-feature-card
            title="Propiedades"
            description="Gestiona el inventario de inmuebles con todos los detalles técnicos, legales y certificaciones exigidas por la normativa española."
            color="blue"
            route="properties.index"
            button-text="Ver Propiedades">

            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </x-slot>

            <x-slot name="checklist">
                <x-check-list-item color="blue">
                    Referencias catastrales validadas
                </x-check-list-item>
                <x-check-list-item color="blue">
                    Certificados energéticos y habitabilidad
                </x-check-list-item>
                <x-check-list-item color="blue">
                    Gestión de gastos (IBI, comunidad)
                </x-check-list-item>
            </x-slot>
        </x-feature-card>

        {{-- Contratos Card --}}
        <x-feature-card
            title="Contratos"
            description="Genera contratos de arrendamiento conformes con la LAU, incluyendo cláusulas específicas y documentos listos para imprimir."
            color="purple"
            route="contracts.index"
            button-text="Ver Contratos">

            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </x-slot>

            <x-slot name="checklist">
                <x-check-list-item color="purple">
                    Conformes con LAU vigente
                </x-check-list-item>
                <x-check-list-item color="purple">
                    Cálculo automático de depósitos
                </x-check-list-item>
                <x-check-list-item color="purple">
                    Documentos imprimibles y firmables
                </x-check-list-item>
            </x-slot>
        </x-feature-card>
    </div>

    {{-- Key Features Section --}}
    <div class="bg-linear-to-br from-slate-50 to-slate-100 rounded-xl p-8 mb-12">
        <h2 class="text-3xl font-bold text-slate-900 text-center mb-8">
            Características Principales
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-key-feature-item
                title="Cumplimiento Legal"
                description="Validación automática de documentos conforme a la normativa española y catalana"
                color="blue">

                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </x-slot>
            </x-key-feature-item>

            <x-key-feature-item
                title="Ahorro de Tiempo"
                description="Genera contratos completos en minutos, no en horas"
                color="green">

                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </x-slot>
            </x-key-feature-item>

            <x-key-feature-item
                title="Gestión Centralizada"
                description="Toda la información de alquileres en un solo lugar"
                color="purple">

                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </x-slot>
            </x-key-feature-item>

            <x-key-feature-item
                title="Documentos Profesionales"
                description="Contratos listos para imprimir con formato legal estándar"
                color="amber">

                <x-slot name="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </x-slot>
            </x-key-feature-item>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-stat-card
            value="65+"
            label="Propietarios Registrados"
            color="green" />

        <x-stat-card
            value="98+"
            label="Propiedades Gestionadas"
            color="blue" />

        <x-stat-card
            value="130+"
            label="Contratos Generados"
            color="purple" />
    </div>
@endsection
