<x-baseof-layout>
    <div class="min-h-screen">

        <x-header/>

        <main id="main">
            {{ $slot }}
        </main>
    </div>

    <x-footer/>
</x-baseof-layout>

