<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-offset-2">
            <h3>Добавить водителя</h3>
            <form method="post" action="form_processing_drive.php">
                <h4>Имя*</h4>
                <input class="form-control" type="text" name="add_new_drive" required placeholder="Имя">
                <h4>Фамилия*</h4>
                <input class="form-control" type="text" name="add_new_surname" required placeholder="Фамилия"><br>
                <input class="btn btn-success" type="submit" onclick="alert('Добавлено')" value="Отправить">
            </form>
        </div>
        <div class="col-md-5">
            <h3>Все водители</h3>

            <table id="drivers_table" class="table table-bordered" border="1">
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                </tr>
            </table>

        </div>
    </div>
</div>
