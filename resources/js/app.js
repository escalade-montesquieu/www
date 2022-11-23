import './bootstrap';

import Alpine from 'alpinejs';

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
    el.scrollTop = el.scrollHeight;
}
