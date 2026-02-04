@if(session('success') || session('error'))
    <div id="flash-message"
         class="mb-6 rounded-lg shadow-lg p-4 flex items-start justify-between
                {{ session('success') ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">

        <div class="flex items-start">
            {{-- Icon --}}
            <div class="shrink-0">
                @if(session('success'))
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @else
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @endif
            </div>

            {{-- Message Text --}}
            <div class="ml-3">
                <p class="text-sm font-medium {{ session('success') ? 'text-green-800' : 'text-red-800' }}">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>
        </div>

        {{-- Close Button --}}
        <button type="button"
                onclick="document.getElementById('flash-message').remove()"
                class="shrink-0 ml-4 inline-flex text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Auto-dismiss after 5 seconds --}}
    <script>
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = 'opacity 0.5s ease-out';
                flashMessage.style.opacity = '0';
                setTimeout(function() {
                    flashMessage.remove();
                }, 500);
            }
        }, 5000);
    </script>
@endif
