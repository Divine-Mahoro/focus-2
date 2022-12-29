        <?php 
            $error_msg = '';
            $success_msg = '';
            $warning_msg = '';
            
            if(isset($_GET['movable_asset_id'])){
                $movable_asset_id = $_GET['movable_asset_id'];
            } else if(isset($_POST['movable_asset_id'])){
                $movable_asset_id = $_POST['movable_asset_id'];
            }

            if(isset($_POST['btnSubmit'])){
                //print_r($_POST);
                $gift_type = prepare_input($_POST['gift_type']);
                $estimated_value = prepare_input($_POST['estimated_value']);
                $donor = prepare_input($_POST['donor']);
				$insert_date = date('Y-m-d H:i:s');

				$qry = "INSERT INTO gift_declarations(
                    movable_asset_id,
                    asset_type_id,
                    employee_id,
                    declaration_period_id,
                    gift_type,
                    estimated_value,
                    donor,
                    declaration_date
                     )
                    values(
                        2,
                        2,
						'".$employee_id."',
                        '".getDeclarationPeriodId()."',
                        '".$gift_type."',
                        '".$estimated_value."',
                        '".$donor."',
                        '".$insert_date."'
                        )";	

                        if(getDeclarationPeriodId() != NULL){
							echo '<br>';
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
       
                <?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/movable/forms/giftForm.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM gift_declarations
								 WHERE gift_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/livestockEditForm.php");
				} else {
					$query = "SELECT * FROM gift_declarations
							  WHERE employee_id = '".$_SESSION['employee']."'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
				

				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
					<!--<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=movable&page=gift&action=add"> Add</a></span></div>-->
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
										<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=movable&page=gift&action=add"> Add</a></span></div>
											<table id="example2" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>Gift Type</th>
														<th>Estimated Value</th>
														<th align="center">Donor</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
															$id = $row["gift_declaration_id"];
															echo '<tr>';
															echo '<td style="color:black">'.$row["gift_type"].'</td>';
															echo '<td style="color:black">'.$row["estimated_value"].'</td>';
															echo '<td style="color:black">'.$row["donor"].'</td>';
															
															echo '<td>';
															if($main_link == 'staff.php'){
																echo '<a href="editGift.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
															}else{
																echo '<a href="editGiftUser.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
															}
															echo '<a href="./pages/movable/deleteGift.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
															echo '</td>';
															echo '<input type="hidden" class="res_data" value="'.$id.'" />';
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
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=movable&page=gift&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
					</div>
				</div>
                
        <!--**********************************
            Content body end
        ***********************************-->
