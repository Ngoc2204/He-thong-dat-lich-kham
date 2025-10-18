import './bootstrap';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';
import 'animate.css';

document.addEventListener('DOMContentLoaded', () => {
  // Ẩn tất cả nội dung slides ban đầu
  document.querySelectorAll('.slide-content h1, .slide-content p, .slide-content .btn').forEach((el) => {
    el.style.opacity = '0';
  });

  const swiper = new Swiper('.mySwiper', {
    modules: [Navigation, Pagination, Autoplay, EffectFade],
    loop: true,
    autoplay: {
      delay: 5000, // 5 giây - thời gian hiển thị mỗi slide
      disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    speed: 1000, // Thời gian chuyển đổi giữa các slide

    on: {
      init: function () {
        // Thêm animation cho slide đầu tiên khi khởi tạo
        const activeSlide = document.querySelector('.swiper-slide-active .slide-content');
        if (activeSlide) {
          const heading = activeSlide.querySelector('h1');
          const paragraph = activeSlide.querySelector('p');
          const button = activeSlide.querySelector('.btn');

          if (heading) {
            heading.style.opacity = '1';
            heading.classList.add('animate__animated', 'animate__fadeInDown');
          }
          if (paragraph) {
            paragraph.style.opacity = '1';
            paragraph.classList.add('animate__animated', 'animate__fadeInUp', 'animate__delay-1s');
          }
          if (button) {
            button.style.opacity = '1';
            button.classList.add('animate__animated', 'animate__fadeInUp', 'animate__delay-2s');
          }
        }
      },

      slideChangeTransitionStart: function () {
        // Ẩn và xóa animation classes khỏi tất cả slides
        document.querySelectorAll('.slide-content h1, .slide-content p, .slide-content .btn').forEach((el) => {
          el.style.opacity = '0';
          el.classList.remove(
            'animate__animated',
            'animate__fadeInDown',
            'animate__fadeInUp',
            'animate__delay-1s',
            'animate__delay-2s'
          );
        });
      },

      slideChangeTransitionEnd: function () {
        // Thêm animation cho slide mới
        const activeSlide = document.querySelector('.swiper-slide-active .slide-content');
        if (activeSlide) {
          const heading = activeSlide.querySelector('h1');
          const paragraph = activeSlide.querySelector('p');
          const button = activeSlide.querySelector('.btn');

          // Delay để đảm bảo animation chạy mượt
          setTimeout(() => {
            if (heading) {
              heading.style.opacity = '1';
              heading.classList.add('animate__animated', 'animate__fadeInDown');
            }
            if (paragraph) {
              paragraph.style.opacity = '1';
              paragraph.classList.add('animate__animated', 'animate__fadeInUp', 'animate__delay-1s');
            }
            if (button) {
              button.style.opacity = '1';
              button.classList.add('animate__animated', 'animate__fadeInUp', 'animate__delay-2s');
            }
          }, 200);
        }
      },
    },
  });
});
