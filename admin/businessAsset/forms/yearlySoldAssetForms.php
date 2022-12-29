<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Sold asset yearly Declaration</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=businessAsset&page=yearlySoldAsset" method="POST" name="rsForm" id="rsForm"
									    onsubmit="return getDetails();">
                                        <div class="form-row">
											<div class="form-group col-md-2" id="loan_clear_date">
												<input type="text" class="form-control" name="asset_type" id="asset_type" placeholder="Asset type" required>
                                            </div>
											<div class="form-group col-md-3">
											   
                                               <select class="custom-select mr-sm-2" name="locationValue" id="location">
                                                    <option value="">Location...</option>
                                                    <option value="1">Rwanda</option>
                                                    <option value="2">Abroad</option>
                                                </select>
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
												<input type="text" class="form-control" name="earned_amount" id="earned_amount" placeholder="Earned money" required>
                                            </div>
                                            
                                        </div>
										
                                    
                                        <button type="submit" name="btnSubmit"  class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
						
						
						
                        
                        
                        
                        
                        
						
                    </div>
					
					
                    
                </div>
                <script type="text/javascript">
		
                    function getDetails(){
                        
                        let locationValue = document.forms["rsForm"]["locationValue"].value;
                        if (document.forms[0]['locationValue'].value == "") {
                            alert("Please Select Location");
                            return false;
                        }
                    }
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
		
		        </script>