<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BtnMain from "@/Components/BtnMain.vue";
import OTP from "@/Components/OTP.vue";

const showRestore = ref(false);
const showSignUp = ref(false);

const openRestore = () => {
    showRestore.value = true;
    document.body.classList.add("no-scroll");
};

const openSignUp = () => {
    showSignUp.value = true;
    document.body.classList.add("no-scroll");
};

const close = () => {
    showRestore.value = false;
    showSignUp.value = false;
    document.body.classList.remove("no-scroll");
};

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onSuccess: () => document.body.classList.remove("no-scroll"),
        onFinish: () => form.reset("password"),
    });
};

const restoreForm = useForm({
    email: "",
});

const submitRestore = () => {
    restoreForm.post(route("password.email"));
};

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
            <button class="close-modal" @click.prevent="close">
                <svg
                    width="30"
                    height="30"
                    viewBox="0 0 30 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M23 7L8 22"
                        stroke="#ffffff"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M8 7L23 22"
                        stroke="#ffffff"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>
            <div class="card">
                <h3>Войти</h3>
                <form class="login-form" @submit.prevent="submit">
                    <div class="input-label">
                        <InputLabel
                            for="signIn_login"
                            value="Email или телефон???*"
                        />
                        <TextInput
                            :class="{ error: form.errors.username }"
                            id="signIn_login"
                            v-model="form.username"
                            type="text"
                            required
                        />
                        <InputError :message="form.errors.username" />
                    </div>
                    <div class="input-label">
                        <InputLabel for="signIn_password" value="Пароль*" />
                        <TextInput
                            :class="{ error: form.errors.password }"
                            id="signIn_password"
                            v-model="form.password"
                            type="password"
                            required
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    <BtnMain
                        :disabled="form.processing"
                        :loading="form.processing"
                        >Войти</BtnMain
                    >
                    <button
                        class="link-underline restore"
                        @click.prevent="openRestore"
                    >
                        Забыли пароль?
                    </button>
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
                <h3>Создать аккаунт</h3>
                <p>
                    Создайте учетную запись, чтобы отслеживать заказы, копить
                    бонусы и упростить процесс оформления заказа!
                </p>
                <button
                    class="btn btn-main btn-signUp"
                    @click.prevent="openSignUp"
                >
                    Создать
                </button>
            </div>
        </div>
    </section>

    <section
        class="modal modal-restore"
        :class="{ 'show fade': showRestore }"
        id="restoreModal"
    >
        <div class="login">
            <button class="close-modal" @click.prevent="close">
                <img src="/img/icons/close-dark.svg" alt="" />
            </button>
            <div class="card">
                <h3>Восстановить пароль</h3>
                <form
                    class="login-form restore-form"
                    @submit.prevent="submitRestore"
                >
                    <div class="input-label restore-email show fade">
                        <InputLabel
                            for="restore_email"
                            value="Введите Email*"
                        />
                        <TextInput
                            :class="{ error: restoreForm.errors.email }"
                            id="restore_email"
                            v-model="restoreForm.email"
                            type="email"
                            required
                        />
                        <InputError :message="restoreForm.errors.email" />
                    </div>
                    <div class="input-label restore-code">
                        <label for="login">Введите полученный код*</label>
                        <input
                            class="input error"
                            id="login"
                            type="text"
                        /><span class="error-text"
                            >Данное поле обязательное для заполнения</span
                        >
                    </div>
                    <button class="btn btn-main btn-restore">
                        Получить код
                    </button>
                </form>
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
                </form>
            </div>
        </div>
    </section>

    <!-- <OTP /> -->
</template>

<!-- <script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <Head title="Log in" />

    <AuthenticationCard>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template> -->
