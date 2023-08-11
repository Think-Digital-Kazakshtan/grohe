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
                        class="selection btn btn-main"
                        >Установка</Link
                    >
                    <Link
                        :href="$route('support.services')"
                        class="selection btn btn-main selected"
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
                    <h2>Сервисные центры</h2>
                    <div class="support-content">
                        <p>
                            Специалисты технической поддержки GROHE
                            проконсультируют вас по вопросам сервисного
                            обслуживания продукции.
                        </p>
                        <br />
                        <p class="font-medium">
                            Позвоните или напишите в службу технической
                            поддержки в Казахстане
                        </p>
                        <ul>
                            <li>
                                <a href="tel:+77750070527">+7 775 007 05 27</a>
                            </li>
                            <li>
                                <a href="mailto:service-kz@grohe.com"
                                    >service-kz@grohe.com</a
                                >
                            </li>
                        </ul>
                        <p class="font-medium">
                            Подробнее о гарантии и преимуществах сервисного
                            обслуживания GROHE
                        </p>
                        <br />
                        <p class="font-medium">
                            При обращении в сервисный центр вам необходимо
                            предъявить:
                        </p>
                        <ul>
                            <li>Товар</li>
                            <li>Гарантийный талон</li>
                            <li>Чек (необязательно)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
