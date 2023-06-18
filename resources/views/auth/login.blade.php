<x-auth-layout>
    <div class="flex flex-coool items-center pb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        <h2 class="text-h2">Se connecter</h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}" class="flex flex-coool gap-8">
        @csrf

        <div>
            <x-input-label for="email" value="Email"/>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                          required autofocus/>

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="password" value="Mot de passe"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            @if (Route::has('password.request'))
                <a class="float-right link" href="{{ route('password.request') }}">
                    Vous l'avez oublié?
                </a>
            @endif

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="flex flex-coool gap-4">
            <button class="btn-cta-primary">Se connecter</button>
            <a class="btn-cta-tertiary" href="{{ route('register') }}">Je n'ai pas de compte</a>
        </div>
    </form>
</x-auth-layout>
