<nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="index.php?page=1">Главная</a></li>
                <li><a href="index.php?page=2">Каталог</a></li>
                <li><a href="index.php?page=3">Корзина</a></li>
                <?php 
                session_start();
                  if ($_SESSION['role']==1){
                    echo '<li class="adminli"><a href="index.php?page=5">Админка</a></li>';
                  }
                 ?>
                
              </ul>
            </div>
          </div>
        </nav>