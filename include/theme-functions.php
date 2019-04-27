<?php
function theme_dir(){
	echo "http://localhost/mahdavi/";
}

function get_theme_dir(){
	return "http://localhost/mahdavi/";
}

function view_url($view){
	echo theme_dir() . $view;
}

function get_view_url($view){
	return get_theme_dir() . $view;
}

function page_title(){
	echo "حسابداری شخصی مهدوی";
}

function get_full_url(){
	$fullurl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $fullurl;
}

function check_active(){
	
}
?>