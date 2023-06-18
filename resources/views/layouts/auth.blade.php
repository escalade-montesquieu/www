<x-baseof-layout>
    <div class="h-screen  overflow-x-hidden flex flex-col">
        <div class="max-lg:hidden">
            <x-header/>
        </div>
        <main id="main" class="container max-w-md flex flex-coool gap-2 lg:gap-16 py-10 mt-auto lg:mb-auto">
            <x-back-link class="mr-auto lg:hidden" :link="route('home')"/>
            {{ $slot }}
        </main>
    </div>
</x-baseof-layout>

