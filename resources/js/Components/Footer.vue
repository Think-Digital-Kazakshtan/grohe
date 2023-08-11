<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const isShow = ref(null);
const btnShow = (showId) => {
    if (isShow.value == null) {
        isShow.value = showId;
    } else {
        isShow.value = null;
    }
};
</script>

<template>
    <footer class="footer">
        <div class="footer-main main-container">
            <div class="footer-logo">
                <a href="index.html"
                    ><img src="/img/logo-white.svg" alt=""
                /></a>
                <form class="subscribe" action="">
                    <h5>
                        Будьте в курсе наших акций и специальных предложений!
                    </h5>
                    <div class="input-item">
                        <input
                            class="input"
                            type="email"
                            name="email"
                            placeholder="Электронная почта"
                        />
                        <button type="submit">
                            <svg
                                width="18"
                                height="19"
                                viewBox="0 0 18 19"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M1.5 16.9999L16.5 1.99988"
                                    stroke="#0F2B4B"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M1.5 1.99988H16.5V16.9999"
                                    stroke="#0F2B4B"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="wrapper">
                <div class="footer-content">
                    <button
                        class="btn-accordion"
                        :class="{ active: isShow === '#isShow1' }"
                        @click.prevent="btnShow('#isShow1')"
                    >
                        <h5>Поддержка</h5>
                        <img src="/img/icons/arrow-down.svg" alt="" />
                    </button>
                    <ul
                        class="hidden-content"
                        :class="{ show: isShow === '#isShow1' }"
                        id="isShow1"
                    >
                        <li>
                            <Link :href="$route('support.delivery')"
                                >Доставка</Link
                            >
                        </li>
                        <li>
                            <Link :href="$route('support.pickup')"
                                >Самовывоз</Link
                            >
                        </li>
                        <li>
                            <Link :href="$route('support.payments')"
                                >Условия оплаты</Link
                            >
                        </li>
                        <li>
                            <Link :href="$route('support.return')"
                                >Возврат</Link
                            >
                        </li>
                        <li>
                            <Link :href="$route('support.guarantee')"
                                >Гарантия</Link
                            >
                        </li>
                        <li>
                            <Link :href="$route('support.installation')"
                                >Установка</Link
                            >
                        </li>
                        <li>
                            <Link :href="$route('support.services')"
                                >Сервисные центры</Link
                            >
                        </li>
                        <li><Link :href="'/contacts'">Контакты</Link></li>
                    </ul>
                </div>
                <div class="footer-content">
                    <button
                        class="btn-accordion"
                        :class="{ active: isShow === '#isShow2' }"
                        @click.prevent="btnShow('#isShow2')"
                    >
                        <h5>Адреса (г. Алматы)</h5>
                        <img src="/img/icons/arrow-down.svg" alt="" />
                    </button>
                    <ul
                        class="hidden-content"
                        :class="{ show: isShow === '#isShow2' }"
                        id="isShow2"
                    >
                        <li>{{ $helpers.setting("address_1") }}</li>
                        <li>{{ $helpers.setting("address_2") }}</li>
                        <li>{{ $helpers.setting("address_3") }}</li>
                        <li>
                            <p>
                                Время работы: Пн-Вс:
                                {{ $helpers.setting("work_time") }}
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="footer-content">
                    <button
                        class="btn-accordion"
                        :class="{ active: isShow === '#isShow3' }"
                        @click.prevent="btnShow('#isShow3')"
                    >
                        <h5>Контакты</h5>
                        <img src="/img/icons/arrow-down.svg" alt="" />
                    </button>
                    <div
                        class="hidden-content"
                        :class="{ show: isShow === '#isShow3' }"
                        id="isShow3"
                    >
                        <ul>
                            <li>
                                <a :href="'tel:' + $helpers.setting('phone')">{{
                                    $helpers.setting("phone")
                                }}</a>
                            </li>
                            <li>
                                <a
                                    :href="
                                        'mailto:' + $helpers.setting('email')
                                    "
                                    >{{ $helpers.setting("email") }}</a
                                >
                            </li>
                        </ul>
                        <ul class="social-bar">
                            <li>
                                <a href="" target="_blank">
                                    <img src="/img/icons/Insta.svg" alt=""
                                /></a>
                            </li>
                            <li>
                                <a href="" target="_blank">
                                    <img src="/img/icons/Facebook.svg" alt=""
                                /></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <form class="subscribe subscribe-mobile" action="">
                <h5>Будьте в курсе наших акций и специальных предложений!</h5>
                <div class="input-item">
                    <input
                        class="input"
                        type="email"
                        name="email"
                        placeholder="Электронная почта"
                    />
                    <button type="submit">
                        <svg
                            width="18"
                            height="19"
                            viewBox="0 0 18 19"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.5 16.9999L16.5 1.99988"
                                stroke="#0F2B4B"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M1.5 1.99988H16.5V16.9999"
                                stroke="#0F2B4B"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="footer-policy">
            <div class="main-container footer-policy-container">
                <span>2023 Официальный интернет-магазин GROHE</span>
                <ul class="policy-links">
                    <li><a href="">Политика конфиденциальности</a></li>
                    <li><a href="">Договор оферты</a></li>
                    <li><a href="">Реквизиты</a></li>
                </ul>
            </div>
        </div>
    </footer>
</template>
