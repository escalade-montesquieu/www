<x-auth-layout>
    <div class="flex flex-coool items-center pb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        <h4 class="text-h4">Réinitialiser votre mot de passe</h4>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('password.update') }}" class="flex flex-coool gap-8">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email"/>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email', $request->email)"
                          required autofocus/>

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Mot de passe"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation"
                          required/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <button class="btn-cta-primary">Réinitialiser le mot de passe</button>
    </form>
</x-auth-layout>
