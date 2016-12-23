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

<!--Slider-->

<div class="container content">
    <div class="row row-slider hidden-sm hidden-xs col-sm-12">
        <div class="col-sm-12 col-md-12 slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <!--    <ol class="carousel-indicators">-->
                <!--        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
                <!--        <li data-target="#myCarousel" data-slide-to="1"></li>-->
                <!--        <li data-target="#myCarousel" data-slide-to="2"></li>-->
                <!--        <li data-target="#myCarousel" data-slide-to="3"></li>-->
                <!--    </ol>-->

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img/slider/33861256_skyris_banner_ok.jpg" alt="pic">
                    </div>

                    <div class="item">
                        <img src="img/slider/banenr-tethys-iphone5-2.jpg" alt="pic">
                    </div>

                    <div class="item">
                        <img src="img/slider/bc-hp-xmas-xsale-1250.jpg" alt="pic">
                    </div>

                    <div class="item">
                        <img src="img/slider/digital-televisions-site.jpg" alt="pic">
                    </div>
                    <div class="item">
                        <img src="img/slider/header-scott.jpg" alt="pic">
                    </div>
                    <div class="item">
                        <img src="img/slider/Huawei-Mate-S-Announces-Ultra-Slim-Dual-SIM-Price-Specifications-Display.jpg" alt="pic">
                    </div>
                    <div class="item">
                        <img src="img/slider/lights-header.jpg" alt="pic">
                    </div>
                    <div class="item">
                        <img src="img/slider/success-shopper-new.jpg" alt="pic">
                    </div>
                    <div class="item">
                        <img src="img/slider/trendy-predictions-2015-4.jpg" alt="pic">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!--Novinki-->
        <form action="index.php?page=1" method="post">
            <div class="row row-product">
                <h2 class="text-center novelty">Новинки</h2>
                <div class="col-sm-12">                   
                  <?php 
                  $items=Item::GetItems();
                  $num = count($items);

                  $items[$num-1]->Draw();
                  $items[$num-2]->Draw();
                  $items[$num-3]->Draw();
                  $items[$num-4]->Draw();
                  ?>
              </div>
          </div>
          <div class="row row-product">
            <h2 class="text-center novelty">Популярное</h2>
            <div class="col-sm-12">
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
        <div class="row row-product">
            <h2 class="text-center novelty">Распродажа</h2>
            <div class="col-sm-12">
                <?php 
                $items=Item::GetItems();

                $items[rand(0,4)]->Draw();
                $items[rand(5,9)]->Draw();
                $items[rand(10,14)]->Draw();
                $items[rand(14,18)]->Draw();
                ?>
            </div>
        </div>
    </form>
</div>
</div>




