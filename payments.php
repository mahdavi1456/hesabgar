<?php include"header.php"; ?>

	<div class="container-fluid">
		<h2>مدیریت پرداخت ها</h2>
		<hr>
		<form action="" method="post" class="form">
			<?php
			$p_typee = "";
			$p_price = "";
			$p_datee = "";
			$from_id = "";
			$to_id = "";

			if(isset($_POST['edit-payment-table'])){
				$p_id = $_POST['edit-payment-table'];
				$res = get_select_query("select * from payments where p_id = $p_id");
				$p_typee = $res[0]['p_typee'];
				$p_price = number_format($res[0]['p_price']);
				$p_datee = eng_number($res[0]['p_datee']);
				$from_id = $res[0]['from_id'];
				$to_id = $res[0]['to_id'];
			}
			?>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<h4>نوع پرداخت</h4>
					<select name="p_typee" class="form-control">
						<option <?php if($p_typee=="هزینه")echo "selected"; ?> style="background: red; color: #fff;">هزینه</option>
						<option <?php if($p_typee=="درآمد")echo "selected"; ?> style="background: #00e732; color: #fff;">درآمد</option>
					</select>
				</div>
				<div class="col-md-4 col-sm-6">
					<h4>مبلغ به تومان</h4>
					<input name="p_price" class="number form-control" type="text" placeholder="مثلا 500.000" value="<?php echo $p_price; ?>">
				</div>
				<div class="col-md-4 col-sm-6">
					<h4>تاریخ</h4>
                	<div class="form-group">
        				<label class="sr-only" for="exampleInput1">تاریخ و زمان</label>
        				<div class="input-group">
        				    <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#exampleInput3" data-mdpersiandatetimepicker="" data-enabletimepicker="false" data-mdformat="yyyy/MM/dd" data-mdpersiandatetimepickershowing="false">
                			<span class="glyphicon glyphicon-calendar"></span>
            				</div>
            				<input value="<?php echo $p_datee; ?>" name="p_datee" type="text" class="form-control" id="exampleInput3" placeholder="تاریخ" data-englishnumber="true" data-mdpersiandatetimepicker="" data-enabletimepicker="false" data-mdformat="yyyy/MM/dd" data-mdpersiandatetimepickershowing="false">
        			</div>
    				</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<h4>از حساب</h4>
					<select name="from_id" class="select2 form-control">
						<?php
						$items = get_select_query("select * from items");
						foreach($items as $item){
						?>
						<option <?php if($from_id==$item['i_id'])echo "selected"; ?> value="<?php echo $item['i_id']; ?>"><?php echo $item['i_namee']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-4 col-sm-6">
					<h4>به حساب</h4>
					<select name="to_id" class="select2 form-control">
						<?php
						$items = get_select_query("select * from items");
						foreach($items as $item){
						?>
						<option <?php if($to_id==$item['i_id'])echo "selected"; ?> value="<?php echo $item['i_id']; ?>"><?php echo $item['i_namee']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-4 text-center margin-top30">
					<?php
					if(isset($_POST['edit-payment-table'])){ ?>
					<button value="<?php echo $_POST['edit-payment-table']; ?>" name="edit-payment" class="btn btn-warning btn-lg">ویرایش اطلاعات</button>
					<?php
					} else {
					?>
					<button name="set-payment" class="btn btn-success btn-lg">ثبت اطلاعات</button>
					<?php
					} ?>
				</div>

				<div class="col-md-12">
					<?php
					if(isset($_POST['set-payment'])){
						$p_typee = $_POST['p_typee'];
						$p_price = str_replace(',', '', $_POST['p_price']);
						$p_datee = eng_number($_POST['p_datee']);
						$from_id = $_POST['from_id'];
						$to_id = $_POST['to_id'];
						ex_query("insert into payments(p_typee, p_price, p_datee, from_id, to_id) values('$p_typee', '$p_price', '$p_datee', $from_id, $to_id)");
						?><br>
						<div class="alert alert-success">
							مورد با موفقیت ثبت شد
						</div>
						<script type="text/javascript">
							window.location.reload();
							return;
						</script>
						<?php
					}

					if(isset($_POST['edit-payment'])){
						$p_id = $_POST['edit-payment'];
						$p_typee = $_POST['p_typee'];
						$p_price = str_replace(',', '', $_POST['p_price']);
						$p_datee = eng_number($_POST['p_datee']);
						$from_id = $_POST['from_id'];
						$to_id = $_POST['to_id'];
						ex_query("update payments set p_typee = '$p_typee', p_price = '$p_price', p_datee = '$p_datee', from_id = $from_id, to_id = $to_id where p_id = $p_id");
						?><br>
						<div class="alert alert-warning">
							مورد با موفقیت ویرایش شد
						</div>
						<script type="text/javascript">
							window.location.reload();
							return;
						</script>
						<?php
					}

					if(isset($_POST['del-payment'])){
						$p_id = $_POST['del-payment'];
						ex_query("delete from payments where p_id = $p_id");
						?><br>
						<div class="alert alert-success">
							مورد با موفقیت حذف شد
						</div>
						<script type="text/javascript">
							window.location.reload();
							return;
						</script>
					<?php
					}
					?>
				</div>
			</div>
		</form>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h4 class="panel-title">جدول پرداخت ها</h4>
					</div>
				<table class="table table-striped">
					<tr>
						<th>ردیف</th>
						<th>نوع پرداخت</th>
						<th>مبلغ</th>
						<th>تاریخ</th>
						<th>از حساب</th>
						<th>به حساب</th>
						<th>مدیریت</th>
					</tr>
					<?php
					$i = 1;
					$res = get_select_query("select * from payments");
					if(count($res)>0){
						foreach($res as $row){
							if($row['p_typee']=="هزینه"){ ?>
							<tr style="background: red; color: #fff;">
							<?php } else { ?>
							<tr style="background: #00e732; color: #fff;">
							<?php
							} ?>
								<td><?php echo per_number($i); ?></td>
								<td><?php echo $row['p_typee']; ?></td>
								<td><?php echo per_number(number_format($row['p_price'])); ?></td>
								<td><?php echo per_number($row['p_datee']); ?></td>
								<td><?php echo get_item_name($row['from_id']); ?></td>
								<td><?php echo get_item_name($row['to_id']); ?></td>
								<td>
									<form action="" method="post">
										<button onclick="confirm('آیا از حذف این مورد اطمینان دارید؟')" name="del-payment" value="<?php echo $row['p_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
										<button name="edit-payment-table" value="<?php echo $row['p_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
									</form>
								</td>
							</tr>
							<?php
							$i++;
						}
					} else { ?>
						<tr>
							<td class="text-center" colspan="6">موردی جهت نمایش موجود نیست</td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php include"footer.php"; ?>