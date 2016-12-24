<?php 

session_start();

include_once ("classes.php");



if (isset($_GET['item'])){



	Tools::SetParam('localhost','root','123456','shop_db');

	$pdo=Tools::connect();

	$item = $_GET['item'];



	$ps=$pdo->prepare('SELECT * FROM items WHERE id='.$item);

	$ps->execute(array($id));

	$row=$ps->fetch(PDO::FETCH_LAZY);



	$id = $row['id'];

	$itemname = $row['itemname'];

	$catid = $row['catid'];

	$subid = $row['subid'];

	$pricein = $row['pricein'];

	$pricesale = $row['pricesale'];

	$info = $row['info'];

	$rate = $row['rate'];

	$imagepath = $row['imagepath'];

	$action = $row['action'];

}

?>

<style type="text/css">

	.caroufredsel_wrapper:nth-child(1){

		top: 0 !important;

	}

	.caroufredsel_wrapper{

		bottom: 55px !important;

		position: absolute !important;

	}

	#wrapper {

		border: 1px solid #ddd;

		background-color: #fff;

		width: 450px;

		height: 550px;

		box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);

	}

	#wrapper img {

		display: block;

		float: left;

	}

	div #images, div #thumbs {

		height: 350px !important;

		overflow: hidden;

	}

	div #images {

		width: 350px !important;

		margin: 50px 0 25px 50px;

	}

	div #thumbs {

		width: 450px !important;

		height: 100px !important;

	}

	div #thumbs img {

		border: 1px solid #ccc;

		padding: 14px;

		margin: 0 12px 0 12px;

		cursor: pointer;

	}

	#thumbs img.selected, #thumbs img:hover {

		border-color: #333;

	}



	#prev, #next {

		width: 15px;

		height: 21px;			

		display: block;				

		text-indent: -999em;

		background: transparent url(img/carousel_control.png) no-repeat 0 0;

		position: absolute;

		bottom: 80px;				

	}

	#prev {

		background-position: 0 0;

		left: 55px;

	}

	#prev:hover {

		left: 52px;

	}			

	#next {

		background-position: -18px 0;

		right: 145px;

	}

	#next:hover {

		right: 142px;

	}			



	#source {

		text-align: center;

		width: 400px;

		margin: 0 0 0 -200px;

		position: absolute;

		bottom: 10px;

		left: 50%;

	}

	#source, #source a {

		color: #999;

		font-size: 12px;

	}

</style>



<div class="container">

	<div class="row">

		<div class="col-sm-12">

			<h2 style="margin-bottom: 30px"><?php echo $itemname ?></h2>

			<div class="col-md-6">

				<div id="wrapper">

					<div id="images">

						<?php 

						$str='SELECT imagepath FROM images WHERE itemid='.$id;

						$ps=$pdo->prepare($str);

						$ps->execute();

						echo '<img src="'.$imagepath.'" alt="ek-aanhanger" class="widthImg" />';

						while($row=$ps->fetch(PDO::FETCH_LAZY)){

							echo '<img src="'.$row[0].'" alt="ek-aanhanger" class="widthImg" />';

						}

						?>

					</div>

					<div id="thumbs">

						<?php 

						$str='SELECT imagepath FROM images WHERE itemid='.$id;

						$ps=$pdo->prepare($str);

						$ps->execute();

						echo '<img src="'.$imagepath.'" alt="ek-aanhanger" width="70" height="70" />';

						while($row=$ps->fetch(PDO::FETCH_LAZY)){

							echo '<img src="'.$row[0].'" alt="ek-aanhanger" width="70" height="70" />';

						}

						?>

					</div>

					<a id="prev" href="#"></a>

					<a id="next" href="#"></a>

				</div>

			</div>

			<div class="col-md-6">

				<h3><?php echo $pricesale ?> грн</h3>

				<h4 style="color:gray; text-decoration:line-through"><?php echo $pricesale+($pricesale*0.1) ?> грн</h4>

				<h5 style="color: green">Есть в наличии!</h5>

				<p style="margin: 50px 0"><?php echo $info ?></p>

				<form action="<?php $_SERVER['PHP_SELF']?>" method="post">

					<input type="submit" name="cart<?php echo $id ?>>" value="В корзину" class="add-cart2">

				</form>

			</div>

		</div>

	</div>

	<hr>

	<div class="row">

		<div class="col-sm-12">

			<h3 class="text-center">Популярные товары</h3>

			<?php 

			$items=Item::GetItems();

			$num = count($items);



			$items[rand(19,$num-1)]->Draw();

			$items[rand(19,$num-1)]->Draw();

			$items[rand(19,$num-1)]->Draw();

			$items[rand(19,$num-1)]->Draw();

			?>

		</div>

	</div>

	<div class="row">

		<div class="col-sm-8 col-sm-offset-2">

			<h3 class="text-center"><?php echo $itemname ?></h3>

			<?php 

			if ($_SESSION['reguser']) 

			{

				echo '<div class="comment text-center">Оставить отзыв</div>';

			}

			else

			{

				echo '<div class="text-center">Что бы написать отзыв - нужно зарегистрироваться!<br>

				<a href="index.php?page=4" class="text-center">Вход/Регистрация</a></div>';

			}

			?>

		</div>

	</div><br>

	<div class="row row-comment">

		<div class="col-sm-8 col-sm-offset-2">

			<form action="<?php $_SERVER['PHP_SELF']?>" class="send-comment" method="post">

				<textarea name="text" placeholder="Оставте сообщение..."></textarea><br>

				<button type="submit" name="sendcomment">Добавить</button>

			</form>

		</div>

	</div>



	<div class="row">

	<?php

	if (isset($_REQUEST['sendcomment'])) {

		$dt=date("Y-m-d H:i:s");

		$text=$_POST['text'];

		$ins = $pdo->prepare('INSERT INTO comments(itemid,text,username,datein) VALUES(:itemid,:text,:username,:datein)');

		$data = array('itemid' => $item, 'text' => $text, 'username' => $_SESSION['reguser'], 'datein' => $dt);

		$ins->execute($data);

		echo '<p class="add text-center">Комментарий добавлен.</p>';

	}

	?>

		<?php

		$sel = $pdo->prepare('SELECT * FROM comments WHERE itemid='.$item.' ORDER BY datein DESC');

		$sel->execute();



		while ($row = $sel->fetch(PDO::FETCH_LAZY)) {

			$sel2 = $pdo->prepare('SELECT * FROM customers WHERE login="'.$row['username'].'"');

			$sel2->execute();

			$row2 = $sel2->fetch(PDO::FETCH_LAZY);

			echo '<div class="col-sm-8 col-sm-offset-2 comment-row">';

			echo '<div class="col-md-2 col-xs-2">';

			echo '<img src="'.$row2['imagepath'].'" alt="" width="80" height="80">';

			echo '<div class="text-center" style="width:80px">'.$row2['login'].'</div>';

			echo '</div>';

			echo '<div class="col-md-10 col-xs-9 col-xs-offset-1 block">';

			echo $row['text'];

			echo '</div>';

			echo '<div class="text-right" style="color:#9a9a9a">'.$row['datein'].'</div>';

			echo '</div>';

		}

		?>	

	</div>

</div>

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

?>