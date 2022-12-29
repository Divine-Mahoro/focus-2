                <?php
							if(isset($_POST['btnReset'])){
								//print_r($_POST);
							  $user= prepare_input($_POST['user']);
							  $sql = "SELECT * FROM register_user where register_user_id='$user'";
							  $stmt = $dbh->prepare($sql);
							  $stmt->execute();
							if($stmt->rowCount()){
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
								$account_status = $row['status'];
								
								if($account_status == "Disable"){
									$error_msg = '
											<div class="text-danger" style="margin-left: 15px;">Account is Disabled</div>
										';
								}else{
									$user = $row['register_user_ID'];
									$qryUpd = "UPDATE register_user 
											   SET PASSWORD='".$user."' 
											   WHERE register_user_id = '".$user."'";
									$stmtUpd = $dbh->prepare($qryUpd);
									
									if($stmtUpd->execute()){
										$success_msg = 'Password reset success updated';
									} else {
										$warning_msg = 'Error. Reset password failure.';
									}
								}
								
							} else {
									 $error_msg = '
											<div class="text-danger" style="margin-left: 15px;">Wrong ID. Please enter user valid ID</div>
										';
							}
						}
							//echo $upd_qry;
				?>
				<!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reset User Password</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=Admin&page=resetUserPassword" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											<!-- <input type="text" id="search_employee" /> -->
												<div class="form-group col-md-3">
													<label>Employee ID</label>
													<input type="text" name="user" id="user" class="form-control" required>
												</div>
											
                                        </div>
                                        <button type="submit" name="btnReset" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        
