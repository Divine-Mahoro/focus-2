                <?php
							if(isset($_POST['btnSubmit'])){
								$account_status = prepare_input($_POST['account_status']);
								$user= prepare_input($_POST['eid']);
								$upd_qry = "UPDATE register_user SET 
											STATUS = '".$account_status."' 
										   WHERE register_user_ID = '".$user."'";
								
								$stmt = $dbh->prepare($upd_qry);
								if($stmt->execute()){
									$success_msg = 'Record Updated successfully';
									echo "<meta http-equiv='refresh' content='0;url=staff.php?dir=Admin&page=addingRole&success_msg=".$success_msg."'>";
									//header("Location:submitSuccess.php");
								} else {
									$error_msg = 'Updation failed';
									echo "<meta http-equiv='refresh' content='0;url=staff.php?dir=Admin&page=addingRole&error_msg=".$error_msg."'>";
								}
							}
							echo $upd_qry;
				?>
				<!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lock / Unlock user</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=Admin&page=addingRole" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
									
											
											<div class="col-auto mb-2">
												<select class="custom-select mr-sm-2" name="eid" id="role">
                                                     <option value="0">Select user...</option>
													 <?php 
														
															foreach($dbh->query("select * from register_user order by name") as $e){
																$id = $e['register_user_ID'];
																$name = $e['NAME'];
																echo '<option width="20%" style="color:black" value="'.$id.'">'.$name.'</option>';
															}
														
													?>
                                                </select>
                                            </div>
											
											<div class="col-auto mb-2">
												<select class="custom-select mr-sm-2" name="account_status" id="role">
                                                     <option value="0">Select status...</option>
													 <option value="Disabled">Disable</option>
													 <option value="Enabled">Enable</option>
                                                </select>
                                            </div>
                                            
                                        </div>
										
                                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					
					
                    
                </div>
            
        <script type="text/javascript">
		
		function getDetails(){
			let role = document.forms["rsForm"]["role"].value;
			let id = document.forms["rsForm"]["employees"].value;
			alert("selected Employee id:"+id);
			if(id == ""){
				alert("Please select of Employee");
				return false;
			}
			if(role == "0"){
				alert("Please select role of Employee");
				return false;
			}
		}
		
		</script>
