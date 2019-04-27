<?php
session_start();
include"include/theme-functions.php"; include"include/user-functions.php"; include"include/database.php"; include"include/functions.php";

if((isset($_GET['login']) && $_GET['login']=="ok")){
	$_SESSION['user_id'] = $_GET['id'];
	$id = $_GET['id'];
	$user_info = get_select_query("select * from users where ID=$id");
	$_SESSION['name'] = $user_info[0]['namee'];
	$_SESSION['family'] = $user_info[0]['family'];
	$_SESSION['username'] = $user_info[0]['username'];
	$_SESSION['level'] = $user_info[0]['level'];
}

if(isset($_GET['logout']) || !isset($_SESSION['user_id'])){
	$_SESSION = [];
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/select2.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.rtl.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.Bootstrap-PersianDateTimePicker.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/select2.min.js"></script>
	<script type="text/javascript" src="js/jquery.Bootstrap-PersianDateTimePicker.js"></script>
	<script type="text/javascript" src="js/jalaali.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>
	
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
	  	<div class="container-fluid">
	    	<div class="navbar-header">
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        		<span class="sr-only">داشبرد</span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	      		</button>
	      		<a class="navbar-brand" href="index.php">داشبرد</a>
	    	</div>
	    	<?php $basename = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
	    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      		<ul class="nav navbar-nav">
	        		<?php
	        		if($_SESSION['level']=="مدیر"){ ?>
	        		<li class="<?php if($basename=="items")echo 'active'; ?>"><a href="items.php">تعریف مستغلات و اشخاص</a></li>
	        		<?php
	        		} ?>
	        	
	        		<li class="<?php if($basename=="pay_persons" || $basename=="report_persons")echo 'active'; ?> dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">حساب اشخاص<span class="caret"></span></a>
	          			<ul class="dropdown-menu">
		            		<li><a href="pay_persons.php">ثبت پرداخت ها</a></li>
		            		<li><a href="report_persons.php">گزارش وضعیت</a></li>
	          			</ul>
	        		</li>

	        		<li class="<?php if($basename=="payments" || $basename=="report1")echo 'active'; ?> dropdown">
	          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">حساب مستغلات<span class="caret"></span></a>
	          			<ul class="dropdown-menu">
		            		<li><a href="payments.php">پرداخت ها</a></li>
		            		<li><a href="report1.php">گزارش وضعیت</a></li>
	          			</ul>
	        		</li>

	        		<?php
	        		if($_SESSION['level']=="مدیر"){ ?>
	        		<li class="<?php if($basename=="users")echo 'active'; ?>"><a href="users.php">حساب کاربری</a></li>
	        		<?php
	        		} ?>
	      		</ul>
	      		<ul class="nav navbar-nav navbar-right">
	      			<li>
	      				<a href="">
	      					سلام. <?php echo $_SESSION['name'] . " " . $_SESSION['family']; ?>
	      				</a>
	      			</li>
	        		<li><a href="<?php theme_dir(); ?>index.php?logout=yes">خروج از حساب کاربری</a></li>
	      		</ul>
	    	</div>
	  	</div>
	</nav>