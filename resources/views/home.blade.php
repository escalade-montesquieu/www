<x-app-layout>
    <div class="container flex flex-coool gap-20">
        <article
            class="relative -mt-20 pt-20 pb-10 before:-z-10 before:absolute before:inset-0 before:bg-white-medium before:scale-x-400 before:rotate-3">
            <h1 class="text-h1">Lycée Montesquieu</h1>
            <h2 class="text-h2">Section Escalade</h2>
        </article>
        <article>
            <div class="swiper w-full">
                <div class="swiper-wrapper ">
                    <!-- Slides -->
                    @foreach($photos as $photo)
                        <div class="swiper-slide">
                            <img class="rounded-lg" src="{{ asset($photo->src) }}" alt=""/>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <p class="mt-8">Bienvenue sur le site de la section escalade du lycée Montesquieu à Bordeaux.</p>
            <p class="mt-4">Nous préparons les élèves grimpeurs avec des entraînements sportifs, dans un cadre alliant
                curiosité,
                responsabilité et bonne humeur.</p>
        </article>
        <article
            class="relative space-y-10 before:-z-10 py-8 before:absolute before:inset-0 before:bg-white-medium before:scale-x-400 before:-rotate-3">
            <h2 class="text-h2">Articles</h2>
            <livewire:articles.display-list :onlyOnHomepage="true"/>
            <a href="{{ route('articles') }}" class="btn-cta-tertiary">Tout voir</a>
        </article>
        <article class="space-y-10">
            <h2 class="text-h2">Évènements à venir</h2>
            <livewire:events.display-list :onlyIncoming="true"/>
            <a href="{{ route('events') }}" class="btn-cta-secondary">Tout voir</a>
        </article>
    </div>
</x-app-layout>
