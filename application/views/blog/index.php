<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Авторизация</h2>
            <form action="<?=$url?>" method="post">
                <p>
                    <label>Ваш логин:<br></label>
                    <input class="form-control" name="login" required type="text">
                </p>
                <p>
                    <label>Ваш пароль:<br></label>
                    <input class="form-control" name="password" required type="password">
                </p>
                <p>
                    <input class="btn btn-success" type="submit" name="submit" value="Войти">
                    <br>
                </p>
            </form>
            <p class="text-right"><a href="/register">Регистрация</a></p>
        </div>
    </div>
</div>