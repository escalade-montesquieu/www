<div class="flex flex-coool gap-16">
    @if(!$onlyOnHomepage)
        <section class="sticky top-header bg-white-light py-4 -my-4 grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-16">
            <div class="col-span-full lg:col-span-4">
                <label for="orderBy">Ordonner par</label>
                <select wire:model="orderBy" id="orderBy" name="orderBy" class="input w-full">
                    <option value="desc">Récent d'abord</option>
                    <option value="asc">Ancien d'abord</option>
                </select>
            </div>
        </section>
    @endif
    <section class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-16 lg:gap-16">
        @foreach($this->articles as $article)
            <x-articles.card :article="$article"/>
        @endforeach
    </section>
</div>
