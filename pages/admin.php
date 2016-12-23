<?php

// include_once('classes.php');
// $user = new User();
// $customer = $user->Login($login,$pass);
// echo $customer['login'];

if (isset($_REQUEST['signin']))
{
    $login=trim($_REQUEST['login']);
    $pass=trim($_REQUEST['pass1']);

    $user = new User();
    $customer = $user->Login($login,$pass);

    if ($customer['login']==$login && $customer['pass']==md5($pass)) {
        session_start();
        $_SESSION['reguser']=$login;
        $_SESSION['role']=$customer['roleid'];
        echo '<script>location.href = "index.php?page=1"</script>';
    }
    else
    {
        echo '<h3 style="color:red; text-align:center">Неверные логин или пароль!</h3>';
    }

    if ($login=='' || $pass=='')
    {
        echo '<h3 style="color: red" class="text-center">Введите логин и пароль!</h3>';
        echo '<a href="index.php?page=4" class="text-center"><h4>Назад</h4></a>';
        exit();
    }
    


}

///////////////////////////////////////////////////////////////////
if (isset($_REQUEST['reg']))
{
    $login=trim($_REQUEST['login']);
    $pass=trim($_REQUEST['pass1']);
    $pass2=trim($_REQUEST['pass2']);
    $email=trim($_REQUEST['email']);
    if ($login=='' || $pass=='')
    {
        echo '<h3 style="color: red" class="text-center">Введите логин и пароль!</h3>';
        echo '<a href="index.php?page=4" class="text-center"><h4>Назад</h4></a>';
        exit();
    }
    if (strlen($login)<3 || strlen($login)>30 || strlen($pass)<3 || strlen($pass)>30)
    {
        echo '<h3 style="color:red;" class="text-center">Слишком короткие логин/пароль</h3>';
        echo '<a href="index.php?page=4" class="text-center"><h4>Назад</h4></a>';
        exit();
    }
    if ($pass != $pass2)
    {
        echo '<h3 style="color:red;" class="text-center">Пароли отличаются!</h3>';
        echo '<a href="index.php?page=4" class="text-center"><h4>Назад</h4></a>';
        exit();
    }

    $path='';
    if (is_uploaded_file($_FILES['avatar']['tmp_name']))
    {
        $path='img/avatars/'.$_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], 'img/avatars/'.$_FILES['avatar']['name']);
    }
    else
    {
        $path='img/avatars/null.png';
    }
    
    $customer=new Customer($login,$pass,$email,$path);
    $customer->IntoDb();
}
else{
    ?>

    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center">Вход на сайт</h1><br>
            <div class="col-sm-12 register text-center">

                <form action="index.php?page=4" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="l">Введите свой логин</label>
                        <input id="l" type="text" name="login" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="p1">Введите свой пароль:</label>
                        <input id="p1" type="password" name="pass1" class="form-control"/>
                    </div>
                    <input type="checkbox" name="cb1" id="chbox">&nbsp;
                    <label for="chbox">Регистрация</label> <br>
                    <div class="form-group qwerty">
                        <label for="p2">Повторите пароль:</label>
                        <input id="p2" type="password" name="pass2" class="form-control"/>
                    </div>
                    <div class="form-group qwerty">
                        <label for="m">Введите свой почтовый адрес:</label>
                        <input id="m" type="email" name="email" class="form-control"/>
                    </div>
                    <div class="form-group qwerty">
                        <label for="avatar">Выберите фото</label>
                        <input type="file" name="avatar">
                    </div>
                    <input type="submit" name="signin" class="reg" value="Войти">
                </form>
            </div>
        </div>
    </div>

    <?php
}
?>