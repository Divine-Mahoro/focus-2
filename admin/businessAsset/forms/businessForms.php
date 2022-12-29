 <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Business Declaration</h4>
                            </div>
                            <?php 
								if(isset($success_msg) && $success_msg != ''){
									echo '<p class="text-success">'.$success_msg.'</p>';
								} else if(isset($warning_msg) && $warning_msg != ''){
									echo '<p class="text-warning">'.$warning_msg.'</p>';
								} else if(isset($error_msg) && $error_msg != ''){
									echo '<p class="text-danger">'.$error_msg.'</p>';
								}
							?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php echo $main_link; ?>?dir=businessAsset&page=business" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											
											<div class="form-group col-md-2" id="gift_type">
												<input type="text" class="form-control" name="business_type" id="business_type" placeholder="Type of the business">
                                            </div>
											<div class="form-group col-md-2" id="estimated_value">
												<input type="text" class="form-control" name="capital" id="capital" placeholder="Capital" >
                                            </div>
											<div class="form-group col-md-2" id="donor">
												<input type="text" class="form-control" id="annual_turnover" name="annual_turnover" placeholder="Annual turnover">
                                            </div>
                                            <div class="form-group col-md-3" id="donor">
												<input type="text" class="form-control" id="annual_profit" name="annual_profit" placeholder="Annual profit or loss">
                                            </div>
                                            
                                        </div>
										
                                        <!-- <input type="hidden" name="movable_asset_id" value="<?php echo $movable_asset_id; ?>" /> -->
                                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
						
						
						
                        
                        
                        
                        
                        
						
                    </div>
					
					
                    
                </div>
            <script type="text/javascript">
		
				function getDetails(){
					let businessType = document.forms["rsForm"]["business_type"].value;
                    let capitalValue = document.forms["rsForm"]["capital"].value;
                    let annualTurnover = document.forms["rsForm"]["annual_turnover"].value;
                    let annualProfit = document.forms["rsForm"]["annual_profit"].value;
                    if(businessType ==""){
                        alert("Business type is mendetory");
                        return false;
                    }
                    if(capitalValue == ""){
                        alert("Capital value is mendetory");
                        return false;
                    }
                    if(annualTurnover == ""){
                        alert("Annualy TurnOver is mendetory");
                        return false;
                    }
                    if(annualProfit == ""){
                        alert("Annualy Profit is mendetory");
                        return false;
                    }
				}
			</script>