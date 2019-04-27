<?php include"header.php"; ?>

	<div class="container-fluid">
		
        
		<div class="col-md-6">
			<h3>حساب اشخاص</h3>
            <div class="well well-lg">
				<?php
                $list = array();
                $list_val = array();
                $res = get_select_query("select * from items where i_typee = 'اشخاص'");
                foreach($res as $row){
                    $h = 0;
                    $d = 0;
                    $t = 0;
                    array_push($list, $row['i_namee']);
                    $item = $row['i_id'];

                    $sql_t = "select * from hesab where (i_id = $item)";
                    $res_t = get_select_query($sql_t);
                    foreach($res_t as $row_t){
                        if($row_t['h_type']=="بدهکار"){
                            $h += $row_t['h_price'];
                        }else if($row_t['h_type']=="بستانکار"){
                            $d += $row_t['h_price'];
                        }
                    }
                    $t = $d - $h;
                    array_push($list_val, $t);
                }
                ?>
				<canvas id="myChart"></canvas>
				<script>
				var ctx = document.getElementById("myChart");
				var myChart = new Chart(ctx, {
    				type: 'bar',
    				data: {
        				labels: [
                            <?php foreach($list as $l){ ?>
                                "<?php echo $l; ?>",
                            <?php
                            } ?>
                        ],
        				datasets: [{
            			label: '',
            				data: [
                                <?php foreach($list_val as $v){ ?>
                                    <?php echo $v; ?>,
                                <?php
                                } ?>
                            ],
            				backgroundColor: [
                				'rgba(255, 99, 132, 0.2)',
                				'rgba(54, 162, 235, 0.2)',
                				'rgba(255, 206, 86, 0.2)',
                				'rgba(75, 192, 192, 0.2)',
                				'rgba(153, 102, 255, 0.2)',
                				'rgba(255, 159, 64, 0.2)'
            				],
            				borderColor: [
                				'rgba(255,99,132,1)',
                				'rgba(54, 162, 235, 1)',
                				'rgba(255, 206, 86, 1)',
                				'rgba(75, 192, 192, 1)',
                				'rgba(153, 102, 255, 1)',
                				'rgba(255, 159, 64, 1)'
            				],
            				borderWidth: 1
        				}]
    				},
    				options: {
        				scales: {
            				yAxes: [{
                			ticks: {
                    			beginAtZero:true
                			}
            			}]
        				}
    				}
				});
				</script>

			</div>
		</div>



        <div class="col-md-6">
            <h3>حساب مستغلات</h3>
            <div class="well well-lg">
                <?php
                $list = array();
                $list_val = array();
                $res = get_select_query("select * from items where i_typee = 'مستغلات'");
                foreach($res as $row){
                    $h = 0;
                    $d = 0;
                    $t = 0;
                    array_push($list, $row['i_namee']);
                    $item = $row['i_id'];

                    $sql_t = "select * from payments where (from_id = $item or to_id = $item)";
                    $res_t = get_select_query($sql_t);
                    foreach($res_t as $row_t){
                        if($row_t['p_typee']=="هزینه"){
                            $h += $row_t['p_price'];
                        }else if($row_t['p_typee']=="درآمد"){
                            $d += $row_t['p_price'];
                        }
                    }
                    $t = $d - $h;
                    array_push($list_val, $t);
                }
                ?>
                <canvas id="myChart1"></canvas>
                <script>
                var ctx = document.getElementById("myChart1");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php foreach($list as $l){ ?>
                                "<?php echo $l; ?>",
                            <?php
                            } ?>
                        ],
                        datasets: [{
                        label: '',
                            data: [
                                <?php foreach($list_val as $v){ ?>
                                    <?php echo $v; ?>,
                                <?php
                                } ?>
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                        }
                    }
                });
                </script>

            </div>
        </div>




	</div>

<?php include"footer.php"; ?>