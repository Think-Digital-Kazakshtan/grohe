<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <section class="path main-container">
        <ul class="path-row">
            <li><a href="/">Главная / </a></li>
            <li class="path-active"><a href="/category.html">Поддержка</a></li>
        </ul>
    </section>
    <section class="support main-container content-container">
        <div class="support-main">
            <div class="aside">
                <div class="selections tab-toggle">
                    <Link
                        :href="$route('support.delivery')"
                        class="selection btn btn-main"
                        >Доставка</Link
                    >
                    <Link
                        :href="$route('support.pickup')"
                        class="selection btn btn-main"
                        >Самовывоз</Link
                    >
                    <Link
                        :href="$route('support.requisites')"
                        class="selection btn btn-main"
                        >Реквизиты</Link
                    >
                    <Link
                        :href="$route('support.payments')"
                        class="selection btn btn-main"
                        >Условия оплаты</Link
                    >
                    <Link
                        :href="$route('support.return')"
                        class="selection btn btn-main"
                        >Возврат</Link
                    >
                    <Link
                        :href="$route('support.guarantee')"
                        class="selection btn btn-main"
                        >Гарантия</Link
                    >
                    <Link
                        :href="$route('support.installation')"
                        class="selection btn btn-main selected"
                        >Установка</Link
                    >
                    <Link
                        :href="$route('support.services')"
                        class="selection btn btn-main"
                        >Сервисные центры</Link
                    >
                    <Link
                        :href="$route('support.work')"
                        class="selection btn btn-main"
                        >Правила работы</Link
                    >
                </div>
            </div>
            <div class="support-container">
                <div class="support-wrapper">
                    <h2>Установка оборудования</h2>
                    <div class="support-content">
                        <p>
                            Беспроблемная работа и долгий срок службы смесителей
                            и сантехнического оборудования GROHE зависят
                            от качественно выполненной установки оборудования.
                            Клиентам официального интернет-магазина GROHE
                            мы предлагаем воспользоваться услугами
                            профессионального монтажа официального партнёра
                            GROHE в Алматы:
                        </p>
                        <br />
                        <p class="font-medium">
                            Преимущества установки через официального партнера
                            GROHE:
                        </p>
                        <ul>
                            <li>
                                Лучшие мастера, прошедшие отбор и обучение
                                в GROHE
                            </li>
                            <li>
                                Консультации по выбору необходимого
                                дополнительного оборудования
                            </li>
                            <li>
                                Стоимость работ становится известна заранее
                                и не изменится, когда мастер приедет к вам
                            </li>
                            <li>
                                Работа по договору. Гарантия на работы
                                12 месяцев
                            </li>
                            <li>
                                Всё застраховано. Если партнёр что-то испортит,
                                то возместит ущерб
                            </li>
                        </ul>
                        <p class="font-medium">Как воспользоваться?</p>
                        <ul>
                            <li>
                                Закажите необходимую сантехнику GROHE
                                в официальном интернет-магазине shop.grohe.kz.
                                После оформления заказа во всплывающем окне
                                отметьте пункт «Заказать установку».
                            </li>
                            <li>
                                После подтверждения заказа и даты доставки
                                специалисты компании-установщика свяжутся с вами
                                для подтверждения заказа на установку.
                            </li>
                            <li>
                                В согласованное время после доставки заказа
                                приедет мастер и установит купленное
                                оборудование.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
