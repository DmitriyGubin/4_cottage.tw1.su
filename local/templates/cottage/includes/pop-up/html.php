<link href="<?= SITE_TEMPLATE_PATH.'/includes/pop-up/css/styles.css'; ?>" rel="stylesheet">
<link href="<?= SITE_TEMPLATE_PATH.'/includes/pop-up/css/media.css'; ?>" rel="stylesheet">

<!-- Попап на заявку -->
<div class="send_order" style="display: none">

    <div class="pop-up-form">
        <span id="close">&#10005;</span>
        <form id="form-content">
            <h2 id="pop-up-title">Оставить заявку</h2>
            <p class="upper-text">
                Оставьте заявку и наш специалист свяжется с вами в ближайшее время
            </p>

            <input id="pop-up-name" placeholder="Ваше имя" type="text"/>

            <input id="pop-up-phone" placeholder="Ваш телефон" type="text"/>

            <button id="for_send" class="buttonn">Отправить</button>

            <p class="below_input_text">
               Нажимая на кнопку, вы даете согласие
                на обработку персональных данных и соглашаетесь
                с  <a href="#">Политикой Конфиденциальности</a>
            </p>
        </form>

        <h2 id="succes_order" style="display: none">
            Ваши данные отправлены успешно!<br>Ожидайте звонка наших операторов.
        </h2>
    </div> 
</div>

<script src="<?= SITE_TEMPLATE_PATH.'/includes/pop-up/js/pop_up.js'; ?>"></script>
<!-- Попап на заявку -->