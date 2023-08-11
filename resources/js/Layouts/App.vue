<script setup>
import Nav from "@/Components/Nav.vue";
import Footer from "@/Components/Footer.vue";
import { onMounted, onUpdated, getCurrentInstance, ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
const currentPage = usePage();
const props = defineProps({
    categories: Array,
    cart_count: Number,
    sets: Array,
    favorites: Array,
    user: Object,
    verification: Object,
});
const instance = getCurrentInstance();
const $notify = instance.appContext.config.globalProperties.$notify;

onUpdated(() => {
    initSnackbar();
});

const initSnackbar = () => {
    const notification = currentPage.props.flash.notify;
    const statuses = {
        error: {
            customClass: "notification-bar-error",
            textColor: "#D62D30",
            backgroundColor: "#fff",
            actionTextColor: "#0F2B4B",
        },
        success: {
            customClass: "notification-bar-succes",
            textColor: "#69A042",
            backgroundColor: "#fff",
            actionTextColor: "#0F2B4B",
        },
        warning: {
            customClass: "notification-bar-warning",
            textColor: "#FFBF00",
            backgroundColor: "#fff",
            actionTextColor: "#0F2B4B",
        },
    };
    if (notification) {
        let config = {
            text: notification.message,
            pos: "bottom-right",
            actionText: "Скрыть",
            customClass: "notification-bar",
        };
        Object.assign(config, statuses[notification.status]);
        if (notification.button) {
            config = Object.assign(config, {
                actionText: notification.button[0],
                onActionClick: (element) => {
                    router.get(route(notification.button[1]));
                },
            });
        }
        $notify.show(config);
    }
};
</script>

<template>
    <main>
        <Nav
            :categories="categories"
            :cart_count="cart_count"
            :sets="sets"
            :favorites="favorites"
            :user="user"
            :verification="verification"
        />
        <slot />
        <Footer />
    </main>
</template>
