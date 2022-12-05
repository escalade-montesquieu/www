<div class="relative flex flex-col" x-data="{isOpen: false}">
    <button class="relative flex flex-row items-center justify-center gap-2" @click="isOpen=!isOpen">
        <span>{{ auth()->user()->username }}</span>
        <img class="h-8 w-8 rounded-full object-cover" src="{{ asset(auth()->user()->avatar) }}" alt=" ">
    </button>

    <div x-show="isOpen" @click.outside="isOpen = false"
         class="absolute top-[120%] w-auto right-0 flex flex-col gap-2 px-4 py-3 whitespace-nowrap rounded-lg bg-white-light">
        <a href="{{ route('profile.show') }}">Mon profil</a>
        @if(auth()->user()->canAccessFilament())
            <a href="{{ route('filament.pages.dashboard') }}">Panel admin</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
</div>
