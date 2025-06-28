

/*--- SWIPER ---*/

import Swiper from 'swiper';
import 'swiper/css';

// Dodatkowe moduły (opcjonalnie)
import { Navigation, Pagination } from 'swiper/modules';

Swiper.use([Navigation, Pagination]);

/*--- SWIPER ---*/

document.addEventListener('DOMContentLoaded', () => {
  const swipers = document.querySelectorAll('.swipers');

  if (swipers.length > 0) {
    swipers.forEach((container) => {
      new Swiper(container, {
        slidesPerView: 1.5,
        spaceBetween: 72,
        loop: true,
        pagination: {
          el: container.querySelector('.swiper-pagination'),
          clickable: true,
        },
        navigation: {
          nextEl: container.querySelector('.swiper-button-next'),
          prevEl: container.querySelector('.swiper-button-prev'),
        },
      });
    });
  }
});