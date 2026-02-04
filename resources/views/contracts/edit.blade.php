@extends('layouts.app')

@section('title', 'Editar Contrato - ' . $contract->property->address . ' - Rentoo')

@section('content')
    {{-- Flash Messages --}}
    <x-flash-message />

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Editar Contrato</h1>
        <p class="text-slate-600 mt-1">Modificar información del contrato: <strong>{{ $contract->property->address }}</strong></p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('contracts.update', $contract) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Section: Property Selection --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Propiedad
                </h2>

                <div class="space-y-4">
                    <div>
                        <label for="property_id" class="block text-sm font-medium text-slate-700 mb-1">
                            Seleccionar Propiedad <span class="text-red-600">*</span>
                        </label>
                        <select id="property_id"
                                name="property_id"
                                required
                                onchange="updateOwnerInfo()"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('property_id') @enderror">
                            <option value="">-- Seleccione una propiedad --</option>
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}"
                                        data-owner-name="{{ $property->owner->name }}"
                                        data-owner-dni="{{ $property->owner->dni }}"
                                        data-owner-email="{{ $property->owner->email }}"
                                        data-owner-phone="{{ $property->owner->phone }}"
                                        {{ old('property_id', $contract->property_id) == $property->id ? 'selected' : '' }}>
                                    {{ $property->address }} - {{ $property->city }} ({{ $property->owner->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Owner Information Display --}}
                    <div id="owner-info" class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-purple-900 mb-2">Información del Propietario</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <div>
                                <dt class="text-purple-700 font-medium">Nombre:</dt>
                                <dd id="owner-name" class="text-purple-900"></dd>
                            </div>
                            <div>
                                <dt class="text-purple-700 font-medium">DNI:</dt>
                                <dd id="owner-dni" class="text-purple-900 font-mono"></dd>
                            </div>
                            <div>
                                <dt class="text-purple-700 font-medium">Email:</dt>
                                <dd id="owner-email" class="text-purple-900"></dd>
                            </div>
                            <div>
                                <dt class="text-purple-700 font-medium">Teléfono:</dt>
                                <dd id="owner-phone" class="text-purple-900"></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- Section: Contract Dates --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Fechas del Contrato
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Start Date --}}
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Inicio <span class="text-red-600">*</span>
                        </label>
                        <input type="date"
                               id="start_date"
                               name="start_date"
                               value="{{ old('start_date', $contract->start_date->format('Y-m-d')) }}"
                               required
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('start_date') @enderror">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Fin (Opcional)
                        </label>
                        <input type="date"
                               id="end_date"
                               name="end_date"
                               value="{{ old('end_date', $contract->end_date?->format('Y-m-d')) }}"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('end_date') @enderror">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Tenant 1 (Principal) --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Inquilino Principal
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tenant1_name" class="block text-sm font-medium text-slate-700 mb-1">
                            Nombre Completo <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="tenant1_name"
                               name="tenant1_name"
                               value="{{ old('tenant1_name', $contract->tenant1_name) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('tenant1_name') @enderror">
                        @error('tenant1_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant1_dni" class="block text-sm font-medium text-slate-700 mb-1">
                            DNI/NIE/TIE <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="tenant1_dni"
                               name="tenant1_dni"
                               value="{{ old('tenant1_dni', $contract->tenant1_dni) }}"
                               required
                               pattern="^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$"
                               maxlength="9"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-mono uppercase @error('tenant1_dni') @enderror"
                               style="text-transform: uppercase;">
                        @error('tenant1_dni')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant1_email" class="block text-sm font-medium text-slate-700 mb-1">
                            Correo Electrónico <span class="text-red-600">*</span>
                        </label>
                        <input type="email"
                               id="tenant1_email"
                               name="tenant1_email"
                               value="{{ old('tenant1_email', $contract->tenant1_email) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('tenant1_email') @enderror">
                        @error('tenant1_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant1_phone" class="block text-sm font-medium text-slate-700 mb-1">
                            Teléfono <span class="text-red-600">*</span>
                        </label>
                        <input type="tel"
                               id="tenant1_phone"
                               name="tenant1_phone"
                               value="{{ old('tenant1_phone', $contract->tenant1_phone) }}"
                               required
                               maxlength="20"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('tenant1_phone') @enderror">
                        @error('tenant1_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Tenant 2 (Optional) --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Segundo Inquilino (Opcional)
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tenant2_name" class="block text-sm font-medium text-slate-700 mb-1">
                            Nombre Completo
                        </label>
                        <input type="text"
                               id="tenant2_name"
                               name="tenant2_name"
                               value="{{ old('tenant2_name', $contract->tenant2_name) }}"
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('tenant2_name') @enderror">
                        @error('tenant2_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant2_dni" class="block text-sm font-medium text-slate-700 mb-1">
                            DNI/NIE/TIE
                        </label>
                        <input type="text"
                               id="tenant2_dni"
                               name="tenant2_dni"
                               value="{{ old('tenant2_dni', $contract->tenant2_dni) }}"
                               pattern="^([0-9]{8}|[XYZ][0-9]{7})[TRWAGMYFPDXBNJZSQVHLCKE]$"
                               maxlength="9"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 font-mono uppercase @error('tenant2_dni') @enderror"
                               style="text-transform: uppercase;">
                        @error('tenant2_dni')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant2_email" class="block text-sm font-medium text-slate-700 mb-1">
                            Correo Electrónico
                        </label>
                        <input type="email"
                               id="tenant2_email"
                               name="tenant2_email"
                               value="{{ old('tenant2_email', $contract->tenant2_email) }}"
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('tenant2_email') @enderror">
                        @error('tenant2_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tenant2_phone" class="block text-sm font-medium text-slate-700 mb-1">
                            Teléfono
                        </label>
                        <input type="tel"
                               id="tenant2_phone"
                               name="tenant2_phone"
                               value="{{ old('tenant2_phone', $contract->tenant2_phone) }}"
                               maxlength="20"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('tenant2_phone') @enderror">
                        @error('tenant2_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Financial Conditions --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Condiciones Económicas
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="monthly_rent" class="block text-sm font-medium text-slate-700 mb-1">
                            Renta Mensual (€) <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               id="monthly_rent"
                               name="monthly_rent"
                               value="{{ old('monthly_rent', $contract->monthly_rent) }}"
                               required
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('monthly_rent') @enderror">
                        @error('monthly_rent')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="legal_deposit" class="block text-sm font-medium text-slate-700 mb-1">
                            Fianza Legal (€) <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               id="legal_deposit"
                               name="legal_deposit"
                               value="{{ old('legal_deposit', $contract->legal_deposit) }}"
                               required
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('legal_deposit') @enderror">
                        @error('legal_deposit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="additional_deposit" class="block text-sm font-medium text-slate-700 mb-1">
                            Fianza Adicional (€)
                        </label>
                        <input type="number"
                               id="additional_deposit"
                               name="additional_deposit"
                               value="{{ old('additional_deposit', $contract->additional_deposit) }}"
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('additional_deposit') @enderror">
                        @error('additional_deposit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tensioned Area & IRPA --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Is Tensioned Area Checkbox --}}
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox"
                                id="is_tensioned_area"
                                name="is_tensioned_area"
                                value="1"
                                {{ old('is_tensioned_area') ? 'checked' : '' }}
                                class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                        </div>
                        <label for="is_tensioned_area" class="ml-3">
                            <span class="text-sm font-medium text-slate-700">¿Zona Tensionada?</span>
                            <p class="text-xs text-slate-500">Marque si la propiedad está en zona de mercado tensionado</p>
                        </label>
                    </div>

                    {{-- IRPA Value --}}
                    <div>
                        <label for="irpa_value" class="block text-sm font-medium text-slate-700 mb-1">
                            Valor IRPA (€/mes)
                        </label>
                        <input type="number"
                            id="irpa_value"
                            name="irpa_value"
                            value="{{ old('irpa_value') }}"
                            min="0"
                            max="999999.99"
                            step="0.01"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('irpa_value') @enderror"
                            placeholder="Ej: 12.50">
                        @error('irpa_value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500">Solo completar si la propiedad está en zona tensionada</p>
                    </div>
                </div>
            </div>

            {{-- Section: Expense Distribution --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Distribución de Gastos
                </h2>

                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="tenant_pays_ibi"
                               value="1"
                               {{ old('tenant_pays_ibi', $contract->tenant_pays_ibi) ? 'checked' : '' }}
                               class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                        <span class="ml-3 text-sm text-slate-700">Inquilino paga IBI (Impuesto de Bienes Inmuebles)</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox"
                               name="tenant_pays_community_fees"
                               value="1"
                               {{ old('tenant_pays_community_fees', $contract->tenant_pays_community_fees) ? 'checked' : '' }}
                               class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                        <span class="ml-3 text-sm text-slate-700">Inquilino paga Gastos de Comunidad</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox"
                               name="tenant_pays_garbage_fees"
                               value="1"
                               {{ old('tenant_pays_garbage_fees', $contract->tenant_pays_garbage_fees) ? 'checked' : '' }}
                               class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                        <span class="ml-3 text-sm text-slate-700">Inquilino paga Tasa de Basura</span>
                    </label>
                </div>
            </div>

            {{-- Section: Contract Status --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Estado del Contrato
                </h2>

                <div class="space-y-3">
                    <label class="flex items-center p-3 border border-slate-300 rounded-lg cursor-pointer hover:bg-slate-50">
                        <input type="radio"
                               name="status"
                               value="draft"
                               {{ old('status', $contract->status) == 'draft' ? 'checked' : '' }}
                               required
                               class="w-4 h-4 text-purple-600 focus:ring-purple-500">
                        <span class="ml-3">
                            <span class="block text-sm font-medium text-slate-900">Borrador</span>
                            <span class="block text-xs text-slate-500">El contrato está en preparación</span>
                        </span>
                    </label>

                    <label class="flex items-center p-3 border border-slate-300 rounded-lg cursor-pointer hover:bg-slate-50">
                        <input type="radio"
                               name="status"
                               value="active"
                               {{ old('status', $contract->status) == 'active' ? 'checked' : '' }}
                               class="w-4 h-4 text-purple-600 focus:ring-purple-500">
                        <span class="ml-3">
                            <span class="block text-sm font-medium text-slate-900">Activo</span>
                            <span class="block text-xs text-slate-500">El contrato está vigente y en curso</span>
                        </span>
                    </label>

                    <label class="flex items-center p-3 border border-slate-300 rounded-lg cursor-pointer hover:bg-slate-50">
                        <input type="radio"
                               name="status"
                               value="finalized"
                               {{ old('status', $contract->status) == 'finalized' ? 'checked' : '' }}
                               class="w-4 h-4 text-purple-600 focus:ring-purple-500">
                        <span class="ml-3">
                            <span class="block text-sm font-medium text-slate-900">Finalizado</span>
                            <span class="block text-xs text-slate-500">El contrato ha concluido</span>
                        </span>
                    </label>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                <div class="flex gap-3">
                    <button type="submit"
                            class="px-6 py-2.5 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Actualizar Contrato

                    </button>
                    <a href="{{ route('contracts.show', $contract) }}"
                    class="px-6 py-2.5 bg-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-300 transition-colors">
                        Cancelar
                    </a>
                </div>

                <button type="button"
                        onclick="confirmDelete()"
                        class="px-6 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Eliminar Contrato
                </button>
            </div>
        </form>
    </div>

    {{-- Additional Information --}}
    <div class="mt-6 bg-slate-50 border border-slate-200 rounded-lg p-4">
        <h3 class="text-sm font-semibold text-slate-700 mb-2">Información del Registro</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
            <div class="flex justify-between">
                <dt class="text-slate-600">Creado:</dt>
                <dd class="text-slate-900 font-medium">{{ $contract->created_at->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-slate-600">Última actualización:</dt>
                <dd class="text-slate-900 font-medium">{{ $contract->updated_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>
    </div>
@endsection

{{-- Hidden Delete Form --}}
<form id="delete-form" action="{{ route('contracts.destroy', $contract) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

{{-- JavaScript for Dynamic Behavior --}}
<script>
// Update owner information when property is selected
function updateOwnerInfo() {
    const select = document.getElementById('property_id');
    const selectedOption = select.options[select.selectedIndex];
    const ownerInfo = document.getElementById('owner-info');

    if (selectedOption.value) {
        // Get data from selected option
        document.getElementById('owner-name').textContent = selectedOption.dataset.ownerName;
        document.getElementById('owner-dni').textContent = selectedOption.dataset.ownerDni;
        document.getElementById('owner-email').textContent = selectedOption.dataset.ownerEmail;
        document.getElementById('owner-phone').textContent = selectedOption.dataset.ownerPhone;

        // Show owner info
        ownerInfo.classList.remove('hidden');
    } else {
        // Hide owner info
        ownerInfo.classList.add('hidden');
    }
}

// Delete confirmation
function confirmDelete() {
    const propertyAddress = "{{ $contract->property->address }}";
    const tenant = "{{ $contract->tenant1_name }}";

    if (confirm(`¿Estás seguro de que deseas eliminar este contrato?\n\nPropiedad: ${propertyAddress}\nInquilino: ${tenant}\n\nEsta acción no se puede deshacer.`)) {
        document.getElementById('delete-form').submit();
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // If property was pre-selected (from query param or old input), show owner info
    updateOwnerInfo();
});
</script>

