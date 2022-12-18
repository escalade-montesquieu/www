<x-app-layout>

    <section class="pt-12 lg:py-28 lg:bg-white-medium">
        <div class="container grid grid-cols-1 lg:grid-cols-12 gap-16">
            <article class="relative -mt-20 pt-20 pb-10 lg:col-start-1 lg:col-end-7">
                <div class="lg:hidden -z-10 absolute inset-0 bg-white-medium scale-x-400 rotate-3"></div>
                <h1 class="text-h1 lg:mt-4">Lycée Montesquieu</h1>
                <h2 class="text-h2 lg:mt-2">Section Escalade</h2>

                <p class="max-lg:hidden mt-8">
                    Bienvenue sur le site de la section escalade du lycée Montesquieu à Bordeaux.
                </p>
                <p class="max-lg:hidden mt-4">
                    Nous préparons les élèves grimpeurs avec des entraînements sportifs, dans un cadre alliant
                    curiosité, responsabilité et bonne humeur.
                </p>
            </article>
            <article class="lg:col-start-7 lg:col-end-13">
                <div class="swiper w-full overflow-hidden rounded-lg lg:rounded-2xl">
                    <div class="swiper-wrapper ">
                        <!-- Slides -->
                        @foreach($photos as $photo)
                            <div class="swiper-slide">
                                <img class="rounded-lg lg:rounded-2xl" src="{{ $photo->assetSrc }}" alt=""/>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <p class="lg:hidden mt-8">
                    Bienvenue sur le site de la section escalade du lycée Montesquieu à Bordeaux.
                </p>
                <p class="lg:hidden mt-4">
                    Nous préparons les élèves grimpeurs avec des entraînements sportifs, dans un cadre alliant
                    curiosité, responsabilité et bonne humeur.
                </p>
            </article>
        </div>
    </section>

    <article class="container relative space-y-10 mt-20 max-lg:py-8 lg:mt-32">
        <div class="lg:hidden -z-10 py-8 absolute inset-0 bg-white-medium scale-x-400 -rotate-3"></div>
        <h2 class="text-h2 flex flex-row gap-4">
            Articles
            <a href="{{ route('articles') }}" class="max-lg:hidden btn-cta-secondary">Tout voir</a>
        </h2>
        <livewire:articles.display-list :onlyOnHomepage="true"/>
        <a href="{{ route('articles') }}" class="lg:hidden btn-cta-tertiary">Tout voir</a>
    </article>

    <section class="relative container grid grid-cols-12 gap-16">
        <article class="col-span-full lg:col-span-6 space-y-10 mt-20 lg:mt-32">
            <h2 class="text-h2">Évènements à venir</h2>
            <livewire:events.display-list :onlyIncoming="true"/>
            <a href="{{ route('events') }}" class="btn-cta-secondary">Tout voir</a>
        </article>

        <article class="sticky top-0 col-span-full lg:col-span-6 space-y-10 mt-20 lg:mt-32">
            <h2 class="text-h2">Forum</h2>
            <p>Posez vos questions, organisez des sessions entre lycéens, partagez vos expériences !</p>
            <a href="{{ route('events') }}" class="btn-cta-secondary">Aller au forum</a>
        </article>
    </section>

</x-app-layout>
