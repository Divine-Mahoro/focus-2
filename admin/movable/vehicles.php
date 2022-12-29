<?php 
$error_msg = '';
$success_msg = '';
$warning_msg = '';

if(isset($_POST['btnSubmit'])){
	//print_r($_POST);
	$vehicle_type_id = prepare_input($_POST['vehicle_type_id']);
	$asset_owner_id = prepare_input($_POST['asset_owner']);
	$asset_location_id = prepare_input($_POST['location']);
	$plate_no = prepare_input($_POST['plate_no']);	
	$asset_source = prepare_input($_POST['asset_source']);
	
	$joint_asset = prepare_input($_POST['jointopt']);
	$percentage_of_shares = 0;
	if(isset($_POST['percentage_of_shares']) && $_POST['percentage_of_shares'] > 0){
		$percentage_of_shares = prepare_input($_POST['percentage_of_shares']);
	}
	$is_bought = prepare_input($_POST['boughtopt']);
	$seller_name = prepare_input($_POST['seller_name']);
	$buying_price = 0;
	if(isset($_POST['buying_price']) && $_POST['buying_price'] > 0){
		$buying_price = prepare_input($_POST['buying_price']);
	}
	$by_loan = prepare_input($_POST['loanopt']);
	$bank_name = prepare_input($_POST['bank_name']);
	$installment = prepare_input($_POST['installment']);
	$loan_amount = 0;
	if(isset($_POST['loan_amount']) && $_POST['loan_amount'] > 0){
		$loan_amount = prepare_input($_POST['loan_amount']);
	}	
	$expected_loan_clear_date = '0000-00-00';
	if(isset($_POST['expected_loan_clear_date'])){
		$expected_loan_clear_date = prepare_input($_POST['expected_loan_clear_date']);
	}	
	$estimated_spent_amount = prepare_input($_POST['estimated_spent_amount']);
	$estimated_income = 0;
	if(isset($_POST['estimated_income']) && $_POST['estimated_income'] > 0){
		$estimated_income = prepare_input($_POST['estimated_income']);
	}	
	$movable_asset_id = prepare_input($_POST['movable_asset_id']);
	$insert_date = date('Y-m-d H:i:s');
	
	$qry = "INSERT INTO vehicle_declarations(
				   asset_type_id,
				   vehicle_type_id,
				   movable_asset_id,
				   employee_id,
				   declaration_period_id,
				   asset_location_id,
				   plate_no,
				   asset_owner_id,
				   asset_source,
				   joint_asset,
				   percentage_of_shares,
				   is_bought,
				   seller_name,
				   buying_price,
				   by_loan,
				   bank_name,
				   installment,
				   loan_amount,
				   expected_loan_clear_date,
				   estimated_spent_amount,
				   estimated_income,
				   declaration_date
					) VALUES (
						  '2',
						  '".$vehicle_type_id."',
						  '3',
						  '".$employee_id."',
						  '".getDeclarationPeriodId()."',
						  '".$asset_location_id."',
						  '".$plate_no."',
						  '".$asset_owner_id."',
						  '".$asset_source."',
						  '".$joint_asset."',
						  '".$percentage_of_shares."',
						  '".$is_bought."',
						  '".$seller_name."',
						  '".$buying_price."',
						  '".$by_loan."',
						  '".$bank_name."',
						  '".$installment."',
						  '".$loan_amount."',
						  '".$expected_loan_clear_date."',
						  '".$estimated_spent_amount."',
						  '".$estimated_income."',
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
					include("pages/movable/forms/vehicleForm.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM vehicle_declarations
								 WHERE vehicle_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/vehicleEditForm.php");
				} else {
					$query = "SELECT * FROM vehicle_declarations
							  WHERE employee_id = '".$_SESSION['employee']."'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
				

				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
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
								<div class="col-12">
									<div class="card">
									<div class="card-body">
									
										<div class="table-responsive my-3 align-items-center">
										<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=movable&page=vehicles&action=add"> Add</a></span></div>
                                    <table id="example2" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
												<th>Vehicle Type</th>
												<th>Plate Number</th>
												<th>Location</th>
                                                <th>Estimated Income</th>
                                                <th>Asset source</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
													$id = $row["vehicle_declaration_id"];
													echo '<tr>';
													if($row["vehicle_type_id"] == 1){
														echo '<td style="color:black">TOYOTA RUSH</td>';
													} else if($row["vehicle_type_id"] == 2) {
														echo '<td style="color:black">BENZ</td>';
													}else if($row["vehicle_type_id"] == 3) {
														echo '<td style="color:black">BMW</td>';
													}
													echo '<td style="color:black">'.$row["plate_no"].'</td>';
													if($row["asset_location_id"] == 1){
														echo '<td style="color:black">Rwanda</td>';
													} else {
														echo '<td style="color:black">Abroad</td>';
													}
													echo '<td style="color:black">'.$row["estimated_income"].'</td>';
													echo '<td style="color:black">'.$row["asset_source"].'</td>';
													echo '<input type="hidden" class="res_data" value="'.$id.'" />';
													echo '<td>';
													echo '<a href="staffUser.php?dir=movable&page=vehicles&rid='.$id.'" data-toggle="modal" data-target="#viewResidential"><span class="vehiclesId">view</span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													if($main_link == 'staff.php'){
														echo '<a href="editVehicles.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													}else{
														echo '<a href="editVehiclesUser.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													}
													echo '<a href="./pages/movable/deleteVehicle.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
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
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=movable&page=vehicles&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
							<div class="modal fade" id="viewResidential">
                                       
									   <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Vehicle Data view</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
													
													<div class="form-row my-2">
														
														<div class="col">Vehicle Type:</div>
														<div class="col vehicle_type_id"></div>
														
													</div>
													
													<div class="form-row my-2">
														
														<div class="col">Plate Number:</div>
														<div class="col plate_no"></div>
														
													</div>
													
													<div class="form-row my-2">
														
														<div class="col">Asset Owner:</div>
														<div class="col asset_owner_id"></div>
														
													</div>
                                                    
													<div class="form-row my-2">
														<div class="col">Asset Location:</div>
														<div class="col asset_location_id"></div>
														
													</div>
													
													<div class="form-row my-2">
														<div class="col">Asset source:</div>
														<div class="col asset_source"></div>
													</div>
																										
													<div class="form-row my-2">
														<div class="col">Joint:</div>
														<div class="col joint_asset"></div>
													</div>
													
													<div class="form-row my-2">
														<div class="col">Percentage of Share:</div>
														<div class="col percentage_of_shares"></div>
													</div>
                                                    
													<div class="form-row my-2">
														<div class="col">Is Bought Asset:</div>
														<div class="col is_bought"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Seller Name:</div>
														<div class="col seller_name"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Amount:</div>
														<div class="col buying_price"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Is Loan Asset:</div>
														<div class="col by_loan"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Bank Name:</div>
														<div class="col bank_name"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Installment:</div>
														<div class="col installment"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Loan Amount:</div>
														<div class="col loan_amount"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Date to clear loan:</div>
														<div class="col expected_loan_clear_date"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Estimated Spent Amount:</div>
														<div class="col estimated_spent_amount"></div>
													</div>
													<div class="form-row my-2">
														<div class="col">Estimated Income:</div>
														<div class="col estimated_income"></div>
													</div>
													
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
					
				</div>

