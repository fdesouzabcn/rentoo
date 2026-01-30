@extends('layouts.app')

@section('title', 'Test Page - Rentoo')

@section('content')
    <div class="space-y-8">
        {{-- Header --}}
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900 mb-2">
                Layout Test Page
            </h1>
            <p class="text-lg text-slate-600">
                Testing app.blade.php with Tailwind CSS
            </p>
        </div>

        {{-- Color Test Card --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Color System Test
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="w-full h-20 bg-slate-50 rounded border border-slate-200"></div>
                    <p class="text-sm mt-2">slate-50</p>
                </div>
                <div class="text-center">
                    <div class="w-full h-20 bg-slate-200 rounded"></div>
                    <p class="text-sm mt-2">slate-200</p>
                </div>
                <div class="text-center">
                    <div class="w-full h-20 bg-blue-600 rounded"></div>
                    <p class="text-sm mt-2 text-black">blue-600</p>
                </div>
                <div class="text-center">
                    <div class="w-full h-20 bg-blue-700 rounded"></div>
                    <p class="text-sm mt-2 text-black">blue-700</p>
                </div>
            </div>
        </div>

        {{-- Typography Test Card --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Typography Test
            </h2>
            <div class="space-y-3">
                <p class="text-sm text-slate-600">text-sm (14px) - Small text</p>
                <p class="text-base text-slate-700">text-base (16px) - Base text</p>
                <p class="text-lg text-slate-800">text-lg (18px) - Large text</p>
                <p class="text-xl text-slate-900">text-xl (20px) - Extra large</p>
                <p class="text-2xl font-bold text-slate-900">text-2xl (24px) - Heading</p>
            </div>
        </div>

        {{-- Spacing Test Card --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Spacing Test
            </h2>
            <div class="space-y-4">
                <div class="bg-blue-100 p-2 rounded">p-2 (8px padding)</div>
                <div class="bg-blue-100 p-4 rounded">p-4 (16px padding)</div>
                <div class="bg-blue-100 p-6 rounded">p-6 (24px padding)</div>
                <div class="bg-blue-100 p-8 rounded">p-8 (32px padding)</div>
            </div>
        </div>

        {{-- Responsive Test Card --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Responsive Test
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-green-100 p-4 rounded text-center">
                    <p class="font-medium">Column 1</p>
                    <p class="text-sm text-slate-600">1 col mobile</p>
                    <p class="text-sm text-slate-600">2 col tablet</p>
                    <p class="text-sm text-slate-600">3 col desktop</p>
                </div>
                <div class="bg-green-100 p-4 rounded text-center">
                    <p class="font-medium">Column 2</p>
                    <p class="text-sm text-slate-600">Resize browser</p>
                    <p class="text-sm text-slate-600">to see changes</p>
                </div>
                <div class="bg-green-100 p-4 rounded text-center">
                    <p class="font-medium">Column 3</p>
                    <p class="text-sm text-slate-600">Mobile: Stack</p>
                    <p class="text-sm text-slate-600">Desktop: Row</p>
                </div>
            </div>
        </div>

        {{-- Button Test Card --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Button Styles Test
            </h2>
            <div class="flex flex-wrap gap-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Primary Button
                </button>
                <button class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors">
                    Secondary Button
                </button>
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Outline Button
                </button>
            </div>
        </div>

        {{-- Navigation Active State Test --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Navigation Test
            </h2>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-sm text-yellow-800">
                    <strong>✓ Test:</strong> Look at the navigation bar above.
                    None of the links should be highlighted (blue background) since this is a test page.
                </p>
                <p class="text-sm text-yellow-800 mt-2">
                    <strong>Next:</strong> When you visit /owners, /properties, or /contracts,
                    the corresponding nav link will have a blue background.
                </p>
            </div>
        </div>

        {{-- Mobile Menu Test --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-slate-800 mb-4">
                Mobile Menu Test
            </h2>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-800">
                    <strong>✓ Desktop:</strong> Navigation links visible in header
                </p>
                <p class="text-sm text-blue-800 mt-2">
                    <strong>✓ Mobile:</strong> Hamburger menu icon appears (resize browser to < 768px)
                </p>
                <p class="text-sm text-blue-800 mt-2">
                    <strong>✓ Click hamburger:</strong> Mobile menu slides down
                </p>
            </div>
        </div>

        {{-- Success Message --}}
        <div class="bg-green-50 border-l-4 border-green-500 rounded-r-lg p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-green-900 mb-1">
                        Layout Working Correctly!
                    </h3>
                    <p class="text-green-800">
                        If you can see this page with proper styling, colors, and responsive design,
                        your app.blade.php layout and Tailwind CSS are configured correctly.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
