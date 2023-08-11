<script setup>

    import { ref } from 'vue';
    import { router } from '@inertiajs/vue3';

    const selectedTab = ref('#cabinet_tab1');

    const selectTab = (tabId) => {
        selectedTab.value = tabId;
    };

    const editAddressValue = ref(false);

    const editAddress = () => {
        editAddressValue.value = true;
    };
    
    const cancelEditAddress = () => {
        editAddressValue.value = false;
    };

    const addAddressValue = ref(false);

    const addAddress = () => {
        addAddressValue.value = true;
    };
    
    const cancelAddAddress = () => {
        addAddressValue.value = false;
    };

    defineProps({ user: Object });

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
                    <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#cabinet_tab1' }" type="button" @click.prevent="selectTab('#cabinet_tab1')">Персональные данные</button>
                    <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#cabinet_tab2' }" type="button" @click.prevent="selectTab('#cabinet_tab2')">Мои заказы</button>
                    <button class="selection btn btn-main" :class="{ 'selected' : selectedTab === '#cabinet_tab3' }" type="button" @click.prevent="selectTab('#cabinet_tab3')">Адреса</button>
                    <form class="selection btn btn-main" @submit.prevent="logout"><button class="w-full text-left">Выход</button></form>
                </div>
            </div>
            <div class="cabinet-container tab-wrapper">
                <div class="cabinet-wrapper tab" :class="{ 'show fade' : selectedTab === '#cabinet_tab1' }" id="cabinet_tab1">
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
                                <input class="input" type="text" name="name" :value="user.name" >
                            </div>
                            <div class="input-label">
                                <label for="">Фамилия</label>
                                <input class="input" type="text" name="name" :value="user.name" >
                            </div>
                            <div class="input-label">
                                <label for="">Телефон*</label>
                                <input class="input" type="tel" name="phone" :value="user.phone" >
                            </div>
                            <div class="input-label">
                                <label for="">Электронная почта*</label>
                                <input class="input" type="email" name="email" :value="user.email" >
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
                <div class="cabinet-wrapper tab" :class="{ 'show fade' : selectedTab === '#cabinet_tab2' }" id="cabinet_tab2">
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
                        <div class="card"><a class="close-modal" href="#orderModal1"><img
                                    src="/img/icons/close-dark.svg" alt=""></a>
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
                        <div class="card"><a class="close-modal" href="#orderModal2"><img
                                    src="/img/icons/close-dark.svg" alt=""></a>
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
                        <div class="card"><a class="close-modal" href="#orderModal3"><img
                                    src="/img/icons/close-dark.svg" alt=""></a>
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
                <div class="cabinet-wrapper tab addresses" :class="{ 'show fade' : selectedTab === '#cabinet_tab3' }" id="cabinet_tab3">
                    <h2>Адреса</h2>
                    <div class="card-wrapper">
                        <div class="addresses-container">
                            <div class="card edit-address" :class="{ 'show fade' : !editAddressValue }">
                                <h5>Адрес 1</h5>
                                <p>г. Алматы, ул. Каратаева 38а</p>
                                <div class="btns-group">
                                    <button class="btn-edit" @click.prevent="editAddress"><img src="/img/icons/edit.svg" alt="">
                                        <p class="link-underline">Изменить</p>
                                    </button>
                                    <button class="btn-remove"><img src="/img/icons/delete-red.svg" alt="">
                                        <p class="link-underline">Удалить</p>
                                    </button>
                                </div>
                            </div>
                            <div class="card edit-form" :class="{ 'show fade' : editAddressValue }">
                                <form class="address-form" action="">
                                    <h5>Адрес 1</h5>
                                    <input class="input" type="text" value="г. Алматы, ул. Каратаева 38а">
                                    <div class="btns-group">
                                        <button class="btn btn-main">Сохранить</button>
                                        <button class="btn-cancel link-underline" @click.prevent="cancelEditAddress">Отменить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="addresses-container">
                            <div class="card add-address" :class="{ 'show fade' : !addAddressValue }"><img src="/img/icons/geo.svg" alt="">
                                <button class="btn-add-address link-underline" @click.prevent="addAddress">Добавить новый адрес</button>
                            </div>
                            <div class="card add-form" :class="{ 'show fade' : addAddressValue }">
                                <form class="address-form" action="">
                                    <h5>Введите адрес в свободной форме</h5>
                                    <input class="input" type="text" placeholder="Например: г. Алматы, ул. Каратаева, 38а, кв 75">
                                    <div class="btns-group">
                                        <button class="btn btn-main">Сохранить</button>
                                        <button class="btn-cancel link-underline" @click.prevent="cancelAddAddress">Отменить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>