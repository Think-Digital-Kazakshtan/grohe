<script setup>
    defineProps({
        loading: null
    });
</script>


<template>
    <button class="btn btn-main">
        <span v-if="!loading"><slot></slot></span>
        <img v-if="loading" src="/img/icons/loader.svg" alt="">
    </button>
</template>