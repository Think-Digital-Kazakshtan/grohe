<script setup>
import { Link, usePage, useForm, router } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import BtnMain from "@/Components/BtnMain.vue";

const currentPage = usePage();
const user = currentPage.props.user;
const addresses = ref(currentPage.props.user.addresses);

defineProps({ user: Object });

const state = reactive({
    selectedAddress: {},
});

const openAddressValue = ref(Array(addresses.length).fill(false));
const addAddressValue = ref(false);

const addAddress = () => {
    addAddressValue.value = true;
};

const cancelAddAddress = (index) => {
    cancelAddressForm(index);
};

const openAddressForm = (index, address) => {
    openAddressValue.value[index] = true;
    state.selectedAddress = address;
};

const cancelAddressForm = (index) => {
    openAddressValue.value[index] = false;
    addAddressValue.value = false;
    state.selectedAddress = {};
};

const isOpen = (index) => {
    return openAddressValue.value[index] || addAddressValue.value;
};

const addressForm = useForm({
    city: "",
    street: "",
    building: "",
    block: "",
    apartment: "",
});

const submitAddress = (address) => {
    if (address.id == state.selectedAddress.id) {
        addressForm.put(route("cabinet.addresses.update", address.id), {
            onSuccess: () => {
                router.visit("addresses");
                cancelAddressForm();
            },
        });
    } else {
        addressForm.post(route("cabinet.addresses.add"), {
            onSuccess: () => {
                router.visit("addresses");
                cancelAddAddress();
            },
        });
    }
};

const deleteAddressForm = useForm({
    id: "",
});

const deleteAddress = (id) => {
    deleteAddressForm.id = id;
    deleteAddressForm.delete(route("cabinet.addresses.delete"), {
        onSuccess: () => {
            addresses.value = addresses.value.filter(
                (address) => address.id !== id
            );
        },
    });
};

const logout = () => {
    router.post(route("logout"));
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
                    <Link
                        class="selection btn btn-main"
                        :href="$route('cabinet.index')"
                        >Персональные данные</Link
                    >
                    <Link
                        class="selection btn btn-main"
                        :href="$route('cabinet.myOrders')"
                        >Мои заказы</Link
                    >
                    <Link
                        class="selection btn btn-main selected"
                        :href="$route('cabinet.addresses.index')"
                        >Адреса</Link
                    >
                    <form
                        class="selection btn btn-main"
                        @submit.prevent="logout"
                    >
                        <button
                            class="w-full text-left sm:text-center lg:text-left"
                        >
                            Выход
                        </button>
                    </form>
                </div>
            </div>
            <div class="cabinet-container tab-wrapper">
                <div class="cabinet-wrapper tab addresses show fade">
                    <h2>Адреса</h2>
                    <div class="card-wrapper">
                        <div
                            class="addresses-container"
                            v-for="(address, index) in addresses"
                            :key="index"
                        >
                            <div class="card edit-address show fade">
                                <h5>Адрес {{ 1 + index }}</h5>
                                <p>
                                    {{
                                        address.city +
                                        ", " +
                                        address.street +
                                        ", " +
                                        address.building +
                                        (address.block != null
                                            ? ", подъезд " + address.block
                                            : "") +
                                        (address.apartment != null
                                            ? ", квартира " + address.apartment
                                            : "")
                                    }}
                                </p>
                                <div class="btns-group">
                                    <button
                                        class="btn-edit"
                                        @click.prevent="
                                            openAddressForm(index, address)
                                        "
                                    >
                                        <img src="/img/icons/edit.svg" alt="" />
                                        <p class="link-underline">Изменить</p>
                                    </button>
                                    <button
                                        class="btn-remove"
                                        @click.prevent="
                                            deleteAddress(address.id)
                                        "
                                    >
                                        <img
                                            src="/img/icons/delete-red.svg"
                                            alt=""
                                        />
                                        <p class="link-underline">Удалить</p>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="modal modal-address"
                                :class="{ 'show fade': isOpen(index) }"
                            >
                                <form
                                    class="address-form"
                                    @submit.prevent="submitAddress(address)"
                                >
                                    <h3 v-if="openAddressValue[index]">
                                        Редактировать адрес
                                    </h3>
                                    <h3 v-if="addAddressValue">
                                        Введите адрес
                                    </h3>
                                    <h5
                                        v-if="openAddressValue[index]"
                                        class="mb-5"
                                    >
                                        Адрес {{ 1 + index }}
                                    </h5>
                                    <div class="input-label">
                                        <InputLabel
                                            for="addAddress_city"
                                            value="Город*"
                                        />
                                        <TextInput
                                            :class="{
                                                error: addressForm.errors.city,
                                            }"
                                            :id="
                                                'addAddress_city_' + address.id
                                            "
                                            v-model="addressForm.city"
                                            :value="address.city"
                                            type="text"
                                        />
                                        <InputError
                                            :message="addressForm.errors.city"
                                        />
                                    </div>
                                    <div class="input-label">
                                        <InputLabel
                                            for="addAddress_street"
                                            value="Улица*"
                                        />
                                        <TextInput
                                            :class="{
                                                error: addressForm.errors
                                                    .street,
                                            }"
                                            :id="
                                                'addAddress_street_' +
                                                address.id
                                            "
                                            v-model="addressForm.street"
                                            :value="address.street"
                                            type="text"
                                        />
                                        <InputError
                                            :message="addressForm.errors.street"
                                        />
                                    </div>
                                    <div class="flex w-full">
                                        <div class="input-label w-1/3 mr-5">
                                            <InputLabel
                                                for="addAddress_building"
                                                value="Дом*"
                                            />
                                            <TextInput
                                                :class="{
                                                    error: addressForm.errors
                                                        .building,
                                                }"
                                                :id="
                                                    'addAddress_building_' +
                                                    address.id
                                                "
                                                v-model="addressForm.building"
                                                :value="address.building"
                                                type="text"
                                            />
                                            <InputError
                                                :message="
                                                    addressForm.errors.building
                                                "
                                            />
                                        </div>
                                        <div class="input-label w-1/3 mr-5">
                                            <InputLabel
                                                for="addAddress_block"
                                                value="Подъезд"
                                            />
                                            <TextInput
                                                :id="
                                                    'addAddress_block_' +
                                                    address.id
                                                "
                                                v-model="addressForm.block"
                                                :value="address.block"
                                                type="text"
                                            />
                                        </div>
                                        <div class="input-label w-1/3">
                                            <InputLabel
                                                for="addAddress_apartment"
                                                value="Квартира"
                                            />
                                            <TextInput
                                                :id="
                                                    'addAddress_apartment_' +
                                                    address.id
                                                "
                                                v-model="addressForm.apartment"
                                                :value="address.apartment"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="btns-group">
                                        <BtnMain
                                            :disabled="addressForm.processing"
                                            :loading="addressForm.processing"
                                            type="submit"
                                            >Сохранить</BtnMain
                                        >
                                        <button
                                            class="btn-cancel link-underline"
                                            @click.prevent="
                                                cancelAddAddress(index)
                                            "
                                        >
                                            Отменить
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="addresses-container">
                            <div class="card add-address show fade">
                                <img src="/img/icons/geo.svg" alt="" />
                                <button
                                    class="btn-add-address link-underline"
                                    @click.prevent="addAddress"
                                >
                                    Добавить новый адрес
                                </button>
                            </div>
                            <!-- <div class="modal modal-address" :class="{ 'show fade' : addAddressValue }">
                                <form class="address-form" @submit.prevent="submitAddAddress">
                                    <h3>Введите адрес</h3>
                                    <div class="input-label">
                                        <InputLabel for="addAddress_city" value="Город*" />
                                        <TextInput :class="{ 'error' : addAddressForm.errors.city }" id="addAddress_city" v-model="addAddressForm.city" type="text"  />
                                        <InputError :message="addAddressForm.errors.city" />
                                    </div>
                                    <div class="input-label">
                                        <InputLabel for="addAddress_street" value="Улица*" />
                                        <TextInput :class="{ 'error' : addAddressForm.errors.street }" id="addAddress_street" v-model="addAddressForm.street" type="text"  />
                                        <InputError :message="addAddressForm.errors.street" />
                                    </div>
                                    <div class="flex w-full">
                                        <div class="input-label w-1/3 mr-5">
                                            <InputLabel for="addAddress_building" value="Дом*" />
                                            <TextInput :class="{ 'error' : addAddressForm.errors.building }" id="addAddress_building" v-model="addAddressForm.building" type="text"  />
                                            <InputError :message="addAddressForm.errors.building" />
                                        </div>
                                        <div class="input-label w-1/3 mr-5">
                                            <InputLabel for="addAddress_block" value="Подъезд" />
                                            <TextInput id="addAddress_block" v-model="addAddressForm.block" type="text" />
                                        </div>
                                        <div class="input-label w-1/3">
                                            <InputLabel for="addAddress_apartment" value="Квартира" />
                                            <TextInput id="addAddress_apartment" v-model="addAddressForm.apartment" type="text" />
                                        </div>
                                    </div>
                                    <div class="btns-group">
                                        <BtnMain :disabled="addAddressForm.processing" :loading="addAddressForm.processing" type="submit">Сохранить</BtnMain>
                                        <button class="btn-cancel link-underline" @click.prevent="cancelAddAddress">Отменить</button>
                                    </div>
                                </form>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
