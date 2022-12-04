import './bootstrap';

import Alpine from 'alpinejs';
import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    scrollForumMessagesListToBottom();
})

window.addEventListener('forum-message-sent', () => {
    console.log('Message sent: scroll bottom');
    scrollForumMessagesListToBottom();
})

function scrollForumMessagesListToBottom() {
    const el = document.getElementById('forumMessagesList');

    if (!el) {
        return;
    }
    el.scrollTop = el.scrollHeight;
}

const lightbox = new PhotoSwipeLightbox({
    gallery: '#gallery',
    children: 'a',
    pswpModule: () => import('photoswipe')
});
lightbox.init();
