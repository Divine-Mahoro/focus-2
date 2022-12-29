
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Individual Report Declaration</h4>
								<?php 
								if(isset($success_msg) && $success_msg != ''){
									echo '<p class="text-success">'.$success_msg.'</p>';
								} else if(isset($warning_msg) && $warning_msg != ''){
									echo '<p class="text-warning">'.$warning_msg.'</p>';
								} else if(isset($error_msg) && $error_msg != ''){
									echo '<p class="text-danger">'.$error_msg.'</p>';
								}
								?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                    <div class="col-lg-12" id="details">
                        <div class="card">
                            <div class="card-header d-block">
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
												WHERE employee_id = '".$_SESSION['employee']."'";
												$stmt = $dbh->prepare($query);
												$stmt->execute();
											?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">All Exam Result</h4>
														</div>
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
													</div>
													<?php
														} else {
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
														}
													
													?>
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
													WHERE employee_id = '".$_SESSION['employee']."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Livestock</h4>
														</div>
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
														</div>
													</div>
													<?php
														} else {
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
														}
													
													?>
												</div>
												<?php 
													$query = "SELECT * FROM gift_declarations
													WHERE employee_id = '".$_SESSION['employee']."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Gift</h4>
														</div>
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
														}
													
													?>
												</div>
												<?php 
													$query = "SELECT * FROM vehicle_declarations
													WHERE employee_id = '".$_SESSION['employee']."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Vehicles</h4>
														</div>
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
														}
													
													?>
												</div>
												</div>
												<?php 
													$query = "SELECT * FROM money_declarations
													WHERE employee_id = '".$_SESSION['employee']."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Money</h4>
														</div>
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
														}
													
													?>
												</div>
												<?php 
													$query = "SELECT * FROM other_movable_declarations
													WHERE employee_id = '".$_SESSION['employee']."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Other Movable</h4>
														</div>
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
														</div>
													</div>
													<?php
														} else {
															echo '<div class="card-header">';
															echo '<h4 class="card-title">Other Movable</h4>';
															echo '</div>';
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
                                        <div class="accordion__header collapsed" data-toggle="collapse" data-target="#incorporeal">
                                            <span class="accordion__header--text">Incorporeal Asset</span>
                                            <span class="accordion__header--indicator"></span>
                                        </div>
                                        <div id="incorporeal" class="collapse accordion__body" data-parent="#accordion-one">
                                            <div class="accordion__body--text">
												<?php 
													$query = "SELECT * FROM shares_in_society
													WHERE employee_id = '".$_SESSION['employee']."'";
													$stmt = $dbh->prepare($query);
													$stmt->execute();
												?>
												<div class="col-lg-12">
													<?php if($stmt->rowCount() > 0){ ?>
													<div class="card">
														<div class="card-header">
															<h4 class="card-title">Share in society</h4>
														</div>
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
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
													WHERE employee_id = '".$_SESSION['employee']."'";
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
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
													WHERE employee_id = '".$_SESSION['employee']."'";
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
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
													WHERE employee_id = '".$_SESSION['employee']."'";
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
															echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=quarry&action=add"> Add</a></span></div>';
															echo 'No records found.';
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
                    </div>
                </div>

			
            
        