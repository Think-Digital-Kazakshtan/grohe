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
                        class="selection btn btn-main selected"
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
                    <h2>Правила возврата товаров</h2>
                    <div class="support-content">
                        <p>
                            Официальный интернет-магазин GROHE с уважением
                            относится к праву выбора покупателей, и предлагает
                            возможность отказаться от покупки в случае,
                            если выбранный товар вам не подойдёт. Мы также будем
                            рады обменять приобретеннyю продукцию на любую
                            другую из нашего ассортимента. Разницу в цене можно
                            будет доплатить/получить.
                        </p>
                        <br />
                        <p>
                            До передачи товара покупателю отказаться от покупки
                            можно в любой момент, а после передачи — в течение
                            14 дней. Для осуществления возврата полученного
                            товара необходимо будет соблюсти ряд условий.
                        </p>
                        <br /><br />
                        <p class="font-medium">
                            Возвращаемый товар должен быть представлен:
                        </p>
                        <ul>
                            <li>в полной комплектации</li>
                            <li>
                                без следов использования/установки и любых типов
                                повреждений, с сохранением товарного вида
                                и потребительских качеств
                            </li>
                            <li>в неповреждённой оригинальной упаковке</li>
                            <li>
                                с сохранением всех видов маркировки и защиты,
                                пломб, фабричных ярлыков
                            </li>
                            <li>
                                с оригиналами документов, подтверждающих покупку
                                товара (кассовый и товарный чеки, гарантийный
                                талон)
                            </li>
                            <li>
                                с заявлением от имени покупателя, в котором,
                                в том числе, указывается наименование товара,
                                причина возврата, количество и общая стоимость
                                возвращаемой продукции.
                            </li>
                        </ul>
                        <p>
                            Для помощи в оформлении возврата товара, пожалуйста,
                            обратитесь к специалистам интернет-магазина GROHE
                            по телефону +7 (700) 836–85–15 в рабочие
                            дни с 10 до 18 часов. Мы вышлем частично заполненное
                            заявление на ваш электронный адрес.
                        </p>
                        <br /><br />
                        <p class="font-medium">
                            Пожалуйста, обратите внимание:
                        </p>
                        <ul>
                            <li>
                                Условия возврата не предполагают,
                                что возвращаемый товар был в употреблении
                                с целью тестирования или с любой другой целью.
                                Мы принимаем ваше право передумать, но можем
                                отказать в возврате или обмене товаров, имеющих
                                следы эксплуатации.
                            </li>
                            <li>
                                Покупатель не вправе отказаться от товара
                                надлежащего качества, имеющего
                                индивидуально-определённые свойства,
                                если указанный товар может быть использован
                                исключительно приобретающим его потребителем.
                                Возврат также не распространяется на товары
                                в запаянных упаковках-блистерах.
                            </li>
                            <li>
                                В случае, если к товару прилагались подарок
                                или дополнительные аксессуары,
                                они также подлежат возврату в соответствии
                                с указанными правилами.
                            </li>
                            <li>
                                Доставка товара надлежащего качества
                                в интернет-магазин с целью возврата или обмена
                                на другой товар производится исключительно
                                силами покупателя и за его счёт.
                            </li>
                            <li>
                                Возврат денежных средств производится
                                таким же способом, каким была произведена оплата
                                товара. Например, если товар был оплачен
                                наличными — возврат средств также осуществляется
                                наличными; если товар оплачен банковской картой
                                онлайн — деньги будут возвращены на банковскую
                                карту, с которой производилась оплата товара.
                            </li>
                            <li>
                                Возврат денежных средств осуществляется
                                ТОО «Гидробаланс» в течение десяти дней с даты
                                оформления возврата товара. Конечный срок
                                перечисления зависит от внутренних регламентов
                                платёжных систем и банков, и может составлять
                                до тридцати рабочих дней.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
