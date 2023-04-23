@php
    $v = 1;
@endphp

<title>@if(View::hasSection('title'))
        @yield('title') -
    @endif{{config('app.name')}}</title>

<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Escalade Montesquieu",
        "url": "https://escalade-montesquieu.fr",
        "address": "5 Place Longchamps 4 et 33000 Bordeaux",
        "sameAs": [
        "https://www.facebook.com/escalademontesquieu/",
        "https://www.instagram.com/escalade_montesquieu/",
        "https://twitter.com/MontesEscalade",
        "https://www.linkedin.com/in/arthaud-proust/"
        ]
    }





</script>


<meta name="keywords"
      content="montesquieu, lycée, bordeaux, escalade, section, grimpe, développeur, association, sportive, as, arthaud, proust">
<meta name="description" content="{{ config('app.description') }}"/>
<meta name="author" content="Arthaud Proust">
<meta name="subject" content="Escalade">
<meta name="language" content="FR">
<meta name="url" content="https://escalade-montesquieu.fr"/>
<meta name="identifier-URL" content="https://escalade-montesquieu.fr">
<meta name="owner" content="Arthaud Proust">
<meta name="target" content="all">
<meta name="robots" content="all"/>
<meta name="theme-color" content="#222">


<!-- Open graph Meta -->
<meta property="og:title" content="{{ config('app.name') }}"/>
<meta property="og:type" content="website"/>
<meta property="og:description" content="{{ config('app.description') }}"/>
<meta property="og:site_name" content="{{ config('app.name') }}"/>
<meta property="og:url" content="https://escalade-montesquieu.fr"/>
<meta property="og:locale" content="fr_FR"/>
<meta property="og:image" content="https://escalade-montesquieu.fr/assets/img/hero@0.5x.jpg?v={{ $v }}"/>


<!-- Twitter Meta Card -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="https://escalade-montesquieu.fr"/>
<meta name="twitter:title" content="{{ config('app.name') }}"/>
<meta name="twitter:description" content="{{ config('app.description') }}"/>
<meta name="twitter:image" content="https://escalade-montesquieu.fr/assets/img/hero@0.5x.jpg?v={{ $v }}">

<!-- Apple meta -->
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="#222"/>
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}"/>
<link rel="apple-touch-icon" href="/assets/img/apple/apple-touch-icon.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="57x57" href="/assets/img/apple/apple-touch-icon-57x57.pngv"/>
<link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple/apple-touch-icon-72x72.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple/apple-touch-icon-76x76.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple/apple-touch-icon-114x114.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="120x120" href="/assets/img/apple/apple-touch-icon-120x120.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple/apple-touch-icon-144x144.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="152x152" href="/assets/img/apple/apple-touch-icon-152x152.png?v={{ $v }}"/>
<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple/apple-touch-icon-180x180.png?v={{ $v }}"/>

<link rel="icon" href="/assets/img/favicon.ico?v={{ $v }}">
<meta http-equiv="content-language" content="fr"/>
<link rel="canonical" href="https://escalade-montesquieu.fr/"/>
