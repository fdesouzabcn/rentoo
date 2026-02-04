@props([
    'value',
    'label',
    'color' => 'blue'
])

@php
    $colorClasses = [
        'green' => 'text-green-600',
        'blue' => 'text-blue-600',
        'purple' => 'text-purple-600',
        'amber' => 'text-amber-600',
        'red' => 'text-red-600',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="bg-white rounded-lg shadow p-6 text-center">
    <div class="text-3xl font-bold {{ $colorClass }} mb-2">{{ $value }}</div>
    <div class="text-sm text-slate-600">{{ $label }}</div>
</div>
