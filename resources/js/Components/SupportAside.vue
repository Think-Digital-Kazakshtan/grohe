<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({ selectedDelivery: Boolean, selectedPickup: Boolean });
</script>

<template>
    <div class="aside">
        <div class="selections tab-toggle">
            <Link
                class="selection btn btn-main"
                :class="{ selected: selectedDelivery }"
                >Доставка</Link
            >
            <Link
                class="selection btn btn-main"
                :class="{ selected: selectedPickup }"
                >Самовывоз</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Реквизиты</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Условия оплаты</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Возврат</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Гарантия</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Установка</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Сервисные центры</Link
            >
            <Link class="selection btn btn-main" :class="{ selected: selected }"
                >Правила работы</Link
            >
        </div>
    </div>
</template>
