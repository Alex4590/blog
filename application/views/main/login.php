<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">Авторизация</h2>
            <form action="avt.php" method="post">
                <p>
                    <label>Ваш логин (Email):<br></label>
                    <input class="form-control" name="login" type="email" required>
                </p>
                <p>
                    <label>Ваш пароль:<br></label>
                    <input class="form-control" name="password" type="password" required>
                </p>
                <p>
                    <input class="btn btn-success" type="submit" name="submit" value="Войти">
                    <br>
                </p>
            </form>
            <br>
            <h2 class="text-center">Регистрация</h2>
            <form action="redgistration.php" method="post">
                <p>
                    <label>ФИО:<br></label>
                    <input class="form-control" name="name" type="text" required>
                </p>
                <p>
                    <label>Ваш логин (Email):<br></label>
                    <input class="form-control" name="login" type="email" required>
                </p>
                <p>
                    <label>Ваш пароль:<br></label>
                    <input class="form-control" name="password" type="password" required>
                </p>
                <p>
                    <input  class="btn btn-success" type="submit" name="submit" value="Зарегистрироваться">
                </p>
            </form>
        </div>
    </div>
</div>