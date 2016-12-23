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
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center" style="margin-bottom: 30px">Каталог</h1>
			
			<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
				<div class="row">
					<div class="col-sm-6">
						<h5 style="font-weight: bold; margin-top: 5px">Сортировать по категориям</h5>
						<?php 
						include_once('pages/lists.html');
						?>
					</div>
				</form>
				<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
					<div class="col-sm-6">
						<p class="sort">
							<label for="amount">Сортировать по цене: </label>
							<input type="text" id="amount" name="min">
							<input type="text" id="amount_1" name="max">
							<span id="filterPrice">Фильтр</span>
						</p>

						<div id="slider-range" style="margin-top: 20px"></div>
					</div>
					</form>
				</div>

				<hr>

<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
				<?php
				$items=array();
				if (isset($_GET['sid'])) {
					if (isset($_GET['sid'])) {
						$items=Item::GetItems($_GET['sid']);
					}
					else
					{
						$items=Item::GetItems();
					}

					$items=array_reverse($items);

					foreach ($items as $i) 
					{
						$i->Draw();
					}
				}
				
				
				if (isset($_GET['min'], $_GET['max'])) {
					$items=Item::GetItems();
					$min=$_GET['min'];
					$max=$_GET['max'];

					echo '<h4>Показаны товары в ценовом диапазоне: <b>'.$min.' - '.$max.' грн</b></h4>';

					foreach ($items as $i) 
					{
						if ($i->GetPrice()<$min || $i->GetPrice()>$max) 
						{
							continue;
						}
						$i->Draw();	
					}
				}

				
				

				?>
			</form>
		</div>
	</div>
</div>

<script>
	function getSubid(sid) {
		document.location="index.php?page=2&sid="+sid;
	}
</script>


