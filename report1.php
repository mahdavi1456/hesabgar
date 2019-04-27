<?php include"header.php"; ?>
	<div class="container-fluid">
		<h2>گزارش وضعیت مستغلات</h2>
		<hr>
		<?php
		if(isset($_POST['item'])){
			$iitem = $_POST['item'];
		}else{
			$iitem = "";
		}
		if(isset($_POST['month'])){
			$month = $_POST['month'];
		}else{
			$month = "";
		}
		if(isset($_POST['year'])){
			$year = $_POST['year'];
		}else{
			$year = "";
		}
		?>
		<form action="" method="post" class="form">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<h4>گزارش مربوط به</h4>
					<select name="item" class="select2 form-control">
						<?php
						$items = get_select_query("select * from items");
						foreach($items as $item){
						?>
						<option <?php if($iitem==$item['i_id'])echo "selected"; ?> value="<?php echo $item['i_id']; ?>"><?php echo $item['i_namee']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3 col-sm-6">
					<h4>ماه</h4>
					<select name="month" class="select2 form-control">
						<option <?php if($month=="01")echo "selected"; ?> value="01">فروردین</option>
						<option <?php if($month=="02")echo "selected"; ?> value="02">اردیبهشت</option>
						<option <?php if($month=="03")echo "selected"; ?> value="03">خرداد</option>
						<option <?php if($month=="04")echo "selected"; ?> value="04">تیر</option>
						<option <?php if($month=="05")echo "selected"; ?> value="05">مرداد</option>
						<option <?php if($month=="06")echo "selected"; ?> value="06">شهریور</option>
						<option <?php if($month=="07")echo "selected"; ?> value="07">مهر</option>
						<option <?php if($month=="08")echo "selected"; ?> value="08">آبان</option>
						<option <?php if($month=="09")echo "selected"; ?> value="09">آذر</option>
						<option <?php if($month=="10")echo "selected"; ?> value="10">دی</option>
						<option <?php if($month=="11")echo "selected"; ?> value="11">بهمن</option>
						<option <?php if($month=="12")echo "selected"; ?> value="12">اسفند</option>
					</select>
				</div>
				<div class="col-md-3 col-sm-6">
					<h4>سال</h4>
					<select name="year" class="select2 form-control">
						<?php
						for($i=1380; $i<=1500; $i++){ ?>
						<option <?php if($year==$i)echo "selected"; ?>><?php echo $i; ?></option>
						<?php
						} ?>
					</select>
				</div>
				<div class="col-md-3 text-center margin-top30">
					<button name="search" class="btn btn-success btn-lg">گزارش تاریخ</button>
					<button name="show-all" class="btn btn-primary btn-lg">گزارش همه</button>
				</div>
			</div>	
		</form>
		
		<hr>

		<h4>
		<?php
		if(isset($_POST['search'])){ ?>
			<p style="float: right">گزارش <?php echo get_item_name($_POST['item']); ?> مربوط به ماه <?php echo per_number($_POST['month']); ?> سال <?php echo per_number($_POST['year']); ?>
			</p>
			<?php
		}
		if(isset($_POST['show-all'])){ ?>
			<p style="float: right">گزارش <?php echo get_item_name($_POST['item']); ?>
			</p>
			<?php
		}
		?>
		</h4>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h4 class="panel-title">جدول گزارش</h4>
					</div>
					<table class="table table-striped">
						<tr>
							<th>ردیف</th>
							<th>نوع پرداخت</th>
							<th>مبلغ</th>
							<th>تاریخ</th>
							<th>از حساب</th>
							<th>به حساب</th>
						</tr>
						<?php
						$i = 1;
						$h = 0;
						$d = 0;
						if(isset($_POST['search'])){
							$item = $_POST['item'];
							$dt = $_POST['year'] . "/" . $_POST['month'];
							$sql = "select * from payments where (from_id = $item or to_id = $item) and p_datee like '%" . $dt . "%'";
							$res = get_select_query($sql);
						}
						if(isset($_POST['show-all'])){
							$item = $_POST['item'];
							$sql = "select * from payments where (from_id = $item or to_id = $item)";
							$res = get_select_query($sql);
						}
						if(isset($_POST['search']) || isset($_POST['show-all'])){
						if(count($res)>0){
							foreach($res as $row){
								if($row['p_typee']=="هزینه"){ ?>
									<tr style="background: red; color: #fff;">
									<?php } else { ?>
									<tr style="background: #00e732; color: #fff;">
									<?php
									}
									if($row['p_typee']=="هزینه"){
										$h += $row['p_price'];
									}else if($row['p_typee']=="درآمد"){
										$d += $row['p_price'];
									}
									?>
										<td><?php echo per_number($i); ?></td>
										<td><?php echo $row['p_typee']; ?></td>
										<td><?php echo per_number(number_format($row['p_price'])); ?> تومان</td>
										<td><?php echo per_number($row['p_datee']); ?></td>
										<td><?php echo get_item_name($row['from_id']); ?></td>
										<td><?php echo get_item_name($row['to_id']); ?></td>
									</tr>
								<?php
								$i++;
							}
						?>
						<tr style="font-size: 20px;">
							<th>جمه هزینه ها: </th><td><?php echo per_number(number_format($h)); ?> تومان</td>
							<th>جمه درآمد ها: </th><td><?php echo per_number(number_format($d)); ?> تومان</td>
							<th>تراز: </th>
							<?php $t = $d - $h; ?>
							<td style="background: <?php if($t<0) echo "red"; else echo "#00e732"; ?>; color: #fff"><?php echo per_number(number_format($t)); ?></td>
						</tr>
					<?php
					} else { ?>
					<tr><td class="text-center" colspan="7">موردی جهت نمایش موجود نیست</td></tr>
					<?php
					}
					}
					?>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php include"footer.php"; ?>