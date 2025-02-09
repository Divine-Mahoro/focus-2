                <?php
							if(isset($_POST['btnSubmit'])){
								$role = prepare_input($_POST['role']);
								$employeeId= prepare_input($_POST['eid']);
								$upd_qry = "UPDATE EMPLOYEES SET 
											role = '".$role."' 
										   WHERE employee_id = '".$employeeId."'";
								
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
                    <div class="col-xl-6 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Changing Role</h4>
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
                                                     <option value="0">Select employee...</option>
													 <?php 
														
															foreach($dbh->query("select * from employees order by family_name") as $e){
																$eid = $e['employee_id'];
																$ename = $e['family_name'] . " " . $e['given_name'];
																echo '<option value="'.$eid.'">'.$ename.'</option>';
															}
														
														?>
                                                </select>
                                            </div>
											
											<div class="col-auto mb-2">
												<select class="custom-select mr-sm-2" name="role" id="role">
                                                     <option value="0">Select role...</option>
													 <option value="user">User</option>
													 <option value="admin">Admin</option>
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
