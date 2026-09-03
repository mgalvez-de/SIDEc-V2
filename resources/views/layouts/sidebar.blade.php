<div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40">
</div>

<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-50 p-4">


    <div class="mb-6 mt-2 py-2 px-3 bg-ucsc-red text-white rounded-lg text-center font-bold">
        Menú - SIDEc
    </div>
    <nav class="space-y-1">
        @role('Manager|Area Manager')
        <a href="{{ route('dashboard') }}"
            class="block py-2 px-3 rounded-lg text-gray-700 font-medium hover:bg-ucsc-red hover:text-white transition">
            Dashboard
        </a>
        @endrole

        @role('Manager|Area Manager')
        <a href="#"
            class="block py-2 px-3 rounded-lg text-gray-700 font-medium hover:bg-ucsc-red hover:text-white transition">
            Recepciones
        </a>
        @endrole

        @role('Analist|Manager|Area Manager')
        <a href="#"
            class="block py-2 px-3 rounded-lg text-gray-700 font-medium hover:bg-ucsc-red hover:text-white transition">
            Ingreso de muestras
        </a>
        @endrole

        @role('Manager|Area Manager')
        <a href="#"
            class="block py-2 px-3 rounded-lg text-gray-700 font-medium hover:bg-ucsc-red hover:text-white transition">
            Rechazos
        </a>
        @endrole

        @role('Analist|Manager|Area Manager')
        <div x-data="{ bioassaysOpen: false }">
            <button @click="bioassaysOpen = !bioassaysOpen"
                class="w-full flex items-center justify-between py-2 px-3 rounded-lg text-gray-700 font-medium hover:bg-ucsc-red hover:text-white transition">
                <span>Bioensayos</span>
                <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': bioassaysOpen }" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="bioassaysOpen" class="pl-4 mt-1 space-y-1">
                <a href="#"
                    class="block py-1.5 px-3 rounded-lg text-sm text-gray-600 hover:bg-ucsc-red hover:text-white transition">
                    Daphnia magna
                </a>
                <a href="#"
                    class="block py-1.5 px-3 rounded-lg text-sm text-gray-600 hover:bg-ucsc-red hover:text-white transition">
                    Isochrysis galbana
                </a>
                <a href="#"
                    class="block py-1.5 px-3 rounded-lg text-sm text-gray-600 hover:bg-ucsc-red hover:text-white transition">
                    Selenastrum capricornutum
                </a>
            </div>
        </div>
        @endrole

    </nav>

</div>