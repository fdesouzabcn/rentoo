@extends('layouts.app')

@section('title', 'Editar Propietario - ' . $owner->name . ' - Rentoo')

@section('content')
    {{-- Flash Messages --}}
    <x-flash-message />

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Editar Propietario</h1>
        <p class="text-slate-600 mt-1">Modificar información de: <strong>{{ $owner->name }}</strong></p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('owners.update', $owner) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Section: Personal Information --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Información Personal
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">
                            Nombre Completo <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $owner->name) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') @enderror"
                               placeholder="Ej: Juan García Martínez">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- DNI/NIE/TIE --}}
                    <div>
                        <label for="dni" class="block text-sm font-medium text-slate-700 mb-1">
                            DNI/NIE/TIE <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="dni"
                               name="dni"
                               value="{{ old('dni', $owner->dni) }}"
                               required
                               pattern="^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$"
                               maxlength="9"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 font-mono uppercase @error('dni') @enderror"
                               placeholder="Ej: 12345678A o X1234567L"
                               style="text-transform: uppercase;">
                        @error('dni')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500">Formato: 12345678A (DNI) o X1234567L (NIE)</p>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                            Correo Electrónico <span class="text-red-600">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $owner->email) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') @enderror"
                               placeholder="Ej: juan.garcia@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">
                            Teléfono <span class="text-red-600">*</span>
                        </label>
                        <input type="tel"
                               id="phone"
                               name="phone"
                               value="{{ old('phone', $owner->phone) }}"
                               required
                               maxlength="20"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('phone') @enderror"
                               placeholder="Ej: +34 612 345 678">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Address --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Dirección
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-slate-700 mb-1">
                            Calle y Número <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="address"
                               name="address"
                               value="{{ old('address', $owner->address) }}"
                               required
                               maxlength="250"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('address') @enderror"
                               placeholder="Ej: Calle Gran Vía, 123, 2º 1ª">
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- City --}}
                    <div>
                        <label for="city" class="block text-sm font-medium text-slate-700 mb-1">
                            Ciudad <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="city"
                               name="city"
                               value="{{ old('city', $owner->city) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('city') @enderror"
                               placeholder="Ej: Barcelona">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Postal Code --}}
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-slate-700 mb-1">
                            Código Postal <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="postal_code"
                               name="postal_code"
                               value="{{ old('postal_code', $owner->postal_code) }}"
                               required
                               maxlength="10"
                               pattern="[0-9]{5}"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('postal_code') @enderror"
                               placeholder="Ej: 08001">
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Province --}}
                    <div class="md:col-span-2">
                        <label for="province" class="block text-sm font-medium text-slate-700 mb-1">
                            Provincia <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="province"
                               name="province"
                               value="{{ old('province', $owner->province) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('province') @enderror"
                               placeholder="Ej: Barcelona">
                        @error('province')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex gap-3 pt-6 border-t border-slate-200">
                <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Actualizar Propietario
                </button>
                <a href="{{ route('owners.show', $owner) }}"
                   class="px-6 py-2.5 bg-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-300 transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    {{-- Additional Information --}}
    <div class="mt-6 grid grid-cols-1 gap-4">
        {{-- Record Info --}}
        {{-- <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
            <h3 class="text-sm font-semibold text-slate-700 mb-2">Información del Registro</h3>
            <dl class="space-y-1 text-sm">
                <div class="flex justify-between">
                    <dt class="text-slate-600">Creado:</dt>
                    <dd class="text-slate-900 font-medium">{{ $owner->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-600">Última actualización:</dt>
                    <dd class="text-slate-900 font-medium">{{ $owner->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div> --}}

        {{-- Warning about properties --}}
        @if($owner->properties()->count() > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-yellow-800">Propietario con propiedades</p>
                        <p class="text-yellow-700 mt-1">
                            Este propietario tiene {{ $owner->properties()->count() }}
                            {{ $owner->properties()->count() === 1 ? 'propiedad registrada' : 'propiedades registradas' }}.
                            Los cambios en los datos personales no afectarán las propiedades existentes, pero si los contratos en estado de "Borrador".
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
