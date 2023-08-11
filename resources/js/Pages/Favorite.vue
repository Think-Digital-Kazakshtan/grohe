<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import ProductCard from "@/Components/ProductCard.vue";
const currentPage = usePage();

defineProps({ favorites: Array });
</script>

<template>
    <section class="path main-container">
        <ul class="path-row">
            <li><Link href="/">Главная / </Link></li>
            <li class="path-active">
                <Link :href="$route('cart.index')">Корзина</Link>
            </li>
        </ul>
    </section>
    <section class="cart main-container content-container">
        <div class="title-btn">
            <h2 class="txt-blue">Избранные товары</h2>
        </div>
        <div class="cart-empty" v-if="currentPage.props.user == null">
            <p>
                Войдите или зарегистрируйтесь, чтобы добавить товар в избранное.
            </p>
            <button class="btn btn-main" @click.prevent="router.visit('login')">
                Войти / Зарегистрироваться
            </button>
        </div>
        <div v-else>
            <div class="cart-empty" v-if="favorites.length < 1">
                <p>
                    В избранном нет товаров. Перейдите в каталог чтобы добавить
                    товар в избранное.
                </p>
                <Link class="btn btn-main" :href="$route('product.catalog')"
                    >Перейти в каталог</Link
                >
            </div>
            <div v-else class="products-wrapper">
                <ProductCard
                    class="catalog-product-card"
                    v-for="(product, index) in favorites"
                    :key="index"
                    :product="product"
                    :favorites="favorites"
                />
            </div>
        </div>
    </section>
</template>
