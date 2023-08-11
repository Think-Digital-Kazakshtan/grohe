<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <!-- <div v-show="message">
        <p class="text-sm text-red-600">
            {{ message }}
        </p>
    </div> -->
    <span v-show="message">{{ message }}</span>
</template>
