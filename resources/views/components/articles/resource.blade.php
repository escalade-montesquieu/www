@props(['resource', 'hideTitle' => false])
<article class="w-full">
    @if($resource['type'] === \App\Enums\ArticleResourceType::LINK->value)
        <a href="{{ $resource['data']['url'] }}"
           class="mb-2 flex items-center justify-between gap-2 px-4 py-3 bg-white-medium rounded-lg font-semibold hover:bg-white-dark">
            <span class="sr-only">Lien</span>
            <span>{{ $resource['data']['title'] }}</span>
            <x-heroicon-o-link class="h-6 w-6 text-blue-medium"/>
        </a>
    @else
        @if($resource['data']['title'] && !$hideTitle)
            <h4 class="text-h4 mb-2">{{ $resource['data']['title'] }}</h4>
        @endif
        <div class="mb-2 w-full aspect-video bg-white-medium overflow-hidden rounded-lg">

            @if($resource['type'] === \App\Enums\ArticleResourceType::YOUTUBE_VIDEO->value)
                @php($id =$resource['data']['url'])
                <iframe class="w-full h-full"
                        src="https://www.youtube-nocookie.com/embed/{{ getYoutubeIdFromUrl($id) }}"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
            @elseif($resource['type'] === \App\Enums\ArticleResourceType::INTERNAL_PHOTO->value)
                @php($photo = \App\Models\Photo::find($resource['data']['photo_id']))
                @if($photo)
                    <img class="w-full h-full object-cover"
                         src="{{ asset('storage/'.$photo->small_image) }}"
                         alt="{{ $resource['data']['title'] }}"/>
                @endif
            @elseif($resource['type'] === \App\Enums\ArticleResourceType::EXTERNAL_PHOTO->value)
                <img class="w-full h-full object-cover"
                     src="{{ $resource['data']['url'] }}"
                     alt="{{ $resource['data']['title'] }}"/>
            @elseif($resource['type'] === \App\Enums\ArticleResourceType::EMBED->value)
                <div class="containing-iframe">
                    {!! $resource['data']['content'] !!}
                </div>
            @endif
        </div>
    @endif
</article>

