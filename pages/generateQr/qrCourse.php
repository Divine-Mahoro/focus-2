
					<? 
							
								
					?>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
                        <div class="card">
                            <div class="card-header">
							
                                <h4 class="card-title">Attande <?php $courseName; ?></h4>
								<?php 
								if(isset($_GET['success_msg']) && $_GET['success_msg'] != ''){
										echo '<p class="text-success">'.$_GET['success_msg'].'</p>';
									} else if(isset($_GET['warning_msg']) && $_GET['warning_msg'] != ''){
										echo '<p class="text-warning">'.$_GET['warning_msg'].'</p>';
									} else if(isset($_GET['error_msg']) && $_GET['error_msg'] != ''){
										echo '<p class="text-danger">'.$_GET['error_msg'].'</p>';
									} else if(isset($success_msg) && $success_msg != ''){
										echo '<p class="text-success">'.$success_msg.'</p>';
									} else if(isset($warning_msg) && $warning_msg != ''){
										echo '<p class="text-success">'.$warning_msg.'</p>';
									}  else if(isset($error_msg) && $error_msg != ''){
										echo '<p class="text-success">'.$error_msg.'</p>';
									}
								?>
                            </div>
                            <div class="card-body">
								<div id="qrbox" style="text-align: center;">
								<? 
									$id = $_GET['id'];
									$course = $_GET['course'];
									$textText= $id . ' - ' . $course;
								?>
									<input type="hidden" class="res_data" value="<?php echo $result; ?>" />
									<input type="hidden" class="res_data" value="<?php echo $userExplode; ?>" />
									<input type="hidden" class="res_data" value="<?php echo $couExplode; ?>" />
									<img src="generate.php?text=<?php echo $result; ?>" alt="">
								</div>
                            </div>
                        </div>
                    </div>
                </div>

			
            
        <script type="text/javascript">
		
		
		
		
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
		
		</script>