<?php
include"jdf.php";
function ex_query($sql){
	/*
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemadgrou_db;charset=utf8", 'etemadgrou_db', 'bPc3BPRt0',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	*/
	$pdo_conn = new PDO("mysql:host=localhost;dbname=online_ac;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	
	$pdo_statement = $pdo_conn->prepare($sql);
	$pdo_statement->execute();
}

function get_select_query($sql){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=online_ac;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare($sql);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	return $result;
}

function check_login($username, $password){
	$res = get_select_query("select * from users where username='$username' and password='$password'");
	return count($res);
}

function alert($type, $msg){
	?>
	<div class="alert alert-<?php echo $type; ?> alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $msg; ?>
    </div>
	<?php
}

function get_item_name($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=online_ac;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select i_namee from items where i_id = $id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_product_name($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select name from product where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_product_unit($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select unit from product where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_product_price($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select price from product where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_product_va($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select va from product where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}


function get_customer_name($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select name, family from customer where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0] . " " .$result[0][1];
	}
}

function get_storage_name($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select name from storage where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_user_name($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select namee, family from users where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0] . " " .$result[0][1];
	}
}
function get_user_level($id){
	$pdo_conn = new PDO("mysql:host=localhost;dbname=etemad;charset=utf8", 'root', '',
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$pdo_statement = $pdo_conn->prepare("select level from users where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function per_number($number)
{
    return str_replace(
        range(0, 9),
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
        $number
    );
}

function eng_number($number)
{
    return str_replace(
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
        range(0, 9),
        $number
    );
}
?>