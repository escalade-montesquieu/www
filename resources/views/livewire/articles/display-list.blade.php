<div class="flex flex-coool gap-10">
    @if(!$onlyOnHomepage)
        <section class="flex flex-coool" x-show="showFilters">
            <label for="orderBy">Ordonner par</label>
            <select wire:model="orderBy" id="orderBy" name="orderBy" class="input">
                <option value="desc">Récent d'abord</option>
                <option value="asc">Ancien d'abord</option>
            </select>
        </section>
    @endif
    <section class="grid grid-cols-12 gap-8 lg:gap-16">
        @foreach($this->articles as $article)
            <x-articles.card :article="$article"/>
        @endforeach
    </section>
</div>
