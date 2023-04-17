<x-error-layout>
    <hgroup>
        <h2 class="text-h2">Aïe...</h2>
        <p>Une erreur est survenue.</p>
    </hgroup>

    <p>Cette page n'existe pas, code d'erreur 404.</p>
    <p>Vérifiez que vous avez bien écrit l'url.</p>
    <a href="{{ route('home') }}" class="btn-cta-primary">Retourner à l'accueil</a>
</x-error-layout>
