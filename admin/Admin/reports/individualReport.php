<?php 
$error_msg = '';
$success_msg = '';
$warning_msg = '';

$insert_msg = '';
if(isset($_POST['btnRetrieve'])){
      //print_r($_POST);
      $employee_id= prepare_input($_POST['employee_id']);
  
	  $sql = "SELECT * FROM employees where employee_id='$employee_id'";
	  $stmt = $dbh->prepare($sql);
	  $stmt->execute();
    if($stmt->rowCount()){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        $employee_id = $row['employee_id'];
		
		
	}else{
		$error_msg = '
					<div class="text-danger" style="margin-left: 15px;">Error! User does not exist.</div>
				';
	}
}
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
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header d-block">
                                <h4 class="card-title">Individual Asset Declaration</h4>
                            </div>
							<div class="card-body">
								<form action="#" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											<!-- <input type="text" id="search_employee" /> -->
												<div class="form-group col-md-3">
													<label>Employee ID</label>
													<input type="text" name="employee_id" id="employee_id" class="form-control" required>
												</div>
                                        </div>
                                        <button type="submit" name="btnRetrieve" class="btn btn-primary">Retrieve</button>
                                </form>
							</div>
						</div>
					</div>
					<div class="col-lg-12" id="details">
                        <div class="card">
                            <div class="card-header d-block">
							<?php 
							$name1= getFieldValueById("given_name","employees",$employee_id);
							$name2= getFieldValueById("family_name","employees",$employee_id);
							$name=$name1." ".$name2;
							?>
                                <h4 class="card-title"><?php echo $name; ?></h4>
                            </div>
                            <div class="card-body">
                                <!-- Default accordion -->
                                <div id="accordion-one" class="accordion">
                                    <div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#Immovable">
                                            <span class="accordion__header--text">Immovable Assets</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="Immovable" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM immovable_asset_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													
													<div class="card">
													<div id="printdiv">
														<div class="card-header">
															<h4 class="card-title">All Immovable Declaration</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Immovable type</th>
																			<th>Location</th>
																			<th>City</th>
																			<th>Value</th>
																			<th>Source</th>
																			<th>Acquisation Date</th>
																			<th>Joint Asset</th>
																			<th>Share%</th>
																			<th>Bought</th>
																			<th>Seller name</th>
																			<th>Price</th>
																			<th>Loan</th>
																			<th>Bank</th>
																			<th>Installemnt</th>
																			<th>Loan amount</th>
																			<th>Clear loan date</th>
																			<th>Rent</th>
																			<th>Monthly Pay</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["immovable_asset_declaration_id"];
																				$descId = $row["asset_type_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.getFieldValueById("description", "immovable_assets", $row["asset_type_id"]).'</td>';
																				echo '<td style="color:black">'.getAssetCountry($row["immovable_asset_declaration_id"]).'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">'.getAssetLocation($row["immovable_asset_declaration_id"]).'</td>';
																				} else {
																					echo '<td style="color:black">'.getAssetCity($row["immovable_asset_declaration_id"]).'</td>';
																				}
																				echo '<td style="color:black">'.$row["estimated_value"].'</td>';
																				echo '<td style="color:black">'.$row["asset_source"].'</td>';
																				echo '<td style="color:black">'.$row["date_of_aquisition"].'</td>';
																				echo '<td style="color:black">'.$row["joint_asset"].'</td>';
																				echo '<td style="color:black">'.$row["percentage_of_shares"].'</td>';
																				echo '<td style="color:black">'.$row["is_bought"].'</td>';
																				echo '<td style="color:black">'.$row["seller_name"].'</td>';
																				echo '<td style="color:black">'.$row["buying_price"].'</td>';
																				echo '<td style="color:black">'.$row["by_loan"].'</td>';
																				echo '<td style="color:black">'.$row["bank_name"].'</td>';
																				echo '<td style="color:black">'.$row["installment"].'</td>';
																				echo '<td style="color:black">'.$row["expected_loan_clear_date"].'</td>';
																				echo '<td style="color:black">'.$row["is_rent"].'</td>';
																				echo '<td style="color:black">'.$row["monthly_pay"].'</td>';
																				echo '</tr>';
																			}
																			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
														<center><button onclick="printContent('printdiv')" class="print1" title="Click to Print"><i class="fa fa-print" id="p1"></i>&nbsp;Print</button>&nbsp;&nbsp;
															<a href="unsubmited_to_excel.php" target="_blank" class="printbtn" title="Click to Download the Excel file" style="text-decoration: none;"><i class="fa fa-download" id="d1"></i>&nbsp;Download Excel</a></center>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
													</div>
												</div>
											</div>
                                        </div>
                                    </div>
                                    <div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#Movable">
                                            <span class="accordion__header--text">Movable Asset</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="Movable" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM livestock_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Livestock</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Location</th>
																			<th>City</th>
																			<th>Value</th>
																			<th>Source</th>
																			<th>Acquisation Date</th>
																			<th>Joint Asset</th>
																			<th>Share%</th>
																			<th>Bought</th>
																			<th>Seller name</th>
																			<th>Price</th>
																			<th>Loan</th>
																			<th>Bank</th>
																			<th>Installemnt</th>
																			<th>Loan amount</th>
																			<th>Clear loan date</th>
																			<th>Estimated spent amount</th>
																			<th>Estimated Income</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["livestock_declaration_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.getAssetCountryLivestock($row["livestock_declaration_id"]).'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">'.getAssetLocationLivestock($row["livestock_declaration_id"]).'</td>';
																				} else {
																					echo '<td style="color:black">'.getAssetCityLivestock($row["livestock_declaration_id"]).'</td>';
																				}
																				echo '<td style="color:black">'.$row["estimated_value"].'</td>';
																				echo '<td style="color:black">'.$row["asset_source"].'</td>';
																				echo '<td style="color:black">'.$row["date_of_aquisition"].'</td>';
																				echo '<td style="color:black">'.$row["joint_asset"].'</td>';
																				echo '<td style="color:black">'.$row["percentage_of_shares"].'</td>';
																				echo '<td style="color:black">'.$row["is_bought"].'</td>';
																				echo '<td style="color:black">'.$row["seller_name"].'</td>';
																				echo '<td style="color:black">'.$row["buying_price"].'</td>';
																				echo '<td style="color:black">'.$row["by_loan"].'</td>';
																				echo '<td style="color:black">'.$row["bank_name"].'</td>';
																				echo '<td style="color:black">'.$row["loan_amount"].'</td>';
																				echo '<td style="color:black">'.$row["installment"].'</td>';
																				echo '<td style="color:black">'.$row["expected_loan_clear_date"].'</td>';
																				echo '<td style="color:black">'.$row["estimated_spent_amount"].'</td>';
																				echo '<td style="color:black">'.$row["estimated_income"].'</td>';
																				echo '</tr>';
																			}
																			
																		?>
																	</tbody>
																</table>
															</div>
															<?php
															} else {
																echo '<div class="card-body">';
																echo 'No records found.';
																echo '</div>';
															}
															?>
														</div>
													</div>
													
												</div>
												<?php 
													$query = "SELECT * FROM gift_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Gift</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Gift Type</th>
																			<th>Estimated Value</th>
																			<th>Donor</th>
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
																			}			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
												<?php 
													$query = "SELECT * FROM vehicle_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Vehicles</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Vehicle TYPE</th>
																			<th>Plate No</th>
																			<th>Location</th>
																			<th>Source</th>
																			<th>Joint Asset</th>
																			<th>Share%</th>
																			<th>Bought</th>
																			<th>Seller name</th>
																			<th>Price</th>
																			<th>Loan</th>
																			<th>Bank</th>
																			<th>Installemnt</th>
																			<th>Loan amount</th>
																			<th>Clear loan date</th>
																			<th>Estimated spent amount</th>
																			<th>Estimated Income</th>
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
																				echo '<td style="color:black">'.$row["asset_source"].'</td>';
																				echo '<td style="color:black">'.$row["joint_asset"].'</td>';
																				echo '<td style="color:black">'.$row["percentage_of_shares"].'</td>';
																				echo '<td style="color:black">'.$row["is_bought"].'</td>';
																				echo '<td style="color:black">'.$row["seller_name"].'</td>';
																				echo '<td style="color:black">'.$row["buying_price"].'</td>';
																				echo '<td style="color:black">'.$row["by_loan"].'</td>';
																				echo '<td style="color:black">'.$row["bank_name"].'</td>';
																				echo '<td style="color:black">'.$row["loan_amount"].'</td>';
																				echo '<td style="color:black">'.$row["installment"].'</td>';
																				echo '<td style="color:black">'.$row["expected_loan_clear_date"].'</td>';
																				echo '<td style="color:black">'.$row["estimated_spent_amount"].'</td>';
																				echo '<td style="color:black">'.$row["estimated_income"].'</td>';
																				echo '</tr>';
																			}
																			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
											
												<?php 
													$query = "SELECT * FROM money_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Money</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Bank Name</th>
																			<th>Account Number</th>
																			<th>Amount in RWF</th>
																			<th>Amount in Currency</th>
																			<th>Money on Contract</th>
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
																			}			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
												<?php 
													$query = "SELECT * FROM other_movable_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Other Movable</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Location</th>
																			<th>City</th>
																			<th>Value</th>
																			<th>Source</th>
																			<th>Acquisation Date</th>
																			<th>Joint Asset</th>
																			<th>Share%</th>
																			<th>Bought</th>
																			<th>Seller name</th>
																			<th>Price</th>
																			<th>Loan</th>
																			<th>Bank</th>
																			<th>Installemnt</th>
																			<th>Loan amount</th>
																			<th>Clear loan date</th>
																			<th>Estimated spent amount</th>
																			<th>Estimated Income</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["livestock_declaration_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.getAssetCountryLivestock($row["livestock_declaration_id"]).'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">'.getAssetLocationLivestock($row["livestock_declaration_id"]).'</td>';
																				} else {
																					echo '<td style="color:black">'.getAssetCityLivestock($row["livestock_declaration_id"]).'</td>';
																				}
																				echo '<td style="color:black">'.$row["estimated_value"].'</td>';
																				echo '<td style="color:black">'.$row["asset_source"].'</td>';
																				echo '<td style="color:black">'.$row["date_of_aquisition"].'</td>';
																				echo '<td style="color:black">'.$row["joint_asset"].'</td>';
																				echo '<td style="color:black">'.$row["percentage_of_shares"].'</td>';
																				echo '<td style="color:black">'.$row["is_bought"].'</td>';
																				echo '<td style="color:black">'.$row["seller_name"].'</td>';
																				echo '<td style="color:black">'.$row["buying_price"].'</td>';
																				echo '<td style="color:black">'.$row["by_loan"].'</td>';
																				echo '<td style="color:black">'.$row["bank_name"].'</td>';
																				echo '<td style="color:black">'.$row["loan_amount"].'</td>';
																				echo '<td style="color:black">'.$row["installment"].'</td>';
																				echo '<td style="color:black">'.$row["expected_loan_clear_date"].'</td>';
																				echo '<td style="color:black">'.$row["estimated_spent_amount"].'</td>';
																				echo '<td style="color:black">'.$row["estimated_income"].'</td>';
																				echo '</tr>';
																			}
																			
																		?>
																	</tbody>
																</table>
															</div>
															<?php
																} else {
																	
																	echo 'No records found.';
																}
													
															?>
														</div>
													</div>
													
												</div>
											</div>
                                        </div>
                                    </div>
									<div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#Immovable">
                                            <span class="accordion__header--text">Immovable Assets</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="Immovable" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM immovable_asset_declarations
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													
													<div class="card">
													<div id="printdiv">
														<div class="card-header">
															<h4 class="card-title">All Immovable Declaration</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Immovable type</th>
																			<th>Location</th>
																			<th>City</th>
																			<th>Value</th>
																			<th>Source</th>
																			<th>Acquisation Date</th>
																			<th>Joint Asset</th>
																			<th>Share%</th>
																			<th>Bought</th>
																			<th>Seller name</th>
																			<th>Price</th>
																			<th>Loan</th>
																			<th>Bank</th>
																			<th>Installemnt</th>
																			<th>Loan amount</th>
																			<th>Clear loan date</th>
																			<th>Rent</th>
																			<th>Monthly Pay</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["immovable_asset_declaration_id"];
																				$descId = $row["asset_type_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.getFieldValueById("description", "immovable_assets", $row["asset_type_id"]).'</td>';
																				echo '<td style="color:black">'.getAssetCountry($row["immovable_asset_declaration_id"]).'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">'.getAssetLocation($row["immovable_asset_declaration_id"]).'</td>';
																				} else {
																					echo '<td style="color:black">'.getAssetCity($row["immovable_asset_declaration_id"]).'</td>';
																				}
																				echo '<td style="color:black">'.$row["estimated_value"].'</td>';
																				echo '<td style="color:black">'.$row["asset_source"].'</td>';
																				echo '<td style="color:black">'.$row["date_of_aquisition"].'</td>';
																				echo '<td style="color:black">'.$row["joint_asset"].'</td>';
																				echo '<td style="color:black">'.$row["percentage_of_shares"].'</td>';
																				echo '<td style="color:black">'.$row["is_bought"].'</td>';
																				echo '<td style="color:black">'.$row["seller_name"].'</td>';
																				echo '<td style="color:black">'.$row["buying_price"].'</td>';
																				echo '<td style="color:black">'.$row["by_loan"].'</td>';
																				echo '<td style="color:black">'.$row["bank_name"].'</td>';
																				echo '<td style="color:black">'.$row["installment"].'</td>';
																				echo '<td style="color:black">'.$row["expected_loan_clear_date"].'</td>';
																				echo '<td style="color:black">'.$row["is_rent"].'</td>';
																				echo '<td style="color:black">'.$row["monthly_pay"].'</td>';
																				echo '</tr>';
																			}
																			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
														<center><button onclick="printContent('printdiv')" class="print1" title="Click to Print"><i class="fa fa-print" id="p1"></i>&nbsp;Print</button>&nbsp;&nbsp;
															<a href="unsubmited_to_excel.php" target="_blank" class="printbtn" title="Click to Download the Excel file" style="text-decoration: none;"><i class="fa fa-download" id="d1"></i>&nbsp;Download Excel</a></center>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
													</div>
												</div>
											</div>
                                        </div>
                                    </div>
                                    <div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#incorporeal">
                                            <span class="accordion__header--text">Incorporeal Asset</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="incorporeal" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM shares_in_society
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Share in society</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Company</th>
																			<th>Dividend</th>
																			<th>Location</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["gift_declaration_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.$row["company"].'</td>';
																				echo '<td style="color:black">'.$row["dividend"].'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">Rwanda</td>';
																				} else {
																					echo '<td style="color:black">Abroad</td>';
																				}
																			}			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
                                            </div>
                                        </div>
                                    </div>
									<div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#business">
                                            <span class="accordion__header--text">Business Declaration</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="business" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM business_declaration
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Business Declare</h4>
														</div>
														<?php if($stmt->rowCount() > 0){ ?>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Business Type</th>
																			<th>Capital</th>
																			<th>Annual Turnover</th>
																			<th>Annual Profit</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["business_declaration_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.$row["business_type"].'</td>';
																				echo '<td style="color:black">'.$row["capital"].'</td>';
																				echo '<td style="color:black">'.$row["annual_turnover"].'</td>';
																				echo '<td style="color:black">'.$row["annual_profit"].'</td>';
																			}			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
											</div>
                                        </div>
                                    </div>
									<div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#sold">
                                            <span class="accordion__header--text">Sold Asset</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="sold" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM sold_asset
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Business Declare</h4>
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Asset Type</th>
																			<th>Location</th>
																			<th>Spent Amount</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				echo '<tr>';
																				echo '<td style="color:black">'.$row["asset_type"].'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">Rwanda</td>';
																				} else {
																					echo '<td style="color:black">Abroad</td>';
																				}
																				echo '<td style="color:black">'.$row["earned_amount"].'</td>';
																			}			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
											</div>
                                        </div>
                                    </div>
									<div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#bought">
                                            <span class="accordion__header--text">Bought Asset</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="bought" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM bought_asset
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Bought Declare</h4>
														</div>
														<div class="card-body">
															<div class="table-responsive">
																<table class="table student-data-table m-t-20">
																	<thead>
																		<tr>
																			<th>Asset Type</th>
																			<th>Location</th>
																			<th>Spent Amount</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																				$id = $row["bought_asset_id"];
																				echo '<tr>';
																				echo '<td style="color:black">'.$row["asset_type"].'</td>';
																				if($row["asset_location_id"] == 1){
																					echo '<td style="color:black">Rwanda</td>';
																				} else {
																					echo '<td style="color:black">Abroad</td>';
																				}
																				echo '<td style="color:black">'.$row["spent_amount"].'</td>';
																			}			
																		?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
											</div>
                                        </div>
                                    </div>
									
									<div class="accordion__item">
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#terms">
                                            <span class="accordion__header--text">Terms/Condition and Signature</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="terms" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM submitted_declarations 
													WHERE employee_id = '".$employee_id."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php 
													if($stmt->rowCount() > 0){ 
														$res = $stmt->fetch(PDO::FETCH_ASSOC);
														//extract($res);
														$image_path = $res['document_path'];
													?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Accepted Terms</h4>
														</div>
														<div class="card-body">
															<div class="form-group">
																<p style="color:black">By checking the bellow box you're accepting the use of all Submitted i as per required by Quality Assurance to check everthing related to the information you had provided
															 Please check the button to submitte al declaration as per required! </p>
															 <p style="color:black">Not that once you submitte these information there's no more edit or change to the provided information</p>
															</div>
														</div>
														<div class="card-header">
															<h4 class="card-title">Signature</h4>
															<img src="<?php echo $image_path; ?>" width="75" />
															<?php 
															//print_r($res);
															?>
														</div>
														
													</div>
													<?php
														} else {
															echo '<div class="card-body">';
															echo 'No records found.';
															echo '</div>';
														}
													
													?>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
							
					</div>
				</div>
				<style type="text/css">
.print1{
	background-color: #289;
    border-radius: 8px;
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 15px;
}
.print1:hover{background-color:#FFF; color: #289;}

.print1 #p1{display: none;}
.print1:hover #p1{display: inline;}
.printbtn{
    background-color: #006;
    border-radius: 12px;
    border: none;
    color: white;
    padding: 6px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 15px;
 }
 .printbtn:hover{background-color:#FFF; color: #006;}

 .printbtn #d1{display: none;}
 .printbtn:hover #d1{display: inline;}
 .printbtn:visited{color: white;}
 .button{
    text-decoration: none;
    background-color: #03a9f4;
    color:#fff;
    padding: 10px 15px;
    border:none;
    margin-top: 10px;
    border-radius: 24px;
    transition: 0.25s;
    outline:none;
    cursor:pointer;
}
.button:hover{
    background-color: green;
}
</style>

<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
<script type="text/javascript">
	 $("#btnRetrieve").on("change",function(){
		 $("#details").show();
	 });
</script>