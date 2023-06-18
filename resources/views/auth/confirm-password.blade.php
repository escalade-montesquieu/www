<x-auth-layout>
    @section('robots', 'noindex, follow')
    
    <div class="flex flex-coool items-center pb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        <h4 class="text-h4">Confirmer votre mot de passe</h4>
        <p class="text-center pt-4">Pour des raisons de sécurité merci d'entrer votre mot de passe</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-coool gap-8">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <button class="btn-cta-primary">Continuer</button>
    </form>
</x-auth-layout>
