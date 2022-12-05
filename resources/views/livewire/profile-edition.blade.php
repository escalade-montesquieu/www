<article class="container flex flex-coool">
    <x-back-link class="mr-auto"/>

    <section class="mt-10 flex flex-row gap-4 w-full items-center">
        <img class="rounded-full w-1/3" src="{{ asset($user->avatar) }}">
        <div>
            <h4 class="text-cta">Modifier votre photo</h4>
            <p class="text-label">Maximum 10Mo</p>
        </div>
    </section>

    <section class="flex flex-coool mt-6 gap-6">
        @csrf

        <div>
            <x-input-label for="email" value="Email"/>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          wire:model="email"
                          required autofocus/>

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="bio" value="À propos de vous"/>

            <x-text-area id="bio" class="block mt-1 w-full" type="text" name="bio"
                         wire:model="bio"
                         rows="3"
                         required/>

            <x-input-error :messages="$errors->get('bio')" class="mt-2"/>
        </div>

        <div class="flex flex-coool gap-2">
            <h4 class="text-h4">Vous empruntez</h4>

            <article class="bg-white-medium rounded-lg flex flex-coool overflow-hidden">
                <div
                    class="p-2 flex flex-row items-center gap-2 @if($rent_harness) bg-blue-light text-blue-medium @endif"
                    wire:click="toggleRentHarness">
                    @if($rent_harness)
                        <x-heroicon-o-check class="h-6 w-6"/>
                    @else
                        <div class="bg-white-dark h-6 w-6 rounded-md"></div>
                    @endif

                    <label>Un baudrier</label>
                </div>
            </article>

            <article class="bg-white-medium rounded-lg flex flex-coool overflow-hidden">
                <div
                    class="p-2 flex flex-row items-center gap-2 @if($rent_shoes) bg-blue-light text-blue-medium @endif"
                    wire:click="toggleRentShoes">
                    @if($rent_shoes)
                        <x-heroicon-o-check class="h-6 w-6"/>
                    @else
                        <div class="bg-white-dark h-6 w-6 rounded-md"></div>
                    @endif

                    <label>Des chaussons</label>
                </div>
                @if($rent_shoes)
                    <div class="ml-8 p-2 flex flex-coool">
                        <p>Taille :</p>
                        <select class="btn">
                            <option>qsdqsd</option>
                        </select>
                    </div>
                @endif
            </article>
        </div>

        <button class="btn-cta-primary" wire:click="saveChanges">Enregistrer</button>
    </section>
</article>
