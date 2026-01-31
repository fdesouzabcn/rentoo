{{--
    Key Feature Item Component

    Usage:
    <x-key-feature-item
        title="Cumplimiento Legal"
        description="Validación automática de documentos..."
        color="blue">

        <x-slot name="icon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="..."/>
        </x-slot>
    </x-key-feature-item>

    Props:
    - title: Feature title (required)
    - description: Feature description (required)
    - color: blue|green|purple|amber (default: blue)

    Slots:
    - icon: SVG path element only (component provides the <svg> wrapper)
--}}

@props([
    'title',
    'description',
    'color' => 'blue'
])

@php
    // Map color names to Tailwind classes
    $colorClasses = [
        'blue' => 'bg-blue-600',
        'green' => 'bg-green-600',
        'purple' => 'bg-purple-600',
        'amber' => 'bg-amber-600',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="flex items-start gap-4">
    {{-- Icon Container --}}
    <div class="w-10 h-10 {{ $colorClass }} rounded-lg flex items-center justify-center shrink-0">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {{ $icon }}
        </svg>
    </div>

    {{-- Content --}}
    <div>
        <h3 class="font-semibold text-slate-900 mb-1">{{ $title }}</h3>
        <p class="text-sm text-slate-600">{{ $description }}</p>
    </div>
</div>
