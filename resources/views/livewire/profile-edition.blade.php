<article class="container max-w-2xl pt-8 flex flex-coool gap-10">
    <x-back-link class="mr-auto"/>

    {{ $errors }}

    <label class="w-full flex flex-row gap-4 w-full items-center"
           x-data="{ isUploading: false, isUploaded: false, progress: 0 }"
           x-on:livewire-upload-start="isUploading = true"
           x-on:livewire-upload-finish="isUploading = false; isUploaded = true"
           x-on:livewire-upload-error="isUploading = false"
           x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <input type="file" wire:model="avatar" class="hidden">
        <img class="rounded-full w-1/4 aspect-square object-cover flex-shrink-0"
             src="{{ $avatar?->temporaryUrl() ?? $user->avatar }}" alt="">
        <div>
            <h4 class="text-cta">Modifier votre photo</h4>
            <p x-show="!isUploading && !isUploaded" class="text-label">Maximum 10Mo</p>

            <p x-show="isUploading" class="text-label">Envoi en cours</p>

            <div x-show="isUploading" class="relative h-1 w-full bg-blue-light rounded-full overflow-hidden">
                <div class="h-full bg-blue-medium" :style="'width:'+progress+'%'"></div>
            </div>

            <p x-show="!isUploading && isUploaded" class="text-label">Modification enregistrée !</p>

            <x-input-error :messages="$errors->get('avatar')" class="mt-2"/>
        </div>
    </label>

    <section class="flex flex-coool gap-6">
        <section>
            <x-input-label for="email" value="Email"/>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          wire:model="email"
                          required autofocus/>

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </section>

        <section>
            <x-input-label for="bio" value="À propos de vous"/>

            <x-text-area id="bio" class="block mt-1 w-full" type="text" name="bio"
                         wire:model="bio"
                         rows="4"
                         required/>

            <x-input-error :messages="$errors->get('bio')" class="mt-2"/>
        </section>

        <section class="flex flex-coool gap-2">
            <h4 class="text-h4">Vous empruntez</h4>

            <article class="bg-white-medium rounded-lg flex flex-coool">
                <button
                    class="rounded-lg p-2 flex flex-row items-center gap-2 @if($rent_harness) bg-blue-light text-blue-medium @endif"
                    wire:click="toggleRentHarness">
                    @if($rent_harness)
                        <x-heroicon-o-check class="h-6 w-6"/>
                    @else
                        <div class="bg-white-dark h-6 w-6 rounded-md"></div>
                    @endif

                    <label>Un baudrier</label>
                </button>
            </article>

            <article class="bg-white-medium rounded-lg flex flex-coool">
                <button
                    class="rounded-lg p-2 flex flex-row items-center gap-2 @if($rent_shoes) bg-blue-light text-blue-medium @endif"
                    wire:click="toggleRentShoes">
                    @if($rent_shoes)
                        <x-heroicon-o-check class="h-6 w-6"/>
                    @else
                        <div class="bg-white-dark h-6 w-6 rounded-md"></div>
                    @endif

                    <label>Des chaussons</label>
                </button>
                @if($rent_shoes)
                    <div class="rounded-lg ml-8 p-2 flex flex-coool">
                        <label for="rent_shoes">Taille :</label>
                        <select class="btn" wire:model="rent_shoes" id="rent_shoes">
                            @foreach(App\Models\User::getShoesSizesAvailable() as $size=>$label)
                                <option value="{{ $size }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </article>
        </section>

        <section class="flex flex-coool gap-2">
            <h4 class="text-h4">Préférences email</h4>

            @foreach(App\Enums\UserEmailPreference::cases() as $case)
            <article class="bg-white-medium rounded-lg flex flex-coool">
                <button
                    class="rounded-lg p-2 flex flex-row items-center gap-2 @if($this->isEmailPreferenceSelected($case)) bg-blue-light text-blue-medium @endif"
                    wire:click="toggleEmailPreference('{{ $case->value }}')">
                    @if($this->isEmailPreferenceSelected($case))
                        <x-heroicon-o-check class="h-6 w-6"/>
                    @else
                        <div class="bg-white-dark h-6 w-6 rounded-md"></div>
                    @endif

                    <label>{{ $case->toLabel() }}</label>
                </button>
            </article>
            @endforeach
        </section>

        <button class="btn-cta-primary" wire:click="saveChanges">Enregistrer</button>
    </section>
</article>
