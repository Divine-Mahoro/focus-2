<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Shares in Society Declaration</h4>
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
                                    <form action="editSharesInSocietyUser.php" method="POST" name="rsForm" id="rsForm"
									    onsubmit="return getDetails();">
								<?php } else {  ?>
									<form action="editSharesInSociety.php" method="POST" name="rsForm" id="rsForm"
									    onsubmit="return getDetails();">
								<?php } ?>
                                        <div class="form-row">
											
											<div class="form-group col-md-2" id="company">
												<input type="text" class="form-control" name="company" id="company" value="<?php echo $company; ?>" required>
                                            </div>
											<div class="form-group col-md-2" id="dividend">
												<input type="text" class="form-control" name="dividend" id="dividend" value="<?php echo $dividend; ?>" required>
                                            </div>
                                                <div class="form-group col-md-2">
                                                    <select class="custom-select mr-sm-2" name="locationValue" id="locationValue">
                                                            <option value="">Location...</option>
                                                            <option value="1" <?php if($asset_location_id==1){ echo 'selected="selected"'; } ?>>Rwanda</option>
															<option value="2" <?php if($asset_location_id==2){ echo 'selected="selected"'; } ?>>Abroad</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            
                                        </div>
										<input type="hidden" name="shares_in_society_id" value="<?php echo $shares_in_society_id; ?>" />
                                        <button type="submit" name="btnEdit"  class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
		
                    function getDetails(){
                        
                        let locationValue = document.forms["rsForm"]["locationValue"].value;
                    }
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                </script>