<script setup>
import { Link, usePage } from "@inertiajs/vue3";
// const cartItems = Object.values(usePage().props.cartItems);
// const productProp = usePage().props.product;

defineProps({ product: Object, favorites: Array });

// const inCart = cartItems.find((item) => item.id == usePage().props.product.id);

// console.log(inCart);
// console.log(props.product);

// console.log(cartItems);
</script>

<template>
    <div class="card product-card">
        <Link
            class="card-img"
            :href="'http://grohe.thinkdev.link/product/' + product.slug"
        >
            <img :src="product.media[0].original_url" alt="" />
        </Link>
        <div class="card-content">
            <h5 class="text-blue">
                <Link
                    :href="'http://grohe.thinkdev.link/product/' + product.slug"
                    >{{ product.title + "..." }}</Link
                >
            </h5>
            <div class="price">
                <span class="price-new">{{ product.price }} ₸</span>
                <span v-if="product.old_price != null" class="price-old">{{
                    product.old_price
                }}</span>
            </div>
            <div class="btns-group">
                <button
                    class="btn btn-main"
                    @click.prevent="$cart.add(product.id)"
                >
                    В корзину
                </button>
                <button
                    class="btn btn-icon"
                    :class="{
                        'btn-icon-filled': favorites.find(
                            ($item) => $item.id == product.id
                        ),
                    }"
                    @click.prevent="$favorites.toggle(product.id)"
                >
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
</template>
