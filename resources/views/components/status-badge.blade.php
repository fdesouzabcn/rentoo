{{--
    Status Badge Component

    Usage:
    <x-status-badge status="DRAFT" />
    <x-status-badge status="FINALIZED" />

    Props:
    - status: Contract status (DRAFT|FINALIZED) (required)

    Displays:
    - Color-coded badge based on status
    - Translated label to Spanish
--}}

@props(['status'])

@php
    // Map status to colors and ES labels
    $statusConfig = [
        'draft' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-800',
            'label' => 'BORRADOR'
        ],
        'active' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'label' => 'ACTIVO'
        ],
         'finalized' => [
            'bg' => 'bg-gray-200',
            'text' => 'text-gray-800',
            'label' => 'FINALIZADO'
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['DRAFT'];
@endphp

<span class="inline-flex items-center px-3 py-1 {{ $config['bg'] }} {{ $config['text'] }} text-xs font-semibold rounded-full uppercase">
    {{ $config['label'] }}
</span>
