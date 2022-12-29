<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vehicles Declaration</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=movable&page=vehicles" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">

                                        <div class="form-row mb-1">
                                            <div class="form-group col-md-4">
                                                <select class="custom-select mr-sm-2" name="vehicle_type_id" id="vehicle_type_id">
                                                    <option value="">Vehicle Type...</option>
                                                    <option value="1">TOYOTA RUSH</option>
                                                    <option value="2">BENZ</option>
                                                    <option value="3">BMW</option>
                                                </select>
                                            </div>
											<div class="form-group col-md-4">
												<input type="text" class="form-control" name="plate_no" id="plate_no" placeholder="Plate Number" required />
                                            </div>
                                            <div class="form-group col-md-4">
												<input type="text" class="form-control" name="asset_source" id="asset_source" placeholder="Asset source" required />
                                            </div>
                                        </div>

                                        <div class="form-row">
											<div class="form-group col-md-6">
                                               
                                                <select class="custom-select mr-sm-2" name="asset_owner" id="asset_owner">
                                                    <option value="">Owner...</option>
                                                    <option value="1">My Self</option>
                                                    <option value="2">children</option>
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
										</div>
										<!-- </div> -->
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
												<label>Is Loan Asset:<span class="text-danger">*</span> </label>
												<label class="radio-inline">
													<input type="radio" name="loanopt" id="loanyes" value="y"> Yes</label>
												<label class="radio-inline">
                                                <input type="radio" name="loanopt" id="loanno" value="n"> No</label>
											</div>
											<div class="form-group col-md-2" id="loan_bank" style="display:none;">
                                                <label>Bank Name<span class="text-danger">*</span></label>
                                                <input type="text" name="bank_name" id="bank_name" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="loanAmountDiv" style="display:none;">
                                                <label>Loan Amount</label>
                                                <input type="text" name="loan_amount" id="loan_amount" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="installmentDiv" style="display:none;">
                                                <label>Installment<span class="text-danger">*</span></label>
                                                <input type="text" name="installment" id="installment" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date" style="display:none;">
												<label>Date to clear loan<span class="text-danger">*</span></label>
												<input type="text" name="expected_loan_clear_date" class="form-control" placeholder="yyyy-mm-dd" id="mdate">
                                            </div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-2" id="estimated_spent_amount">
                                                <label>Spent amount<span class="text-danger">*</span></label>
                                                <input type="text" name="estimated_spent_amount" id="estimated_spent_amount" class="form-control">
                                            </div>
											<div class="form-group col-md-2" id="estimated_income">
                                                <label>Estimated Income<span class="text-danger">*</span></label>
                                                <input type="text" name="estimated_income" id="estimated_income" class="form-control">
                                            </div>
										</div>
										
										<input type="hidden" name="movable_asset_id" value="<?php echo $movable_asset_id; ?>" />
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
			var getSelectedValueBought = document.querySelector( 'input[name="boughtopt"]:checked');
			var getSelectedValueLoan = document.querySelector( 'input[name="loanopt"]:checked');
			let x = document.forms["rsForm"]["jointopt"].value;
			let jointShare = document.forms["rsForm"]["percentage_of_shares"].value;
			let bought = document.forms["rsForm"]["boughtopt"].value;
			let seller = document.forms["rsForm"]["seller_name"].value;
			let price = document.forms["rsForm"]["buying_price"].value;
			let loan = document.forms["rsForm"]["loanopt"].value;
			let bank = document.forms["rsForm"]["bank_name"].value;
			let loanAmount = document.forms["rsForm"]["loan_amount"].value;
			let installment = document.forms["rsForm"]["installment"].value;
			let clearDate = document.forms["rsForm"]["expected_loan_clear_date"].value;
			<!--Locations validation-->
			let locationValue = document.forms["rsForm"]["location"].value;
			
			
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
				}
				else if(loanAmount == ""){
					alert("Please enter Loan Amount for Loan");
					return false;
				}else if(clearDate == ""){
					alert("Please select clear date");
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