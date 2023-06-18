<x-app-layout>
    @section('title', 'Articles')
    @section('description', 'Retrouvez les actus, les articles et les vidéos proposés à la lecture')

    <article class="container flex flex-coool gap-4 mt-10 lg:mt-32">
        {{ Breadcrumbs::render('articles') }}
        <header>
            <h1 class="text-h1 mb-2">Articles</h1>
            <p>Retrouvez des ressources, vidéos, évènements à suivre.</p>
        </header>
        <livewire:articles.display-list/>
    </article>
</x-app-layout>
