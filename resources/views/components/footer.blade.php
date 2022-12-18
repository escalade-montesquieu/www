<footer class="bg-white-medium ">
    <div class="container flex flex-coool mt-20 px-4 py-12 gap-y-12 lg:py-20 lg:gap-20 lg:mt-40">

        <section class="grid grid-cols-12 gap-y-8">
            <article class="col-span-full lg:col-span-4 flex flex-coool gap-1 lg:gap-2">
                <h4 class="text-h4">Nous contacter</h4>
                <p>
                    Envoyer un mail à <b class="whitespace-nowrap">contact@escalade-montesquieu.fr</b><br>
                    Ou voir <b class="whitespace-nowrap">M. Granier</b> au lycée
                </p>
            </article>

            <section class="col-span-full lg:col-start-9 lg:col-end-13 flex flex-coool gap-y-8">
                <article class="flex flex-coool gap-1 lg:gap-2">
                    <h4 class="text-h4">Évènements et sorties</h4>
                    <nav class="flex flex-coool">
                        @foreach(\App\Models\EventCategory::all() as $eventCategory)
                            <a class="link" href="{{ route('events') }}">{{ $eventCategory->name }}</a>
                        @endforeach
                    </nav>
                </article>

                <article class="flex flex-coool gap-1 lg:gap-2">
                    <h4 class="text-h4">À propos</h4>
                    <nav class="flex flex-coool">
                        <a class="link" href="">Mentions légales</a>
                        <a class="link" href="">Conditions d'utilisation</a>
                        <a class="link" href="">Politique RGPD</a>
                    </nav>
                </article>
            </section>

        </section>

        <div class="h-px w-full bg-white-dark"></div>

        <article class="grid grid-cols-12 gap-y-1">
            <p class="col-span-full lg:col-span-4">
                <a class="link" href="https://arthaudproust.fr" target="_blank">
                    Développé par Arthaud Proust
                </a>
            </p>
            <p class="col-span-full lg:col-start-9 lg:col-end-13 text-black-medium">&copy; 2020-2022 Tous droits
                réservés</p>
        </article>

    </div>
</footer>
