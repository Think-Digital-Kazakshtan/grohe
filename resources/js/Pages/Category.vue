<script setup>

    import ProductCard from '@/Components/ProductCard.vue';
    
    const props = defineProps({
        category: Object,
        favorites: Array,
    });

    const addBigClass = (index) => {
        return (index + 1) % 5 === 0 || (index + 2) % 5 === 0;
    };

</script>

<template>

    <section class="path main-container">
        <ul class="path-row">
            <li><a href="/">Главная / </a></li>
            <li class="path-active"><a href="/category.html">{{ category.title }}</a></li>
        </ul>
    </section>
    <section class="sets category-page main-container content-container" v-if="category.children.length >= 1">
        <div class="wrapper">
            <a class="set" :class="{ 'set-big' : addBigClass(index) }" :href="item.slug" v-for="(item, index) in category.children" :key="item.id">
                <img :src="$helpers.asset(item.image)" alt="">
                <div class="card">
                    <h4 class="txt-blue">{{ item.title }}</h4>
                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 16.9999L16.5 1.99988" stroke="#0F2B4B" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M1.5 1.99988H16.5V16.9999" stroke="#0F2B4B" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </a>
        </div>
    </section>
    <section class="category-page main-container content-container" v-if="category.children == 0">
        <h2 class="title txt-blue">{{ category.title }}</h2>
        <div v-if="category.products.length >= 1" class="products-wrapper products-wrapper-all">
            <ProductCard v-for="product in category.products" :key="product.id" :product="product" :favorites="favorites" />
        </div>
        <div v-else>
            <p>У данной категории пока нет товаров</p>
        </div>
        <!-- <Pagination v-if="category.products.length >= 1" :data="products" class="pages-pagination" /> -->
    </section>

</template>
