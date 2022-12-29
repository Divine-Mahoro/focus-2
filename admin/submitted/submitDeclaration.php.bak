<?php
$error_msg = '';
$success_msg = '';
$warning_msg = '';

							if(isset($_POST['btnSubmit'])){
								$year_val = getFieldValueById("year","declaration_periods",getDeclarationPeriodId());
								$insert_date = date('Y-m-d H:i:s');
								if(isset($_FILES['file'])){
									$file_name = $_FILES['file']['name'];
									$file_tmp_name = $_FILES['file']['tmp_name'];
									$file_type = $_FILES['file']['type'];
									$file_size = $_FILES['file']['size'];
									$file_error = $_FILES['file']['error'];					
												
									$allowedFileTypes = array("jpeg","jpg","png","pdf");              
									$fileExt = explode('.',$file_name);
									$fileActualExt = strtolower(end($fileExt));
									$file_upload_msg = '';   
									if(in_array($fileActualExt,$allowedFileTypes)){
										if($file_error === 0){
											if($file_size < 5242880){
												$fileNameNew = uniqid('',true).".".$fileActualExt;
												$user_dir = "signature/".$employee_id;
												if (!is_dir($user_dir))
												{
													mkdir($user_dir);
												}
												
												$fileDestination = $user_dir."/".$fileNameNew;
																	
												if(move_uploaded_file($file_tmp_name, $fileDestination)){ // Upload file file in specified directory
													$file_upload_msg .= $file_name . " upload is complete.<br />";
													
													$qry = "INSERT INTO submitted_declarations(
															declaration_period_id,
															employee_id,
															document_name,
															document_type,
															document_size,
															document_path,
															year,
															declaration_date
															) VALUES (
															'".getDeclarationPeriodId()."',
															'".$employee_id."',
															'".$fileNameNew."',
															'".$file_type."',
															'".$file_size."',
															'".$fileDestination."',
															'".$year_val."',
															'".$insert_date."'
															)";
													
													
													if(getDeclarationPeriodId() != NULL){
														$stmt = $dbh->prepare($qry);
														if($stmt->execute()){
															$success_msg = 'Record submitted successfully';
															session_start();
															session_destroy();
															//echo "<meta http-equiv='refresh' content='0;url=staff.php?dir=movable&page=gift&movable_asset_id=2&success_msg=".$success_msg."'>";
															echo "<script>location.assign('submitSuccess.php?employee=".$employee_id."')</script>";
														} else {
															$error_msg = 'Error occurs while inserting record';
														}
													} else {
														$error_msg = 'It is not period of declaration now!';
													}							
													
												} else {
													$error_msg = "move_uploaded_file function failed for " . $file_name . "<br />";
												}
											} else {
												$error_msg = "Your file is too big! (".($file_size/1024)." KB)<br />";
											}
										} else {
											$error_msg = "There was an error uploading your file!<br />";
										}
									} else {
										//$error_msg = "You cannot upload files of this type!<br />";
										$error_msg = $file_name;
									}
								} else { $error_msg = "No file"; }
							}

?>
						
						<div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Terms and Condition</h4>
                            </div>
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
										echo '<p class="text-warning">'.$warning_msg.'</p>';
									}  else if(isset($error_msg) && $error_msg != ''){
										echo '<p class="text-danger">'.$error_msg.'</p>';
									}
								?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php echo $main_link; ?>?dir=submitted&page=submitDeclaration" method="POST" enctype="multipart/form-data" name="rsForm" id="rsForm">
                                        <div class="form-group">
                                            <p style="color:black">By checking the bellow box you're accepting the use of all Submitted i as per required by Quality Assurance to check everthing related to the information you had provided
										 Please check the button to submitte al declaration as per required! </p>
										 <p style="color:black">Not that once you submitte these information there's no more edit or change to the provided information</p>
                                        </div>
										
										<div class="form-group">
											<div class="form-row col-md-6">
												<label for="myFile"> Upload Signature <span style="color: red; font-size: 16px;">*</span> </label>
												<input type="file" class="form-control" id="myFile" name="file" required />(Allowed format: .jpg, .jpeg and .png) Maximum File size: 5MB
											</div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="trmsCondition" id="trmsCondition" value="1" type="checkbox" required>
                                                <label class="form-check-label">
                                                    Accept terms and Condition
                                                </label>
                                            </div>
                                        </div>
										<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>