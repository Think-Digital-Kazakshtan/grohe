import Swiper, { Navigation, Pagination, EffectFade, Autoplay, Thumbs } from 'swiper';
Swiper.use([Navigation, Pagination, EffectFade, Autoplay, Thumbs]);

const APP = {

    initSwiper() {

        Array.from(document.querySelectorAll('.swiper')).forEach(swiper => {
            
            const deafultOptions = {
                slidesPerView: 4,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                    },
                autoplay: {
                    autoplay: false,
                    stopOnLastSlide: false,
                    disableOnInteraction: false,
                },
            };

            const customOptions = JSON.parse(swiper.dataset.options);

            const options = Object.assign(deafultOptions, customOptions);

            new Swiper(swiper, options);
        
        });

        const thumbsSwiper = new Swiper('.thumbs-swiper', {
            slidesPerView: 7,
            spaceBetween: 10,
            loop: false,
            watchSlidesProgress: true,
            grabCursor: true,
            breakpoints: {
                320: {
                    slidesPerView: 5,
                    spaceBetween: 5
                },
                1440: {
                    spaceBetween: 10
                },
                1536: {
                    slidesPerView: 6
                }
            }
        });

        const productSwiper = new Swiper('.main-swiper', {
            slidesPerView : 1,
            spaceBetween : 0,
            grabCursor: true,
            autoplay: false,
            navigation : {
                prevEl : ".btn-prev",
                nextEl : ".btn-next"
            },
            thumbs : {
                swiper : thumbsSwiper
            }
        });

    },

    btnClick() {

        if(document.querySelector('.btn-burger')) {

            document.querySelector('.btn-burger').addEventListener('click', function() {
                document.querySelector('.nav-menu').classList.toggle('show');
                document.querySelector('.nav-btns').classList.toggle('show');
                document.querySelector('.btn-burger').classList.toggle('active');
                document.body.classList.toggle('no-scroll');
            });

        };

        [...document.querySelectorAll('.footer-content')].forEach($footerContent => {
            const $btnAccord = $footerContent.querySelector('.btn-accordion');
            const $hiddenContent = $footerContent.querySelector('.hidden-content');

            $btnAccord.addEventListener('click', function() {
                $btnAccord.classList.toggle('active');
                $hiddenContent.classList.toggle('show');
            });
        });

        [...document.querySelectorAll('.select-item')].forEach($selectItem => {
            const $btnSelect = $selectItem.querySelector('.select-btn');
            const $options = $selectItem.querySelector('.options');

            $btnSelect.addEventListener('click', function() {
                $btnSelect.classList.toggle('active');
                $options.classList.toggle('show');
            });

            [...document.querySelectorAll('.options')].forEach($el => {
                const $option = $el.querySelectorAll('.option');

                $option.forEach($item => {
                    $item.addEventListener('click', function() {
                        $btnSelect.classList.remove('active');
                        $options.classList.remove('show');
                    });
                });
            });
        });

        [...document.querySelectorAll('.filter-item')].forEach($filterItem => {
            const $selectBtn = $filterItem.querySelector('.select-btn');
            const $options = $filterItem.querySelector('.options-filter');

            $selectBtn.addEventListener('click', function() {
                $selectBtn.classList.toggle('active');
                $options.classList.toggle('show');
                $options.classList.toggle('accord-effect');
            });
        });

        if(document.querySelector('.filter-btn')) {
            document.querySelector('.filter-btn').addEventListener('click', function() {
                document.querySelector('.filters-container').classList.add('show');
                document.body.classList.add('no-scroll');
            });
            document.querySelector('.btn-close-filters').addEventListener('click', function() {
                document.querySelector('.filters-container').classList.remove('show');
                document.body.classList.remove('no-scroll');
            })
        };

        [...document.querySelectorAll('.open-modal')].forEach($openModal => {
            $openModal.addEventListener("click", e => {
                const id = $openModal.getAttribute("href");
                document.querySelector(id).classList.add('show');
                document.body.classList.add('no-scroll');

                document.querySelector('.nav-menu').classList.remove('show');
                document.querySelector('.nav-btns').classList.remove('show');
                document.querySelector('.btn-burger').classList.remove('active');
            });
        });

        [...document.querySelectorAll('.close-modal')].forEach($closeModal => {
            $closeModal.addEventListener("click", e => {
                const id = $closeModal.getAttribute("href");
                document.querySelector(id).classList.remove('show');
                document.body.classList.remove('no-scroll');
            });
        });

        if(document.querySelector('.restore')) {

            document.querySelector('.restore').addEventListener('click', () => {
                document.querySelector('.modal-login').classList.remove('show');
                document.querySelector('.modal-restore').classList.add('show');
            });

            document.querySelector('.btn-restore').addEventListener('click', () => {
                document.querySelector('.restore-email').classList.remove('show');
                document.querySelector('.restore-email').classList.remove('fade');
                document.querySelector('.restore-code').classList.add('show');
                document.querySelector('.restore-code').classList.add('fade');
                document.querySelector('.btn-restore').textContent = 'Сбросить пароль';
            });
    
            document.querySelector('.btn-signUp').addEventListener("click", () => {
    
                document.getElementById('loginModal').classList.remove('show');
                document.getElementById('loginModal').classList.remove('fade');
                document.getElementById('signUpModal').classList.add('show');
                document.getElementById('signUpModal').classList.add('fade');
    
            });

        };

        if(document.querySelector('.addresses-container')) {

            document.querySelector('.btn-edit').addEventListener("click", () => {

                document.querySelector('.edit-address').classList.remove('fade');
                document.querySelector('.edit-address').classList.remove('show');
                document.querySelector('.edit-form').classList.add('show');
                document.querySelector('.edit-form').classList.add('fade');

            });

            document.querySelector('.btn-add-address').addEventListener("click", () => {

                document.querySelector('.add-address').classList.remove('fade');
                document.querySelector('.add-address').classList.remove('show');
                document.querySelector('.add-form').classList.add('show');
                document.querySelector('.add-form').classList.add('fade');

            });

        }

    },

    counter() {

        if(document.querySelector('.counter')) {

            const $counters = document.querySelectorAll('.counter');

            $counters.forEach(($counter) => {

                const $input = $counter.querySelector('input');
                const $minusBtn = $counter.querySelector('.minus');
                const $plusBtn = $counter.querySelector('.plus');

                let count = 1;
                $input.value = count;

                $minusBtn.addEventListener('click', () => {
                    count--;
                    if(count < 1) {
                        count = 1;
                    }
                    $input.value = count;
                });

                $plusBtn.addEventListener('click', () => {
                    count++;
                    $input.value = count;
                });

            });

        }

    },

    tabs() {
    
        [...document.querySelectorAll(".tabs")].forEach(($item) => {
            [...$item.querySelectorAll("[data-tab]")].forEach(($toggle) => {
                $toggle.addEventListener("click", (event) => {
                    event.preventDefault();
            
                    const tabId = $toggle.dataset.tab;
                    const $tab = $item.querySelector(tabId);
            
                    $item.querySelector(".tab.show").classList.remove("show");
                    $item.querySelector(".tab.fade").classList.remove("fade");
                    $item.querySelector("[data-tab].selected").classList.remove("selected");
            
                    $tab.classList.add("show");
                    $tab.classList.add("fade");
                    $toggle.classList.add("selected");
                });
            });
        });
    
    },

    videoPlay() {

        [...document.querySelectorAll('.video-container')].forEach($videoContainer => {

            const $video = $videoContainer.querySelector('video');
            const $btnPlay = $videoContainer.querySelector('.btn-container');

            if($btnPlay.addEventListener) {
                $btnPlay.addEventListener("click", play, false)
            } else if($btnPlay.attachEvent) {
                $btnPlay.addEventListener("click", play)
            }

            function play() {
                if($video.paused) {
                    $video.play();
                    $btnPlay.classList.add('hide');
                } else {
                    $video.pause();
                    $btnPlay.classList.remove('hide');
                }
            }

        })

    },

}

document.addEventListener("DOMContentLoaded", function () {

    // APP.initSwiper();

    // APP.btnClick();

    // APP.counter();

    // APP.tabs();

    // APP.videoPlay();

});