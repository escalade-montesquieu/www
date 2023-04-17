<x-error-layout>
    <hgroup>
        <h2 class="text-h2">Aïe...</h2>
        <p>Une erreur est survenue.</p>
    </hgroup>
    <p>Accès interdit, code d'erreur 403.</p>
    <a href="{{ route('home') }}" class="btn-cta-primary">Retourner à l'accueil</a>
</x-error-layout>
