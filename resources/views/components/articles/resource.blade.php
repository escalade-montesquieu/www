@if($resource['type'] === \App\Enums\ArticleResourceType::YOUTUBE_VIDEO->value)
    @php($id =$resource['data']['url'])
    <iframe class="mb-2 w-full aspect-video bg-white-medium"
            src="https://www.youtube-nocookie.com/embed/{{ getYoutubeIdFromUrl($id) }}"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
@elseif($resource['type'] === \App\Enums\ArticleResourceType::INTERNAL_PHOTO->value)
    @php($photo = \App\Models\Photo::find($resource['data']['photo_id']))
    @if($photo)
        <img class="mb-2 w-full aspect-video bg-white-medium object-cover"
             src="{{ $photo->public_src }}"
             alt="{{ $resource['data']['title'] }}"/>
    @endif
@elseif($resource['type'] === \App\Enums\ArticleResourceType::EXTERNAL_PHOTO->value)
    <img class="mb-2 w-full aspect-video bg-white-medium object-cover"
         src="{{ $resource['data']['url'] }}"
         alt="{{ $resource['data']['title'] }}"/>
@endif
