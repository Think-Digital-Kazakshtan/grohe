<script setup>
import { ref, onMounted } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import VOtpInput from "vue3-otp-input";
import InputError from "@/Components/InputError.vue";

onMounted(() => {
    setTimer();
});

const timer = ref(59);

const sendCodeForm = useForm({
    otp: null,
});

const sendCodeAgainForm = useForm({
    id: usePage().props.verification ? usePage().props.verification.id : null,
});

const setTimer = () => {
    timer.value = 59;
    const interval = setInterval(() => {
        if (timer.value > 0) {
            timer.value--;
        } else {
            clearInterval(interval);
        }
    }, 1000);
};

const handleOnComplete = (value) => {
    sendCodeForm
        .transform((data) => ({
            ...data,
            otp: Number(value),
        }))
        .post(route("verify_and_login"), {
            onSuccess: () => {
                window.location.reload();
            },
        });
    setTimer();
};

const handleOnChange = (value) => {};

const sendAgain = () => {
    sendCodeAgainForm.post(route("send_otp_again"), {
        onSuccess: setTimer,
    });
};
</script>

<template>
    <div class="login otp-modal">
        <button class="close-modal" @click.prevent="close">
            <img src="/img/icons/close-dark.svg" alt="" />
        </button>
        <div class="card text-center">
            <h3>Введите код авторизации</h3>
            <div class="otp-container" v-if="!sendCodeForm.processing">
                <div class="otp-inner">
                    <v-otp-input
                        ref="otpInput"
                        v-model="sendCodeForm.otp"
                        input-classes="otp-input"
                        separator="-"
                        :num-inputs="4"
                        :should-auto-focus="true"
                        input-type="numeric"
                        :conditionalClass="['one', 'two', 'three', 'four']"
                        :placeholder="['-', '-', '-', '-']"
                        @on-change="handleOnChange"
                        @on-complete="handleOnComplete"
                    />
                </div>
                <InputError
                    class="otp-error-message"
                    :message="sendCodeForm.errors.otp"
                />
                <div class="otp-timer">
                    <button
                        class="send-again"
                        :disabled="timer > 0"
                        :class="{ 'disabled-link': timer > 0 }"
                        @click.prevent="sendAgain"
                    >
                        Отправить еще раз
                    </button>
                    <span> через 00:{{ timer < 10 ? 0 : "" }}{{ timer }}</span>
                </div>
            </div>
            <img
                class="opt-loader"
                v-if="sendCodeForm.processing"
                src="/img/icons/loader.svg"
                alt=""
            />
        </div>
    </div>
</template>

<style lang="scss">
.otp-container {
    @apply w-[428px];
}
.otp-inner {
    @apply flex items-center justify-center flex-col;
    span {
        @apply hidden;
    }
}
.otp-timer {
    @apply mt-5 flex justify-around;
}
.send-again {
    @apply underline;
    &.disabled-link {
        @apply opacity-70 pointer-events-none;
    }
}
.opt-loader {
    @apply w-20 h-20 mx-auto;
}
.otp-error-message {
    @apply mt-5 block text-error;
}
.otp-input {
    @apply w-20 h-20 p-2.5 mx-0 border-t-0 border-r-0 border-l-0 border-b border-accent2 text-center focus:outline-none focus:ring-0 focus:border-b-secondary text-5xl;
}
.otp-input.is-complete {
    @apply bg-transparent;
}
.otp-input::-webkit-inner-spin-button,
.otp-input::-webkit-outer-spin-button {
    @apply m-0;
    -webkit-appearance: none;
}
input.otp-input::placeholder {
    @apply text-3xl text-center font-semibold;
}
</style>
