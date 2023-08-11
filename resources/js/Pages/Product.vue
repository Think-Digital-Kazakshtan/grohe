<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { ref, onMounted } from 'vue';
    import { Thumbs, Navigation } from 'swiper';
    import { Swiper, SwiperSlide } from 'swiper/vue';

    import Counter from '@/Components/Counter.vue';
    const props = defineProps({
        product: Object,
        products: Array,
        favorites: Array,
    });

    const thumbsSwiper = ref(null);
    const setThumbsSwiper = (swiper) => {
        thumbsSwiper.value = swiper;
    };

    const selectedTab = ref('#desc_tab1');
    const selectTab = (tabId) => {
        selectedTab.value = tabId;
    };

    const isShow = ref(false);

    // const count = ref(1);
    // const countUpdate = (value) => {
    //     count = value;
    // };

</script>

<template>

    <section class="path main-container">
        <ul class="path-row">
            <li><Link href="/">Главная / </Link></li>
            <li><Link href="/catalog">Каталог /</Link></li>
            <li class="path-active">{{ product.title }}</li>
        </ul>
    </section>
    <section class="product-page main-container content-container">
        <div class="product-slider">
            <swiper
                :modules="[Thumbs, Navigation]"
                :thumbs="{ swiper: thumbsSwiper }"
                :slides-per-view="1"
                :space-between="0"
                :autoplay="false"
                :grabCursor="true"
                :navigation="{
                    prevEl: '.btn-prev',
                    nextEl: '.btn-next'
                }"
            >
                <swiper-slide class="main-swiper" v-for="image in product.media" :key="image.id">
                    <div class="product-img"><img :src="image.original_url" alt=""></div>
                </swiper-slide>
                <div class="navs" v-if="product.media.length > 1">
                    <div class="btn-prev"><svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.75 15H6.25" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 23.75L6.25 15L15 6.25" stroke="#0F2B4B" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="btn-next"><svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.25 15H23.75" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 6.25L23.75 15L15 23.75" stroke="#0F2B4B" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </swiper>
            <swiper
                class="thumbs-swiper swiper"
                :modules="[Thumbs]"
                watch-slides-progress
                @swiper="setThumbsSwiper"
                :slides-per-view="7"
                :space-between="10"
                :loop="false"
                :grabCursor="true"
                :breakpoints="{
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
                }"
            >
                <swiper-slide v-for="image in product.media" :key="image.id">
                    <div class="product-img"><img :src="image.original_url" alt=""></div>
                </swiper-slide>
            </swiper>
        </div>
        <div class="product-info">
            <div class="title">
                <h1 class="txt-blue">{{ product.title }}</h1><span
                    class="txt-blue-opacity">Код товара: {{ product.sku }}</span>
            </div>
            <div class="price">
                <div class="price-new">{{ parseFloat(product.price).toFixed(0) }} ₸</div>
                <div class="price-old" v-if="product.old_price != null">{{ parseFloat(product.old_price).toFixed(0) }} ₸</div>
            </div>
            <div class="complect" v-if="Object.keys(product.params).length >= 5">
                <ul>
                    <template v-for="(param, index) in product.params" :key="index">
                        <li v-if="index < 6 || product.params.length < 6">{{ param }}</li>
                    </template>               
                </ul>
                <ul class="complect-hidden" :class="{ 'show fade' : isShow }" >
                    <template v-for="(param, index) in product.params" :key="index">
                        <li v-if="index > 6 || index >= 6">{{ param }}</li>
                    </template>     
                </ul>
                <button class="link-underline" @click.prevent="isShow = !isShow">{{ isShow ? 'Скрыть' : 'Показать больше' }}</button>
            </div>
            <div class="complect" v-else>
                <ul>
                    <li v-for="(param, index) in product.params" :key="index">{{ param }}</li>
                </ul>
            </div>
            <div class="available">
                <div class="in-stock in-stock-yes"><img src="/img/icons/success.svg" alt=""><span>В наличии</span></div>
            </div>
            <div class="btns-group">
                <Counter @count-updated="countUpdate" />
                <button class="btn btn-main" @click.prevent="$cart.add(product.id)">Добавить в корзину</button>
                <button class="btn btn-icon" :class="{ 'btn-icon-filled' : props.favorites.find($item => $item.id == props.product.id) }" @click.prevent="$favorites.toggle(product.id)">
                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z" stroke="#0F2B4B" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
    <section class="product-desc main-container content-container">
        <div class="product-desc-main tabs">
            <div class="selections tab-toggle">
                <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#desc_tab1' }" type="button" @click.prevent="selectTab('#desc_tab1')">Обзор</button>
                <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#desc_tab2' }" type="button" @click.prevent="selectTab('#desc_tab2')">Характеристики</button>
                <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#desc_tab3' }" type="button" @click.prevent="selectTab('#desc_tab3')">Инструкция</button>
                <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#desc_tab4' }" type="button" @click.prevent="selectTab('#desc_tab4')">Видео</button>
            </div>
            <div class="product-desc-wrapper tab-wrapper">
                <div class="desc-item tab" :class="{ 'show fade' : selectedTab === '#desc_tab1' }" id="desc_tab1">
                    <div class="desc-container" v-html="product.description"></div>
                </div>
                <div class="desc-item tab" :class="{ 'show fade' : selectedTab === '#desc_tab2' }" id="desc_tab2">
                    <div class="desc-container">
                        <div class="card">
                            <h5>Общие характеристики</h5>
                            <ul class="desc-list">
                                <li v-for="(value, key) in product.params_detail" :key="key">
                                    <p>{{ key }}</p><span>{{ value }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="desc-container">
                        <div class="card">
                            <h5>Дизайн</h5>
                            <ul class="desc-list">
                                <li>
                                    <p>Цвет</p><span>{{ product.color }}</span>
                                </li>
                                <li>
                                    <p>Коллекция</p><span>New Tempesta</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <h5>Дополнительная информация</h5>
                            <ul class="desc-list">
                                <li>
                                    <p>Страна производства</p><span>{{ product.made_in }}</span>
                                </li>
                                <li>
                                    <p>Гарантия</p><span>{{ product.warranty }}</span>
                                </li>
                                <li>
                                    <p>Обратите внимание</p><span><div v-html="product.note"></div></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="desc-item tab" :class="{ 'show fade' : selectedTab === '#desc_tab3' }" id="desc_tab3">
                    <div class="desc-container">
                        <div class="card">
                            <h5>Чертежи</h5>
                            <ul class="desc-list">
                                <li>
                                    <p>Фотография 1</p><span><a class="link-underline" href=""
                                            download>Скачать</a></span>
                                </li>
                                <li>
                                    <p>Фотография 2</p><span><a class="link-underline" href=""
                                            download>Скачать</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="desc-container">
                        <div class="card">
                            <h5>Инструкции</h5>
                            <ul class="desc-list">
                                <li>
                                    <p>PDF файл 1</p><span><a class="link-underline" href="" download>Скачать</a></span>
                                </li>
                                <li>
                                    <p>PDF файл 2</p><span><a class="link-underline" href="" download>Скачать</a></span>
                                </li>
                                <li>
                                    <p>PDF файл 3</p><span><a class="link-underline" href="" download>Скачать</a></span>
                                </li>
                                <li>
                                    <p>PDF файл 4</p><span><a class="link-underline" href="" download>Скачать</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="desc-item tab" :class="{ 'show fade' : selectedTab === '#desc_tab4' }" id="desc_tab4">
                    <div class="video-container">
                        <video src="/video/video1.mp4" controls></video>
                        <div class="btn-container">
                            <button class="btn-play"><img src="/img/icons/video-play.svg" alt=""></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sales alsoProducts main-container content-container">
        <div class="title">
            <h2 class="txt-blue">К нему также берут</h2>
        </div>
        <div class="products-wrapper">
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-1.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Угловой вентиль 1/2 дюйма, хро...</a></h5>
                    <div class="price"><span class="price-new">3 000 ₸</span><span class="price-old">4 500</span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-2.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Душевая система GROHE New Temp...</a></h5>
                    <div class="price"><span class="price-new">143 000 ₸</span><span class="price-old"></span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-3.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Панель смыва для унитаза Skate...</a></h5>
                    <div class="price"><span class="price-new">25 400 ₸</span><span class="price-old"></span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-4.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Сифон для раковины GROHE 1 1/4...</a></h5>
                    <div class="price"><span class="price-new">11 600 ₸</span><span class="price-old">18 600</span>
                    </div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-5.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Душевая система GROHE New Temp...</a></h5>
                    <div class="price"><span class="price-new">143 000 ₸</span><span class="price-old"></span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sales main-container content-container">
        <div class="title-btn">
            <h2 class="txt-blue">Похожие товары</h2><a class="btn btn-main" href="">Смотреть все</a>
        </div>
        <div class="products-wrapper">
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-1.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Угловой вентиль 1/2 дюйма, хро...</a></h5>
                    <div class="price"><span class="price-new">3 000 ₸</span><span class="price-old">4 500</span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-2.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Душевая система GROHE New Temp...</a></h5>
                    <div class="price"><span class="price-new">143 000 ₸</span><span class="price-old"></span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-3.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Панель смыва для унитаза Skate...</a></h5>
                    <div class="price"><span class="price-new">25 400 ₸</span><span class="price-old"></span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-4.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Сифон для раковины GROHE 1 1/4...</a></h5>
                    <div class="price"><span class="price-new">11 600 ₸</span><span class="price-old">18 600</span>
                    </div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card"><a class="card-img" href=""> <img src="/img/products/product-5.png" alt=""></a>
                <div class="card-content">
                    <h5 class="text-blue"><a href="">Душевая система GROHE New Temp...</a></h5>
                    <div class="price"><span class="price-new">143 000 ₸</span><span class="price-old"></span></div>
                    <div class="btns-group">
                        <button class="btn btn-main">В корзину</button>
                        <button class="btn btn-icon"><svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                    stroke="#0F2B4B" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
