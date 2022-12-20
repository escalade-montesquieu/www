<x-app-layout>
    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        <x-back-link :link="route('galleries')" text="Retour aux galeries"/>
        <header>
            <h1 class="text-h1 mb-2">{{ $gallery->name }}</h1>
        </header>
        <section class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-16" id="gallery">
            @foreach($gallery->photos as $photo)
                <a href="{{ $photo->assetSrc }}"
                   target="_blank"
                   data-pswp-width="{{ $photo->image_data[0] }}"
                   data-pswp-height="{{ $photo->image_data[1] }}"
                >
                    <img class="rounded-lg" src="{{ $photo->assetSrc }}" alt=""/>
                </a>
            @endforeach
        </section>
    </article>
</x-app-layout>
