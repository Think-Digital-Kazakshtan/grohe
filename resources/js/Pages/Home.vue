<script>
import { Link, usePage } from "@inertiajs/vue3";
import { Navigation, Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import ProductCard from "@/Components/ProductCard.vue";
import InfoText from "@/Components/InfoText.vue";

export default {
    components: {
        Swiper,
        SwiperSlide,
        Link,
        ProductCard,
        InfoText,
    },
    props: {
        sets: Array,
        categories: Array,
        favorites: Array,
        products: Array,
        popular: Array,
        promotion: Array,
        slides: Array,
        cartItems: Array,
    },
    methods: {
        addBigClass(index) {
            return (index + 1) % 5 === 0 || (index + 2) % 5 === 0;
        },
    },
    setup() {
        const onSwiper = (swiper) => {};
        const onSlideChange = () => {};
        return {
            ProductCard,
            onSwiper,
            onSlideChange,
            modules: [Navigation, Pagination],
        };
    },
};
</script>

<template>
    <div>
        <section class="hero">
            <swiper
                class="hero-swiper"
                :modules="modules"
                :slides-per-view="1"
                :space-between="0"
                :navigation="{ prevEl: '.btn-prev', nextEl: '.btn-next' }"
                :pagination="{ el: '.hero-pagination', clickable: true }"
                @swiper="onSwiper"
                @slideChange="onSlideChange"
            >
                <swiper-slide v-for="(slide, index) in slides" :key="index">
                    <a class="hero-container" :href="slide.url">
                        <div class="hero-img">
                            <img :src="$helpers.asset(slide.image)" alt="" />
                        </div>
                        <div class="main-container">
                            <div class="hero-content">
                                <h1>{{ slide.title }}</h1>
                                <p v-html="slide.description"></p>
                            </div>
                        </div>
                    </a>
                </swiper-slide>
                <div class="btn-navs">
                    <button class="btn-prev">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-chevron-left"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"
                            />
                        </svg>
                    </button>
                    <button class="btn-next">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-chevron-right"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"
                            />
                        </svg>
                    </button>
                </div>
                <div class="main-container">
                    <div class="hero-pagination"></div>
                </div>
            </swiper>
        </section>
        <section class="main-categories main-container content-container">
            <div class="categories-wrapper">
                <div class="cards">
                    <div class="cards-wrapper">
                        <Link
                            class="card"
                            :href="
                                $route('category.category', categories[1].slug)
                            "
                        >
                            <h3 class="txt-blue">{{ categories[1].title }}</h3>
                            <p class="txt-blue-opacity">
                                Все, что нужно для создания идеальной ванной
                                комнаты — от ванных изделий до смесителей и
                                аксессуаров
                            </p>
                            <img
                                class="category-img"
                                :src="$helpers.asset(categories[1].cover)"
                                alt=""
                            /><img
                                class="icon-circle"
                                src="/img/icons/arrow-circle.svg"
                                alt=""
                            /><img
                                class="icon-circle-filled"
                                src="/img/icons/arrow-circle-filled.svg"
                                alt=""
                            />
                        </Link>
                    </div>
                    <div class="cards-wrapper-sm">
                        <Link
                            class="card"
                            :href="
                                $route('category.category', categories[3].slug)
                            "
                        >
                            <h3 class="txt-blue">{{ categories[3].title }}</h3>
                            <img
                                class="category-img"
                                :src="$helpers.asset(categories[3].cover)"
                                alt=""
                            />
                            <img
                                class="icon-circle"
                                src="/img/icons/arrow-circle.svg"
                                alt=""
                            />
                            <img
                                class="icon-circle-filled"
                                src="/img/icons/arrow-circle-filled.svg"
                                alt=""
                            />
                        </Link>
                        <Link
                            class="card"
                            :href="
                                $route('category.category', categories[0].slug)
                            "
                        >
                            <h3 class="txt-blue">{{ categories[0].title }}</h3>
                            <img
                                class="category-img"
                                :src="$helpers.asset(categories[0].cover)"
                                alt=""
                            />
                            <img
                                class="icon-circle"
                                src="/img/icons/arrow-circle.svg"
                                alt=""
                            />
                            <img
                                class="icon-circle-filled"
                                src="/img/icons/arrow-circle-filled.svg"
                                alt=""
                            />
                        </Link>
                    </div>
                </div>
                <div class="cards">
                    <div class="cards-wrapper-sm">
                        <Link
                            class="card"
                            :href="
                                $route('category.category', categories[4].slug)
                            "
                        >
                            <h3 class="txt-blue">{{ categories[4].title }}</h3>
                            <p class="txt-blue-opacity">
                                Все необходимые аксессуары для ванной комнаты,
                                кухни и туалета — от зеркал и
                                полотенцедержателей до держателей для зубных
                                щёток и мыла
                            </p>
                            <img
                                class="category-img"
                                :src="$helpers.asset(categories[4].cover)"
                                alt=""
                            />
                            <img
                                class="icon-circle"
                                src="/img/icons/arrow-circle.svg"
                                alt=""
                            />
                            <img
                                class="icon-circle-filled"
                                src="/img/icons/arrow-circle-filled.svg"
                                alt=""
                            />
                        </Link>
                    </div>
                    <div class="cards-wrapper">
                        <Link
                            class="card"
                            :href="
                                $route('category.category', categories[2].slug)
                            "
                        >
                            <h3 class="txt-blue">{{ categories[2].title }}</h3>
                            <p class="txt-blue-opacity">
                                Все, что нужно для создания идеальной ванной
                                комнаты — от ванных изделий до смесителей и
                                аксессуаров
                            </p>
                            <img
                                class="category-img"
                                :src="$helpers.asset(categories[2].cover)"
                                alt=""
                            />
                            <img
                                class="icon-circle"
                                src="/img/icons/arrow-circle.svg"
                                alt=""
                            />
                            <img
                                class="icon-circle-filled"
                                src="/img/icons/arrow-circle-filled.svg"
                                alt=""
                            />
                        </Link>
                    </div>
                </div>
            </div>
        </section>
        <section class="popular main-container content-container">
            <div class="title-btn">
                <h2 class="txt-blue">Популярные товары</h2>
                <Link class="btn btn-main" href="/catalog">Смотреть все</Link>
            </div>
            <swiper
                :modules="modules"
                :slides-per-view="5"
                :space-between="20"
                @swiper="onSwiper"
                @slideChange="onSlideChange"
                :breakpoints="{
                    1440: { slidesPerView: 5 },
                    1280: { slidesPerView: 4 },
                    768: { slidesPerView: 3 },
                    320: { slidesPerView: 2, spaceBetween: 5 },
                }"
            >
                <swiper-slide v-for="product in popular" :key="product.id">
                    <ProductCard
                        :cartItems="cartItems"
                        :product="product"
                        :favorites="favorites"
                    />
                </swiper-slide>
            </swiper>
            <!-- <div class="products-wrapper">
                <ProductCard
                    v-for="product in popular"
                    :key="product.id"
                    :product="product"
                    :favorites="favorites"
                />
            </div> -->
        </section>
        <section
            v-if="sets.length >= 1"
            class="sets main-container content-container"
        >
            <h2 class="title txt-blue">Готовые наборы</h2>
            <div class="wrapper">
                <a
                    class="set"
                    :class="{ 'set-big': addBigClass(index) }"
                    :href="$route('sets.sets', item.slug)"
                    v-for="(item, index) in sets"
                    :key="item.id"
                >
                    <img :src="$helpers.asset(item.image)" alt="" />
                    <div class="card">
                        <h4 class="txt-blue">{{ item.title }}</h4>
                        <svg
                            width="18"
                            height="19"
                            viewBox="0 0 18 19"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.5 16.9999L16.5 1.99988"
                                stroke="#0F2B4B"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M1.5 1.99988H16.5V16.9999"
                                stroke="#0F2B4B"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                </a>
            </div>
        </section>
        <section class="sales main-container content-container">
            <div class="title-btn">
                <h2 class="txt-blue">Скидки</h2>
                <Link class="btn btn-main" href="/catalog">Смотреть все</Link>
            </div>
            <swiper
                :modules="modules"
                :slides-per-view="5"
                :space-between="20"
                @swiper="onSwiper"
                @slideChange="onSlideChange"
                :breakpoints="{
                    1440: { slidesPerView: 5 },
                    1280: { slidesPerView: 4 },
                    768: { slidesPerView: 3 },
                    320: { slidesPerView: 2, spaceBetween: 5 },
                }"
            >
                <swiper-slide v-for="product in promotion" :key="product.id">
                    <ProductCard
                        :cartItems="cartItems"
                        :product="product"
                        :favorites="favorites"
                    />
                </swiper-slide>
            </swiper>
            <!-- <div class="products-wrapper">
                <ProductCard
                    v-for="product in promotion"
                    :key="product.id"
                    :product="product"
                    :favorites="favorites"
                />
            </div> -->
        </section>
        <section class="info main-container">
            <div class="content-container">
                <swiper
                    :slides-per-view="3"
                    :space-between="20"
                    :breakpoints="{
                        320: { slidesPerView: 1.1, spaceBetween: 10 },
                        1024: { slidesPerView: 3, spaceBetween: 20 },
                    }"
                    @swiper="onSwiper"
                    @slideChange="onSlideChange"
                >
                    <swiper-slide>
                        <Link :href="$route('support.guarantee')" class="card">
                            <div class="card-content">
                                <div class="img-box">
                                    <svg
                                        width="46"
                                        height="45"
                                        viewBox="0 0 46 45"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M43.4213 22.5C43.3655 20.5403 46.0625 19.3972 45.6161 17.4919C45.1697 15.5867 42.2309 15.6956 41.4125 13.9173C40.4825 12.1754 42.4169 10.0161 41.1707 8.47378C39.9245 6.94959 37.3205 8.29233 35.7954 7.02217C34.1958 5.84273 34.9584 3.06652 33.1542 2.23184C31.35 1.37902 29.6016 3.7016 27.6672 3.21168C25.6956 2.83064 25.1562 0 23.166 0C21.1572 0 20.6178 2.83064 18.6648 3.21168C16.7304 3.7016 14.9821 1.37902 13.1779 2.23184C11.3737 3.08466 12.1363 5.86088 10.5367 7.02217C9.01148 8.29233 6.4075 6.93144 5.1613 8.47378C3.91511 9.99798 5.83089 12.1754 4.91949 13.9173C4.1011 15.7137 1.16231 15.5867 0.715916 17.4919C0.269518 19.3972 2.9665 20.5403 2.9107 22.5C2.9665 24.4597 0.269518 25.6028 0.715916 27.5081C1.16231 29.4133 4.1011 29.3044 4.91949 31.0826C5.84949 32.8246 3.91511 34.9839 5.1613 36.5262C6.4075 38.0504 9.01148 36.7076 10.5367 37.9778C12.1363 39.1572 11.3737 41.9335 13.1779 42.7681C14.9821 43.621 16.7304 41.2984 18.6648 41.7883C20.6364 42.1693 21.1758 45 23.166 45C25.1748 45 25.7142 42.1693 27.6672 41.7883C29.6016 41.2984 31.35 43.621 33.1542 42.7681C34.9584 41.9153 34.1958 39.1391 35.7954 37.9778C37.3205 36.7076 39.9245 38.0685 41.1707 36.5262C42.4169 35.002 40.5011 32.8246 41.4125 31.0826C42.2309 29.2863 45.1697 29.4133 45.6161 27.5081C46.0625 25.6028 43.3655 24.4597 43.4213 22.5ZM8.37908 14.1532C3.65471 22.1371 6.46329 32.3528 14.6286 36.9617C22.794 41.5706 33.2472 38.8306 37.9715 30.8468C42.6959 22.8629 39.8873 12.6472 31.722 8.03829C23.538 3.44757 13.0849 6.16935 8.37908 14.1532Z"
                                            fill="white"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M10.2943 15.2418C6.20232 22.1733 8.63891 31.0644 15.7255 35.0745C22.8306 39.0846 31.926 36.6894 36.018 29.758C40.11 22.8265 37.6734 13.9354 30.5868 9.92528C23.5002 5.93335 14.4049 8.31037 10.2943 15.2418ZM32.67 17.4918L22.2727 30.9192C21.7147 31.645 20.6731 31.7721 19.9291 31.2458C19.7989 31.1551 19.7059 31.0463 19.6129 30.9374L12.6379 23.2257C12.0241 22.5543 12.0985 21.52 12.7867 20.9212C13.3819 20.4132 14.2375 20.3769 14.8513 20.8124L20.7475 24.895L30.159 15.387C30.7914 14.7337 31.8516 14.7156 32.5212 15.3507C33.1164 15.9313 33.1722 16.8567 32.67 17.4918Z"
                                            fill="white"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Расширенная фирменная гарантия на всю
                                    продукцию до 10 лет
                                </p>
                            </div>
                        </Link>
                    </swiper-slide>
                    <swiper-slide>
                        <Link :href="$route('support.delivery')" class="card">
                            <div class="card-content">
                                <div class="img-box">
                                    <svg
                                        width="48"
                                        height="40"
                                        viewBox="0 0 48 40"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M20.6169 14.3162V17.4832C20.6169 17.6498 20.7481 17.7795 20.9168 17.7795H24.4217C24.5904 17.7795 24.7216 17.6498 24.7216 17.4832V16.4275C24.7216 16.2608 24.5904 16.1312 24.4217 16.1312H22.6037C22.435 16.1312 22.3038 16.0015 22.3038 15.8348V14.9644C22.3038 14.7977 22.435 14.6681 22.6037 14.6681H24.0469C24.2155 14.6681 24.3467 14.5384 24.3467 14.3717V13.4828C24.3467 13.3161 24.2155 13.1865 24.0469 13.1865H22.6037C22.435 13.1865 22.3038 13.0568 22.3038 12.8901V12.0382C22.3038 11.8715 22.435 11.7419 22.6037 11.7419H24.2343C24.403 11.7419 24.5342 11.6122 24.5342 11.4455V10.5751C24.5342 10.4084 24.403 10.2788 24.2343 10.2788H20.9168C20.7481 10.2788 20.6169 10.4084 20.6169 10.5751V14.3162ZM15.369 14.2977V17.4646C15.369 17.6313 15.5002 17.761 15.6689 17.761H18.9863C19.155 17.761 19.2862 17.6313 19.2862 17.4646V16.409C19.2862 16.2423 19.155 16.1127 18.9863 16.1127H17.3557C17.187 16.1127 17.0558 15.983 17.0558 15.8163V14.9459C17.0558 14.7792 17.187 14.6495 17.3557 14.6495H18.7989C18.9676 14.6495 19.0988 14.5199 19.0988 14.3532V13.4643C19.0988 13.2976 18.9676 13.1679 18.7989 13.1679H17.3557C17.187 13.1679 17.0558 13.0383 17.0558 12.8716V12.0197C17.0558 11.853 17.187 11.7234 17.3557 11.7234L18.9863 11.7048C19.155 11.7048 19.2862 11.5752 19.2862 11.4085V10.538C19.2862 10.3714 19.155 10.2417 18.9863 10.2417L15.6689 10.2602C15.5002 10.2602 15.369 10.3899 15.369 10.5566V14.2977ZM12.0515 12.5568C12.0515 13.6124 10.6833 13.8161 10.6833 13.2605V11.9271C10.6833 11.7048 10.8708 11.6122 11.0769 11.6308C11.6392 11.6308 12.0515 11.8715 12.0515 12.5568ZM8.99649 14.2977V17.4646C8.99649 17.6313 9.12768 17.761 9.29637 17.761H10.3647C10.5334 17.761 10.6646 17.6313 10.6646 17.4646V14.9273C10.6646 14.7792 10.9082 14.7422 11.0207 14.9088C11.583 15.7978 12.1453 16.8349 12.6513 17.6128C12.7075 17.7054 12.8013 17.761 12.9137 17.761H14.5443C14.638 17.761 14.6943 17.6498 14.638 17.5758L12.7638 14.6681C12.3327 13.9828 13.8696 14.6125 13.8696 12.4642C13.8696 11.2789 13.0449 10.1676 10.5709 10.1676H9.27763C9.12769 10.1676 8.99649 10.3158 8.99649 10.464V14.2977ZM6.12886 11.6678H7.62827C7.79696 11.6678 7.92815 11.5381 7.92815 11.3715V10.501C7.92815 10.3343 7.79696 10.2047 7.62827 10.2047C6.48497 10.2047 5.37915 10.2047 4.25459 10.2047C4.0859 10.2047 3.9547 10.3343 3.9547 10.501V17.5017C3.9547 17.6684 4.0859 17.798 4.25459 17.798C4.64818 17.798 5.11675 17.798 5.51035 17.798C5.67903 17.798 5.81023 17.6684 5.81023 17.5017V15.1496C5.81023 14.9829 5.94143 14.8533 6.11011 14.8533C7.89067 14.8533 7.66576 15.057 7.66576 13.668C7.66576 13.5013 7.53456 13.3717 7.36587 13.3717H6.12886C5.96017 13.3717 5.82897 13.242 5.82897 13.0753V12.0197C5.81023 11.7974 5.96017 11.6678 6.12886 11.6678ZM1.16205 0H27.0082C27.608 0 28.1328 0.537102 28.1328 1.14827V27.5952C28.1328 28.1879 27.6267 28.7064 27.0082 28.7064H16.025C15.5564 28.7064 15.1441 28.5768 14.7505 28.3175C12.2577 26.6137 8.86529 26.6137 6.31628 28.3175C5.92269 28.5768 5.52909 28.7064 5.04178 28.7064H1.16205C0.56228 28.7064 0 28.1879 0 27.5952V1.14827C0 0.537102 0.56228 0 1.16205 0Z"
                                            fill="white"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M30.3819 27.6138V11.2604C30.3819 10.6678 30.813 10.1677 31.4127 10.1677H43.5955C45.0387 10.1677 45.0387 12.3902 43.5955 12.3902H41.3838L42.6396 19.8353C42.7333 20.428 43.2019 20.8539 43.8016 20.9095L46.9879 21.2243C47.5502 21.2799 47.9813 21.7614 47.9813 22.2985V23.0949H46.4818C45.4885 23.0949 45.4885 24.5765 46.4818 24.5765H47.9813V27.5583C47.9813 28.1509 47.4939 28.651 46.8754 28.651H42.7895C42.321 28.651 41.9086 28.5213 41.515 28.262C40.353 27.4657 38.9098 26.9842 37.2792 26.9842C35.7236 26.9842 34.2616 27.4657 33.0621 28.262C32.6685 28.5213 32.2749 28.651 31.7876 28.651H31.3752C30.7942 28.7065 30.3819 28.225 30.3819 27.6138ZM40.4092 19.7612L39.1535 12.4087H32.4436V19.2056C32.4436 19.539 32.706 19.8168 33.0433 19.8538L39.7157 20.5206C40.1281 20.5576 40.4842 20.1872 40.4092 19.7612ZM1.10582 30.929H3.01757C3.41117 30.929 3.69231 31.3179 3.54237 31.6883C3.11128 32.7625 2.92386 33.9478 3.03631 35.1331C3.0738 35.4664 2.8114 35.7442 2.47403 35.7442H1.10582C0.506051 35.7442 0 35.2442 0 34.6145V32.0587C0 31.429 0.506051 30.929 1.10582 30.929ZM17.9742 30.929H29.8196C30.2132 30.929 30.4943 31.3179 30.3444 31.6883C29.9133 32.7625 29.7259 33.9478 29.8383 35.1331C29.8758 35.4664 29.6134 35.7442 29.2761 35.7442H18.5365C18.1991 35.7442 17.9555 35.4664 17.9742 35.1331C18.0867 33.9478 17.8805 32.7625 17.4494 31.6883C17.2995 31.3179 17.5619 30.929 17.9742 30.929ZM46.8942 30.929C47.494 30.929 48 31.429 48 32.0587V34.6145C48 35.2442 47.5127 35.7442 46.8942 35.7442H45.3198C44.9824 35.7442 44.7388 35.4664 44.7575 35.1331C44.87 33.9478 44.6638 32.7625 44.2327 31.6883C44.0828 31.3179 44.3639 30.929 44.7575 30.929H46.8942ZM10.4959 32.2624C12.4639 32.2624 13.4572 34.633 12.0515 36.0035C10.6646 37.374 8.26552 36.3925 8.26552 34.4478C8.28426 33.244 9.27763 32.2624 10.4959 32.2624ZM37.2979 32.2624C39.2659 32.2624 40.2593 34.633 38.8536 36.0035C37.4666 37.374 35.0676 36.3925 35.0676 34.4478C35.0676 33.244 36.0609 32.2624 37.2979 32.2624ZM37.2979 28.8917C42.2835 28.8917 44.8137 34.8738 41.2526 38.3741C37.7103 41.8559 31.6751 39.3742 31.6751 34.4478C31.6751 31.392 34.1866 28.8917 37.2979 28.8917ZM10.4959 28.8917C15.4815 28.8917 18.0117 34.8738 14.4506 38.3741C10.9082 41.8559 4.8731 39.3742 4.8731 34.4478C4.89184 31.392 7.40336 28.8917 10.4959 28.8917Z"
                                            fill="white"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Бесплатная доставка по Алматы при сумме
                                    заказа от 50 000 тенге
                                </p>
                            </div>
                        </Link>
                    </swiper-slide>
                    <swiper-slide>
                        <Link :href="$route('support.return')" class="card">
                            <div class="card-content">
                                <div class="img-box">
                                    <svg
                                        width="49"
                                        height="48"
                                        viewBox="0 0 49 48"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M33.1514 33.1885C38.643 33.1885 43.085 28.7207 43.085 23.2203C43.085 17.72 38.643 13.2522 33.1514 13.2522H28.4658V18.2644C28.4658 18.9027 27.7535 19.2218 27.2475 18.8464L14.9523 10.0796C14.5774 9.77925 14.5587 9.17854 14.9523 8.91573L27.2475 0.148974C27.7535 -0.207703 28.4658 0.111447 28.4658 0.730939V5.74318H33.1514C41.5294 5.74318 48.333 12.5576 48.333 20.9676C48.333 29.3777 41.5294 36.1921 33.1514 36.1921V33.1885Z"
                                            fill="white"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M16.0197 18.5459L29.6456 24.5156L30.3391 25.5668V40.979L29.6456 42.0303L16.0197 47.9999H14.6514L1.02552 42.0303L0.332031 40.979V25.5668L1.02552 24.5156L14.6514 18.5459H16.0197ZM27.3402 26.8996L15.3449 32.3437V45.3905L2.97477 40.0216V26.543L14.5015 31.0671C18.1563 29.3401 21.7924 27.5191 25.466 25.961L27.3402 26.8996Z"
                                            fill="white"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Возможность возврата товара по любой причине
                                    в течении 14 дней.
                                </p>
                            </div>
                        </Link>
                    </swiper-slide>
                </swiper>
            </div>
            <InfoText />
        </section>
    </div>
</template>
