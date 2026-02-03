@extends('layouts.app')

@section('title', 'Editar Propiedad - ' . $property->address . ' - Rentoo')

@section('content')
    {{-- Flash Messages --}}
    <x-flash-message />

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Editar Propiedad</h1>
        <p class="text-slate-600 mt-1">Modificar información de: <strong>{{ $property->address }}</strong></p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('properties.update', $property) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Section: Owner Selection --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Propietario
                </h2>

                <div>
                    <label for="owner_id" class="block text-sm font-medium text-slate-700 mb-1">
                        Seleccionar Propietario <span class="text-red-600">*</span>
                    </label>
                    <select id="owner_id"
                            name="owner_id"
                            required
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('owner_id') @enderror">
                        <option value="">-- Seleccione un propietario --</option>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}"
                                    {{ old('owner_id', $property->owner_id) == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }} ({{ $owner->dni }})
                            </option>
                        @endforeach
                    </select>
                    @error('owner_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section: Location --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Ubicación
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-slate-700 mb-1">
                            Dirección Completa <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="address"
                               name="address"
                               value="{{ old('address', $property->address) }}"
                               required
                               maxlength="250"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('address') @enderror"
                               placeholder="Ej: Calle Balmes, 123, 4º 2ª">
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
                               value="{{ old('city', $property->city) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('city') @enderror"
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
                               value="{{ old('postal_code', $property->postal_code) }}"
                               required
                               pattern="[0-9]{5}"
                               maxlength="5"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('postal_code') @enderror"
                               placeholder="Ej: 08008">
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
                               value="{{ old('province', $property->province) }}"
                               required
                               maxlength="100"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('province') @enderror"
                               placeholder="Ej: Barcelona">
                        @error('province')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Cadastral Reference --}}
                    <div class="md:col-span-2">
                        <label for="cadastral_reference" class="block text-sm font-medium text-slate-700 mb-1">
                            Referencia Catastral <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="cadastral_reference"
                               name="cadastral_reference"
                               value="{{ old('cadastral_reference', $property->cadastral_reference) }}"
                               required
                               pattern="[A-Z0-9]{20}"
                               minlength="20"
                               maxlength="20"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono uppercase @error('cadastral_reference') @enderror"
                               placeholder="Ej: 1234567VK1234S0001WX"
                               style="text-transform: uppercase;">
                        @error('cadastral_reference')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500">Exactamente 20 caracteres alfanuméricos</p>
                    </div>
                </div>
            </div>

            {{-- Section: Property Details --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Características de la Propiedad
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Surface Area --}}
                    <div>
                        <label for="surface_area" class="block text-sm font-medium text-slate-700 mb-1">
                            Superficie (m²) <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               id="surface_area"
                               name="surface_area"
                               value="{{ old('surface_area', $property->surface_area) }}"
                               required
                               min="10"
                               max="9999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('surface_area') @enderror"
                               placeholder="Ej: 75.50">
                        @error('surface_area')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bedrooms --}}
                    <div>
                        <label for="bedrooms" class="block text-sm font-medium text-slate-700 mb-1">
                            Habitaciones <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               id="bedrooms"
                               name="bedrooms"
                               value="{{ old('bedrooms', $property->bedrooms) }}"
                               required
                               min="0"
                               max="255"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('bedrooms') @enderror"
                               placeholder="Ej: 3">
                        @error('bedrooms')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bathrooms --}}
                    <div>
                        <label for="bathrooms" class="block text-sm font-medium text-slate-700 mb-1">
                            Baños <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               id="bathrooms"
                               name="bathrooms"
                               value="{{ old('bathrooms', $property->bathrooms) }}"
                               required
                               min="0"
                               max="255"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('bathrooms') @enderror"
                               placeholder="Ej: 2">
                        @error('bathrooms')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-3">
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1">
                            Descripción (Opcional)
                        </label>
                        <textarea id="description"
                                  name="description"
                                  rows="3"
                                  maxlength="1000"
                                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') @enderror"
                                  placeholder="Descripción adicional de la propiedad...">{{ old('description', $property->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Energy Certificate --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Certificado de Eficiencia Energética
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Energy Rating --}}
                    <div>
                        <label for="energy_certificate_rating" class="block text-sm font-medium text-slate-700 mb-1">
                            Calificación Energética <span class="text-red-600">*</span>
                        </label>
                        <select id="energy_certificate_rating"
                                name="energy_certificate_rating"
                                required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('energy_certificate_rating') @enderror">
                            <option value="">-- Seleccione --</option>
                            @foreach(['A', 'B', 'C', 'D', 'E', 'F', 'G'] as $rating)
                                <option value="{{ $rating }}"
                                        {{ old('energy_certificate_rating', $property->energy_certificate_rating) == $rating ? 'selected' : '' }}>
                                    {{ $rating }}
                                </option>
                            @endforeach
                        </select>
                        @error('energy_certificate_rating')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Energy Certificate Number --}}
                    <div>
                        <label for="energy_certificate_number" class="block text-sm font-medium text-slate-700 mb-1">
                            Número de Certificado <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="energy_certificate_number"
                               name="energy_certificate_number"
                               value="{{ old('energy_certificate_number', $property->energy_certificate_number) }}"
                               required
                               maxlength="50"
                               pattern="[A-Z0-9]+"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono uppercase @error('energy_certificate_number') @enderror"
                               placeholder="Ej: EE12345678"
                               style="text-transform: uppercase;">
                        @error('energy_certificate_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Energy Certificate Expiry --}}
                    <div>
                        <label for="energy_certificate_expiry" class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Vencimiento <span class="text-red-600">*</span>
                        </label>
                        <input type="date"
                               id="energy_certificate_expiry"
                               name="energy_certificate_expiry"
                               value="{{ old('energy_certificate_expiry', $property->energy_certificate_expiry?->format('Y-m-d')) }}"
                               required
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('energy_certificate_expiry') @enderror">
                        @error('energy_certificate_expiry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Habitability Certificate --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Cédula de Habitabilidad
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Habitability Certificate Number --}}
                    <div>
                        <label for="habitability_certificate_number" class="block text-sm font-medium text-slate-700 mb-1">
                            Número de Cédula <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="habitability_certificate_number"
                               name="habitability_certificate_number"
                               value="{{ old('habitability_certificate_number', $property->habitability_certificate_number) }}"
                               required
                               maxlength="50"
                               pattern="[A-Z0-9]+"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono uppercase @error('habitability_certificate_number') @enderror"
                               placeholder="Ej: CH98765432"
                               style="text-transform: uppercase;">
                        @error('habitability_certificate_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Habitability Certificate Expiry --}}
                    <div>
                        <label for="habitability_certificate_expiry" class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Vencimiento <span class="text-red-600">*</span>
                        </label>
                        <input type="date"
                               id="habitability_certificate_expiry"
                               name="habitability_certificate_expiry"
                               value="{{ old('habitability_certificate_expiry', $property->habitability_certificate_expiry?->format('Y-m-d')) }}"
                               required
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('habitability_certificate_expiry') @enderror">
                        @error('habitability_certificate_expiry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Financial Details --}}
            <div>
                <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Información Financiera (Opcional)
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Last Rent Amount --}}
                    <div>
                        <label for="last_rent_amount" class="block text-sm font-medium text-slate-700 mb-1">
                            Último Monto de Alquiler (€)
                        </label>
                        <input type="number"
                               id="last_rent_amount"
                               name="last_rent_amount"
                               value="{{ old('last_rent_amount', $property->last_rent_amount) }}"
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('last_rent_amount') @enderror"
                               placeholder="Ej: 850.00">
                        @error('last_rent_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- IBI Annual Amount --}}
                    <div>
                        <label for="ibi_annual_amount" class="block text-sm font-medium text-slate-700 mb-1">
                            IBI Anual (€)
                        </label>
                        <input type="number"
                               id="ibi_annual_amount"
                               name="ibi_annual_amount"
                               value="{{ old('ibi_annual_amount', $property->ibi_annual_amount) }}"
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ibi_annual_amount') @enderror"
                               placeholder="Ej: 450.00">
                        @error('ibi_annual_amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Community Fees Monthly --}}
                    <div>
                        <label for="community_fees_monthly" class="block text-sm font-medium text-slate-700 mb-1">
                            Gastos de Comunidad Mensual (€)
                        </label>
                        <input type="number"
                               id="community_fees_monthly"
                               name="community_fees_monthly"
                               value="{{ old('community_fees_monthly', $property->community_fees_monthly) }}"
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('community_fees_monthly') @enderror"
                               placeholder="Ej: 65.00">
                        @error('community_fees_monthly')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Garbage Fees Annual --}}
                    <div>
                        <label for="garbage_fees_annual" class="block text-sm font-medium text-slate-700 mb-1">
                            Tasa de Basura Anual (€)
                        </label>
                        <input type="number"
                               id="garbage_fees_annual"
                               name="garbage_fees_annual"
                               value="{{ old('garbage_fees_annual', $property->garbage_fees_annual) }}"
                               min="0"
                               max="999999.99"
                               step="0.01"
                               class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('garbage_fees_annual') @enderror"
                               placeholder="Ej: 120.00">
                        @error('garbage_fees_annual')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex gap-3 pt-6 border-t border-slate-200">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Actualizar Propiedad
                </button>
                <a href="{{ route('properties.show', $property) }}"
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
                    <dd class="text-slate-900 font-medium">{{ $property->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-600">Última actualización:</dt>
                    <dd class="text-slate-900 font-medium">{{ $property->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div> --}}

        {{-- Warning about contracts --}}
        @if($property->contracts()->count() > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="text-sm">
                        <p class="font-medium text-yellow-800">Propiedad con contratos</p>
                        <p class="text-yellow-700 mt-1">
                            Esta propiedad tiene {{ $property->contracts()->count() }}
                            {{ $property->contracts()->count() === 1 ? 'contrato' : 'contratos' }}.
                            Los cambios en los datos de la propiedad afectarán a los contratos en estado de "Borrador".
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
