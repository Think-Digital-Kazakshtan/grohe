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
                        class="selection btn btn-main selected"
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
                    <h2>Реквизиты</h2>
                    <div class="support-content">
                        <p>
                            Официальный интернет-магазин GROHE создан
                            и поддерживается в партнёрстве с компанией
                            ТОО «Гидробаланс», официальным логистическим
                            партнёром компании GROHE. Все заказы, оформленные
                            через интерфейс интернет-магазина или по телефону,
                            выполняются компанией ТОО «Гидробаланс». Приобретая
                            товары в интернет-магазине, вы заключаете договор
                            купли-продажи с компанией ТОО «Гидробаланс».
                        </p>
                        <div class="card">
                            <h5>Реквизиты ТОО «Гидробаланс»</h5>
                            <ul class="desc-list">
                                <li>
                                    <p>Юридический адрес</p>
                                    <span
                                        >РК, г. Алматы, проспект Жибек Жолы 135,
                                        офис 48</span
                                    >
                                </li>
                                <li>
                                    <p>Фактический адрес</p>
                                    <span
                                        >РК, г. Алматы, проспект Жибек Жолы 135,
                                        офис 48</span
                                    >
                                </li>
                                <li>
                                    <p>Расчетный счет</p>
                                    <span
                                        >KZ7296502F0010037954 в Филиал АО
                                        «ForteBank», г. Алматы</span
                                    >
                                </li>
                                <li>
                                    <p>БИК</p>
                                    <span>IRTYKZKA</span>
                                </li>
                                <li>
                                    <p>БИН</p>
                                    <span>181140002166</span>
                                </li>
                                <li>
                                    <p>Директор</p>
                                    <span>Абраев Ильяс Муратович</span>
                                </li>
                            </ul>
                        </div>
                        <p>
                            Порядок предъявления требований потребителями при
                            обнаружении недостатков в товарах, приобретённых в
                            интернет-магазине: требования могут быть предъявлены
                            к Продавцу: ТОО «Гидробаланс», адрес: г. Алматы,
                            проспект Жибек Жолы 135, офис 48, телефон: +7 (700)
                            836-85-15
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
