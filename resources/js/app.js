import './bootstrap';

import Alpine from 'alpinejs';

import PhotoSwipeLightbox from 'photoswipe/lightbox';
import 'photoswipe/style.css';

// core version + navigation, pagination modules:
import Swiper, {Autoplay, Pagination} from 'swiper';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/pagination';

window.Alpine = Alpine;

Alpine.start();


window.addEventListener('DOMContentLoaded', () => {

    const lightbox = new PhotoSwipeLightbox({
        gallery: '#gallery',
        children: 'a',
        pswpModule: () => import('photoswipe')
    });
    lightbox.init();


    // init Swiper:
    const swiper = new Swiper('.swiper', {
        modules: [Pagination, Autoplay],

        pagination: {
            el: '.swiper-pagination',
        },
        loop: true,
        spaceBetween: 16,
        autoplay: {
            delay: 2000,
            disableOnInteraction: true,
        }
    });

})
