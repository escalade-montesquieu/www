<x-baseof-layout>
    <div class="h-screen flex flex-coool">
        <x-header/>

        <main class="h-full container lg:max-w-2xl overflow-x-hidden flex flex-coool gap-2">
            {{ $slot }}
        </main>
    </div>
</x-baseof-layout>

