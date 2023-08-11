<script setup>
import { Link, usePage, router } from "@inertiajs/vue3";
import { ref } from "vue";
import SignUp from "@/Components/SignUp.vue";
import SignIn from "@/Components/SignIn.vue";
import SearchModal from "@/Components/SearchModal.vue";

const currentPage = usePage();
const user = currentPage.props.user;

defineProps({
    canResetPassword: Boolean,
    status: String,
    categories: Array,
    cart_count: Number,
    sets: Array,
    favorites: Array,
    verification: Object,
});

const newCategories = usePage().props.categories;
const sortedCategories = newCategories.map((category) => {
    const sortedChildren = category.children
        .slice()
        .sort((a, b) => a.position - b.position);
    return { ...category, sortedChildren };
});

const showSearch = ref(false);
const showLogin = ref(false);
const showRegister = ref(false);

const openSearch = () => {
    showSearch.value = true;
    document.body.classList.add("no-scroll");
    closeBurger();
};

const openLogin = () => {
    showLogin.value = true;
    showSearch.value = false;
    document.body.classList.add("no-scroll");
    closeBurger();
};

const openRegister = () => {
    showRegister.value = true;
    showLogin.value = false;
    document.body.classList.add("no-scroll");
};

const closeRegister = () => {
    showRegister.value = false;
    document.body.classList.remove("no-scroll");
};

const closeLogin = () => {
    showLogin.value = false;
    document.body.classList.remove("no-scroll");
};

const closeSearch = () => {
    showSearch.value = false;
    document.body.classList.remove("no-scroll");
};

const isBurger = ref(false);
const clickBurger = () => {
    isBurger.value ^= true;
};

const closeBurger = () => {
    isBurger.value = false;
};
</script>

<template>
    <header class="nav main-container">
        <div class="nav-logo">
            <Link href="/"><img src="/img/logo-dark.svg" alt="" /></Link>
        </div>
        <ul class="nav-menu" :class="{ show: isBurger }">
            <li
                class="link"
                v-for="category in sortedCategories"
                :key="category.id"
            >
                <Link :href="$route('category.category', category.slug)">{{
                    category.title
                }}</Link>
                <ul class="nav-categories">
                    <li
                        class="link"
                        v-for="item in category.children"
                        :key="item.id"
                    >
                        <Link :href="'/category/' + item.slug">{{
                            item.title
                        }}</Link>
                    </li>
                </ul>
            </li>
            <li class="link">
                <Link href="/sets">Наборы</Link>
                <ul class="nav-categories">
                    <li class="link" v-for="set in sets" :key="set.id">
                        <Link :href="$route('sets.sets', set.slug)">{{
                            set.title
                        }}</Link>
                    </li>
                </ul>
            </li>
            <li class="link"><Link href="/sales">Акции</Link></li>
            <li class="link"><Link href="/catalog">Скидки</Link></li>
        </ul>
        <div class="nav-btns" :class="{ show: isBurger }">
            <ul>
                <li>
                    <button class="open-modal" @click.prevent="openSearch">
                        <img src="/img/icons/search.svg" alt="" />
                    </button>
                </li>
                <li>
                    <button
                        class="open-modal"
                        @click.prevent="
                            user == null
                                ? openLogin()
                                : router.visit('cabinet/profile') && closeBurger
                        "
                    >
                        <img src="/img/icons/login.svg" alt="" />
                    </button>
                </li>
                <li>
                    <Link href="/favorite" @click.passive="closeBurger">
                        <span class="count-numb" v-if="favorites.length > 0">{{
                            favorites.length
                        }}</span
                        ><img src="/img/icons/fav.svg" alt=""
                    /></Link>
                </li>
                <li>
                    <Link
                        class="cart-btn"
                        href="/cart"
                        @click.passive="closeBurger"
                    >
                        <span class="count-numb" v-if="cart_count > 0">{{
                            cart_count
                        }}</span>
                        <img src="/img/icons/cart.svg" alt=""
                    /></Link>
                </li>
            </ul>
        </div>
        <button
            class="btn-burger"
            :class="{ active: isBurger }"
            @click.prevent="clickBurger"
        >
            <span></span><span></span><span></span>
        </button>
    </header>
    <SearchModal :showSearch="showSearch" @onCloseSearch="closeSearch" />
    <SignIn
        :showLogin="showLogin"
        @onCloseLogin="closeLogin"
        @onOpenRegister="openRegister"
    />
    <SignUp
        :showRegister="showRegister"
        :verification="verification"
        @onCloseRegister="closeRegister"
    />
</template>
