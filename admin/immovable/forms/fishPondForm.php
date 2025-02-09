
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
                                    <form action="<?php echo $main_link; ?>?dir=immovable&page=fishPond" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											<div class="form-group col-md-6">
                                               
                                                <select class="custom-select mr-sm-2" name="asset_owner" id="asset_owner">
                                                    <option value="">Owner...</option>
                                                    <option value="1">My Self</option>
                                                    <option value="2">Children</option>
                                                    <option value="3">Spouse</option>
                                                </select>
                                            </div>
											
											<div class="form-group col-md-6">
											   
                                               <select class="custom-select mr-sm-2" name="location" id="location">
                                                    <option value="">Location...</option>
                                                    <option value="1">Rwanda</option>
                                                    <option value="2">Abroad</option>
                                                </select>
                                            </div>
											
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="province" id="province" style="display:none;">
                                                    <option value="">Province...</option>
                                                </select>
                                            </div>
                                        </div>
										
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="district" id="district" style="display:none;">
                                                     <option value="">District...</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                               <select class="custom-select mr-sm-2" name="sector" id="sector" style="display:none;">
                                                    <option value="">Sector...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <select class="custom-select mr-sm-2" name="cell" id="cell" style="display:none;">
                                                    <option value="">Cell...</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                 <select class="custom-select mr-sm-2" name="village" id="village" name="village" style="display:none;">
                                                    <option value="">Village...</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row">
                                            <div class="col-auto my-1">
                                                 <select class="custom-select mr-sm-2" name="countryValue" id="countryValue" style="display:none;">
                                                    <option value="">Country...</option>
													<option value="Uganda">Uganda</option>
													<option value="Canada">Canada</option>
                                                </select>
                                            </div>
										</div>
										
										<div class="form-row align-items-center">
                                            <div class="col-auto my-1">
                                                <input type="text" class="form-control" name="cityValue" id="cityValue" placeholder="City" style="display:none;">
                                            </div>
									    </div>
										</div>
								</div>
										
										<div class="form-row mb-2">
                                                    <label class="sr-only" for="val-currency">Currency
                                                        <span class="text-danger">*</span>
														
                                                    </label>
                                                    <div class="col-auto my-1">
														<input type="text" class="form-control" name="estimated_value" id="estimated_value" placeholder="Estimated value" required />
                                                    </div>
													<div class="col-auto my-1">
														<input type="text" class="form-control" name="asset_source" id="asset_source" placeholder="Asset source" required />
                                                    </div>
                                        </div>
										
										<div class="form-row mb-2 ">
											<div class="col-auto">
												<label>Date of acquisition<span class="text-danger">*</span></label>
											</div>
											<div class="col-auto">
												<input type="date" class="form-control" name="date_of_aquisition" id="date_of_aquisitionId" placeholder="yyyy-mm-dd" required />
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3" required>
												<label>Is Joint Asset: <span class="text-danger">*</span></label>
												<label class="radio-inline" id="jointyes">
													<input type="radio" value="y" name="jointopt" id="jointyes"> Yes</label>
												<label class="radio-inline" id="jointno">
                                                <input type="radio" value="n" name="jointopt"> No</label>
											</div>
											<div class="form-group col-md-2" id="percentage_of_shares" style="display:none;">
                                                <label>Percentage of shares <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="percentage_of_shares_val" name="percentage_of_shares">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Bought Asset <span class="text-danger">*</span></label>
												<label class="radio-inline">
													<input type="radio" name="boughtopt" value="y" id="boughtyes"> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="boughtopt" value="n" id="boughtno"> No</label>
											</div>
											<div class="form-group col-md-2" id="bought_seller" style="display:none;">
                                                <label>Seller name <span class="text-danger">*</span></label>
                                                <input type="text" id="seller_name" name="seller_name" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="bought_amount" for="val-digits" style="display:none;">
                                                <label>Amount <span class="text-danger">*</span></label>
                                                <input type="text" id="buying_price" name="buying_price" class="form-control">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Loan Asset: </label>
												<label class="radio-inline">
													<input type="radio" name="loanopt" id="loanyes" value="y"> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="loanopt" id="loanno" value="n"> No</label>
											</div>
											<div class="form-group col-md-2" id="loan_bank" style="display:none;">
                                                <label>Bank Name</label>
                                                <input type="text" name="bank_name" id="bank_name" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="installmentDiv" style="display:none;">
                                                <label>Installment</label>
                                                <input type="text" name="installment" id="installment" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="loanAmountDiv" style="display:none;">
                                                <label>Loan Amount</label>
                                                <input type="text" name="loan_amount" id="loan_amount" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date" style="display:none;">
												<label>Date to clear loan</label>
												<input type="text" name="expected_loan_clear_date" class="form-control" placeholder="yyyy-mm-dd" id="mdate">
                                            </div>
										</div>
										
										<div class="form-row">
											<div class="form-group col-md-3">
												<label>Is Rent Asset: </label>
												<label class="radio-inline">
													<input type="radio" name="is_rent" value="y" id="is_rent_yes"> Yes</label>
												<label class="radio-inline">
													<input type="radio" name="is_rent" value="n" id="is_rent_no"> No</label>
											</div>
											<div class="form-group col-md-2" id="monthly_pay" style="display:none;">
                                                <label>Monthly pay</label>
                                                <input type="text" name="monthly_pay" id="monthly_pay_amt" class="form-control">
                                            </div>
										</div>
										
										<input type="hidden" name="immovable_asset_id" value="<?php echo $immovable_asset_id; ?>" />
                                        <button type="submit" name="btnSubmit"  class="btn btn-primary">Submit</button>
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