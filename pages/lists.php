<?php 

include_once('classes.php');
$cat=$_GET['cat'];
Tools::SetParam('localhost','root','123456','shop_db');
$pdo=Tools::connect();

$ps=$pdo->prepare('SELECT * FROM subcategories WHERE catid=? ORDER BY subcategory');
$ps->execute(array($cat));
echo '<option value="0">Выбирите подкатегорию...</option>';
while ($row=$ps->fetch()) {
	echo '<option value="'.$row['id'].'">'.$row['subcategory'].'</option>';
}
 ?>