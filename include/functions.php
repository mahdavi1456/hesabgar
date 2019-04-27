<?php
function timeDiff($time2, $time1){
	$list2 = explode('/', $time2);
    $time2 = jalali_to_gregorian($list2[0], $list2[1], $list2[2], '-');
    $list1 = explode('/', $time1);
    $time1 = jalali_to_gregorian($list1[0], $list1[1], $list1[2], '-');
    $diff = strtotime($time2) - strtotime($time1);
	return ($diff / 3600) / 24;
}

function add_to_datee($datee, $add){
	$list2 = explode('/', $datee);
    $date2 = jalali_to_gregorian($list2[0], $list2[1], $list2[2], '-');
   	return jdate('Y/m/d', strtotime($date2 . ' + ' . $add . ' days'));
}

if(isset($_POST['add_to_datee'])){

	$datee = $_POST['datee'];

	$add = $_POST['add'];

	echo add_to_datee($datee, $add);

	exit();

}

if(isset($_POST['minus_from_datee'])){

	$datee2 = $_POST['datee2'];

	$datee1 = $_POST['datee1'];

	echo timeDiff($datee2, $datee1);

	exit();

}



if(isset($_POST['get_price'])){

	$id = $_POST['id'];

	$price_list = get_select_query("select * from product where ID=$id");

	echo "<div style='width: 90%; margin: 5px 5%;' class='text-center alert alert-info'>";

	echo "قیمت واریزی: " .  number_format($price_list[0]['vprice']) . "&nbsp&nbsp&nbsp";

	echo "قیمت همکار: " .  number_format($price_list[0]['hprice']) . "&nbsp&nbsp&nbsp";

	echo "قیمت پایه: " .  number_format($price_list[0]['bprice']) . "&nbsp&nbsp&nbsp";

	$level = $_SESSION['level'];

	if($level=="مدیر"){

		echo "قیمت تمام شده: " .  number_format($price_list[0]['eprice']);

	}

	echo "</div><br>";

	exit();

}



function convert_number($number) {

    $ones = array("", "یک",'دو&nbsp;', "سه", "چهار", "پنج", "شش", "هفت", "هشت", "نه", "ده", "یازده", "دوازده", "سیزده", "چهارده", "پانزده", "شانزده", "هفده", "هجده", "نونزده");

        $tens = array("", "", "بیست", "سی", "چهل", "پنجاه", "شصت", "هفتاد", "هشتاد", "نود");

        $tows = array("", "صد", "دویست", "سیصد", "چهار صد", "پانصد", "ششصد", "هفتصد", "هشت صد", "نه صد");

       	if (($number < 0) || ($number > 999999999)) {

			throw new Exception("Number is out of range");

		}

		$Gn = floor($number / 1000000);

		/* Millions (giga) */

		$number -= $Gn * 1000000;

		$kn = floor($number / 1000);

		/* Thousands (kilo) */

		$number -= $kn * 1000;

		$Hn = floor($number / 100);

		/* Hundreds (hecto) */

		$number -= $Hn * 100;

		$Dn = floor($number / 10);

		/* Tens (deca) */

		$n = $number % 10;

		/* Ones */

		$res = "";

		if ($Gn) {

			$res .= convert_number($Gn) .  " میلیون و ";

		}

		if ($kn) {

			$res .= (empty($res) ? "" : " ") . convert_number($kn) . " هزار و";

		}

		if ($Hn) {

			$res .= (empty($res) ? "" : " ") . $tows[$Hn] . " و ";

		}

		if ($Dn || $n) {

			if (!empty($res)) {

				$res .= "";

			}

			if ($Dn < 2) {

				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= " و " . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "صفر";
		}
		$res=rtrim($res," و");
		return $res;
}

?>