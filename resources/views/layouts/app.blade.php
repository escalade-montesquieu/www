<x-baseof-layout>
    <div class="min-h-screen">

        <x-header/>

        <main class="overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>

    <x-footer/>
</x-baseof-layout>

