<?php 

class Tools
{
	static private $param;

	static function SetParam($host,$user,$pass,$dbname)
	{
		Tools::$param=array($host,$user,$pass,$dbname);
	}

	static function connect()
	{
		$dns='mysql:host='.Tools::$param[0].';dbname='.Tools::$param[3].';charset=utf8;'; //строка подключения к mysql
		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8'
			);

		$pdo=new PDO($dns,Tools::$param[1],Tools::$param[2],$options);
		return $pdo;
	}
}

////////////////////////////////////////////////////////////
class Customer
{
	public $id;
	public $login;
	public $pass;
	public $roleid;
	public $discount;
	public $total;
	public $imagepath;

	function __construct($login,$pass,$email,$imagepath,$id=0)
	{

		$this->id = $id;
		$this->login = $login;
		$this->pass = $pass;
		$this->email = $email;
		$this->roleid = 2;
		$this->discount = 0;
		$this->total = 0;
		$this->imagepath = $imagepath;
		
	}

	function IntoDb()
	{
		Tools::SetParam('localhost','root','123456','shop_db');
		$pdo=Tools::connect();

		$ps=$pdo->prepare('INSERT INTO customers (login,pass,email,roleid,discount, total,imagepath) VALUES (:login,md5(:pass),:email,:roleid,:discount,:total,:imagepath)');

		$data=array(
			'login'=>$this->login,
			'pass'=>$this->pass,
			'email'=>$this->email,
			'roleid'=>$this->roleid,
			'discount'=>$this->discount,
			'total'=>$this->total,
			'imagepath'=>$this->imagepath);

		$ps->execute((array)$data);
		echo '<h4 style="color: green" class="text-center">Пользователь добавлен!</h4>';
		echo '<h4 style="color:blue; text-align:center"><a href="index.php?page=1">На главную</a></h4>';

	}

	static function FromDb($id)
	{
		Tools::SetParam('localhost','root','123456','shop_db');
		$pdo=Tools::connect();

		$ps=$pdo->prepare('SELECT * FROM customers WHERE id=?');
		$ps->execute(array($id));
		$row=$ps->fetch(PDO::FETCH_LAZY);

		$customer=new Customer($row['login'],$row['pass'],$row['imagepath'], $id);
		return $customer;
	}

}


///////////////////////////////////////////////////////////

class Item
{
	protected $id, $itemname, $subcategory, $catid, $subid, $pricein, $pricesale, $info, $rate, $imagepath, $action;

	function __construct($data)
	{
		$this->id=$data['id'];
		$this->itemname=$data['itemname'];
		$this->subcategory=$data['subcategory'];
		$this->catid=$data['catid'];
		$this->subid=$data['subid'];
		$this->pricein=$data['pricein'];
		$this->pricesale=$data['pricesale'];
		$this->info=$data['info'];
		$this->rate=0;
		$this->imagepath=$data['imagepath'];
		$this->action=0;

	}

	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop_db');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('INSERT INTO items(itemname,catid,subid,pricein,pricesale,info,rate,imagepath,action)
			values (:itemname,:catid,:subid,:pricein,:pricesale,:info,:rate,:imagepath,:action)');
		$data=array('itemname'=>$this->itemname,
			'catid'=>$this->catid,
			'subid'=>$this->subid,
			'pricein'=>$this->pricein,
			'pricesale'=>$this->pricesale,
			'info'=>$this->info,
			'rate'=>$this->rate,
			'imagepath'=>$this->imagepath,
			'action'=>$this->action);
		$ps->execute($data);
	}

	static function fromDb($id)
	{
		$item=null;
		try
		{
			$pdo=Tools::connect();
			$ps=$pdo->prepare('SELECT * FROM items WHERE id=?');
			$ps->execute(array($id));
			$row=$ps->fetch();
			$data=array(
				'id'=>$row['id'],
				'itemname'=>$row['itemname'],
				'catid'=>$row['catid'],
				'subid'=>$row['subid'],
				'pricein'=>$row['pricein'],
				'pricesale'=>$row['pricesale'],
				'info'=>$row['info'],
				'rate'=>$row['rate'],
				'imagepath'=>$row['imagepath'],
				'action'=>$row['action']);
			$item=new Item($data);
			return $item;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function Draw()
	{
		echo '<div class="col-sm-6 col-md-3 col-xs-12 product">';
		echo '<div class="text-center"><a href="index.php?page=6&item='.$this->id.'" target="_blanc""><img src="'.$this->imagepath.'" alt="" class="product-img"></a></div>';
		echo '<div class="text-left stars"><img src="img/5.png" alt="pic"></div>';
		echo '<div class="text-right review"><a href="index.php?page=6&item='.$this->id.'" target="_blanc">Подробнее</a></div>';
		echo '<p class="name text-center" title="'.$this->itemname.'">'.$this->itemname.'</p>';
		echo '<p class="review rewinfo">'.$this->info.'</p>';
		echo '<p class="price">'.$this->pricesale.' грн</p>';
		echo '<button name="cart'.$this->id.'" class="add-cart">В корзину</button>';
		echo '</div>';
	}

	function DrawCart()
	{
		echo '<div class="rowCart">';
		echo '<img src="'.$this->imagepath.'" width="70px">';
		echo '<span style="font-style:italic">'.$this->itemname.' - </span>';
		echo '<span style="font-weight:bold">  '.$this->pricesale.' грн. </span>';
		$reguser='';
		if (!isset($_SESSION['reguser']) || $_SESSION['reguser']=='') {
			$reguser='cart_'.$this->id;
		}
		else{
			$reguser=$_SESSION['reguser'].'_'.$this->id;
		}
		echo '<button onclick=deleteCookie("'.$reguser.'")>x</button>';
		echo '</div>';
	}

	function Sale()
	{
		try{

			$pdo=Tools::connect();
			$reguser='cart';
			if (isset($_SESSION['reguser']) && $_SESSION['reguser'] !='') {
				$reguser=$_SESSION['reguser'];
			}
			//увеличение поля total для таблички customers
			$rq1='UPDATE customers SET total = total + ? WHERE login = ?';
			$ps1=$pdo->prepare($rq1);
			$ps1->execute(array($this->pricesale,$reguser));
			$rq2='INSERT INTO sales(customername,itemname,pricein,pricesale,datesale)VALUES(?,?,?,?,?)';
			$ps2=$pdo->prepare($rq2);
			$ps2->execute(array($reguser,$this->itemname,$this->pricein,$this->pricesale,@date('Y/m/d H:i:s')));
		}
		catch(PDOException $e)
		{
			echo $e->getMessege();
			return false;
		}
	}

	function getPrice(){
		return $this->pricesale;
	}


	static function GetItems($sid=0)
	{
		$pdo=Tools::connect();
		$ps='';

		$items=array();
		if ($sid==0) {
			$ps=$pdo->prepare('SELECT * FROM items');
			$ps->execute();
		}
		else
		{
			$ps=$pdo->prepare('SELECT * FROM items WHERE subid=?');
			$ps->execute(array($sid));
		}
		
		
		while ($row=$ps->fetch()) 
		{
			$data=array(
				'id'=>$row['id'],
				'itemname'=>$row['itemname'],
				'catid'=>$row['catid'],
				'subid'=>$row['subid'],
				'pricein'=>$row['pricein'],
				'pricesale'=>$row['pricesale'],
				'info'=>$row['info'],
				'rate'=>$row['rate'],
				'imagepath'=>$row['imagepath'],
				'action'=>$row['action']
				);
			$i=new Item($data);
			$items[]=$i;
		}
		return $items;
	}
}
/////////////////////////////////////////////////

class User
{
	public $login, $pass;

	static function Login($login,$pass)
	{
		Tools::SetParam('localhost','root','123456','shop_db');
		$pdo=Tools::connect();

		$ps=$pdo->prepare('SELECT * FROM customers WHERE login="'.$login.'" AND pass="'.md5($pass).'"');
		$ps->execute(array($id));
		$row=$ps->fetch(PDO::FETCH_LAZY);
		return $row;
	}
}


?>