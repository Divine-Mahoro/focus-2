<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Gift Declaration</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=movable&page=gift" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											
											<div class="form-group col-md-2" id="gift_type">
												<input type="text" class="form-control" name="gift_type" id="gift_type" placeholder="Gift type">
                                            </div>
											<div class="form-group col-md-2" id="estimated_value">
												<input type="text" class="form-control" name="estimated_value" id="estimated_value" placeholder="Estimated amount" >
                                            </div>
											<div class="form-group col-md-2" id="donor">
												<input type="text" class="form-control" id="donor" name="donor" placeholder="Donor">
                                            </div>
                                            
                                        </div>
										
                                        <input type="hidden" name="movable_asset_id" value="<?php echo $movable_asset_id; ?>" />
                                        <button type="submit" name="btnSubmit" class="btn btn-primary btn sweet-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <script type="text/javascript">
		
				function getDetails(){
					let giftType = document.forms["rsForm"]["gift_type"].value;
                    let estimatedValue = document.forms["rsForm"]["estimated_value"].value;
                    let donarValue = document.forms["rsForm"]["donor"].value;
                    if(giftType ==""){
                        alert("Gift type is mendetory");
                        return false;
                    }
                    if(estimatedValue == ""){
                        alert("Estimated value is mendetory");
                        return false;
                    }
                    if(donarValue == ""){
                        alert("Donor is mendetory");
                        return false;
                    }
				}
			</script>