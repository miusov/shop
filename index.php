<?php
session_start();
include_once ("pages/classes.php");
Tools::SetParam('localhost','root','123456','shop_db');
$pdo=Tools::connect();
if(isset($_GET['page'])){
    $page=$_GET['page'];
}

$array=array();
foreach ($_COOKIE as $key => $value) {
    if (stripos($key, 'cart')!==false || stripos($key, $_SESSION['reguser'])!==false) {
        $array[]=$key;
    }
}

if (isset($_POST['sendEmail'])) {
    if ($_POST['mail'] != "") {
        $ins = $pdo->prepare('INSERT INTO emails(emails) VALUES(:emails)');
        $data = array('emails' => $_POST['mail']);
        $ins->execute($data);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="callBackBlock">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <input type="text" name="name" placeholder="ИМЯ"><br><br>
            <input type="tel" name="tel" placeholder="ТЕЛЕФОН"><br><br>
            <textarea name="message" placeholder="СООБЩЕНИЕ"></textarea><br><br>
            <input type="submit" name="sendMessage" value="Отправить">
        </form>
    </div>

    <div class="wrapper">
        <!--  LOGO-->
        <div class="content">
            <div class="container-fluid">
                <div class="row layout">
                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <div class="layout-left col-md-6 text-left hidden-sm hidden-xs"></div>
                        <form action="" method="post">
                            <div class="layout-right col-md-6 col-xs-12 text-right">
                                <?php
                                if (isset($_SESSION['reguser'])){
                                   echo 'Добро пожаловать <b>'. $_SESSION['reguser']. 
                                   ' </b><a href="index.php?page=userinfo&user='.$_SESSION['reguser'].'" target="_blanc">[профиль]</a><input type="submit" value="Выход" id="exit" name="exit">';
                               } 
                               else{
                                echo '<a href="index.php?page=4">Вход/Регистрация</a>';
                            }
                            if (isset($_POST['exit'])) {
                                $ins = $pdo->prepare('UPDATE customers SET lastactivity="'.date("Y-m-d H:i:s").'",lastip="'.$_SERVER["REMOTE_ADDR"].'" WHERE login="'.$_SESSION['reguser'].'"');
                                $ins->execute();
                                unset($_SESSION['reguser']);
                                unset($_SESSION['role']);
                                echo '<script>
                                var cookies = document.cookie.split(";");
                                for(var i=0; i < cookies.length; i++) {
                                    var equals = cookies[i].indexOf("=");
                                    var name = equals > -1 ? cookies[i].substr(0, equals) : cookies[i];
                                    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                                }
                            </script>';

                            echo '<script>location.href = "index.php?page=1"</script>';
                        }
                        ?>

                    </div>
                </form>
            </div>
        </div>        
        <div class="row row-logo text-left">
            <div class="col-md-10 col-md-offset-1">
                <div class="time-workig col-md-4 hidden-sm hidden-xs">
                    (099) 123 45 67 <br> (099) 123 45 67 <br>
                    <span>Ежедневно с 7:00 до 20:00</span> <br>
                    <button class="back-call">Обратный звонок</button>
                    <?php 
                    if (isset($_POST['sendMessage'])) {
                        if ($_POST['name'] != "" || $_POST['tel'] != "" || $_POST['message'] != "") {
                            mail('miusov86@gmail.com', 'Перезвоните мне '.$_POST['tel'], $_POST['message']);
                            echo '<br><span style="color: green">Мы вам перезвоним.</span>';
                        }
                    }
                    ?>
                </div>
                <div class="logo text-center col-md-4 col-sm-6 col-xs-6"><a href="index.php?page=1"><img src="img/logo2.jpg" alt=""></a></div>
                <div class="cart-and-search text-right col-md-4 col-sm-6 col-xs-6">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <a href="index.php?page=3">Корзина <span>(<?php echo count($array); ?>)</span></a><br><br>

                    <form action="index.php?page=5" method="get">
                        <div class="input-group">

                            <input type="text" name="search" class="form-control search" placeholder="Поиск товаров" style="width: 70%">
                            <span class="input-group-btn">

                                <button class="btn btn-default" type="submit">Поиск</button>

                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- navbar -->

    <?php include('pages/menu.php');
    include_once("pages/classes.php"); ?>

    <!-- content -->

    <section class="container">
        <div class="row">

            <?php
            if (empty($_GET)) {
                include_once("pages/main.php");

            }
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                if ($page == 1) include_once("pages/main.php");
                if ($page == 2) include_once("pages/catalog.php");
                if ($page == 3) include_once("pages/cart.php");
                if ($page == 4) include_once("pages/admin.php");
                if ($page == 5) include_once("pages/admin-panel.php");
                if ($page == 6) include_once("pages/iteminfo.php");
                if ($page == 'userinfo') include_once("pages/userinfo.php");
                if ($page == 'delprofile') include_once("pages/delprofile.php");
            }
            if (isset($_GET['search'])) {
                include_once("pages/search.php");
            }
            ?>

        </div>
    </section>
</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 row-email">
                Подпишитесь на рассылку новостей и узнавайте первыми о распродажах и новинках &nbsp;&nbsp; 
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <input type="email" placeholder="Электронная почта" name="mail"><input type="submit" name="sendEmail" value="Подписаться"></input>
                </form>
            </div>
        </div>
        <div class="row social text-center">
            <p>SHOP&trade; my brand in trand</p>
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <p>&copy;shop 2016</p>
        </div>
    </div>
</footer>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/jquery.scrollUp.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.carouFredSel-6.0.4-packed.js"></script>
<script src="js/ajax.js"></script>
<script src="js/main.js"></script>
</body>
</html>