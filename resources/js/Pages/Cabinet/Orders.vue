<script setup>

    import { Link, usePage } from '@inertiajs/vue3';

    const currentPage = usePage();
    const user = currentPage.props.user;

    defineProps({user: Object});

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
                    <Link class="selection btn btn-main" :href="$route('cabinet.index')">Персональные данные</Link>
                    <Link class="selection btn btn-main selected" :href="$route('cabinet.myOrders')">Мои заказы</Link>
                    <Link class="selection btn btn-main" :href="$route('cabinet.addresses.index')">Адреса</Link>
                    <form class="selection btn btn-main" @submit.prevent="logout"><button class="w-full text-left sm:text-center lg:text-left">Выход</button></form>
                </div>
            </div>
            <div class="cabinet-container tab-wrapper">
                <div class="cabinet-wrapper tab show fade">
                    <h2>Мои заказы</h2>
                    <div class="card orders">
                        <div class="order-header">
                            <div class="order-title">
                                <p>Номер заказа</p>
                            </div>
                            <div class="order-title">
                                <p>Сумма заказа</p>
                            </div>
                            <div class="order-title">
                                <p>Дата</p>
                            </div>
                            <div class="order-title">
                                <p>Статус</p>
                            </div>
                            <div class="order-title">
                                <p>Подробнее</p>
                            </div>
                        </div>
                        <div class="order">
                            <div class="order-info">
                                <p>D8765H</p>
                            </div>
                            <div class="order-info">
                                <p>460 700 ₸</p>
                            </div>
                            <div class="order-info">
                                <p>02.09.2019</p>
                            </div>
                            <div class="order-info completed">
                                <p>Заказ выполнен</p>
                            </div>
                            <div class="order-info"><a class="open-modal" href="#orderModal1">
                                    <p>Смотреть подробнее</p>
                                </a></div>
                        </div>
                        <div class="order">
                            <div class="order-info">
                                <p>D8765H</p>
                            </div>
                            <div class="order-info">
                                <p>80 700 ₸</p>
                            </div>
                            <div class="order-info">
                                <p>16.05.2022</p>
                            </div>
                            <div class="order-info in-progress">
                                <p>Ожидается доставка</p>
                            </div>
                            <div class="order-info"><a class="open-modal" href="#orderModal2">
                                    <p>Смотреть подробнее</p>
                                </a></div>
                        </div>
                        <div class="order">
                            <div class="order-info">
                                <p>D8765H66782</p>
                            </div>
                            <div class="order-info">
                                <p>100 000 ₸</p>
                            </div>
                            <div class="order-info">
                                <p>02.09.2019</p>
                            </div>
                            <div class="order-info canceled">
                                <p>Отменен</p>
                            </div>
                            <div class="order-info"><a class="open-modal" href="#orderModal3">
                                    <p>Смотреть подробнее</p>
                                </a></div>
                        </div>
                    </div>
                    <div class="modal modal-order" id="orderModal1">
                        <div class="card"><a class="close-modal" href="#orderModal1"><img src="/img/icons/close-dark.svg"
                                    alt=""></a>
                            <div class="card-header">
                                <h4>Номер заказа: D8765H</h4>
                                <div class="card-date">
                                    <p class="txt-blue-opacity">Дата:02.09.2019</p><span>Ожидаемая доставка:
                                        25.05.2023</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5>Содержание заказа:</h5>
                                <div class="product-item card">
                                    <div class="product-info"><img src="/img/products/product-1.png" alt="">
                                        <div class="product-content">
                                            <p>Угловой вентиль 1/2 дюйма, хром</p><span>Цвет: Хром</span>
                                        </div>
                                    </div>
                                    <div class="product-price">3 000 ₸</div>
                                </div>
                                <div class="product-item card">
                                    <div class="product-info"><img src="/img/products/product-2.png" alt="">
                                        <div class="product-content">
                                            <p>Tempesta-F Trigger Spray 30 Душевой набор</p><span>Цвет: Хром</span>
                                        </div>
                                    </div>
                                    <div class="product-price">100 000 ₸</div>
                                </div>
                                <div class="card-info">
                                    <h5>Доставка</h5>
                                    <p class="txt-blue-opacity">Казахстан, г. Алматы, Каирбекова 38а, кв 75</p>
                                </div>
                                <div class="card-info">
                                    <h5>Оплата</h5>
                                    <p class="txt-blue-opacity">Оплата при получении</p>
                                </div>
                            </div>
                            <div class="card-footer total">
                                <div class="total-price">
                                    <h5>Итог</h5>
                                    <h5>1 580 300 ₸</h5>
                                </div>
                                <ul>
                                    <li>
                                        <p>Товары, 2 шт</p>
                                        <p>145 000 ₸</p>
                                    </li>
                                    <li> <span>Скидка</span><span>(35%) - 45 000 ₸</span></li>
                                    <li> <span>Доставка</span><span>0 ₸</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal modal-order" id="orderModal2">
                        <div class="card"><a class="close-modal" href="#orderModal2"><img src="/img/icons/close-dark.svg"
                                    alt=""></a>
                            <div class="card-header">
                                <h4>Номер заказа: D8765H</h4>
                                <div class="card-date">
                                    <p class="txt-blue-opacity">Дата:16.05.2022</p><span>Ожидаемая доставка:
                                        25.05.2023</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5>Содержание заказа:</h5>
                                <div class="product-item card">
                                    <div class="product-info"><img src="/img/products/product-2.png" alt="">
                                        <div class="product-content">
                                            <p>Tempesta-F Trigger Spray 30 Душевой набор</p><span>Цвет: Хром</span>
                                        </div>
                                    </div>
                                    <div class="product-price">100 000 ₸</div>
                                </div>
                                <div class="card-info">
                                    <h5>Доставка</h5>
                                    <p class="txt-blue-opacity">Казахстан, г. Алматы, Каирбекова 38а, кв 75</p>
                                </div>
                                <div class="card-info">
                                    <h5>Оплата</h5>
                                    <p class="txt-blue-opacity">Оплата при получении</p>
                                </div>
                            </div>
                            <div class="card-footer total">
                                <div class="total-price">
                                    <h5>Итог</h5>
                                    <h5>1 580 300 ₸</h5>
                                </div>
                                <ul>
                                    <li>
                                        <p>Товары, 2 шт</p>
                                        <p>145 000 ₸</p>
                                    </li>
                                    <li> <span>Скидка</span><span>(35%) - 45 000 ₸</span></li>
                                    <li> <span>Доставка</span><span>0 ₸</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal modal-order" id="orderModal3">
                        <div class="card"><a class="close-modal" href="#orderModal3"><img src="/img/icons/close-dark.svg"
                                    alt=""></a>
                            <div class="card-header">
                                <h4>Номер заказа: D8765H66782</h4>
                                <div class="card-date">
                                    <p class="txt-blue-opacity">Дата:02.09.2019</p><span>Ожидаемая доставка:
                                        25.05.2023</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5>Содержание заказа:</h5>
                                <div class="product-item card">
                                    <div class="product-info"><img src="/img/products/product-1.png" alt="">
                                        <div class="product-content">
                                            <p>Угловой вентиль 1/2 дюйма, хром</p><span>Цвет: Хром</span>
                                        </div>
                                    </div>
                                    <div class="product-price">100 000 ₸</div>
                                </div>
                                <div class="card-info">
                                    <h5>Доставка</h5>
                                    <p class="txt-blue-opacity">Казахстан, г. Алматы, Каирбекова 38а, кв 75</p>
                                </div>
                                <div class="card-info">
                                    <h5>Оплата</h5>
                                    <p class="txt-blue-opacity">Оплата при получении</p>
                                </div>
                            </div>
                            <div class="card-footer total">
                                <div class="total-price">
                                    <h5>Итог</h5>
                                    <h5>1 580 300 ₸</h5>
                                </div>
                                <ul>
                                    <li>
                                        <p>Товары, 2 шт</p>
                                        <p>145 000 ₸</p>
                                    </li>
                                    <li> <span>Скидка</span><span>(35%) - 45 000 ₸</span></li>
                                    <li> <span>Доставка</span><span>0 ₸</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="orders-mobile">
                        <div class="card">
                            <div class="order-title">
                                <h5>Номер заказа: D8765H</h5>
                            </div>
                            <ul>
                                <li>Сумма заказа: 460 700 ₸</li>
                                <li>Дата: 02.09.2019</li>
                                <li>Статус: Заказ выполнен</li>
                            </ul><a class="open-modal link-underline" href="#orderModal1">Смотреть подробнее</a>
                        </div>
                        <div class="card">
                            <div class="order-title">
                                <h5>Номер заказа: D8765H</h5>
                            </div>
                            <ul>
                                <li>Сумма заказа: 80 700 ₸</li>
                                <li>Дата: 16.05.2022</li>
                                <li>Статус: Ожидается доставка</li>
                            </ul><a class="open-modal link-underline" href="#orderModal2">Смотреть подробнее</a>
                        </div>
                        <div class="card">
                            <div class="order-title">
                                <h5>Номер заказа: D8765H66782</h5>
                            </div>
                            <ul>
                                <li>Сумма заказа: 100 000 ₸</li>
                                <li>Дата: 02.09.2019</li>
                                <li>Статус: Отменен</li>
                            </ul><a class="open-modal link-underline" href="#orderModal3">Смотреть подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
