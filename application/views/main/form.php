<div class="container" id="app_form">
    <div class="row">

        <form action="/AppLogistic/" method="post" class="form-inline">

            <h1 class="text-center">Заявка на осуществление автоперевозок</h1>
            <h4 class="text-center">Пожалуйста, заполните необходимую информацию.</h4>

            <h3>Организация заказчика*</h3>
            <input class="form-control" type="text" name="organization" required placeholder="краткий ответ">

            <h3>Контактное лицо со стороны заказчика(ФИО и номер телефона)*</h3>
            <input class="form-control" type="text" name="contact_person" required placeholder="краткий ответ">

            <h1 class="text-center">Информация о рейсе</h1>

            <h3>Дата рейса*</h3>
            <input name="trip_date" required type="date" class="form-control"/>

            <h3>Описание рейса*</h3>
            <input class="form-control" type="text" name="trip_description" required placeholder="краткий ответ">

            <h3>Требуется доверенность*</h3>
            <p><input  type="radio" name="req_power_attorney" value="да"> Да</p>
            <p><input  type="radio" name="req_power_attorney" value="нет"> Нет</p>

            <h3>Адрес для получения/загрузки с указанием наименования компании</h3>
            <input class="form-control" type="text" name="address_person_name" required placeholder="краткий ответ">

            <h3>Время получения/загрузки*</h3>
            <input class="form-control" type="text" name="load_time" required placeholder="краткий ответ">

            <h3>Контактное лицо по адресу получения/загрузки(ФИО и номер телефона)</h3>
            <input class="form-control" type="text" name="address_person_load" required placeholder="краткий ответ">

            <h3>Обратный адрес/разгрузка*</h3>
            <input class="form-control" type="text" name="return_address_unload" required placeholder="краткий ответ">

            <h3>Контактное лицо по адресу разгрузки*</h3>
            <input class="form-control" type="text" name="address_person_unload" required placeholder="краткий ответ">

            <br><br>
            <input class="btn btn-success" type="submit" value="Отправить">
        </form>
    </div>
</div>