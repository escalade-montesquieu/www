<x-app-layout>
    <article class="container flex flex-coool gap-10">
        <header>
            <h1 class="text-h1 mb-2">Galerie photo</h1>
            <p>Voici les photos ajoutées au fil des sorties. Souriez, vous êtes sans doute parmi ces photos!</p>
        </header>
    </article>

    <section class="container flex flex-coool gap-8 mt-8">
        @foreach($galleries as $gallery)
            <article class="rounded-xl flex flex-coool overflow-hidden">
                <img class="aspect-5/4 border-0 object-cover"
                     src="{{ $gallery->photo->assetSrc }}">
                <h3 class="text-h3 bg-white-medium p-4">
                    <a href="{{ route('galleries.show', $gallery) }}">
                        {{ $gallery->name }}
                    </a>
                </h3>
            </article>
        @endforeach
    </section>
</x-app-layout>
