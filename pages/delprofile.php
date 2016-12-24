<h2 class="text-center"> Вы уверены что хотите удалить профиль?</h2>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
	<p class="text-center">
		<input type="submit" name="yes" value="Да" class="delButton">&nbsp
		<input type="submit" name="no" value="Нет" class="delButton">
	</p>	
</form>

<?php 
if (isset($_POST['yes'])){
	$ins = $pdo->prepare('DELETE FROM customers WHERE login="'.$_SESSION['reguser'].'"');
	$ins->execute();
	unset($_SESSION['reguser']);
    unset($_SESSION['role']);
	echo "<script>document.location='index.php?page=4'</script>";
}
if (isset($_POST['no'])){
	echo "<script>document.location='index.php?page=userinfo&user=".$_SESSION['reguser']."'</script>";
}
?>