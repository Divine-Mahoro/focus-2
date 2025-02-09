            <?php 
                $error_msg = '';
                $success_msg = '';
                $warning_msg = '';
                
                if(isset($_POST['btnSubmit'])){
                    //print_r($_POST);
                    $company = prepare_input($_POST['company']);
                    $dividend = prepare_input($_POST['dividend']);
                    $asset_location_id = prepare_input($_POST['locationValue']);
					$insert_date = date('Y-m-d H:i:s');

                    $qry = "INSERT INTO shares_in_society(
                            employee_id,
                            declaration_period_id,
                            company,
                            dividend,
                            asset_location_id,
                            declaration_date
                    )VALUES(
                            '".$employee_id."',
                            '".getDeclarationPeriodId()."',
                            '".$company."',
                            '".$dividend."',
                            '".$asset_location_id."',
                            '".$insert_date."'
                            )";
                            if(getDeclarationPeriodId() != NULL){
								echo '<br>';
								echo $qry;
								$stmt = $dbh->prepare($qry);
								if($stmt->execute()){
									$success_msg = 'Record inserted successfully';
								} else {
									$error_msg = 'Error occurs while inserting record';
								}
							} else {
								$error_msg = 'It is not period of declaration now!';
							}	
                }

            ?>
       
            <?php if(!(isset($_GET['action']) and $_GET['action']=="add")){ ?>
				<?php } else { ?>
						
			    <?php } ?>

				<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/incorporeal/forms/sharesInSocietyForm.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM shares_in_society
								 WHERE gift_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/sharesInSocietyEditForm.php");
				} else {
					$query = "SELECT * FROM shares_in_society
							  WHERE employee_id = '".$_SESSION['employee']."'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
				

				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
				
							<div class="card-body">
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

								<?php if($stmt->rowCount() > 0){ ?>
								<?php echo $upd_qry;?>
								<div class="col-12">
									<div class="card">
									<div class="card-body">
									
										<div class="table-responsive my-3 align-items-center">
										<div><span class="pull-right btn btn-primary"><a href="staff.php?dir=incorporeal&page=sharesInSociety&action=add"> Add</a></span></div>
                                    <table id="example2" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Company</th>
												<th>Dividend</th>
                                                <th align="center">Location</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
													$id = $row["shares_in_society_id"];
													echo '<tr>';
													echo '<td style="color:black">'.$row["company"].'</td>';
													echo '<td style="color:black">'.$row["dividend"].'</td>';
													if($row["asset_location_id"] == 1){
														echo '<td style="color:black">Rwanda</td>';
													} else {
														echo '<td style="color:black">Abroad</td>';
													}
													echo '<input type="hidden" class="res_data" value="'.$id.'" />';
													echo '<td>';
													if($main_link == 'staffUser.php'){
														echo '<a href="editSharesInSocietyUser.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													} else {
														echo '<a href="editSharesInSociety.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													}
													echo '<a href="./pages/incorporeal/deleteShareInSociety.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
													echo '</td>';
													echo '</tr>';
												}
												
											?>
                                          
                                        </tbody>
										
                                       
                                   	 </table>
                               </div>
									</div>
									</div>
								</div>
								<?php
									} else {
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=incorporeal&page=sharesInSociety&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
					</div>
				</div>    
                