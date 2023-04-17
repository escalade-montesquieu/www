<x-app-layout>

    <section class="overflow-hidden pt-12 lg:py-28 lg:bg-white-medium">
        <div class="container grid grid-cols-1 lg:grid-cols-12 gap-16">
            <article class=" relative -mt-20 pt-20 pb-10 lg:col-start-1 lg:col-end-7">
                <div class="lg:hidden -z-10 absolute inset-0 bg-white-medium scale-x-400 rotate-3"></div>
                <h1 class="text-h1 lg:mt-4">Lycée Montesquieu</h1>
                <h2 class="text-h2 lg:mt-2">Section Escalade</h2>

                <p class="max-lg:hidden mt-8">
                    Bienvenue sur le site de la section escalade du Lycée Montesquieu à Bordeaux.
                </p>
                <p class="max-lg:hidden mt-4">
                    Nous préparons les élèves grimpeurs avec des entraînements sportifs, dans un cadre alliant
                    curiosité, responsabilité et bonne humeur.
                </p>
            </article>
            <article class="lg:col-start-7 lg:col-end-13">
                <div class="swiper  w-full overflow-hidden rounded-lg lg:rounded-2xl">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($photos as $photo)
                            <div class="swiper-slide">
                                <img class="rounded-lg lg:rounded-2xl aspect-4/3 object-cover w-full"
                                     src="{{ asset('storage/'.$photo->large_image) }}" alt=""/>
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

    <article class="container relative max-md:bg-white-medium flex flex-col gap-8 mt-40 max-lg:py-8 lg:mt-32">
        <section class="flex justify-between items-end gap-4 whitespace-nowrap">
            <h2 class="text-h2 ">
                Derniers articles
            </h2>
            <a href="{{ route('articles') }}" class="max-md:hidden btn-cta-secondary">Voir tous les articles</a>
        </section>
        <livewire:articles.display-list :onlyPinned="true"/>
        <a href="{{ route('articles') }}" class="md:hidden btn-cta-tertiary">Tout voir</a>
    </article>

    <section class="container grid grid-cols-1 lg:grid-cols-12 gap-x-16 lg:mt-40">
        <article class="col-span-full lg:col-start-1 lg:col-end-7 space-y-8 max-lg:mt-20">
            <h2 class="text-h2">Évènements à venir</h2>
            <livewire:events.display-list :onlyIncoming="true"/>
            <a href="{{ route('events') }}" class="btn-cta-secondary">Tout voir</a>
        </article>

        <div class="col-span-full lg:col-start-8 lg:col-end-13 lg:row-start-1 max-lg:mt-20">
            <article class="lg:sticky lg:top-36 space-y-8">
                <h2 class="text-h2">Forum</h2>
                <img class="h-auto md:h-40 max-md:w-2/3 mt-4" src="{{ asset('assets/svg/sharing.svg') }}" alt=" "/>
                <p>
                    Posez vos questions, organisez des sessions entre lycéens, partagez vos expériences !
                </p>
                <a href="{{ route('forum') }}" class="btn-cta-secondary mr-auto">Aller au forum</a>
            </article>
        </div>
    </section>

</x-app-layout>
