<article class="group rounded-xl flex flex-coool overflow-hidden relative bg-white-medium">
    @if($gallery->photo)
        <div class="aspect-5/4 overflow-hidden">
            <img class="group-hover:scale-110 duration-1000 transition-transform border-0 object-cover h-full w-full"
                 src="{{ asset('storage/'.$gallery->photo->small_image) }}">
        </div>
    @endif
    <h3 class="text-h3 p-4">
        <a class="link-stretch" href="{{ route('galleries.show', $gallery) }}">
            {{ $gallery->title }}
        </a>
    </h3>
</article>
