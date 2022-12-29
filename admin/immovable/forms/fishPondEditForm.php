
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Fish Pond Declaration</h4>
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
								<?php if($main_link == 'staffUser.php'){ ?>
                                    <form action="editFishPondUser.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
								<?php } else {?>
									<form action="editFishPond.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
								<?php } ?>
                                        <div class="form-row">
											<div class="form-group col-md-6">
                                               
                                                <select class="custom-select mr-sm-2" name="asset_owner" id="asset_owner">
                                                    <option value="">Owner...</option>
                                                    <option value="1" <?php if($asset_owner_id==1){ echo 'selected="selected"'; } ?>>My Self</option>
                                                    <option value="2" <?php if($asset_owner_id==2){ echo 'selected="selected"'; } ?>>children</option>
                                                    <option value="3" <?php if($asset_owner_id==3){ echo 'selected="selected"'; } ?>>Spouse</option>
                                                </select>
                                            </div>
											
											<div class="form-group col-md-6">
											   
                                               <select class="custom-select mr-sm-2" name="location" id="location">
                                                    <option value="">Location...</option>
                                                    <option value="1" <?php if($asset_location_id==1){ echo 'selected="selected"'; } ?>>Rwanda</option>
                                                    <option value="2" <?php if($asset_location_id==2){ echo 'selected="selected"'; } ?>>Abroad</option>
                                                </select>
                                            </div>
										<?php if($asset_location_id==1){ ?>	
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="province" id="province">
                                                    
													<?php 
													$provincesQry = "SELECT * FROM provinces";
													foreach($dbh->query($provincesQry) as $p){
														$provinceCode = $p['province_code'];
														$provinceName = $p['province_name'];
														echo '<option value="'.$provinceCode.'"';
														if($provinceCode == $province_code){ echo ' selected="selected"'; }
														echo '>'.$provinceName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
										
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="district" id="district">
                                                    
													<?php 
													$pCode = getProvinceCodeByVillageCode($village_code);
													$districtsQry = "SELECT * FROM districts WHERE province_code = '".$pCode."'";
													foreach($dbh->query($districtsQry) as $d){
														$districtCode = $d['district_code'];
														$districtName = $d['district_name'];
														echo '<option value="'.$districtCode.'"';
														if($districtCode == $district_code){ echo ' selected="selected"'; }
														echo '>'.$districtName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="sector" id="sector">
                                                    
													<?php 
													$dCode = getDistrictCodeByVillageCode($village_code);
													$sectorsQry = "SELECT * FROM sectors WHERE district_code = '".$dCode."'";
													foreach($dbh->query($sectorsQry) as $s){
														$sectorCode = $s['sector_code'];
														$sectorName = $s['sector_name'];
														echo '<option value="'.$sectorCode.'"';
														if($sectorCode == $sector_code){ echo ' selected="selected"'; }
														echo '>'.$sectorName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <select class="custom-select mr-sm-2" name="cell" id="cell">
                                                    
													<?php 
													$sCode = getSectorCodeByVillageCode($village_code);
													$cellsQry = "SELECT * FROM cells WHERE sector_code = '".$sCode."'";
													foreach($dbh->query($cellsQry) as $c){
														$cellCode = $c['cell_code'];
														$cellName = $c['cell_name'];
														echo '<option value="'.$cellCode.'"';
														if($cellCode == $cell_code){ echo ' selected="selected"'; }
														echo '>'.$cellName.'</option>';
													}
													?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                 <select class="custom-select mr-sm-2" name="village" id="village" name="village">
                                                    
													<?php 
													$cCode = getCellCodeByVillageCode($village_code);
													$villagesQry = "SELECT * FROM villages WHERE cell_code = '".$cCode."'";
													foreach($dbh->query($villagesQry) as $v){
														$villageCode = $v['village_code'];
														$villageName = $v['village_name'];
														echo '<option value="'.$villageCode.'"';
														if($villageCode == $village_code){ echo ' selected="selected"'; }
														echo '>'.$villageName.'</option>';
													}
													?>
													
                                                </select>
                                            </div>
                                        </div>
										<?php } else if($asset_location_id==2){ ?>	
										<div class="form-row">
                                            <div class="col-auto my-1">
                                                 <select class="custom-select mr-sm-2" name="countryValue" id="countryValue">
                                                    <option value="">Country...</option>
													<option value="Uganda" <?php if($country=="Uganda"){ echo 'selected="selected"'; } ?>>Uganda</option>
													<option value="Canada" <?php if($country=="Canada"){ echo 'selected="selected"'; } ?>>Canada</option>
                                                </select>
                                            </div>
										</div>
										
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <input type="text" class="form-control" name="cityValue" id="cityValue" value="<?php echo $city; ?>">
                                            </div>
									    </div>
										<?php } ?>	
										</div>
								</div>
										
										<div class="form-row mb-2">
                                                    <label class="sr-only" for="val-currency">Currency
                                                        <span class="text-danger">*</span>
														
                                                    </label>
                                                    <div class="col-auto my-1">
														<input type="text" class="form-control" name="estimated_value" id="estimated_value" value="<?php echo $estimated_value; ?>" required />
                                                    </div>
													<div class="col-auto my-1">
														<input type="text" class="form-control" name="asset_source" id="asset_source" value="<?php echo $asset_source; ?>" required />
                                                    </div>
                                        </div>
										
										<div class="form-row mb-2 ">
											<div class="col-auto">
												<label>Date of acquisition<span class="text-danger">*</span></label>
											</div>
											<div class="col-auto">
												<input type="date" class="form-control" name="date_of_aquisition" id="date_of_aquisitionId" value="<?php echo $date_of_aquisition; ?>" required />
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3" required>
												<label>Is Joint Asset: <span class="text-danger">*</span></label>
												<label class="radio-inline" id="jointyes">
													<input type="radio" value="y" name="jointopt" id="jointyes" <?php if($joint_asset == 'y' || $joint_asset == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline" id="jointno">
                                                <input type="radio" value="n" name="jointopt" <?php if($joint_asset == 'n' || $joint_asset == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="percentage_of_shares" style="display:none;">
                                                <label>Percentage of shares <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="percentage_of_shares_val" name="percentage_of_shares" value="<?php echo $percentage_of_shares; ?>">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Bought Asset <span class="text-danger">*</span></label>
												<label class="radio-inline">
													<input type="radio" name="boughtopt" value="y" id="boughtyes" <?php if($is_bought == 'y' || $is_bought == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="boughtopt" value="n" id="boughtno" <?php if($is_bought == 'n' || $is_bought == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="bought_seller" style="display:none;">
                                                <label>Seller name <span class="text-danger">*</span></label>
                                                <input type="text" id="seller_name" name="seller_name" class="form-control" value="<?php echo $seller_name; ?>">
                                            </div>
											<div class="form-group col-md-2" id="bought_amount" for="val-digits" style="display:none;">
                                                <label>Amount <span class="text-danger">*</span></label>
                                                <input type="text" id="buying_price" name="buying_price" class="form-control" value="<?php echo $buying_price; ?>">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Loan Asset: </label>
												<label class="radio-inline">
													<input type="radio" name="loanopt" id="loanyes" value="y" <?php if($by_loan == 'y' || $by_loan == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="loanopt" id="loanno" value="n" <?php if($by_loan == 'n' || $by_loan == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="loan_bank" style="display:none;">
                                                <label>Bank Name</label>
                                                <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $bank_name; ?>">
                                            </div>
											<div class="form-group col-md-2" id="installmentDiv" style="display:none;">
                                                <label>Installment</label>
                                                <input type="text" name="installment" id="installment" class="form-control" value="<?php echo $installment; ?>">
                                            </div>
											<div class="form-group col-md-2" id="loanAmountDiv" style="display:none;">
                                                <label>Loan Amount</label>
                                                <input type="text" name="loan_amount" id="loan_amount" class="form-control" value="<?php echo $loan_amount; ?>">
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date" style="display:none;">
												<label>Date to clear loan</label>
												<input type="text" name="expected_loan_clear_date" class="form-control" value="<?php echo $expected_loan_clear_date; ?>" id="mdate">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Rent Asset: </label>
												<label class="radio-inline">
													<input type="radio" name="is_rent" value="y" id="is_rent_yes" <?php if($is_rent == 'y' || $is_rent == 'Y'){ echo 'checked="checked"'; } ?>> Yes</label>
												<label class="radio-inline">
													<input type="radio" name="is_rent" value="n" id="is_rent_no" <?php if($is_rent == 'n' || $is_rent == 'N'){ echo 'checked="checked"'; } ?>> No</label>
											</div>
											<div class="form-group col-md-2" id="monthly_pay" style="display:none;">
                                                <label>Monthly pay</label>
                                                <input type="text" name="monthly_pay" id="monthly_pay_amt" class="form-control" value="<?php echo $monthly_pay; ?>">
                                            </div>
										</div>
										
										<input type="hidden" name="immovable_asset_declaration_id" value="<?php echo $immovable_asset_declaration_id; ?>" />
										<input type="hidden" name="immovable_asset_id" value="<?php echo $immovable_asset_id; ?>" />
                                        <button type="submit" name="btnEdit"  class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			
            
        <script type="text/javascript">
		
		function getDetails(){
			var getSelectedValueJoint = document.querySelector( 'input[name="jointopt"]:checked');
			//var getSelectedValueJointValue = document.querySelector('input[name="jointopt"]:checked').value;
			var getSelectedValueBought = document.querySelector( 'input[name="boughtopt"]:checked');
			var getSelectedValueLoan = document.querySelector( 'input[name="loanopt"]:checked');
			var getSelectedValueRent = document.querySelector( 'input[name="is_rent"]:checked');
			let x = document.forms["rsForm"]["jointopt"].value;
			let jointShare = document.forms["rsForm"]["percentage_of_shares"].value;
			let bought = document.forms["rsForm"]["boughtopt"].value;
			let seller = document.forms["rsForm"]["seller_name"].value;
			let price = document.forms["rsForm"]["buying_price"].value;
			let loan = document.forms["rsForm"]["loanopt"].value;
			let bank = document.forms["rsForm"]["bank_name"].value;
			let installment = document.forms["rsForm"]["installment"].value;
			let clearDate = document.forms["rsForm"]["expected_loan_clear_date"].value;
			let rent = document.forms["rsForm"]["is_rent"].value;
			let monthlyPay = document.forms["rsForm"]["monthly_pay"].value;
			<!--Locations validation-->
			let locationValue = document.forms["rsForm"]["location"].value;
			let countryValue = document.forms["rsForm"]["countryValue"].value;
			let cityValue = document.forms["rsForm"]["cityValue"].value;
			let villageValue = document.forms["rsForm"]["village"].value;
			
			if(locationValue == '2'){
				if(countryValue == ""){
					alert("Please enter Country from abroad");
					return false;
				}
				else if(cityValue == ""){
					alert("Please enter City of this Country");
					return false;
				}
			}
			else if(locationValue == '1'){
				if(villageValue == ""){
					alert("Please select location of Rwanda up to village");
					return false;
				}
			}
			
			if(x == 'y' && jointShare == ""){
				alert("Please enter shares percentage");
				return false;
			}
			if(bought == 'y'){
				if(seller == ""){
					alert("Please enter seller name");
					return false;
				}
				else if(price == ""){
					alert("Please enter Bought price");
					return false;
				}
			}
			
			if(loan == 'y'){
				if(bank == ""){
					alert("Please enter Bank name");
					return false;
				}
				else if(installment == ""){
					alert("Please enter Installment for Loan");
					return false;
				}else if(clearDate == ""){
					alert("Please select clear date");
					return false;
				}
			}
			
			if(rent == 'y'){
				if(monthlyPay == ""){
					alert("Please enter monthly pay");
					return false;
				}
			}
			
			
			
			if (document.forms[0]['asset_owner'].value == 0) {
				alert("Please Select Owner Asset");
				return false;
			}
			if (document.forms[0]['location'].value == 0) {
				alert("Please select location");
				return false;
			}
			
			
			if(getSelectedValueJoint == null){
				alert("Please Select Joint YES or NO");
				return false;
			}
			if(getSelectedValueBought == null){
				alert("Please Select Bought YES or NO");
				return false;
			}
			if(getSelectedValueLoan == null){
				alert("Please Select Loan YES or NO");
				return false;
			}
			if(getSelectedValueRent == null){
				alert("Please Select Rent YES or NO");
				return false;
			}
		}
		
		
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
		
		</script>