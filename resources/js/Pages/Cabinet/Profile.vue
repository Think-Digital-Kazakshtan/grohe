<script setup>

    import { Link, usePage, router, useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import InputError from '@/Components/InputError.vue';
    import BtnMain from '@/Components/BtnMain.vue';

    const currentPage = usePage();
    const user = currentPage.props.user;

    const personalForm = useForm({
        _method: 'PUT',
        name: user.name,
        phone: user.phone,
        email: user.email,
    });

    const personalSubmit = () => {
        personalForm.post(route('user-profile-information.update'), {
            errorBag: 'updateProfileInformation',
            preserveScroll: true,
        });
    };

    const passwordInput = ref(null);
    const currentPasswordInput = ref(null);

    const passwordForm = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const updatePassword = () => {
        passwordForm.put(route('user-password.update'), {
            errorBag: 'updatePassword',
            preserveScroll: true,
            onSuccess: () => passwordForm.reset(),
            onError: () => {
                if (passwordForm.errors.password) {
                    passwordForm.reset('password', 'password_confirmation');
                    passwordInput.value.focus();
                }

                if (passwordForm.errors.current_password) {
                    passwordForm.reset('current_password');
                    currentPasswordInput.value.focus();
                }
            },
        });
    };

    const logout = () => {
        router.post(route('logout'));
    };

</script>

<template>
    
    <section class="path main-container">
        <ul class="path-row">
            <li><a href="/">Главная / </a></li>
            <li class="path-active"><a href="">Личный кабинет</a></li>
        </ul>
    </section>
    <section class="cabinet main-container content-container">
        <div class="cabinet-main tabs">
            <div class="aside">
                <div class="selections tab-toggle">
                    <Link class="selection btn btn-main selected" :href="$route('cabinet.index')">Персональные данные</Link>
                    <Link class="selection btn btn-main" :href="$route('cabinet.myOrders')">Мои заказы</Link>
                    <Link class="selection btn btn-main" :href="$route('cabinet.addresses.index')">Адреса</Link>
                    <form class="selection btn btn-main" @submit.prevent="logout"><button class="w-full text-left sm:text-center lg:text-left">Выход</button></form>
                </div>
            </div>
            <div class="cabinet-container tab-wrapper">
                <div class="cabinet-wrapper tab show fade">
                    <div class="title">
                        <h2>Персональные данные</h2>
                        <p>С помощью панели управления у вас есть возможность просматривать краткий обзор активности
                            учётной записи и обновлять информацию о ней. Выберите ссылку для просмотра
                            или редактирования информации.</p>
                    </div>
                    <p class="points">Ваши бонусные баллы: <span>0.00 баллов</span></p>
                    <form class="personal-form" @submit.prevent="personalSubmit">
                        <h3>Данные учетной записи</h3>
                        <div class="personal-inputs">
                            <div class="input-label">
                                <label for="name">ФИО*</label>
                                <input id="name" class="input" type="text" name="name" v-model="personalForm.name" >
                                <InputError :message="personalForm.errors.name" class="mt-2 text-error" />
                            </div>
                            <div class="input-label">
                                <label for="phone">Телефон*</label>
                                <input id="phone" class="input" type="tel" name="phone" v-model="personalForm.phone" >
                                <InputError :message="personalForm.errors.phone" class="mt-2 text-error" />
                            </div>
                            <div class="input-label">
                                <label for="email">Электронная почта*</label>
                                <input id="email" class="input" type="email" name="email" v-model="personalForm.email" >
                                <InputError :message="personalForm.errors.email" class="mt-2 text-error" />
                            </div>
                        </div>
                        <BtnMain :disabled="personalForm.processing" :loading="personalForm.processing">Сохранить данные</BtnMain>
                    </form>
                    <form class="personal-inputs" @submit.prevent="updatePassword">
                        <h3>Изменить пароль</h3>
                        <div class="input-label">
                            <label for="currnet_password">Текущий пароль*</label>
                            <input class="input" id="currnet_password" type="password" ref="currentPasswordInput" v-model="passwordForm.current_password" >
                            <InputError :message="passwordForm.errors.current_password" class="mt-2 text-error" />
                        </div>
                        <div class="input-label">
                            <label for="password">Новый пароль*</label>
                            <input class="input" id="password" type="password" ref="passwordInput" v-model="passwordForm.password" >
                            <InputError :message="passwordForm.errors.password" class="mt-2 text-error" />
                        </div>
                        <div class="input-label">
                            <label for="confirm_password">Подтвердите новый пароль*</label>
                            <input class="input" id="confirm_password" type="password" v-model="passwordForm.password_confirmation" >
                            <InputError :message="passwordForm.errors.password_confirmation" class="mt-2 text-error" />
                        </div>
                        <BtnMain :disabled="passwordForm.processing" :loading="passwordForm.processing">Сохранить пароль</BtnMain>
                    </form>
                </div>
            </div>
        </div>
    </section>

</template>


<!-- <script setup>

    defineProps({ user: Object });

</script>

<template>

    <div class="cabinet-wrapper tab show fade">
        <div class="title">
            <h2>Персональные данные</h2>
            <p>С помощью панели управления у вас есть возможность просматривать краткий обзор активности
                учётной записи и обновлять информацию о ней. Выберите ссылку для просмотра
                или редактирования информации.</p>
        </div>
        <p class="points">Ваши бонусные баллы: <span>0.00 баллов</span></p>
        <form class="personal-form" action="" method="POST">
            <h3>Данные учетной записи</h3>
            <div class="personal-inputs">
                <div class="input-label">
                    <label for="">Имя*</label>
                    <input class="input" type="text" name="name" :value="user.name">
                </div>
                <div class="input-label">
                    <label for="">Фамилия</label>
                    <input class="input" type="text" name="name" :value="user.name">
                </div>
                <div class="input-label">
                    <label for="">Телефон*</label>
                    <input class="input" type="tel" name="phone" :value="user.phone">
                </div>
                <div class="input-label">
                    <label for="">Электронная почта*</label>
                    <input class="input" type="email" name="email" :value="user.email">
                </div>
            </div>
            <h3>Изменить пароль</h3>
            <div class="personal-inputs">
                <div class="input-label">
                    <label for="old_password">Старый пароль*</label>
                    <input class="input" id="old_password" type="password">
                </div>
                <div class="input-label">
                    <label for="new_password">Новый пароль*</label>
                    <input class="input" id="new_password" type="password">
                </div>
                <div class="input-label">
                    <label for="confirm_password">Подтвердите новый пароль*</label>
                    <input class="input" id="confirm_password" type="password">
                </div>
            </div>
            <button class="btn btn-main">Сохранить изменения</button>
        </form>
    </div>

</template> -->