<div x-data="{ isOpen: false }" class="z-40 sticky top-0">
    <header class="flex w-full bg-white-medium">
        <div class="container flex flex-row justify-between p-4">
            <button class="md:hidden" @click="isOpen = true">
                <x-heroicon-o-menu class="icon"/>
            </button>
            <nav class="max-md:hidden flex flex-row gap-2">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('articles') }}">Articles</a>
                <a href="{{ route('events') }}">Évènements</a>
                <a href="{{ route('home') }}">Forum</a>
                <a href="{{ route('home') }}">Galerie photo</a>
            </nav>
            <div class="md:hidden">
                @auth
                    <div class="relative flex flex-row items-center justify-center gap-2">
                        <span>{{ auth()->user()->name }}</span>
                        <img class="h-8 w-8" src="{{ auth()->user()->avatar }}" alt=" ">
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-cta">Se connecter</a>
                @endif
            </div>
        </div>
    </header>

    <div x-show="isOpen" @click="isOpen = false" class="md:hidden fixed inset-0 bg-black-dark opacity-40"></div>

    <section x-show="isOpen" class="md:hidden fixed top-0 left-0 h-screen w-[70%] p-4 bg-white-medium">
        <button @click="isOpen = false">
            <x-heroicon-o-x class="icon"/>
        </button>
        <nav class="mt-8 flex flex-col gap-2">
            <a href="{{ route('home') }}" class="link-offcanvas">Accueil</a>
            <a href="{{ route('articles') }}" class="link-offcanvas">Articles</a>
            <a href="{{ route('events') }}" class="link-offcanvas">Évènements</a>
            <a href="{{ route('home') }}" class="link-offcanvas">Forum</a>
            <a href="{{ route('home') }}" class="link-offcanvas">Galerie photo</a>
        </nav>
    </section>
</div>
