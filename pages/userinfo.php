<?php 
$user = trim($_GET['user']);

Tools::SetParam('localhost','root','123456','shop_db');
$pdo=Tools::connect();

$ps=$pdo->prepare('SELECT * FROM customers WHERE login="'.$user.'"');
$ps->execute();
$row=$ps->fetch();
?>

<h2 class="text-center">Профиль пользователя</h2>
<br>

<?php 

if ($row['name']=='') {
	?>
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-2">
			<a href="" style="font-size: 12px">[изменить]</a>
			<img src="<?php echo $row['imagepath']?>" alt="" width="127" height="127">
			<p style="text-align: center; font-weight: bold"><?php echo $row['login']?></p>
		</div>
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<div class="col-md-3 text-right">
				<label for="surname">Фамилия</label> <label for="name">Имя*</label><br><br>
				<label for="birthday">День рождения*</label><br><br>
				<label for="phone">Телефон*</label><br><br>
				<label for="adress">Адресс*</label><br><br>

			</div>
			<div class="col-md-7">
				<input type="text" id="surname" name="surname"> <input type="text" id="name" name="name"><br><br>
				<input type="date" id="birthday" name="birthday"><br><br>
				<input type="tel" id="phone" name="phone"><br><br>
				<input type="text" id="adress" name="adress"><br><br>

				<p>* - обязательные для заполнения поля</p>
				<input type="submit" id="addinfo" name="addinfo" value="Добавить">
			</div>
			
		</form>
	</div>
	<?php
}
else{
	?>
	<div class="col-md-10 col-md-offset-1">
		<div class="col-md-2">
			<a href="" style="font-size: 12px">[изменить]</a>
			<img src="<?php echo $row['imagepath']?>" alt="" width="127" height="127">
			<p style="text-align: center; font-weight: bold"><?php echo $row['login']?></p>
		</div>
		<div class="col-md-5 text-right">
			<p>ФИО:</p>
			<p>День рождения:</p>
			<p>Телефон:</p>
			<p>Почта</p>
			<p>Дата регистрации:</p>
			<p>Последняя активность:</p>
			<br>
			<p>Адресс:</p>
		</div>
		<div class="col-md-5">
			<p><?php echo $row['surname']?> <?php echo $row['name']?> <?php echo $row['parentname']?></p>
			<p><?php echo $row['birthday']?></p>
			<p><?php echo $row['phone']?></p>
			<p><?php echo $row['email']?></p>
			<p><?php echo $row['regdate']?></p>
			<p><?php echo $row['last-activity']?></p>
			<br>
			<p><?php echo $row['adress']?></p>
		</div>
	</div>

	<?php	
}
?>
<div class="col-md-8 col-md-offset-2 text-center email-form">
	<h2>Написать письмо администрации</h2>
	<form action="">
		<textarea name="" placeholder="Сообщение..."></textarea><br>
		<input type="submit" value="Отправить">
	</form>
<?php 
if (isset($_POST['addinfo'])){
	$surname = trim($_POST['surname']);
	$name = trim($_POST['name']);
	$birthday = trim($_POST['birthday']);
	$phone = trim($_POST['phone']);
	$adress = trim($_POST['adress']);
	if ($surname != "" && $name != "" && $birthday != "" && $phone != "" && $adress != "") {
		$ins = $pdo->prepare('UPDATE customers SET surname="'.$surname.'", name="'.$name.'", birthday="'.$birthday.'", phone="'.$phone.'", adress="'.$adress.'" WHERE login="'.$user.'"');
		$ins->execute();
		echo '<p class="add">Добавлено</p>';
		echo "<script>document.location='index.php?page=userinfo&user=".$user."'</script>";
	}
	else{
		echo '<p class="add">Не все поля заполнены!</p>';
	}
}
?>	
</div>



