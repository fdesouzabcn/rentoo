@props(['status'])

@php
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
