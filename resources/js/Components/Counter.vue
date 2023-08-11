<script setup>

    import { ref, defineEmits } from 'vue';

    const props = defineProps({
        value: {
            type: Number,
            default: 1,
        }
    });

    const emit = defineEmits(['count-updated']);

    const count = ref(props.value);

    const countMinus = () => {
        if(count.value > 1) {
            count.value--;
            emit('count-updated', count.value);
        }
    };

    const countPlus = () => {
        count.value++;
        emit('count-updated', count.value);
    };

</script>

<template>

    <div class="counter">
        <span class="minus" @click.prevent="countMinus">
            <img src="/img/icons/minus.svg" alt="">
        </span>
        <input type="text" :value="count" name="" readonly class="appearance-none">
        <span class="plus" @click.prevent="countPlus">
            <img src="/img/icons/plus.svg" alt="">
        </span>
    </div>

</template>
