<x-app-layout>
    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        <x-back-link class="mr-auto"/>

        <div class="mt-10 flex flex-coool gap-2 w-full items-center">
            <img class="rounded-full w-1/3 aspect-square object-cover" src="{{ asset($user->avatar) }}">
            <h4 class="text-h4">{{ $user->name }}</h4>
            <p class="text-label">{{ $user->role->toLabel() }}</p>
        </div>

        @if($user->id === auth()->user()->id)
            <a href="{{ route('profile.edit') }}" class="mt-10 btn-cta-secondary">Modifier mon profil</a>
        @endif

        @if($user->rent_harness || $user->rent_shoes)
            <h4 class="mt-10 text-h4">J'emprunte</h4>
            <div class="mt-2 flex flex-row gap-2">
                @if($user->rent_harness)
                    <p class="bg-white-medium px-2 py-1 rounded-md">Baudrier</p>
                @endif

                @if($user->rent_shoes)
                    <p class="bg-white-medium px-2 py-1 rounded-md">Chaussons T{{$user->rent_shoes}}</p>
                @endif

            </div>
        @else
            <h4 class="mt-10 text-h4">J'ai mon matériel</h4>
            <div class="mt-2 flex flex-row gap-2">
                <p class="bg-white-medium px-2 py-1 rounded-md">Je n'emprunte rien</p>
            </div>
        @endif

        @if($user->bio)
            <h4 class="mt-10 text-h4">À propos de moi</h4>
            <p>{{ $user->bio }}</p>
        @endif
    </article>
</x-app-layout>
