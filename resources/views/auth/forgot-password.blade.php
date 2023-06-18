<x-auth-layout>
    <div class="flex flex-coool items-center pb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        <h4 class="text-h4">Mot de passe oublié</h4>
        <p class="text-center pt-4">Nous allons vous envoyer un mail pour
            réinitialiser votre mot de passe.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('password.email') }}" class="flex flex-coool gap-8">
        @csrf

        <div>
            <x-input-label for="email" value="Email"/>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                          required autofocus/>

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <button class="btn-cta-primary">Recevoir le mail</button>
    </form>
</x-auth-layout>
