<x-baseof-layout>
    <main class="h-screen container overflow-x-hidden flex flex-coool gap-2 py-10">
        <x-back-link class="mb-auto mt-auto" :link="route('home')"/>
        {{ $slot }}
    </main>
</x-baseof-layout>

