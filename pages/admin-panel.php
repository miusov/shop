<div class="wrapper">
    <div class="tabs">
        <span class="tab" id="one">Категории/Подкатегории</span>
        <span class="tab" id="two">Товары</span>
        <span class="tab" id="three">Картинки</span>
    </div>
    <div class="tab_content container">

        <div class="tab_item row">
            <div class="col-md-6 col-sm-12">
                <h3>Категории</h3>
                <form action="index.php?page=5#one" method="post" class="form-inline">
                    <input type="text" placeholder="Категория" name="cat" class="form-control">
                    <input type="submit" value="Добавить" name="addcat" class="btn btn-default">
                </form>
                <?php
                if (isset($_POST['addcat'])) {
                    $cat = trim($_POST['cat']);
                    if ($cat != "") {
                        $ins = $pdo->prepare('INSERT INTO categories(category) VALUES(:category)');
                        $data = array('category' => $cat);
                        $ins->execute($data);
                        echo '<p class="add">Добавлено</p>';
                    }
                }
                ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <h3>Подкатегории</h3>
                <form action="index.php?page=5#one" method="post" class="form-inline">
                    <select name="cat">
                        <option value="0">Категория</option>
                        <?php
                        $sel = $pdo->prepare('SELECT * FROM categories ORDER BY category');
                        $sel->execute();
                        while ($row = $sel->fetch(PDO::FETCH_LAZY)) {
                            echo '<option value=' . $row['id'] . '>' . $row['category'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" placeholder="Подкатегория" name="sub" class="form-control">
                    <input type="submit" value="Добавить" name="addsub" class="btn btn-default">
                </form>
                <?php
                if (isset($_POST['addsub'])) {
                    $sub = trim($_POST['sub']);
                    $catid = $_POST['cat'];
                    if ($sub != "" && $catid > 0) {
                        $ins = $pdo->prepare('INSERT INTO subcategories(subcategory,catid) VALUES(:subcategory,:catid)');
                        $data = array('subcategory' => $sub, 'catid' => $catid);
                        $ins->execute($data);
                        echo '<p class="add">Добавлено</p>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="tab_item">
            <h3>Добавить товар</h3>
            <form action="index.php?page=5#two" method="post" class="additem" enctype="multipart/form-data">
                <?php 
                include_once('pages/lists.html');
                ?>
                <br>
                <input type="text" name="itemname" placeholder="Название">
                <input type="number" name="pricein" placeholder="Цена закупки">
                <input type="number" name="pricesale" placeholder="Цена продажи">
                <textarea name="info" placeholder="Описание"></textarea>
                <label for="imagepath">Выбрите картинку</label>
                <input type="file" name="imagepath">
                <input type="submit" value="Добавить" name="additem" class="btn btn-default">
            </form>
            <?php
            if (isset($_POST['additem'])) {

                if (is_uploaded_file($_FILES['imagepath']['tmp_name'])) {
                    $path='img/tovari/'.$_FILES['imagepath']['name'];
                    move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
                }

                $itemname = $_POST['itemname'];
                $pricein = $_POST['pricein'];
                $pricesale = $_POST['pricesale'];
                $catid = $_POST['catid'];
                $subid = $_POST['subid'];
                $info = trim($_POST['info']);
                if ($itemname != "" && $catid > 0 && $subid > 0) {
                    $ins = $pdo->prepare('INSERT INTO items(itemname,catid,subid,pricein,pricesale,info,imagepath) VALUES(:itemname,:catid,:subid,:pricein,:pricesale,:info,:imagepath)');
                    $data = array('itemname' => $itemname, 'catid' => $catid, 'subid' => $subid, 'pricein' => $pricein, 'pricesale' => $pricesale, 'info' => $info, 'imagepath' => $path);
                    $ins->execute($data);
                    echo '<p class="add">Добавлено</p>';

                }
            }
            ?>
        </div>

        <div class="tab_item">
            <h3>Добавить картинки</h3>
            <form action="index.php?page=5#three" method="post" class="input-group"  enctype="multipart/form-data">
                <div class="input-group">
                    <?php include_once('pages/lists2.html'); ?>
                </div>
                <br>
                <div class="input-group">
                    <input type="file" name="file[]" multiple accept="image/*" class="form-control"  id="files">
                </div>
                <br>
                <input type="submit" name="addpics" value="Добавить" class="btn btn-default" id="addpics">
            </form>
            <?php 
            if (isset($_POST['addpics']) && $_POST['itemid']>0){
                $i=0;
                $str="INSERT INTO images(itemid,imagepath) VALUES";
                foreach($_FILES['file']['name'] as $k => $v) {
                    if($_FILES['file']['error'][$k] !=0){
                        echo '<script>alert("Неправильный размер файла'.$v.'")</script>';
                        continue;
                    }
                    if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'img/tovari/'.$v)){
                        if ($i>0){
                            $str.=",";
                        }
                        $i++;
                        $str.="(".$_POST['itemid'].",'img/tovari/".$v."')";
                    }
                }
                if ($i>0){
                    $ins=$pdo->prepare($str);
                    $ins->execute();
                }
            }
            ?>

        </div>
    </div>
</div>
</div>