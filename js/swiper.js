document.addEventListener('DOMContentLoaded', function (e) {
  function initSwiper(block, pagination, count, margin320, autoplay) {
    console.log(block, pagination)
    const swiper = new Swiper(block, {
      loop: true,
      direction: 'horizontal',
      parallax: true,
      speed: 800,
      autoplay: autoplay,
      keyboard: {
        enabled: true,
        onlyInViewport: false,
      },
      centerSlides: true,
      threshold: 20,
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: margin320,
        },
        480: {
          slidesPerView: count,
          spaceBetween: window.innerWidth/2/100*30,
        }
      },
      pagination: {
        el: pagination,
      }
    });
  }
  if(window.innerWidth < 768){
    let obj = {
      delay: 3000,
      pauseOnMouseEnter: true
    }
    initSwiper('.swiper-container_dog', '.swiper-pagination_dog', 2, 10, obj);
    initSwiper('.swiper-container_cat', '.swiper-pagination_cat', 2, 10, obj);
    initSwiper('.swiper-container_media', '.swiper-pagination_media', 1, 30, false);
  }
})