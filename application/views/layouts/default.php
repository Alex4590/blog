<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap -->
    <link href="public/styles/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/styles/style.css">

    <!--Js-->
    <script src="public/scripts/jquery.js"></script>
    <script src="public/scripts/ajax.js"></script>
    <!--<script src="public/scripts/main.js"></script>-->


    <title><?=$title?></title>
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href=""><?=$title?></a></li>
            </ul>
            <?php if($url === '/news/'){?>
                <form action="<?=$url?>" method="post">
                    <input type="text" hidden name="exit" name="true">
                    <input  id="exit-btn"  class="btn btn-danger dropdown-toggle pull-right"  type="submit" value="Выход">
                </form>
            <?php }?>
        </div>
    </nav>
    <?=$content?>
</body>
</html>