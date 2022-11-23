import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.scroll-at-bottom').forEach(el => {
        el.scrollTop = el.scrollHeight;
    });
})

function e() {
    console.log(this);
}
