<x-app-layout>
    @section('robots', 'noindex, follow')

    <section class="container lg:mt-40">
        <h1 class="text-h1 mb-4">Mentions légales</h1>

        <h2 class="text-h2 mt-12 mb-4">Présentation du site internet</h2>
        <p class="mb-2">Propriétaire du site : Arthaud PROUST</p>
        <p class="mb-2">Le propriétaire est un particulier. Il est possible de le contacter à l'adresse
            proust@arthaud.dev</p>

        <p class="mb-2">Hébergeur du site : OVH</p>
        <p class="mb-2">Siège social : 2 rue Kellermann - 59100 Roubaix - France</p>

        <h2 class="text-h2 mt-12 mb-4">Cookies</h2>
        <p class="mb-2">
            Un « cookie » est un petit fichier d’information envoyé sur le navigateur de l’Utilisateur et enregistré au
            sein du terminal de l’Utilisateur (ex : ordinateur, smartphone), (ci-après « Cookies »).
        </p>

        <p class="mb-2">
            En naviguant sur le site sans vous connecter, aucun cookie concernant vos données personnelles ne sont
            utilisés.
            Seuls des cookies nécessaires au bon fonctionnement du site sont utilisés (cookies de session utilisateur),
            et
            ce à partir du moment où l'utilisateur se connecte à son compte.
        </p>

        <p class="mb-2">
            Lors de son inscription, l'Utilisateur accepte par les
            <a class="link" href="{{ route('legal.conditions-of-use') }}">Conditions d'utilisation</a> qu'un cookie
            de session soit utilisé pour faciliter sa navigation sur le Site. Les Cookies ne risquent en aucun cas
            d’endommager le terminal de l’Utilisateur.
        </p>

        <p class="mb-2">
            En cliquant sur les icônes dédiées aux réseaux sociaux Twitter, Facebook, Linkedin et Google Plus pouvant
            figurer sur le Site, Twitter, Facebook, Linkedin et Google Plus peuvent également déposer des cookies sur
            vos
            terminaux (ordinateur, tablette, téléphone portable).
            Ces types de cookies ne sont déposés sur vos terminaux qu’à condition que vous y consentiez, en continuant
            votre
            navigation sur le Site.
            À tout moment, l’Utilisateur peut néanmoins revenir sur son consentement à ce que Twitter, Facebook,
            Linkedin et
            Google Plus dépose ce type de cookies.
        </p>

        <h2 class="text-h2 mt-12 mb-4">Utilisation des données personnelles</h2>
        <p class="mb-2">
            Les mentions relatives à l'utilisation des données personnelles sont regroupées dans notre
            <a class="link" href="{{ route('legal.gdpr') }}">politique RGPD</a>.
        </p>
    </section>
</x-app-layout>
