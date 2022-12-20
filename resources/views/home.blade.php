<x-app-layout>

    <section class="overflow-hidden pt-12 lg:py-28 lg:bg-white-medium">
        <div class="container grid grid-cols-1 lg:grid-cols-12 gap-16">
            <article class=" relative -mt-20 pt-20 pb-10 lg:col-start-1 lg:col-end-7">
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

    <article class="overflow-hidden container relative flex flex-col gap-8 mt-40 max-lg:py-8 lg:mt-32">
        <div class="lg:hidden -z-10 py-8 absolute inset-0 bg-white-medium scale-x-400 -rotate-3"></div>
        <h2 class="text-h2 flex">
            <a href="{{ route('articles') }}" class="mr-auto group flex flex-row items-baseline gap-6">
                <span class="duration-150 transition-colors lg:underline decoration-white-light
                group-hover:decoration-black-dark underline-offset-8 decoration-2">
                    Articles
                </span>
                <x-heroicon-o-arrow-right
                    class="max-lg:hidden h-8 w-8 stroke-1.5 duration-150 transition-transform group-hover:translate-x-2"/>
            </a>
        </h2>
        <livewire:articles.display-list :onlyOnHomepage="true"/>
        <a href="{{ route('articles') }}" class="lg:hidden btn-cta-tertiary">Tout voir</a>
    </article>

    <section class="container grid grid-cols-1 lg:grid-cols-12 gap-x-16 lg:mt-40">
        <article class="col-span-full lg:col-start-1 lg:col-end-7 space-y-8 max-lg:mt-20">
            <h2 class="text-h2">Évènements à venir</h2>
            <livewire:events.display-list :onlyIncoming="true"/>
            <a href="{{ route('events') }}" class="btn-cta-secondary">Tout voir</a>
        </article>

        <div class="col-span-full lg:col-start-8 lg:col-end-13 lg:row-start-1 max-lg:mt-20">
            <article class="lg:sticky lg:top-40 space-y-4 lg:space-y-8">
                <h2 class="text-h2">Forum</h2>
                <p>
                    Posez vos questions, organisez des sessions entre lycéens, partagez vos expériences !
                </p>
                <a href="{{ route('events') }}" class="btn-cta-secondary mr-auto">Aller au forum</a>
            </article>
        </div>
    </section>

</x-app-layout>
