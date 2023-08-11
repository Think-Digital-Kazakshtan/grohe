<template>

    <section class="path main-container">
        <ul class="path-row">
            <li><a href="/">Главная / </a></li>
            <li class="path-active"><a href="/category.html">Контакты</a></li>
        </ul>
    </section>
    <section class="contacts main-container content-container">
        <div class="contacts-content">
            <div class="card">
                <h5>Позвоните нам</h5><a class="link" :href="'tel:' + $helpers.setting('phone')">{{ $helpers.setting('phone') }}</a>
            </div>
            <div class="card">
                <h5>Приходите к нам</h5>
                <p>{{ $helpers.setting('address_1') }}</p>
                <p>ПН-СБ с 10:00 - 22:00</p>
                <p>ВС с 10:00 - 20:00</p>
            </div>
        </div>
        <div class="contacts-main">
            <div class="contacts-map content-container">
                <iframe :src="$helpers.setting('map_link')" frameborder="0"> </iframe>
            </div>
            <div class="contacts-feed">
                <h2>Оставьте нам сообщение или задайте вопрос</h2>
                <p class="txt-blue-opacity">Мы дорожим вашим мнением, учитываем все пожелания и стремимся максимально
                    оперативно отвечать на вопросы о поставляемых товарах и работе официального интернет-магазина GROHE
                </p>
                <form class="contacts-form" action="">
                    <div class="input-label">
                        <label for="">Имя</label>
                        <input class="input" type="text" name="name">
                    </div>
                    <div class="input-label">
                        <label for="">Телефон</label>
                        <input class="input" type="tel" name="phone">
                    </div>
                    <div class="input-label">
                        <label for="">Электронная почта*</label>
                        <input class="input" type="email" name="email">
                    </div>
                    <div class="input-label">
                        <label for="">Комментарий</label>
                        <input class="input" type="email" name="email">
                    </div>
                    <div class="input-label input-label-file">
                        <label for="">Вложение</label>
                        <input class="input-file" type="file" name="file">
                    </div>
                    <button class="btn btn-main">Отправить</button>
                    <p class="warning-text">Нажимая кнопку «Отправить», вы соглашаетесь на обработку своих персональных
                        данных</p>
                </form>
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
