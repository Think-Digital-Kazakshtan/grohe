<script setup>

    import { Link } from '@inertiajs/vue3';

    const props = defineProps({ sets: Array });

    const addBigClass = (index) => {
        return (index + 1) % 5 === 0 || (index + 2) % 5 === 0;
    };

</script>

<template>

    <section class="path main-container">
        <ul class="path-row">
            <li><a href="/">Главная / </a></li>
            <li class="path-active"><a href="/sets.html">Готовые наборы</a></li>
        </ul>
    </section>
    <section class="sets main-container content-container">
        <h2 class="title txt-blue">Готовые наборы</h2>
        <div class="wrapper">
            <Link class="set" :class="{ 'set-big' : addBigClass(index) }" :href="$route('sets.sets', item.slug)" v-for="(item, index) in sets" :key="item.id">
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
            </Link>
        </div>
    </section>

</template>