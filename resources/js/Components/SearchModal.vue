<script setup>
import { useForm } from "@inertiajs/vue3";

defineProps({ showSearch: Boolean });

const emits = defineEmits(["onCloseSearch"]);

const onCloseSearch = () => {
    emits("onCloseSearch");
};

const searchForm = useForm({
    val: "",
});

const searchProds = () => {
    searchForm.post(route("search.search"), {
        onBefore: () => console.log(searchForm.val),
        onFinish: () => console.log(searchForm.val),
    });
};
</script>

<template>
    <div
        class="modal modal-search"
        :class="{ 'show fade': showSearch }"
        id="searchModal"
    >
        <div class="main-container">
            <div class="search">
                <div class="search-container">
                    <img src="/img/icons/search.svg" alt="" />
                    <input
                        class="input"
                        type="text"
                        v-model="searchForm.val"
                        placeholder="Введите запрос..."
                        @keyup="searchProds($event.target.value)"
                    />
                    <button class="close-modal" @click.prevent="onCloseSearch">
                        <img src="/img/icons/close-dark.svg" alt="" />
                    </button>
                </div>
                <div class="search-result">
                    <div class="products-wrapper">
                        <div class="card">
                            <a class="card-img" href="">
                                <img src="/img/products/product-1.png" alt=""
                            /></a>
                            <div class="card-content">
                                <h5 class="text-blue">
                                    <a href=""
                                        >Угловой вентиль 1/2 дюйма, хро...</a
                                    >
                                </h5>
                                <div class="price">
                                    <span class="price-new">3 000 ₸</span
                                    ><span class="price-old">4 500</span>
                                </div>
                                <div class="btns-group">
                                    <button class="btn btn-main">
                                        В корзину
                                    </button>
                                    <button class="btn btn-icon">
                                        <svg
                                            width="18"
                                            height="16"
                                            viewBox="0 0 18 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M2.17008 9.14817L8.46769 15.005C8.64784 15.1725 8.73791 15.2563 8.83932 15.2907C8.94352 15.326 9.05648 15.326 9.16068 15.2907C9.26209 15.2563 9.35216 15.1725 9.5323 15.005L9.53231 15.005L15.8299 9.14817C17.6224 7.4812 17.8395 4.71923 16.3296 2.79262L16.0731 2.46523C14.2789 0.175833 10.7055 0.562364 9.44234 3.18247C9.26376 3.55288 8.73624 3.55288 8.55766 3.18247C7.29453 0.562364 3.72114 0.175831 1.92694 2.46522L1.67036 2.79262C0.160475 4.71923 0.37764 7.4812 2.17008 9.14817Z"
                                                stroke="#0F2B4B"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-container">
                        <a class="btn btn-main" href="/searchPage"
                            >Смотреть все результаты поиска (126)</a
                        >
                    </div>
                </div>
                <div class="no-result">
                    <p>По вашему запросу ничего не найдено</p>
                </div>
            </div>
        </div>
    </div>
</template>
