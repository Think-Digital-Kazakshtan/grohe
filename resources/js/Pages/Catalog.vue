<script setup>
import { ref, onMounted } from "vue";
import Checkbox from "@/Components/Checkbox.vue";
import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";

// const filters = [
//     {
//         id: 1,
//         title: "Тип товара",
//         options: [
//             {
//                 id: 1,
//                 title: "Душевая система",
//             },
//             {
//                 id: 2,
//                 title: "Смеситель",
//             },
//             {
//                 id: 3,
//                 title: "Термостатический смеситель",
//             },
//         ],
//     },
//     {
//         id: 2,
//         title: "Режим струи верхнего душа",
//         options: [
//             {
//                 id: 1,
//                 title: "Option 1",
//             },
//             {
//                 id: 2,
//                 title: "Option 2",
//             },
//             {
//                 id: 3,
//                 title: "Option 3",
//             },
//         ],
//     },
//     {
//         id: 3,
//         title: "Режим струи ручного душа",
//         options: [
//             {
//                 id: 1,
//                 title: "Option 1",
//             },
//             {
//                 id: 2,
//                 title: "Option 2",
//             },
//             {
//                 id: 3,
//                 title: "Option 3",
//             },
//             {
//                 id: 4,
//                 title: "Option 4",
//             },
//         ],
//     },
//     {
//         id: 4,
//         title: "Назначение",
//         options: [
//             {
//                 id: 1,
//                 title: "Option 1",
//             },
//             {
//                 id: 2,
//                 title: "Option 2",
//             },
//         ],
//     },
//     {
//         id: 3,
//         title: "Диаметр верхнего душа",
//         options: [
//             {
//                 id: 1,
//                 title: "Option 1",
//             },
//             {
//                 id: 2,
//                 title: "Option 2",
//             },
//             {
//                 id: 3,
//                 title: "Option 3",
//             },
//             {
//                 id: 4,
//                 title: "Option 4",
//             },
//             {
//                 id: 5,
//                 title: "Option 5",
//             },
//             {
//                 id: 6,
//                 title: "Option 6",
//             },
//             {
//                 id: 7,
//                 title: "Option 7",
//             },
//         ],
//     },
// ];

const props = defineProps({
    products: Object,
    favorites: Array,
    filters: Array,
});

const showSort = ref(false);

const toggleSort = () => {
    showSort.value ^= true;
};

const showFilter = ref(Array(props.filters.length).fill(false));

const toggleFilter = (index) => {
    showFilter.value[index] = !showFilter.value[index];
};

const showFilterMobile = ref(false);
const openFilterMobile = () => {
    showFilterMobile.value = true;
};
const closeFilterMobile = () => {
    showFilterMobile.value = false;
};
</script>

<template>
    <section class="path main-container">
        <ul class="path-row">
            <li><a href="/">Главная / </a></li>
            <li class="path-active"><a href="/catalog">Каталог</a></li>
        </ul>
    </section>
    <section class="subcategory-page main-container content-container">
        <div class="title-btn">
            <h2 class="txt-blue">Все товары</h2>
            <div class="sort">
                <span>Сортировать:</span>
                <div class="select-item" @click.prevent="toggleSort">
                    <div class="select-btn">
                        <span>По умолчанию</span
                        ><img src="/img/icons/arrow-down-dark.svg" alt="" />
                    </div>
                    <ul class="options" :class="{ 'show fade': showSort }">
                        <li class="option">По умолчанию</li>
                        <li class="option">Цена: по возрастанию</li>
                        <li class="option">Цена: по убыванию</li>
                    </ul>
                </div>
                <button
                    class="btn btn-main filter-btn"
                    @click.prevent="openFilterMobile"
                >
                    Фильтры
                </button>
            </div>
        </div>
        <div class="products-filters">
            <div class="filters-container" :class="{ show: showFilterMobile }">
                <button
                    class="btn-close-filters"
                    @click.prevent="closeFilterMobile"
                >
                    <img src="/img/icons/close.svg" alt="" />
                </button>
                <h3 class="txt-blue">Фильтры</h3>
                <div class="filters">
                    <div class="filter-item">
                        <div
                            class="select-btn"
                            @click.prevent="toggleFilter(index)"
                        >
                            <span>Цена</span
                            ><img src="/img/icons/arrow-down-dark.svg" alt="" />
                        </div>
                        <div
                            class="options-filter"
                            :class="{ show: showFilter[index] }"
                        >
                            <div class="input-range">
                                <input
                                    class="slider"
                                    id="rangeMin"
                                    type="range"
                                    min="0"
                                    max="1000"
                                    value="0"
                                />
                                <input
                                    class="slider"
                                    id="rangeMax"
                                    type="range"
                                    min="0"
                                    max="1000"
                                    value="1000"
                                />
                            </div>
                            <div class="input-group">
                                <input
                                    class="input"
                                    type="number"
                                    value="0"
                                /><span>-</span>
                                <input
                                    class="input"
                                    type="number"
                                    value="1000"
                                />
                            </div>
                        </div>
                    </div>
                    <div
                        v-for="(filter, index) in props.filters"
                        :key="index"
                        class="filter-item"
                    >
                        <div
                            class="select-btn"
                            @click.prevent="toggleFilter(index)"
                        >
                            <span>{{ filter.title }}</span
                            ><img src="/img/icons/arrow-down-dark.svg" alt="" />
                        </div>
                        <div
                            class="options-filter"
                            :class="{ show: showFilter[index] }"
                        >
                            <div
                                class="checkbox-item"
                                v-for="(option, index) in filter.values"
                                :key="index"
                            >
                                <Checkbox
                                    :id="option.slug + option.id"
                                    :value="option"
                                />
                                <label :for="option.slug + option.id">{{
                                    option.title
                                }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="products-container">
                <div class="products-wrapper products-wrapper-all">
                    <ProductCard
                        class="catalog-product-card"
                        v-for="(product, index) in products.data"
                        :key="index"
                        :product="product"
                        :favorites="favorites"
                    />
                </div>
                <Pagination :data="products" class="pages-pagination" />
            </div>
        </div>
    </section>
</template>
