<x-forum-layout>
    <nav
        class="fixed top-0 left-0 -translate-y-full focus-within:translate-y-0 z-50 flex flex-col gap-2 bg-white-dark p-6">
        <ul class="nav-accessibility" aria-label="Navigation du forum">
            <li><a href="#forum-input">Écrire un message</a></li>
            <li><a href="#messagesAnchor">Accéder aux messages</a></li>
        </ul>
    </nav>
    <livewire:forum.messages/>
    <livewire:forum.input/>
</x-forum-layout>
