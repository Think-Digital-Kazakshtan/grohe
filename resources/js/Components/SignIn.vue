<script setup>
import { ref, defineEmits } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BtnMain from "@/Components/BtnMain.vue";

defineProps({ showLogin: Boolean });

const emits = defineEmits(["onCloseLogin", "onOpenRegister"]);

const onCloseLogin = () => {
    emits("onCloseLogin");
};

const onOpenRegister = () => {
    emits("onOpenRegister");
};

const showRestore = ref(false);

const openRestore = () => {
    showRestore.value = true;
    emits("onCloseLogin");
    document.body.classList.add("no-scroll");
};

const closeRestore = () => {
    emits("onCloseSearch");
    showRestore.value = false;
    document.body.classList.remove("no-scroll");
};

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
        onSuccess: () => {
            form.reset("username", "password");
            onCloseLogin();
        },
    });
};

const restoreForm = useForm({
    email: "",
});

const submitRestore = () => {
    restoreForm.post(route("password.email"));
};
</script>

<template>
    <section
        class="modal modal-login"
        :class="{ 'show fade': showLogin }"
        id="loginModal"
    >
        <div class="login">
            <button class="close-modal" @click.prevent="onCloseLogin">
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
                            for="signIn_username"
                            value="Email или телефон*"
                        />
                        <TextInput
                            :class="{ error: form.errors.username }"
                            id="signIn_username"
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
                    <!-- <div class="social">
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
                    </div> -->
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
                    @click.prevent="onOpenRegister"
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
            <button class="close-modal" @click.prevent="closeRestore">
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
</template>
