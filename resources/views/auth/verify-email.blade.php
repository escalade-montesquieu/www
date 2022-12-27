<x-auth-layout>
    <div class="flex flex-coool items-center pb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        <h4 class="text-h4">Vérifier votre email</h4>
        <p class="text-center pt-4">Merci de cliquer dans le lien que vous allez recevoir afin de confirmer votre
            email</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button class="btn-cta-tertiary">Renvoyer un lien</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="btn-cta-tertiary">Se déconnecter</button>
        </form>
    </div>
</x-auth-layout>
