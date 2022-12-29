<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Money Declaration</h4>
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
                                    <form action="<?php echo $main_link; ?>?dir=movable&page=money" method="POST" name="rsForm" id="rsForm"
									>
                                        <div class="form-row mb-2">
										
											<div class="col mt-2 mt-sm-0">
                                                <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Bank Name" required>
                                            </div>
                                            <div class="col mt-2 mt-sm-0">
                                                <input type="text" id="account_number" name="account_number" class="form-control" placeholder="Account number" required>
                                            </div>
											<div class="col mt-2 mt-sm-0">
                                                <input type="text" id="balance" name="balance" class="form-control" placeholder="Amount in RWF" required>
                                            </div>
											
										</div>
                                        
                                        <div class="form-row" style="display:none;">
											<div class="form-group col-md-6">
                                               
                                                <select class="custom-select mr-sm-2" name="asset_owner" id="asset_owner_id">
                                                    <option value="0">Owner...</option>
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
										
										
										<div class="form-row">
											
											<div class="form-group col-md-2" id="loan_clear_date">
												<input type="text" id="currency_amount" name="currency_amount" class="form-control" placeholder="Amount in currency" required>
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
												<input type="text" id="money_in_contract" name="money_in_contract" class="form-control" placeholder="Money on Contract" required>
                                            </div>
											
                                            
                                        </div>
										
										
										
                                    
                                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>