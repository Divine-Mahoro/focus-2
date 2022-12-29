<?php 
	$error_msg = '';
	$success_msg = '';
	$warning_msg = '';

if(isset($_POST['btnSubmit'])){
	//print_r($_POST);
	$movable_type = prepare_input($_POST['movable_type']);
	$asset_owner_id = prepare_input($_POST['asset_owner']);
	$asset_location_id = prepare_input($_POST['location']);
	$village_code = prepare_input($_POST['village']);
	$country = prepare_input($_POST['countryValue']);
	$city = prepare_input($_POST['cityValue']);
	$estimated_value = prepare_input($_POST['estimated_value']);	
	$asset_source = prepare_input($_POST['asset_source']);
	$date_of_acquisition = '0000-00-00';
	if(isset($_POST['date_of_acquisition'])){
		$date_of_acquisition = prepare_input($_POST['date_of_acquisition']);
	}
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
	
	$qry = "INSERT INTO other_movable_declarations(
				   asset_type_id,
				   movable_type,
				   movable_asset_id,
				   employee_id,
				   declaration_period_id,
				   asset_location_id,
				   country,
				   city,
				   asset_owner_id,
				   village_code,
				   estimated_value,
				   asset_source,
				   date_of_acquisition,
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
						  '".$movable_type."',
						  '5',
						  '".$employee_id."',
						  '".getDeclarationPeriodId()."',
						  '".$asset_location_id."',
						  '".$country."',
						  '".$city."',
						  '".$asset_owner_id."',
						  '".$village_code."',
						  '".$estimated_value."',
						  '".$asset_source."',
						  '".$date_of_acquisition."',
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
        <?php if(!(isset($_GET['action']) and $_GET['action']=="add")){ ?>
				
				<?php } else { ?>
						
			    <?php } ?>

				<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/movable/forms/otherMovableForm.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM other_movable_declarations
								 WHERE other_movable_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/otherMovableEditForm.php");
				} else {
					$query = "SELECT * FROM other_movable_declarations
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
										<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=movable&page=otherMovable&action=add"> Add</a></span></div>
                                    <table id="example2" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Movable type</th>
												<th>Country</th>
												<th>Location</th>
                                                <th>Estimated Value&nbsp;&nbsp; </th>
                                                <th>Asset source</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
													$id = $row["other_movable_declaration_id"];
													echo '<tr>';
													echo '<td style="color:black">'.$row["movable_type"].'</td>';
													echo '<td style="color:black">'.getAssetCountryOtherMovable($row["other_movable_declaration_id"]).'</td>';
													if($row["asset_location_id"] == 1){
														echo '<td style="color:black">'.getAssetLocationOtherMovable($row["other_movable_declaration_id"]).'</td>';
													} else {
														echo '<td style="color:black">'.getAssetCityOtherMovable($row["other_movable_declaration_id"]).'</td>';
													}
													echo '<td style="color:black">'.$row["estimated_value"].'</td>';
													echo '<td style="color:black">'.$row["asset_source"].'</td>';
													echo '<input type="hidden" class="res_data" value="'.$id.'" />';
													echo '<td>';
													echo '<a href="staff.php?dir=movable&page=otherMovable&rid='.$id.'" data-toggle="modal" data-target="#viewResidential"><span class="otherMovableId">view</span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													if($main_link == 'staffUser.php'){
														echo '<a href="editOtherMovableUser.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													} else {
														echo '<a href="editOtherMovable.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													}
													echo '<a href="./pages/movable/deleteOtherMovable.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
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
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=movable&page=otherMovable&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
							<div class="modal fade" id="viewResidential">
                                       
									   <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Other Movable Data view</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
													
													<div class="form-row my-2">
														
														<div class="col">Other Movable Type:</div>
														<div class="col movable_type"></div>
														
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
														<div class="col">Estimated Amount:</div>
														<div class="col estimated_value"></div>
													</div>
													
													<div class="form-row my-2">
														<div class="col">Asset source:</div>
														<div class="col asset_source"></div>
													</div>
													
													<div class="form-row my-2">
														<div class="col">Date of Aquisation:</div>
														<div class="col date_of_acquisition"></div>
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
                

