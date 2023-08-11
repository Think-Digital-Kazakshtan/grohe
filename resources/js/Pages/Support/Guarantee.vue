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
                        class="selection btn btn-main selected"
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
                    <h2>Расширенная гарантия GROHE</h2>
                    <div class="support-content">
                        <p>
                            Продукция GROHE обладает выдающимся качеством.
                            Все изделия, а также их компоненты, подвергаются
                            многочисленным тестам на прочность, качество работы
                            и безупречность внешнего вида. Наши испытания —
                            самые строгие в отрасли, и каждый продукт, прежде
                            чем попасть в продажу, блестяще их проходит.
                        </p>
                        <br />
                        <p>
                            По этой причине на прогрессивные системы подготовки
                            и подачи воды GROHE предоставляется расширенная
                            гарантия, значительно превышающая требуемый
                            по закону минимальный гарантийный срок.
                        </p>
                        <div class="card">
                            <p class="font-medium">
                                Гарантийный срок на основные группы товаров
                            </p>
                            <ul>
                                <li>
                                    Смесители всех типов, системы инсталляции и
                                    душевые гарнитуры
                                </li>
                                <li>
                                    Душевые шланги и распылители, приобретаемые
                                    по отдельности
                                </li>
                                <li>Аксессуары всех видов</li>
                            </ul>
                        </div>
                        <div class="card">
                            <p class="font-medium">
                                10 лет гарантии на профессиональные продукты
                                GROHE
                            </p>
                            <br />
                            <p>
                                GROHE предоставляет расширенную десятилетнюю
                                гарантию производителя на отдельные
                                профессиональные продукты серий Rapid SL,
                                Uniset, встраиваемые смесители и термостаты
                                Rapido и других серий, произведённые с марта
                                2013 года.
                            </p>
                            <p>Продукты GROHE с расширенной гарантией 10 лет</p>
                        </div>
                        <p class="font-medium underline">Условия гарантии</p>
                        <br /><br />
                        <p class="font-medium">
                            Позвоните или напишите в службу технической
                            поддержки в Казахстане
                        </p>
                        <ul>
                            <li>
                                <a class="link" href="tel:+77750070527">
                                    +7 775 007 05 27</a
                                >
                            </li>
                            <li>
                                <a
                                    class="link"
                                    href="mailto:service-kz@grohe.com"
                                    >service-kz@grohe.com</a
                                >
                            </li>
                        </ul>
                        <p>
                            * При отсутствии гарантийного талона GROHE
                            авторизованный сервисный центр принимает продукцию
                            в ремонт в течение установленного гарантийного
                            срока. При отсутствии информации о дате
                            приобретения, датой начала гарантийного срока будет
                            считаться дата производства товара при её наличии
                            на маркировке оригинального изделия GROHE.** Каждый
                            случай рассматривается индивидуально. Решение
                            принимается сервисным центром.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
