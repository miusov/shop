<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>Корзина</h1>
            <?php

            echo '<form action="index.php?page=3" method="post">';
            $reguser='';
            if (!isset($_SESSION['reguser']) || $_SESSION['reguser']=='') {
                $reguser='cart';
            }
            else{
                $reguser=$_SESSION['reguser'];
            }
            $total=0;
            foreach ($_COOKIE as $k => $v) {

              if (strpos($k,$reguser)===0) 
              {
                $pos=strpos($k,'_');
                $iid=substr($k,$pos+1);
                $item=Item::fromDb($iid);
                $item->DrawCart();
                $total+=$item->getPrice();
            }
        }

        echo '<hr>';
        echo '<p style="font-size:22px; font-weight:bold"> Общая сумма - '.$total.' грн.</p>';
        echo '<br>';
        echo '<button class="buy" type="submit" name="subbuy" onmousedown=deleteCookie("'.$reguser.'")>Оформить заказ</button>';
        echo '</form>';

        if (isset($_POST['subbuy'])) {

         foreach ($_COOKIE as $k => $v) {
             $pos=strpos($k,"_");
             if (substr($k,0,$pos)==$reguser) {
                 $id=substr($k,$pos+1);
                 $item=Item::fromDb($id);
                 $item->Sale();
             }
         }
     }
     ?>
 </div>
</div>
</div>

<script>    
   function deleteCookie(rname) {
    var cookies = document.cookie.split(';');
    for(var i=1; i<=cookies.length; i++)
    {
        if (cookies[i-1].indexOf(rname)===1) 
        {
            var cookie=cookies[i-1].split('=');
            var d=new Date(new Date().getTime()-1000);
            document.cookie=cookie[0]+"="+"0"+";path=/;expires="+d.toUTCString();
        }
    }
}
</script>
