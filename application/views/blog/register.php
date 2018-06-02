<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Регистрация</h2>
            <form action="<?=$url?>" method="post">
                <p>
                    <label>Ваш логин:<br></label>
                    <input class="form-control" name="reg_login"  required type="text">
                </p>
                <p>
                    <label>Ваш пароль:<br></label>
                    <input class="form-control" name="reg_password" required type="password">
                </p>
                <p>
                    <input  class="btn btn-success" type="submit" name="submit" value="Зарегистрироваться">
                </p>
            </form>
        </div>
    </div>
</div>