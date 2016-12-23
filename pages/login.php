<?php 
session_start();
print_r($_SESSION);
include_once ("classes.php");
Tools::SetParam('mysql.zzz.com.ua','miusovtest','azso2140','miusovtest');
$pdo=Tools::connect();

$login='miusov';
$pass='123456';
$path='img/avatars/Противоударный.jpg_640x640.jpg';

$user = new User();
$customer = $user->Login($login,$pass);

echo $customer['login'];
// print_r($customer);

// echo $customer->login;


 ?>