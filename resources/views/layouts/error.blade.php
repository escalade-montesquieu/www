<x-baseof-layout>
    <div class="min-h-screen">

        <x-header/>

        <main id="main" class="container max-w-xl mt-20 min-h-full space-y-6">
            <img src="{{ asset('/assets/svg/bug.svg') }}" alt=" "/>
            {{ $slot }}
        </main>
    </div>

</x-baseof-layout>

