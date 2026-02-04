@props([
    'title',
    'description',
    'color' => 'blue',
    'route',
    'buttonText' => 'Ver más'
])

@php
    // Map color names to Tailwind classes
    $colorClasses = [
        'green' => [
            'iconBg' => 'bg-green-100',
            'iconColor' => 'text-green-600',
            'buttonBg' => 'bg-green-600',
            'buttonHover' => 'hover:bg-green-700',
        ],
        'blue' => [
            'iconBg' => 'bg-blue-100',
            'iconColor' => 'text-blue-600',
            'buttonBg' => 'bg-blue-600',
            'buttonHover' => 'hover:bg-blue-700',
        ],
        'purple' => [
            'iconBg' => 'bg-purple-100',
            'iconColor' => 'text-purple-600',
            'buttonBg' => 'bg-purple-600',
            'buttonHover' => 'hover:bg-purple-700',
        ],
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
    <div class="p-6">
        {{-- Icon --}}
        <div class="w-12 h-12 {{ $colorClass['iconBg'] }} rounded-lg flex items-center justify-center mb-4">
            <svg class="w-6 h-6 {{ $colorClass['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {{ $icon }}
            </svg>
        </div>

        {{-- Title --}}
        <h2 class="text-2xl font-semibold text-slate-900 mb-3">
            {{ $title }}
        </h2>

        {{-- Description --}}
        <p class="text-slate-600 mb-4 leading-relaxed">
            {{ $description }}
        </p>

        {{-- Checklist --}}
        <ul class="space-y-2 mb-6">
            {{ $checklist }}
        </ul>

        {{-- CTA Button --}}
        <a href="{{ route($route) }}"
           class="inline-flex items-center justify-center w-full px-4 py-2 {{ $colorClass['buttonBg'] }} text-white font-medium rounded-lg {{ $colorClass['buttonHover'] }} transition-colors">
            {{ $buttonText }}
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div>
