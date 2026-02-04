@extends('layouts.app')

@section('title', 'Contrato - ' . $contract->property->address . ' - Rentoo')

@section('content')
    {{-- Flash Messages --}}
    <x-flash-message />

    {{-- Form Actions --}}
    <div class="no-print mb-6 flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('contracts.index') }}"
            class="inline-flex items-center px-4 py-2 bg-slate-600 text-white font-medium rounded-lg hover:bg-slate-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver a Contratos
            </a>

            <button onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Imprimir Contrato
            </button>

            <a href="{{ route('contracts.edit', $contract) }}"
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
        </div>

        {{-- Status Badge --}}
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium text-slate-600">Estado:</span>
            <x-status-badge :status="$contract->status" />
        </div>
    </div>

    {{-- Hidden Delete Form --}}
    <form id="delete-form" action="{{ route('contracts.destroy', $contract) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    {{-- Contract Document --}}
    <div class="contract-document bg-white shadow-lg rounded-lg p-12 max-w-4xl mx-auto" style="font-family: 'Times New Roman', Times, serif;">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold uppercase mb-2">Contrato de Arrendamiento de Vivienda</h1>
            <p class="text-sm text-slate-600">Ley 29/1994, de 24 de noviembre, de Arrendamientos Urbanos (LAU)</p>
        </div>

        {{-- REUNIDOS Section --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold uppercase mb-3">REUNIDOS</h2>

            <p class="mb-3 text-justify leading-relaxed">
                De una parte, <strong>{{ $contract->property->owner->name }}</strong>,
                mayor de edad, con DNI/NIE/TIE número <strong>{{ $contract->property->owner->dni }}</strong>,
                con domicilio a efectos de notificaciones en
                <strong>{{ $contract->property->owner->address }}, {{ $contract->property->owner->city }},
                {{ $contract->property->owner->postal_code }}, {{ $contract->property->owner->province }}</strong>,
                en su condición de <strong>ARRENDADOR</strong>.
            </p>

            <p class="mb-3 text-justify leading-relaxed">
                Y de otra parte, <strong>{{ $contract->tenant1_name }}</strong>,
                mayor de edad, con DNI/NIE/TIE número <strong>{{ $contract->tenant1_dni }}</strong>,
                con domicilio en <strong>{{ $contract->tenant1_address }}</strong>@if($contract->tenant2_name),
                y <strong>{{ $contract->tenant2_name }}</strong>,
                mayor de edad, con DNI/NIE/TIE número <strong>{{ $contract->tenant2_dni }}</strong>,
                con domicilio en <strong>{{ $contract->tenant2_address }}</strong>@endif,
                en su condición de <strong>ARRENDATARIO{{ $contract->tenant2_name ? 'S' : '' }}</strong>.
            </p>

            <p class="text-justify leading-relaxed">
                Ambas partes se reconocen mutuamente capacidad legal suficiente para formalizar el presente contrato y,
                a tal efecto,
            </p>
        </div>

        {{-- EXPONEN Section --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold uppercase mb-3">EXPONEN</h2>

            <p class="mb-3 text-justify leading-relaxed">
                <strong>PRIMERO.</strong> Que el ARRENDADOR es propietario de la vivienda sita en
                <strong>{{ $contract->property->address }}, {{ $contract->property->city }},
                {{ $contract->property->postal_code }}, {{ $contract->property->province }}</strong>,
                con referencia catastral <strong>{{ $contract->property->cadastral_reference }}</strong>,
                con una superficie construida de <strong>{{ number_format($contract->property->surface_area, 2, ',', '.') }} m²</strong>,
                que cuenta con <strong>{{ $contract->property->bedrooms }} {{ $contract->property->bedrooms === 1 ? 'habitación' : 'habitaciones' }}</strong>
                y <strong>{{ $contract->property->bathrooms }} {{ $contract->property->bathrooms === 1 ? 'baño' : 'baños' }}</strong>,
                ubicada en la planta <strong>{{ $contract->property->floor }}</strong>.
            </p>

            <p class="mb-3 text-justify leading-relaxed">
                <strong>SEGUNDO.</strong> Que la vivienda dispone de Certificado de Eficiencia Energética
                con calificación <strong>{{ $contract->property->energy_certificate_rating }}</strong>,
                número <strong>{{ $contract->property->energy_certificate_number }}</strong>,
                con fecha de caducidad {{ $contract->property->energy_certificate_expiry->format('d/m/Y') }},
                y Cédula de Habitabilidad número <strong>{{ $contract->property->habitability_certificate_number }}</strong>,
                con fecha de caducidad {{ $contract->property->habitability_certificate_expiry->format('d/m/Y') }}.
            </p>

            <p class="text-justify leading-relaxed">
                <strong>TERCERO.</strong> Que es voluntad del ARRENDADOR arrendar la mencionada vivienda,
                y del ARRENDATARIO{{ $contract->tenant2_name ? 'S' : '' }} tomarla en arrendamiento,
                destinándola exclusivamente a vivienda habitual,
                conforme a las siguientes
            </p>
        </div>

        {{-- ESTIPULACIONES Section --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold uppercase mb-3">ESTIPULACIONES</h2>

            {{-- PRIMERA - Objeto y Duración --}}
            <div class="mb-4">
                <p class="font-bold mb-2">PRIMERA.- OBJETO Y DURACIÓN DEL CONTRATO</p>
                <p class="text-justify leading-relaxed mb-2">
                    El ARRENDADOR arrienda al ARRENDATARIO{{ $contract->tenant2_name ? 'S' : '' }} la vivienda descrita,
                    para destinarla exclusivamente a su domicilio habitual.
                </p>
                <p class="text-justify leading-relaxed mb-2">
                    El contrato tendrá una duración de <strong>UN AÑO</strong>,
                    comenzando el día <strong>{{ $contract->start_date?->translatedFormat('d \d\e F \d\e Y') ?? 'a determinar' }}</strong>
                    y finalizando el día <strong>{{ $contract->end_date?->translatedFormat('d \d\e F \d\e Y') ?? 'a determinar' }}</strong>.
                </p>
                <p class="text-justify leading-relaxed">
                    El contrato se prorrogará obligatoriamente por plazos anuales hasta que el arrendamiento alcance una duración mínima
                    de cinco años, salvo que el arrendatario manifieste al arrendador, con treinta días de antelación como mínimo
                    a la fecha de terminación del contrato o de cualquiera de las prórrogas, su voluntad de no renovarlo.
                </p>
            </div>

            {{-- SEGUNDA - Destino --}}
            <div class="mb-4">
                <p class="font-bold mb-2">SEGUNDA.- DESTINO DE LA VIVIENDA</p>
                <p class="text-justify leading-relaxed">
                    La vivienda se destinará exclusivamente a satisfacer la necesidad permanente de vivienda del arrendatario{{ $contract->tenant2_name ? 's' : '' }}.
                    Queda expresamente prohibido el subarrendamiento total o parcial, así como la cesión del contrato sin el consentimiento expreso
                    y por escrito del arrendador.
                </p>
            </div>

            {{-- TERCERA - Renta --}}
            <div class="mb-4">
                <p class="font-bold mb-2">TERCERA.- RENTA</p>
                <p class="text-justify leading-relaxed mb-2">
                    El arrendatario{{ $contract->tenant2_name ? 's' : '' }} se obliga{{ $contract->tenant2_name ? 'n' : '' }}
                    a pagar al arrendador en concepto de renta la cantidad de
                    <strong>{{ number_format($contract->monthly_rent, 2, ',', '.') }} EUROS ({{ number_format($contract->monthly_rent, 2, ',', '.') }} €)</strong>
                    mensuales, que se abonarán dentro de los primeros siete días de cada mes.
                </p>
                @if($contract->is_tensioned_area && $contract->irpa_value)
                <p class="text-justify leading-relaxed">
                    La vivienda se encuentra en zona de mercado residencial tensionado.
                    El índice de referencia de precios de alquiler (IRPA) aplicable es de
                    <strong>{{ number_format($contract->irpa_value, 2, ',', '.') }} €/m²/mes</strong>.
                </p>
                @endif
            </div>

            {{-- CUARTA - Fianza --}}
            <div class="mb-4">
                <p class="font-bold mb-2">CUARTA.- FIANZA</p>
                <p class="text-justify leading-relaxed mb-2">
                    En este acto, el arrendatario{{ $contract->tenant2_name ? 's' : '' }} entrega{{ $contract->tenant2_name ? 'n' : '' }}
                    al arrendador en concepto de fianza legal la cantidad de
                    <strong>{{ number_format($contract->legal_deposit, 2, ',', '.') }} EUROS ({{ number_format($contract->legal_deposit, 2, ',', '.') }} €)</strong>,
                    equivalente a una mensualidad de renta.
                </p>
                @if($contract->additional_deposit > 0)
                <p class="text-justify leading-relaxed mb-2">
                    Adicionalmente, se entrega en concepto de garantía complementaria la cantidad de
                    <strong>{{ number_format($contract->additional_deposit, 2, ',', '.') }} EUROS ({{ number_format($contract->additional_deposit, 2, ',', '.') }} €)</strong>.
                </p>
                @endif
                <p class="text-justify leading-relaxed">
                    La fianza legal será depositada por el arrendador en el organismo autonómico competente en el plazo legalmente establecido.
                </p>
            </div>

            {{-- QUINTA - Gastos y Suministros --}}
            <div class="mb-4">
                <p class="font-bold mb-2">QUINTA.- GASTOS Y SUMINISTROS</p>
                <p class="text-justify leading-relaxed mb-2">
                    Serán de cuenta del arrendatario{{ $contract->tenant2_name ? 's' : '' }} los siguientes gastos:
                </p>
                <ul class="list-disc list-inside ml-4 mb-2">
                    <li>Suministros individuales de la vivienda (agua, luz, gas, telefonía e internet)</li>
                    @if($contract->tenant_pays_community_fees)
                    <li>Gastos de comunidad ({{ number_format($contract->property->community_fees_monthly, 2, ',', '.') }} € mensuales aproximadamente)</li>
                    @endif
                    @if($contract->tenant_pays_garbage_fees)
                    <li>Tasa de basuras</li>
                    @endif
                </ul>
                <p class="text-justify leading-relaxed">
                    Serán de cuenta del arrendador los siguientes gastos:
                </p>
                <ul class="list-disc list-inside ml-4">
                    @if(!$contract->tenant_pays_ibi)
                    <li>Impuesto sobre Bienes Inmuebles (IBI)</li>
                    @endif
                    @if(!$contract->tenant_pays_community_fees)
                    <li>Gastos de comunidad</li>
                    @endif
                    @if(!$contract->tenant_pays_garbage_fees)
                    <li>Tasa de basuras</li>
                    @endif
                    <li>Reparaciones necesarias para conservar la vivienda en condiciones de habitabilidad</li>
                    <li>Grandes reparaciones estructurales</li>
                </ul>
            </div>

            {{-- SEXTA - Obras y Reparaciones --}}
            <div class="mb-4">
                <p class="font-bold mb-2">SEXTA.- OBRAS Y REPARACIONES</p>
                <p class="text-justify leading-relaxed">
                    El arrendatario{{ $contract->tenant2_name ? 's' : '' }} deberá{{ $contract->tenant2_name ? 'n' : '' }} realizar
                    las pequeñas reparaciones que exija el desgaste por el uso ordinario de la vivienda.
                    Las reparaciones necesarias para conservar la vivienda en condiciones de habitabilidad serán de cuenta del arrendador,
                    salvo cuando el deterioro sea imputable al arrendatario{{ $contract->tenant2_name ? 's' : '' }}.
                </p>
            </div>

            {{-- SÉPTIMA - Conservación y Uso --}}
            <div class="mb-4">
                <p class="font-bold mb-2">SÉPTIMA.- CONSERVACIÓN Y USO</p>
                <p class="text-justify leading-relaxed">
                    El arrendatario{{ $contract->tenant2_name ? 's' : '' }} se obliga{{ $contract->tenant2_name ? 'n' : '' }}
                    a utilizar la vivienda con la diligencia de un buen padre de familia,
                    destinándola exclusivamente al uso pactado, y a mantenerla en buen estado de conservación.
                </p>
            </div>

            {{-- OCTAVA - Resolución --}}
            <div class="mb-4">
                <p class="font-bold mb-2">OCTAVA.- RESOLUCIÓN DEL CONTRATO</p>
                <p class="text-justify leading-relaxed mb-2">
                    Serán causas de resolución del presente contrato:
                </p>
                <ul class="list-disc list-inside ml-4">
                    <li>El impago de la renta o de las cantidades asimiladas a la renta</li>
                    <li>El impago del importe de la fianza o de su actualización</li>
                    <li>La realización de daños causados dolosamente en la finca</li>
                    <li>El uso de la vivienda con infracción de lo estipulado en el presente contrato</li>
                    <li>El subarrendamiento o cesión no autorizados</li>
                </ul>
            </div>

            {{-- NOVENA - Notificaciones --}}
            <div class="mb-4">
                <p class="font-bold mb-2">NOVENA.- NOTIFICACIONES</p>
                <p class="text-justify leading-relaxed">
                    Todas las notificaciones que deban realizarse entre las partes se efectuarán en los domicilios indicados
                    en el encabezamiento del presente contrato, salvo que cualquiera de las partes comunique fehacientemente
                    a la otra un cambio de domicilio.
                </p>
            </div>

            {{-- DÉCIMA - Legislación y Jurisdicción --}}
            <div class="mb-4">
                <p class="font-bold mb-2">DÉCIMA.- LEGISLACIÓN APLICABLE Y JURISDICCIÓN</p>
                <p class="text-justify leading-relaxed">
                    El presente contrato se regirá por lo dispuesto en la Ley 29/1994, de 24 de noviembre,
                    de Arrendamientos Urbanos, y sus modificaciones posteriores.
                    Para cualquier cuestión litigiosa derivada del presente contrato,
                    las partes se someten expresamente a la jurisdicción de los Juzgados y Tribunales de
                    {{ $contract->property->city }}, con renuncia expresa a cualquier otro fuero que pudiera corresponderles.
                </p>
            </div>
        </div>

        {{-- INVENTARIO Section --}}
        <div class="mb-8 page-break-before">
            <h2 class="text-lg font-bold uppercase mb-3 text-center border-t border-b border-slate-300 py-2">
                INVENTARIO
            </h2>
            <p class="text-justify leading-relaxed mb-4">
                La vivienda se entrega con el mobiliario y electrodomésticos que se detallan a continuación,
                en perfecto estado de funcionamiento, quedando a disposición del arrendatario{{ $contract->tenant2_name ? 's' : '' }}
                para su uso durante la vigencia del contrato, siendo de su cargo la reparación o reposición de los mismos
                en caso de deterioro o pérdida por causa imputable al arrendatario{{ $contract->tenant2_name ? 's' : '' }}:
            </p>
            <p class="text-sm text-slate-600 italic text-center">
                [El inventario detallado se adjunta como anexo al presente contrato con fotografías del estado de la vivienda]
            </p>
        </div>

        {{-- FIRMAS Section --}}
        <div class="mt-12">
            <h2 class="text-lg font-bold uppercase mb-6 text-center border-t border-b border-slate-300 py-2">
                FIRMAS
            </h2>

            <p class="text-justify leading-relaxed mb-8">
                Y en prueba de conformidad con cuanto antecede, ambas partes firman el presente contrato por duplicado
                en {{ $contract->property->city }}, a {{ $contract->start_date?->translatedFormat('d \d\e F \d\e Y') ?? 'fecha de firma' }}.
            </p>

            <div class="grid grid-cols-2 gap-12 mt-12">
                {{-- Owner - Landlord --}}
                <div class="text-center">
                    <div class="border-t border-slate-400 pt-2 mb-1">
                        <p class="font-bold text-sm">EL ARRENDADOR</p>
                    </div>
                    <p class="text-sm">{{ $contract->property->owner->name }}</p>
                    <p class="text-xs text-slate-600">DNI/NIE/TIE: {{ $contract->property->owner->dni }}</p>
                </div>

                {{-- Tenant(s) --}}
                <div class="text-center">
                    <div class="border-t border-slate-400 pt-2 mb-1">
                        <p class="font-bold text-sm">EL ARRENDATARIO{{ $contract->tenant2_name ? ' (1)' : '' }}</p>
                    </div>
                    <p class="text-sm">{{ $contract->tenant1_name }}</p>
                    <p class="text-xs text-slate-600">DNI/NIE/TIE: {{ $contract->tenant1_dni }}</p>
                </div>

                @if($contract->tenant2_name)
                {{-- Second Tenant --}}
                <div class="text-center col-span-2">
                    <div class="border-t border-slate-400 pt-2 mb-1 max-w-xs mx-auto">
                        <p class="font-bold text-sm">EL ARRENDATARIO (2)</p>
                    </div>
                    <p class="text-sm">{{ $contract->tenant2_name }}</p>
                    <p class="text-xs text-slate-600">DNI/NIE/TIE: {{ $contract->tenant2_dni }}</p>
                </div>
                @endif
            </div>
    </div>

    {{-- Print Styles --}}
    <style>
        @media print {
            /* Hide non-document elements */
            .no-print,
            nav,
            footer {
                display: none !important;
            }

            /* Reset page margins */
            body {
                margin: 0;
                padding: 0;
            }

            /* Contract document styling */
            .contract-document {
                box-shadow: none !important;
                max-width: 100% !important;
                padding: 2cm !important;
                border-radius: 0 !important;
            }

            /* Page setup */
            @page {
                size: A4;
                margin: 2cm;
            }

            /* Page breaks */
            .page-break-before {
                page-break-before: always;
            }

            /* Ensure proper text rendering */
            * {
                color-adjust: exact;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

{{-- Delete Confirmation Script --}}
<script>
function confirmDelete() {
    const propertyAddress = "{{ $contract->property->address }}";
    const tenant = "{{ $contract->tenant1_name }}";

    if (confirm(`¿Estás seguro de que deseas eliminar este contrato?\n\nPropiedad: ${propertyAddress}\nInquilino: ${tenant}\n\nEsta acción no se puede deshacer.`)) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection
