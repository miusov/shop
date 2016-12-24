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
				<input type="text" id="phone" name="phone"><br><br>
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
		<div class="col-md-2 text-center">
			<img src="<?php echo $row['imagepath']?>" alt="" width="127" height="127">
			<p style="text-align: center; font-weight: bold"><?php echo $row['login']?></p>
		</div>
		<div class="col-md-10 text-center">
			<p><span style="font-weight: bold">Фамилия, Имя:</span> &nbsp&nbsp&nbsp<?php echo $row['surname']?> <?php echo $row['name']?> <?php echo $row['parentname']?></p>
			<p><span style="font-weight: bold">День рождения:</span> &nbsp&nbsp&nbsp<?php echo $row['birthday']?></p>
			<p><span style="font-weight: bold">Телефон:</span> &nbsp&nbsp&nbsp<?php echo $row['phone']?></p>
			<p><span style="font-weight: bold">Почта:</span> &nbsp&nbsp&nbsp<?php echo $row['email']?></p>
			<p><span style="font-weight: bold">Дата регистрации:</span> &nbsp&nbsp&nbsp<?php echo $row['regdate']?></p>
			<p><span style="font-weight: bold">В прошлый раз были:</span> &nbsp&nbsp&nbsp<?php echo $row['lastactivity']?></p>
			<p><span style="font-weight: bold">В прошлый раз заходили с ip:</span> &nbsp&nbsp&nbsp<?php echo $row['lastip']?></p>
			<br>
			<p><span style="font-weight: bold">Адресс:</span> &nbsp&nbsp&nbsp<?php echo $row['adress']?></p>
		</div>
		<form action="index.php?page=delprofile" method="post">
			<input type="submit" name="delprofile" value="Удалить профиль" id="delProfile">
		</form>
	</div>

	<?php	
}
?>
<div class="col-md-8 col-md-offset-2 text-center email-form">
	<h2>Написать письмо администрации</h2>
	<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
		<textarea name="textemail" placeholder="Сообщение..."></textarea><br>
		<input type="submit" value="Отправить" name="sendmail">
	</form>
	<?php if (isset($_POST['sendmail'])){
		if ($_POST['textemail']!='') {
			if (mail('miusov86@gmail.com', 'Сообщение с Интернет-магазина, от '.$row['email'], $_POST['textemail'])) {
				echo '<p style="color:green">Сообщение отправлено.</p>';
			}
			else{
				echo '<p style="color:red">Ошибка при отправке!</p>';
			}			
		}
		else{
			echo '<p style="color:red">Напишите сообщение!</p>';
		}
	} ?>
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



