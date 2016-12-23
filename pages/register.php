<?php //
//
//// include_once('classes.php');
//
//if (isset($_REQUEST['adduser']))
//{
//    $login=trim($_REQUEST['login']);
//    $pass=trim($_REQUEST['pass1']);
//    if ($login=='' || $pass=='')
//    {
//        echo '<h3 style="color: red">Введите логин и пароль!</h3>';
//        exit();
//    }
//
//    $path='';
//    if (is_uploaded_file($_FILES['avatar']['tmp_name']))
//    {
//        move_uploaded_file($_FILES['avatar']['tmp_name'], 'img/'.$_FILES['avatar']['name']);
//        $path='img/'.$_FILES['avatar']['name'];
//    }
//
//    $customer=new Customer($login,$pass,$path);
//    $customer->IntoDb();
//}
//
//?>
<!---->
<!--<form action="index.php?page=5" method="post" class="regform" enctype="multipart/form-data">-->
<!--    <div class="form-group">-->
<!--        <label for="login">Login</label>-->
<!--        <input type="text" id="login" class="form-control" name="login">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="pass1">Password</label>-->
<!--        <input type="password" id="pass1" class="form-control" name="pass1">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="pass2">Confirm password</label>-->
<!--        <input type="password" id="pass2" class="form-control"  name="pass2">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="email">E-mail</label>-->
<!--        <input type="email" id="email" class="form-control" name="email">-->
<!--    </div>-->
<!--    <label for="avatar">Avatar</label>-->
<!--    <input type="file" name="avatar">-->
<!--    <input type="submit" class="btn btn-primary" name="adduser" value="Register">-->
<!--</form>-->