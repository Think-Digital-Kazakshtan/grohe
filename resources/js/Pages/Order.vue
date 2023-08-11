<script setup>

    import { Link, usePage, useForm, router } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import BtnMain from '@/Components/BtnMain.vue';

    const currentPage = usePage();

    const props = defineProps({
        cartItems: Array,
        user: Object,
        cart_total: String,
        promocode: Object,
        cart_count: Number,
    });

    const selectedAddress = ref(null);
    const isSelected = ref(false);
    const isOpened = ref(false);

    const selectToggle = () => {
        isSelected.value ^= true;
    };

    const selectAddress = (address) => {
        selectedAddress.value = address;
        isSelected.value = false;
    };

    const openAddAddress = () => {
        isOpened.value ^= true;
    };

    const addressForm = useForm({
        city: '',
        street: '',
        building: '',
        block: '',
        apartment: ''
    });

    const submitAddress = () => {
        if(props.user == null) {
            selectedAddress.value = addressForm;
        } else {
            addressForm.post(route('cabinet.addresses.add'), {
                onSuccess: () => {
                    selectedAddress.value = addressForm;
                    isOpened.value = false;
                }
            });
        }
    };

    const orderForm = useForm({
        name: '',
        phone: '',
        email: '',
        address: selectedAddress,
        pay: ''
    });

</script>

<template>

    <section class="checkout main-container content-container">
        <h2 class="title">Оформление заказа</h2>
        <div class="checkout-wrapper" v-if="cart_count >= 1">
            <form class="checkout-form" action="">
                <div class="checkout-group">
                    <h3>Контактные данные</h3>
                    <div class="input-label">
                        <label for="">Фамилия и имя*</label>
                        <input v-if="user !== null" class="input" type="text" :value="user.name">
                        <input v-else class="input" type="text" v-model="orderForm.name">
                    </div>
                    <div class="input-label">
                        <label for="">Телефон*</label>
                        <input v-if="user !== null" class="input" type="tel" :value="user.phone">
                        <input v-else class="input" type="tel" v-model="orderForm.phone">
                    </div>
                    <div class="input-label">
                        <label for="">Электронная почта*</label>
                        <input v-if="user !== null" class="input" type="email" :value="user.email">
                        <input v-else class="input" type="email" v-model="orderForm.email">
                    </div>
                </div>
                <div class="checkout-group">
                    <h3>Адрес доставки</h3>
                    <div v-if="user !== null">
                        <div class="select-item">
                            <div class="select-btn" @click.prevent="selectToggle">
                                <span>{{ selectedAddress !==null ? selectedAddress.city + ', ' + selectedAddress.street + ', ' + selectedAddress.building + (selectedAddress.block != null ? ', подъезд ' + selectedAddress.block : '') + (selectedAddress.apartment != null ? ', квартира ' + selectedAddress.apartment : '') : 'Выберите адрес' }}</span>
                                <img src="/img/icons/arrow-down-dark.svg" alt="">
                            </div>
                            <ul class="options" :class="{ 'show fade' : isSelected }">
                                <li class="option" :value="address" v-for="address in user.addresses" :key="address.id" @click.prevent="selectAddress(address)">{{ address.city + ', ' + address.street + ', ' + address.building + (address.block != null ? ', подъезд ' + address.block : '') + (address.apartment != null ? ', квартира ' + address.apartment : '') }}</li>
                            </ul>
                        </div>
                    </div>
                    <form :class="{ 'hidden' : !isOpened && user !== null, 'block fade' : isOpened && user == null }" @submit.prevent="submitAddress">
                        <div class="input-label">
                            <InputLabel for="addAddress_city" value="Город*" />
                            <TextInput :class="{ 'error' : addressForm.errors.city }" id="addAddress_city" v-model="addressForm.city" type="text"  />
                            <InputError :message="addressForm.errors.city" />
                        </div>
                        <div class="input-label">
                            <InputLabel for="addAddress_street" value="Улица*" />
                            <TextInput :class="{ 'error' : addressForm.errors.street }" id="addAddress_street" v-model="addressForm.street" type="text"  />
                            <InputError :message="addressForm.errors.street" />
                        </div>
                        <div class="flex w-full">
                            <div class="input-label w-1/3 mr-5">
                                <InputLabel for="addAddress_building" value="Дом*" />
                                <TextInput :class="{ 'error' : addressForm.errors.building }" id="addAddress_building" v-model="addressForm.building" type="text"  />
                                <InputError :message="addressForm.errors.building" />
                            </div>
                            <div class="input-label w-1/3 mr-5">
                                <InputLabel for="addAddress_block" value="Подъезд" />
                                <TextInput id="addAddress_block" v-model="addressForm.block" type="text" />
                            </div>
                            <div class="input-label w-1/3">
                                <InputLabel for="addAddress_apartment" value="Квартира" />
                                <TextInput id="addAddress_apartment" v-model="addressForm.apartment" type="text" />
                            </div>
                        </div>
                        <BtnMain class="btn btn-main">Добавить</BtnMain>
                    </form>
                    <button v-if="user !== null" class="link-underline mt-5" @click.prevent="openAddAddress">{{ isOpened ? 'Отмена' : 'Добавить адрес' }}</button>
                </div>
                <div class="checkout-group">
                    <h3>Метод доставки</h3>
                    <div class="input-group">
                        <input class="input-radio" id="delivery1" type="radio" name="delivery">
                        <label for="delivery1">
                            <p>Самовывоз</p><span>0 ₸</span>
                        </label>
                    </div>
                    <div class="input-group">
                        <input class="input-radio" id="delivery2" type="radio" name="delivery">
                        <label for="delivery2">
                            <p>Доставка магазином Grohe</p><span>0 ₸</span>
                        </label>
                    </div>
                </div>
                <div class="btns-group">
                    <button class="btn btn-main">
                        Оплатить в Kaspi
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 2H7C5.89543 2 5 2.89543 5 4V20C5 21.1046 5.89543 22 7 22H17C18.1046 22 19 21.1046 19 20V4C19 2.89543 18.1046 2 17 2Z" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 18H12.01" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button class="btn btn-main">
                        Оплатить картой
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 4H3C1.89543 4 1 4.89543 1 6V18C1 19.1046 1.89543 20 3 20H21C22.1046 20 23 19.1046 23 18V6C23 4.89543 22.1046 4 21 4Z" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 10H23" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <p class="warning-text">Нажимая кнопку «Оплатить в Kaspi» или «Оплатить картой», вы соглашаетесь с политикой конфиденциальности</p>
            </form>
            <div class="checkout-info">
                <div class="card">
                    <h5>Содержание заказа</h5>
                    <div class="product-item" v-for="item in cartItems" :key="item.id">
                        <div class="product-info"><img :src="item.associatedModel.media[0].original_url" alt="">
                            <div class="product-content">
                                <Link class="link" :href="$route('product.get', item.associatedModel.slug)">{{ item.name.slice(0,40) }}...</Link>
                            </div>
                        </div>
                        <div class="product-price">{{ item.price }} ₸</div>
                    </div>
                </div>
                <div class="total">
                    <div class="card">
                        <ul>
                            <li>
                                <p>Товары, {{ cart_count }} шт</p>
                                <p>{{ cart_total }} ₸</p>
                            </li>
                            <li> <span>Скидка</span><span>(35%) - 45 000 ₸</span></li>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
    export default {

    }

</script>

<style>

</style>
