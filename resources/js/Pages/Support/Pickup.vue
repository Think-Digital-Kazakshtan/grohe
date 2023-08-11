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
                        class="selection btn btn-main selected"
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
                    <h2>Пункт самовывоза GROHE</h2>
                    <div class="support-content">
                        <p class="font-medium">
                            Уважаемые клиенты, приглашаем самостоятельно забрать
                            ваш заказ в Алматы
                        </p>
                        <ul>
                            <li>
                                Мы находимся по адресу г. Алматы пр. Жибек Жолы
                                135/10А бутик 48 (строительный центр Жибек Жолы)
                            </li>
                            <li>
                                Ждём вас на следующий день после оформления
                                заказа или другой удобный день
                                после подтверждения заказа нашим сотрудником
                            </li>
                            <li>
                                Оплата заказа в шоу-руме возможна наличными
                                деньгами или оплатой банковской картой
                                через интернет-магазин
                            </li>
                        </ul>
                        <p class="font-medium">График работы шоу-рума</p>
                        <ul>
                            <li>
                                С понедельника по воскресенье с 10:00 до 20:00
                            </li>
                        </ul>
                        <p class="font-medium">
                            Проложите маршрут и приезжайте к нам
                        </p>
                        <ul>
                            <li>На Яндекс.Картах</li>
                            <li>На Картах Google</li>
                        </ul>
                        <p class="font-medium">
                            Наше здание находится по пр. Жибек Жолы между
                            улицами Масанчи и Амангельды
                        </p>
                        <ul>
                            <li>Вход в здание через центральный вход</li>
                            <li>
                                Мы находимся на втором этаже справа от
                                эскалатора
                            </li>
                        </ul>
                        <p class="font-medium">
                            Свяжитесь с нами, если у вас остались вопросы
                        </p>
                        <ul>
                            <li>
                                <a href="tel:+77008368515"
                                    >+7 (700) 836-85-15</a
                                >
                            </li>
                        </ul>
                        <img src="/img/support.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
