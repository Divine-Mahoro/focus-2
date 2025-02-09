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
								<?php if($main_link == 'staffUser.php'){ ?>
                                    <form action="editMoneyUser.php" method="POST" name="rsForm" id="rsForm">
								<?php } else { ?>
									<form action="editMoney.php" method="POST" name="rsForm" id="rsForm">
								<?php } ?>
                                        <div class="form-row mb-2">
										
											<div class="col mt-2 mt-sm-0">
                                                <input type="text" id="bank_name" name="bank_name" class="form-control" value="<?php echo $bank_name; ?>" required>
                                            </div>
                                            <div class="col mt-2 mt-sm-0">
                                                <input type="text" id="account_number" name="account_number" class="form-control" value="<?php echo $account_number; ?>" required>
                                            </div>
											<div class="col mt-2 mt-sm-0">
                                                <input type="text" id="balance" name="balance" class="form-control" value="<?php echo $balance; ?>" required>
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
												<input type="text" id="currency_amount" name="currency_amount" class="form-control" value="<?php echo $currency_amount; ?>" required>
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
												<input type="text" id="money_in_contract" name="money_in_contract" class="form-control" value="<?php echo $money_in_contract; ?>" required>
                                            </div>
                                        </div>
										<input type="hidden" name="money_declaration_id" value="<?php echo $money_declaration_id; ?>" />
                                        <input type="hidden" name="movable_asset_id" value="<?php echo $movable_asset_id; ?>" />
                                        <button type="submit" name="btnEdit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>