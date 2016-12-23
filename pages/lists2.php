<?php 

include_once('classes.php');
$sub=$_GET['sub'];
Tools::SetParam('localhost','root','123456','shop_db');
$pdo=Tools::connect();

$ps=$pdo->prepare('SELECT * FROM items WHERE subid=? ORDER BY itemname');
$ps->execute(array($sub));
echo '<option value="0">Выбирите товар...</option>';
while ($row=$ps->fetch()) {
	echo '<option value="'.$row['id'].'">'.$row['itemname'].'</option>';
}
 ?>