<x-baseof-layout>
    <div class="h-screen flex flex-coool">
        <x-header/>

        <main class="h-full container overflow-x-hidden flex flex-coool gap-2">
            {{ $slot }}
        </main>
    </div>
</x-baseof-layout>

