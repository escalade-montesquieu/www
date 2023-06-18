<x-error-layout>
    <hgroup>
        <h2 class="text-h2">Aïe...</h2>
        <p>Une erreur est survenue.</p>
    </hgroup>

    <p>La page a expirée, code d'erreur 419.</p>
    <p>Réessayez de vous connecter.</p>

    <div class="space-y-2">
        <a href="{{ route('login') }}" class="btn-cta-primary">Se connecter</a>
        <a href="{{ route('home') }}" class="btn-cta-secondary">Retourner à l'accueil</a>
    </div>
</x-error-layout>
