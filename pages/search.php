<?php 
$reguser='';
if (!isset($_SESSION['reguser']) || $_SESSION['reguser']=='') {
	$reguser='cart';
}
else{
	$reguser=$_SESSION['reguser'];
}
foreach ($_REQUEST as $k => $v) {
	if (substr($k,0,4) =='cart') {
		$iid=substr($k,4);
		echo '<script>
		document.cookie="'.$reguser.'_'.$iid.'='.$iid.'";
	</script>';
}
}

$search=$_GET['search'];
$search=trim($search);

 ?>
 <div class="container">
	<div class="row">
		<div class="col-sm-12">
		<h3>Поиск по запросу "<?php echo $search; ?>"</h3>
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
		<?php
		$items=Item::GetItems();
            $sel=$pdo->prepare('SELECT * FROM items WHERE itemname LIKE "%'.$search.'%"');
            $sel->execute();
            while ($row = $sel->fetch(PDO::FETCH_LAZY)) 
            {
            	$items[$row['id']-1]->Draw();
            }
        ?>
        </form>
		</div>
	</div>
</div>