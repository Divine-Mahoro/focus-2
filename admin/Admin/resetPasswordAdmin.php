                <?php
							if(isset($_POST['btnReset'])){
								//print_r($_POST);
							  $employee_id= prepare_input($_POST['employee_id']);
							  $sql = "SELECT * FROM employees where employee_id='$employee_id'";
							  $stmt = $dbh->prepare($sql);
							  $stmt->execute();
							if($stmt->rowCount()){
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
								$account_status = $row['account_status'];
								
								if($account_status == "Disabled"){
									$error_msg = '
											<div class="text-danger" style="margin-left: 15px;">Account is Disabled</div>
										';
								}else{
									$employee_id = $row['employee_id'];
									echo "<script>location.assign('sendEmailResetPassword.php')</script>";
								}
								
							} else {
									 $error_msg = '
											<div class="text-danger" style="margin-left: 15px;">Wrong ID. Please enter valid ID</div>
										';
							}
						}
							echo $upd_qry;
				?>
				<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reset Employee Password</h4>
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
                                <div class="basic-form">
                                    <form action="sendEmailResetPassword.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											<!-- <input type="text" id="search_employee" /> -->
												<div class="form-group col-md-3">
													<label>Employee ID</label>
													<input type="text" name="employee_id" id="employee_id" class="form-control" required>
												</div>
											
                                        </div>
                                        <button type="submit" name="btnReset" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        
