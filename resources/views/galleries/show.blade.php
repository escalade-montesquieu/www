<x-app-layout>
    <article class="container flex flex-coool gap-10">
        <x-back-link :link="route('galleries')"/>
        <header>
            <h1 class="text-h1 mb-2">{{ $gallery->name }}</h1>
        </header>
        <section class="grid grid-cols-2 gap-4 mt-8" id="gallery">
            @foreach($gallery->photos as $photo)
                <a href="{{ asset($photo->src) }}"
                   target="_blank"
                   @php($size=getimagesize($photo->src))
                   data-pswp-width="{{ $size[0] }}"
                   data-pswp-height="{{ $size[1] }}"
                >
                    <img class="rounded-lg" src="{{ asset($photo->src) }}" alt=""/>
                </a>
            @endforeach
        </section>
    </article>
</x-app-layout>
