<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BtnMain from "@/Components/BtnMain.vue";

const registerForm = useForm({
    name: "",
    email: "",
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
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <section class="page-container">
        <div class="login">
            <div class="card">
                <h3>Регистрация</h3>
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
                    <div class="input-label signUp-email">
                        <InputLabel
                            for="register_email"
                            value="Введите Email*"
                        />
                        <TextInput
                            :class="{ error: registerForm.errors.email }"
                            id="register_email"
                            v-model="registerForm.email"
                            type="email"
                            required
                        />
                        <InputError :message="registerForm.errors.email" />
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
                    <div class="social">
                        <h5>Или войдите с помощью:</h5>
                        <ul class="social-bar">
                            <li>
                                <a href=""
                                    ><img src="/img/icons/Google.svg" alt=""
                                /></a>
                            </li>
                            <li>
                                <a href=""
                                    ><img
                                        src="/img/icons/Facebook-color.svg"
                                        alt=""
                                /></a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="card card-dark">
                <h3>Уже есть аккаунт?</h3>
                <button
                    class="btn btn-main btn-signUp"
                    @click.prevent="openSignUp"
                >
                    Войти
                </button>
            </div>
        </div>
    </section>
    <section
        class="modal modal-restore"
        :class="{ 'show fade': showSignUp }"
        id="signUpModal"
    >
        <div class="login">
            <button class="close-modal" @click.prevent="close">
                <img src="/img/icons/close-dark.svg" alt="" />
            </button>
            <div class="card">
                <h3>Создать аккаунт</h3>
            </div>
        </div>
    </section>
</template>
