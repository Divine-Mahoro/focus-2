<?php 
                    $error_msg = '';
                    $success_msg = '';
                    $warning_msg = '';
                    $immovable_asset_id = $immov_id;
                    if(isset($_GET['movable_asset_id'])){
                        $movable_asset_id = $_GET['immov_id'];
                    } else if(isset($_POST['immovable_asset_id'])){
                        $movable_asset_id = $_POST['immov_id'];
                    }

                    if(isset($_POST['btnSubmit'])){
                        //print_r($_POST);
                        $bank_name = prepare_input($_POST['bank_name']);
                        $account_number = prepare_input($_POST['account_number']);
                        $balance = prepare_input($_POST['balance']);
                        $currency_amount = prepare_input($_POST['currency_amount']);
                        $money_in_contract = prepare_input($_POST['money_in_contract']);
						$insert_date = date('Y-m-d H:i:s');
                       
                        $qry = "INSERT INTO money_declarations(
                                            employee_id,
                                            movable_asset_id,
                                            asset_type_id,
                                            declaration_period_id,
                                            asset_owner_id,
                                            asset_location_id,
                                            bank_name,
                                            account_number,
                                            currency_amount,
                                            money_in_contract,
                                            balance,
                                            declaration_date
                                            )
                                            VALUES (
                                                '".$employee_id."',
                                                4,
                                                2,
                                                '".getDeclarationPeriodId()."',
                                                1,
                                                1,
                                                '".$bank_name."',
                                                '".$account_number."',
                                                '".$currency_amount."',
                                                '".$money_in_contract."',
                                                '".$balance."',
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
					include("pages/movable/forms/moneyForm.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM money_declarations
								 WHERE money_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/moneyEditForm.php");
				} else {
					$query = "SELECT * FROM money_declarations
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
										<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=movable&page=money&action=add"> Add</a></span></div>
                                    <table id="example2" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
												<th>Bank Name</th>
												<th>Account Number</th>
												<th>Amount in RWF</th>
                                                <th>Amount in Currency</th>
                                                <th>Money on Contract</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
													$id = $row["money_declaration_id"];
													
													echo '<tr>';
													echo '<td style="color:black">'.$row["bank_name"].'</td>';
													echo '<td style="color:black">'.$row["account_number"].'</td>';
													echo '<td style="color:black">'.$row["balance"].'</td>';
													echo '<td style="color:black">'.$row["currency_amount"].'</td>';
													echo '<td style="color:black">'.$row["money_in_contract"].'</td>';
													echo '<input type="hidden" class="res_data" value="'.$id.'" />';
													echo '<td>';
													if($main_link == 'staff.php'){
														echo '<a href="editMoney.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													} else {
														echo '<a href="editMoneyUser.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
													}
													echo '<a href="./pages/movable/deleteMoney.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
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
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=movable&page=money&action=add"> Add</a></span></div>';
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
				</div>
        
                