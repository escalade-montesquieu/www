<div class="">
    <div class="flex flex-coool items-center pb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
        <h2 class="text-h2">Créer un compte</h2>
        @if($step===1)
            <p class="text-center pt-4">Vous devez être adhérent à la section sportive du lycée</p>
        @else
            <p class="text-center pt-4">Bienvenue, {{ $name }}!</p>
        @endif
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form wire:submit.prevent="register" class="flex flex-coool gap-8">
        @csrf

        @if($step === 1)
            <div>
                <x-input-label for="name" value="Votre nom"/>

                <x-text-input id="name" class="block mt-1 w-full"
                              type="text"
                              :value="old('name')"
                              wire:model="name"
                              required autofocus/>

                @if($this->isNameLongEnoughToShowSuggestions())
                    <div class="mt-2">
                        @if(count($nameSuggestions) && $nameSuggestions[0] === $name)
                            @if($this->canNextStep())
                                <span class="text-green-medium">Vous êtes dans la liste!</span>
                            @else
                                <span class="text-red-medium">Un compte à votre nom existe déjà</span>
                            @endif
                        @elseif(count($nameSuggestions))
                            <span>C'est vous?</span>
                            @foreach($nameSuggestions as $nameSuggestion)
                                <span class="text-cta text-blue-medium cursor-pointer"
                                      wire:click="setName('{{ $nameSuggestion }}')">
                                    {{ $nameSuggestion }}
                                </span>
                            @endforeach
                        @else
                            <span>Nous n'avons trouvé personne dans la liste :(</span>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex flex-coool gap-4">
                <button
                    @if($this->canNextStep())
                        class="btn-cta-primary"
                    @else
                        class="btn-disabled" disabled
                    @endif
                    type="button"
                    wire:click="nextStep()">
                    Continuer
                </button>
                <a class="btn-cta-tertiary" href="{{ route('login') }}">J'ai déjà un compte</a>
            </div>
        @endif

        @if($step === 2)
            <input type="hidden" value="{{ $name }}">

            <div>
                <x-input-label for="email" :value="__('Email')"/>

                <x-text-input id="email" class="block mt-1 w-full"
                              type="email"
                              wire:model="email"
                              :value="old('email')"
                              required/>

                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              wire:model="password"
                              type="password"
                              required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              wire:model="password_confirmation"
                              type="password"
                              required/>

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>

            <button class="btn-cta-primary">Créer mon compte</button>
        @endif

    </form>
</div>
