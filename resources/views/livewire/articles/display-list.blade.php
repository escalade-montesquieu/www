<div class="flex flex-coool gap-16">
    @if(!$onlyPinned)
        <section
            class="sticky top-header bg-white-light z-10 py-4 -my-4 grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-16">
            <div class="col-span-full lg:col-span-4">
                <label for="orderBy">Ordonner par</label>
                <select wire:model="orderBy" id="orderBy" name="orderBy" class="input w-full">
                    <option value="none">Par défaut</option>
                    <option value="desc">Récent d'abord</option>
                    <option value="asc">Ancien d'abord</option>
                </select>
            </div>
        </section>
    @endif
    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-16 lg:gap-16">
        @foreach($this->articles as $article)
            <div class="xl:[&:nth-child(4)]:hidden">
                <x-articles.card :article="$article"/>
            </div>
        @endforeach
    </section>
</div>
