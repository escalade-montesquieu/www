@unless ($breadcrumbs->isEmpty())
    <ol id="breadcrumbs" class="breadcrumb pointer-events-auto">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li>
                    <a href="{{ $breadcrumb->url }}"
                       class="breadcrumb-item link">{{ $breadcrumb->title }}</a>
                </li>
                <li>/</li>
            @else
                <li class="breadcrumb-item">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
@endunless
