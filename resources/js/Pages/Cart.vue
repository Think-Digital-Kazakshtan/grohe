<script setup>

    import Counter from '@/Components/Counter.vue';
    import { Link, usePage, useForm, router } from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import BtnMain from '@/Components/BtnMain.vue';
    import { ref } from 'vue';

    const currentPage = usePage();

    const props = defineProps({
        cartItems: Array,
        user: Object,
        cart_total: String,
        promocode: Object,
        cart_count: Number,
        cart_subtotal: Number,
    });

    const cartItemsArray = Object.values(props.cartItems);

    const isActivate = ref(false);

    const promocodeForm = useForm({
        code: null,
    });

    const applyPromocode = () => {
        promocodeForm.post(route('cart.promocode'), {
            onSuccess: () => {
                promocodeForm.reset(),
                isActivate.value = true
            }
        });
    };

    const toCheckout = () => {
        router.visit('order');
    };

</script>


<template>

    <section class="path main-container">
        <ul class="path-row">
            <li><Link href="/">Главная / </Link></li>
            <li class="path-active"><Link :href="$route('cart.index')">Корзина</Link></li>
        </ul>
    </section>
    <section class="cart main-container content-container">
        <div class="title-btn">
            <h2 class="txt-blue">Корзина</h2>
            <div v-if="cartItemsArray.length > 1">
                <button class="link-underline" @click.prevent="$cart.clear()">Очистить корзину</button>
            </div>
        </div>
        <div class="cart-empty" v-if="cartItemsArray.length < 1">
            <p>Ваша корзина пуста. Ознакомьтесь с нашим ассортиментом и добавьте в корзину необходимые товары.</p>
            <Link class="btn btn-main" :href="$route('product.catalog')">Перейти в каталог</Link>
        </div>
        <div v-else>
            <div class="cart-wrapper">
                <div class="card" v-for="item in cartItems" :key="item.id">
                    <div class="card-container">
                        <div class="card-img"><img :src="item.associatedModel.media[0].original_url" alt=""></div>
                        <div class="card-desc">
                            <div class="card-title">
                                <Link class="no-underline hover:underline" :href="$route('product.get', item.associatedModel.slug)"><h5>{{ item.associatedModel.title }}</h5></Link><span>{{ item.associatedModel.sku }}</span>
                            </div>
                            <Counter :value="item.quantity" @count-updated="$cart.update(item.id)" />
                            <div class="price">
                                <div class="price-new">{{ item.associatedModel.price }} ₸</div>
                                <div v-if="item.associatedModel.old_price != null" class="price-old">{{ item.associatedModel.old_price }} ₸</div>
                            </div>
                        </div>
                    </div>
                    <button class="btn-delete" @click.prevent="$cart.remove(item.id)"><img src="/img/icons/delete.svg" alt=""></button>
                </div>
            </div>
            <div class="payment-wrapper">
                <div class="promocode-main">
                    <div class="card" v-if="user == null">
                        <h5>Бонусные баллы</h5>
                        <p>Пожалуйста, <a class="link-underline open-modal" href="#loginModal">войдите в личный кабинет</a>,
                            чтобы воспользоваться баллами</p>
                    </div>
                    <div class="card" v-else>
                        <h5>Бонусные баллы</h5>
                        <p>У Вас 0 баллов</p>
                    </div>
                    <div class="card">
                        <h5>Промокод</h5>
                        <form class="promocode-form" @submit.prevent="applyPromocode" v-if="promocode == null">
                            <p>Введите промокод, если он у вас есть</p>
                            <input class="input" type="text" v-model="promocodeForm.code" placeholder="Ваш код">
                            <InputError :message="promocodeForm.errors.code" />
                            <BtnMain :disabled="promocodeForm.processing" :loading="promocodeForm.processing">Применить</BtnMain>
                        </form>
                        <div v-else>
                            <p>Промокод "{{ promocode.code }}" успешно активирован</p>
                        </div>
                    </div>
                </div>
                <div class="total">
                    <div class="card">
                        <ul>
                            <li>
                                <p>Товары, {{ cartItemsArray.length }} шт</p>
                                <p>{{ cart_total }} ₸</p>
                            </li>
                            <li>
                                <span>Скидка</span>
                                <span>45 000 ₸</span>
                            </li>
                            <li>
                                <span>Бонусные баллы</span>
                                <span>-</span>
                            </li>
                            <li>
                                <span>Промокод</span>
                                <div v-if="promocode !== null">
                                    <span v-if="promocode.is_percent == true">{{ promocode.amount }}%</span>
                                    <span v-else>{{ promocode.amount }} ₸</span>
                                </div>
                                <span v-else>-</span>
                            </li>
                        </ul>
                        <div class="total-price">
                            <h5>Итого к оплате:</h5>
                            <h3>{{ cart_total }} ₸</h3>
                        </div>
                        <div class="btns-group">
                            <button class="btn btn-main">Быстрый заказ</button>
                            <button class="btn btn-secondary" @click.prevent="toCheckout">Перейти к
                                оформлению</button>
                        </div>
                    </div>
                    <p class="warning-text">*При заказе на сумму от 50 000 ₸ по г. Алматы, доставка бесплатная</p>
                </div>
            </div>
        </div>
    </section>

</template>