<nav
    class="fixed top-0 left-0 -translate-y-full focus-within:translate-y-0 z-50 flex flex-col gap-2 bg-white-dark p-6">
    <ul class="nav-accessibility" aria-label="Navigation d'accès rapide">
        <li><a href="#main">Accéder au contenu principal</a></li>
        <li><a href="#navigation">Accéder à la navigation</a></li>
    </ul>
</nav>
<div id="navigation" x-data="{ isOpen: false }" class="z-40 sticky top-0">
    <header class="flex w-full bg-white-medium">
        <div class="container flex flex-row items-center justify-between h-header">
            <button class="md:hidden" @click="isOpen = true">
                <x-heroicon-o-menu class="icon"/>
            </button>
            <nav class="max-md:hidden flex flex-row gap-8">
                <a class="link-nav" href="{{ route('home') }}">Accueil</a>
                <a class="link-nav" href="{{ route('articles') }}">Articles</a>
                <a class="link-nav" href="{{ route('events') }}">Évènements</a>
                <a class="link-nav" href="{{ route('forum') }}">Forum</a>
                <a class="link-nav" href="{{ route('galleries') }}">Photos</a>
            </nav>
            <div>
                @auth
                    <x-header-user-dropdown/>
                @else
                    <a href="{{ route('login') }}" class="link-nav">Se connecter</a>
                @endif
            </div>
        </div>
    </header>

    <div x-show="isOpen" class="md:hidden fixed inset-0 bg-black-dark opacity-40"></div>

    <section x-show="isOpen" @click.outside="isOpen = false"
             class="md:hidden fixed top-0 left-0 h-screen w-[70%] p-4 bg-white-medium">
        <button @click="isOpen = false">
            <x-heroicon-o-x class="icon"/>
        </button>
        <nav class="mt-8 flex flex-coool gap-2">
            <a href="{{ route('home') }}" class="link-offcanvas">Accueil</a>
            <a href="{{ route('articles') }}" class="link-offcanvas">Articles</a>
            <a href="{{ route('events') }}" class="link-offcanvas">Évènements</a>
            <a href="{{ route('forum') }}" class="link-offcanvas">Forum</a>
            <a href="{{ route('galleries') }}" class="link-offcanvas">Photos</a>
        </nav>
    </section>
</div>
