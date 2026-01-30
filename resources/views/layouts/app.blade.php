<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rentoo - Sistema de Gestión de Contrato de Alquileres">
    <title>@yield('title', 'Rentoo - Gestión de Contrato de Alquileres')</title>

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    {{-- Navigation --}}
    <nav class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo/Brand --}}
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="text-xl font-bold text-slate-900">Rentoo</span>
                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('owners.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                              {{ request()->routeIs('owners.*')
                                  ? 'bg-blue-600 text-white'
                                  : 'text-slate-700 hover:bg-slate-100' }}">
                        Propietarios
                    </a>
                    <a href="{{ route('properties.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                              {{ request()->routeIs('properties.*')
                                  ? 'bg-blue-600 text-white'
                                  : 'text-slate-700 hover:bg-slate-100' }}">
                        Propiedades
                    </a>
                    <a href="{{ route('contracts.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                              {{ request()->routeIs('contracts.*')
                                  ? 'bg-blue-600 text-white'
                                  : 'text-slate-700 hover:bg-slate-100' }}">
                        Contratos
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden">
                    <button type="button"
                            onclick="toggleMobileMenu()"
                            class="p-2 rounded-lg text-slate-700 hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('owners.index') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('owners.*')
                              ? 'bg-blue-600 text-white'
                              : 'text-slate-700 hover:bg-slate-100' }}">
                    Propietarios
                </a>
                <a href="{{ route('properties.index') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('properties.*')
                              ? 'bg-blue-600 text-white'
                              : 'text-slate-700 hover:bg-slate-100' }}">
                    Propiedades
                </a>
                <a href="{{ route('contracts.index') }}"
                   class="block px-4 py-2 rounded-lg text-sm font-medium
                          {{ request()->routeIs('contracts.*')
                              ? 'bg-blue-600 text-white'
                              : 'text-slate-700 hover:bg-slate-100' }}">
                    Contratos
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center text-sm text-slate-600">
                <p>&copy; {{ date('Y') }} Rentoo - Sistema de Gestión de Contrato de Alquileres</p>
                <p class="mt-1">Desarrollado por Flavio De Souza</p>
            </div>
        </div>
    </footer>

    {{-- Mobile Menu Toggle Script --}}
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
