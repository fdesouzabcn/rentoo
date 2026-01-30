@extends('layouts.app')

@section('title', 'Rentoo - Sistema de Gestión de Contratos de Alquiler')

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

        <p class="text-xl text-slate-600 max-w-2xl mx-auto mb-8">
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
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-semibold text-slate-900 mb-3">
                    Propietarios
                </h2>

                <p class="text-slate-600 mb-4 leading-relaxed">
                    Gestiona la información completa de los propietarios: datos personales, DNI/NIE/TIE, datos de contacto y direcciones fiscales.
                </p>

                <ul class="space-y-2 mb-6">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Validación de DNI/NIE/TIE español</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Gestión de múltiples propiedades</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Perfiles completos y actualizables</span>
                    </li>
                </ul>

                <a href="{{ route('owners.index') }}"
                   class="inline-flex items-center justify-center w-full px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                    Ver Propietarios
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Propiedades Card --}}
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-semibold text-slate-900 mb-3">
                    Propiedades
                </h2>

                <p class="text-slate-600 mb-4 leading-relaxed">
                    Administra el inventario de propiedades con todos los detalles técnicos, legales y certificaciones requeridas por la normativa española.
                </p>

                <ul class="space-y-2 mb-6">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Referencias catastrales validadas</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Certificados energéticos y habitabilidad</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Gestión de gastos (IBI, comunidad)</span>
                    </li>
                </ul>

                <a href="{{ route('properties.index') }}"
                   class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Ver Propiedades
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Contratos Card --}}
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-semibold text-slate-900 mb-3">
                    Contratos
                </h2>

                <p class="text-slate-600 mb-4 leading-relaxed">
                    Genera contratos de arrendamiento conformes con la LAU, incluyendo cláusulas específicas y documentos listos para imprimir.
                </p>

                <ul class="space-y-2 mb-6">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Conformes con LAU vigente</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Cálculo automático de depósitos</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-slate-700">Documentos imprimibles y firmables</span>
                    </li>
                </ul>

                <a href="{{ route('contracts.index') }}"
                   class="inline-flex items-center justify-center w-full px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                    Ver Contratos
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Key Features Section --}}
    <div class="bg-linear-to-br from-slate-50 to-slate-100 rounded-xl p-8 mb-12">
        <h2 class="text-3xl font-bold text-slate-900 text-center mb-8">
            Características Principales
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 mb-1">Cumplimiento Legal</h3>
                    <p class="text-sm text-slate-600">Validación automática de documentos conforme a la normativa española y catalana</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 mb-1">Ahorro de Tiempo</h3>
                    <p class="text-sm text-slate-600">Genera contratos completos en minutos, no en horas</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 mb-1">Gestión Centralizada</h3>
                    <p class="text-sm text-slate-600">Toda la información de alquileres en un solo lugar</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900 mb-1">Documentos Profesionales</h3>
                    <p class="text-sm text-slate-600">Contratos listos para imprimir con formato legal estándar</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-green-600 mb-2">10+</div>
            <div class="text-sm text-slate-600">Propietarios Registrados</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-blue-600 mb-2">19+</div>
            <div class="text-sm text-slate-600">Propiedades Gestionadas</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-purple-600 mb-2">34+</div>
            <div class="text-sm text-slate-600">Contratos Generados</div>
        </div>
    </div>
@endsection
