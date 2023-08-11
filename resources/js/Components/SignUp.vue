<script setup>
import { defineEmits } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BtnMain from "@/Components/BtnMain.vue";
import OTP from "@/Components/OTP.vue";

defineProps({ showRegister: Boolean, verification: Object });

const emits = defineEmits(["onCloseRegister"]);

const onCloseRegister = () => {
    emits("onCloseRegister");
};

const registerForm = useForm({
    name: "",
    username: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submitRegister = () => {
    registerForm.post(route("register"), {
        onSuccess: (response) => {
            document.body.classList.remove("no-scroll");
            console.log("REGISTER", response);
        },
        onFinish: () => registerForm.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <section
        class="modal modal-restore"
        :class="{ 'show fade': showRegister }"
        id="signUpModal"
    >
        <div class="login" v-if="verification == null">
            <button class="close-modal" @click.prevent="onCloseRegister">
                <img src="/img/icons/close-dark.svg" alt="" />
            </button>
            <div class="card">
                <h3>Создать аккаунт</h3>
                <form
                    class="login-form signUp-form"
                    @submit.prevent="submitRegister"
                >
                    <div class="input-label signUp-name">
                        <InputLabel for="register_name" value="ФИО*" />
                        <TextInput
                            :class="{ error: registerForm.errors.name }"
                            id="register_name"
                            v-model="registerForm.name"
                            type="text"
                            required
                        />
                        <InputError :message="registerForm.errors.name" />
                    </div>
                    <div class="input-label signUp-username">
                        <InputLabel
                            for="register_username"
                            value="Введите Email или номер телефона*"
                        />
                        <TextInput
                            :class="{ error: registerForm.errors.username }"
                            id="register_username"
                            v-model="registerForm.username"
                            type="text"
                            required
                        />
                        <InputError :message="registerForm.errors.username" />
                    </div>
                    <div class="input-label signUp-password">
                        <InputLabel for="register_password" value="Пароль*" />
                        <TextInput
                            :class="{ error: registerForm.errors.password }"
                            id="register_password"
                            v-model="registerForm.password"
                            type="password"
                            required
                        />
                        <InputError :message="registerForm.errors.password" />
                    </div>
                    <div class="input-label signUp-password">
                        <InputLabel
                            for="register_password_confirmation"
                            value="Повторите пароль*"
                        />
                        <TextInput
                            :class="{
                                error: registerForm.errors
                                    .password_confirmation,
                            }"
                            id="register_password_confirmation"
                            v-model="registerForm.password_confirmation"
                            type="password"
                            required
                        />
                        <InputError
                            :message="registerForm.errors.password_confirmation"
                        />
                    </div>
                    <BtnMain
                        :disabled="registerForm.processing"
                        :loading="registerForm.processing"
                        >Зарегистрироваться</BtnMain
                    >
                </form>
            </div>
        </div>
        <OTP v-else @onCloseSignUp="onCloseRegister" />
    </section>
</template>
