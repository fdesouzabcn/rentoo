@props(['color' => 'blue'])

@php
    $colorClasses = [
        'green' => 'text-green-600',
        'blue' => 'text-blue-600',
        'purple' => 'text-purple-600',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<li class="flex items-start gap-2">
    <svg class="w-5 h-5 {{ $colorClass }} mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span class="text-sm text-slate-700">{{ $slot }}</span>
</li>
