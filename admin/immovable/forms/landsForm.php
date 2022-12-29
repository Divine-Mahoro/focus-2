
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lands Declaration</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=immovable&page=lands" method="POST" name="rsForm" id="rsForm"
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
													  <option value="Afghanistan">Afghanistan</option>
													  <option value="Albania">Albania</option>
													  <option value="Algeria">Algeria</option>
													  <option value="American Samoa">American Samoa</option>
													  <option value="Andorra">Andorra</option>
													  <option value="Angola">Angola</option>
													  <option value="Anguilla">Anguilla</option>
													  <option value="Antartica">Antarctica</option>
													  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
													  <option value="Argentina">Argentina</option>
													  <option value="Armenia">Armenia</option>
													  <option value="Aruba">Aruba</option>
													  <option value="Australia">Australia</option>
													  <option value="Austria">Austria</option>
													  <option value="Azerbaijan">Azerbaijan</option>
													  <option value="Bahamas">Bahamas</option>
													  <option value="Bahrain">Bahrain</option>
													  <option value="Bangladesh">Bangladesh</option>
													  <option value="Barbados">Barbados</option>
													  <option value="Belarus">Belarus</option>
													  <option value="Belgium">Belgium</option>
													  <option value="Belize">Belize</option>
													  <option value="Benin">Benin</option>
													  <option value="Bermuda">Bermuda</option>
													  <option value="Bhutan">Bhutan</option>
													  <option value="Bolivia">Bolivia</option>
													  <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
													  <option value="Botswana">Botswana</option>
													  <option value="Bouvet Island">Bouvet Island</option>
													  <option value="Brazil">Brazil</option>
													  <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
													  <option value="Brunei Darussalam">Brunei Darussalam</option>
													  <option value="Bulgaria">Bulgaria</option>
													  <option value="Burkina Faso">Burkina Faso</option>
													  <option value="Burundi">Burundi</option>
													  <option value="Cambodia">Cambodia</option>
													  <option value="Cameroon">Cameroon</option>
													  <option value="Canada">Canada</option>
													  <option value="Cape Verde">Cape Verde</option>
													  <option value="Cayman Islands">Cayman Islands</option>
													  <option value="Central African Republic">Central African Republic</option>
													  <option value="Chad">Chad</option>
													  <option value="Chile">Chile</option>
													  <option value="China">China</option>
													  <option value="Christmas Island">Christmas Island</option>
													  <option value="Cocos Islands">Cocos (Keeling) Islands</option>
													  <option value="Colombia">Colombia</option>
													  <option value="Comoros">Comoros</option>
													  <option value="Congo">Congo</option>
													  <option value="Congo">Congo, the Democratic Republic of the</option>
													  <option value="Cook Islands">Cook Islands</option>
													  <option value="Costa Rica">Costa Rica</option>
													  <option value="Cota D'Ivoire">Cote d'Ivoire</option>
													  <option value="Croatia">Croatia (Hrvatska)</option>
													  <option value="Cuba">Cuba</option>
													  <option value="Cyprus">Cyprus</option>
													  <option value="Czech Republic">Czech Republic</option>
													  <option value="Denmark">Denmark</option>
													  <option value="Djibouti">Djibouti</option>
													  <option value="Dominica">Dominica</option>
													  <option value="Dominican Republic">Dominican Republic</option>
													  <option value="East Timor">East Timor</option>
													  <option value="Ecuador">Ecuador</option>
													  <option value="Egypt">Egypt</option>
													  <option value="El Salvador">El Salvador</option>
													  <option value="Equatorial Guinea">Equatorial Guinea</option>
													  <option value="Eritrea">Eritrea</option>
													  <option value="Estonia">Estonia</option>
													  <option value="Ethiopia">Ethiopia</option>
													  <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
													  <option value="Faroe Islands">Faroe Islands</option>
													  <option value="Fiji">Fiji</option>
													  <option value="Finland">Finland</option>
													  <option value="France">France</option>
													  <option value="France Metropolitan">France, Metropolitan</option>
													  <option value="French Guiana">French Guiana</option>
													  <option value="French Polynesia">French Polynesia</option>
													  <option value="French Southern Territories">French Southern Territories</option>
													  <option value="Gabon">Gabon</option>
													  <option value="Gambia">Gambia</option>
													  <option value="Georgia">Georgia</option>
													  <option value="Germany">Germany</option>
													  <option value="Ghana">Ghana</option>
													  <option value="Gibraltar">Gibraltar</option>
													  <option value="Greece">Greece</option>
													  <option value="Greenland">Greenland</option>
													  <option value="Grenada">Grenada</option>
													  <option value="Guadeloupe">Guadeloupe</option>
													  <option value="Guam">Guam</option>
													  <option value="Guatemala">Guatemala</option>
													  <option value="Guinea">Guinea</option>
													  <option value="Guinea-Bissau">Guinea-Bissau</option>
													  <option value="Guyana">Guyana</option>
													  <option value="Haiti">Haiti</option>
													  <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
													  <option value="Holy See">Holy See (Vatican City State)</option>
													  <option value="Honduras">Honduras</option>
													  <option value="Hong Kong">Hong Kong</option>
													  <option value="Hungary">Hungary</option>
													  <option value="Iceland">Iceland</option>
													  <option value="India">India</option>
													  <option value="Indonesia">Indonesia</option>
													  <option value="Iran">Iran (Islamic Republic of)</option>
													  <option value="Iraq">Iraq</option>
													  <option value="Ireland">Ireland</option>
													  <option value="Israel">Israel</option>
													  <option value="Italy">Italy</option>
													  <option value="Jamaica">Jamaica</option>
													  <option value="Japan">Japan</option>
													  <option value="Jordan">Jordan</option>
													  <option value="Kazakhstan">Kazakhstan</option>
													  <option value="Kenya">Kenya</option>
													  <option value="Kiribati">Kiribati</option>
													  <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
													  <option value="Korea">Korea, Republic of</option>
													  <option value="Kuwait">Kuwait</option>
													  <option value="Kyrgyzstan">Kyrgyzstan</option>
													  <option value="Lao">Lao People's Democratic Republic</option>
													  <option value="Latvia">Latvia</option>
													  <option value="Lebanon">Lebanon</option>
													  <option value="Lesotho">Lesotho</option>
													  <option value="Liberia">Liberia</option>
													  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
													  <option value="Liechtenstein">Liechtenstein</option>
													  <option value="Lithuania">Lithuania</option>
													  <option value="Luxembourg">Luxembourg</option>
													  <option value="Macau">Macau</option>
													  <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
													  <option value="Madagascar">Madagascar</option>
													  <option value="Malawi">Malawi</option>
													  <option value="Malaysia">Malaysia</option>
													  <option value="Maldives">Maldives</option>
													  <option value="Mali">Mali</option>
													  <option value="Malta">Malta</option>
													  <option value="Marshall Islands">Marshall Islands</option>
													  <option value="Martinique">Martinique</option>
													  <option value="Mauritania">Mauritania</option>
													  <option value="Mauritius">Mauritius</option>
													  <option value="Mayotte">Mayotte</option>
													  <option value="Mexico">Mexico</option>
													  <option value="Micronesia">Micronesia, Federated States of</option>
													  <option value="Moldova">Moldova, Republic of</option>
													  <option value="Monaco">Monaco</option>
													  <option value="Mongolia">Mongolia</option>
													  <option value="Montserrat">Montserrat</option>
													  <option value="Morocco">Morocco</option>
													  <option value="Mozambique">Mozambique</option>
													  <option value="Myanmar">Myanmar</option>
													  <option value="Namibia">Namibia</option>
													  <option value="Nauru">Nauru</option>
													  <option value="Nepal">Nepal</option>
													  <option value="Netherlands">Netherlands</option>
													  <option value="Netherlands Antilles">Netherlands Antilles</option>
													  <option value="New Caledonia">New Caledonia</option>
													  <option value="New Zealand">New Zealand</option>
													  <option value="Nicaragua">Nicaragua</option>
													  <option value="Niger">Niger</option>
													  <option value="Nigeria">Nigeria</option>
													  <option value="Niue">Niue</option>
													  <option value="Norfolk Island">Norfolk Island</option>
													  <option value="Northern Mariana Islands">Northern Mariana Islands</option>
													  <option value="Norway">Norway</option>
													  <option value="Oman">Oman</option>
													  <option value="Pakistan">Pakistan</option>
													  <option value="Palau">Palau</option>
													  <option value="Panama">Panama</option>
													  <option value="Papua New Guinea">Papua New Guinea</option>
													  <option value="Paraguay">Paraguay</option>
													  <option value="Peru">Peru</option>
													  <option value="Philippines">Philippines</option>
													  <option value="Pitcairn">Pitcairn</option>
													  <option value="Poland">Poland</option>
													  <option value="Portugal">Portugal</option>
													  <option value="Puerto Rico">Puerto Rico</option>
													  <option value="Qatar">Qatar</option>
													  <option value="Reunion">Reunion</option>
													  <option value="Romania">Romania</option>
													  <option value="Russia">Russian Federation</option>
													  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
													  <option value="Saint LUCIA">Saint LUCIA</option>
													  <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
													  <option value="Samoa">Samoa</option>
													  <option value="San Marino">San Marino</option>
													  <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
													  <option value="Saudi Arabia">Saudi Arabia</option>
													  <option value="Senegal">Senegal</option>
													  <option value="Seychelles">Seychelles</option>
													  <option value="Sierra">Sierra Leone</option>
													  <option value="Singapore">Singapore</option>
													  <option value="Slovakia">Slovakia (Slovak Republic)</option>
													  <option value="Slovenia">Slovenia</option>
													  <option value="Solomon Islands">Solomon Islands</option>
													  <option value="Somalia">Somalia</option>
													  <option value="South Africa">South Africa</option>
													  <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
													  <option value="Span">Spain</option>
													  <option value="SriLanka">Sri Lanka</option>
													  <option value="St. Helena">St. Helena</option>
													  <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
													  <option value="Sudan">Sudan</option>
													  <option value="Suriname">Suriname</option>
													  <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
													  <option value="Swaziland">Swaziland</option>
													  <option value="Sweden">Sweden</option>
													  <option value="Switzerland">Switzerland</option>
													  <option value="Syria">Syrian Arab Republic</option>
													  <option value="Taiwan">Taiwan, Province of China</option>
													  <option value="Tajikistan">Tajikistan</option>
													  <option value="Tanzania">Tanzania, United Republic of</option>
													  <option value="Thailand">Thailand</option>
													  <option value="Togo">Togo</option>
													  <option value="Tokelau">Tokelau</option>
													  <option value="Tonga">Tonga</option>
													  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
													  <option value="Tunisia">Tunisia</option>
													  <option value="Turkey">Turkey</option>
													  <option value="Turkmenistan">Turkmenistan</option>
													  <option value="Turks and Caicos">Turks and Caicos Islands</option>
													  <option value="Tuvalu">Tuvalu</option>
													  <option value="Uganda">Uganda</option>
													  <option value="Ukraine">Ukraine</option>
													  <option value="United Arab Emirates">United Arab Emirates</option>
													  <option value="United Kingdom">United Kingdom</option>
													  <option value="United States">United States</option>
													  <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
													  <option value="Uruguay">Uruguay</option>
													  <option value="Uzbekistan">Uzbekistan</option>
													  <option value="Vanuatu">Vanuatu</option>
													  <option value="Venezuela">Venezuela</option>
													  <option value="Vietnam">Viet Nam</option>
													  <option value="Virgin Islands (British)">Virgin Islands (British)</option>
													  <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
													  <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
													  <option value="Western Sahara">Western Sahara</option>
													  <option value="Yemen">Yemen</option>
													  <option value="Serbia">Serbia</option>
													  <option value="Zambia">Zambia</option>
													  <option value="Zimbabwe">Zimbabwe</option>
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
                                                <input type="text" name="loan_amount" id="loan_amount" class="form-control" value="<?php echo $loan_amount; ?>">
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