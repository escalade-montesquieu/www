<x-baseof-layout>
    <div class="min-h-screen">

        <x-header/>

        <main class="pt-12 overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>

    <x-footer/>
</x-baseof-layout>

