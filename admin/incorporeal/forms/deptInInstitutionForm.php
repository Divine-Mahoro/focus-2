<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Dept Declaration</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                      <form action="<?php echo $main_link; ?>?dir=incorporeal&page=deptInInstitution" method="POST" enctype="multipart/form-data" name="rsForm" id="rsForm"
									    onsubmit="return getDetails();">
                                        <div class="row">
										  
											<div class="form-row col-md-6">
												<label for="myFile"> Upload File <span style="color: red; font-size: 16px;">*</span> </label>
												<input type="file" class="form-control" id="myFile" name="file" />(Allowed format: .pdf, .jpg, .jpeg and .png) Maximum File size: 5MB
											</div>
										
										</div>
										
										<div class="row">										
											<div class="form-row col-md-6" >
												<label for="val-currency"> Debts owe you <span style="color: red; font-size: 16px;">*</span> </label>
												<input type="text" class="form-control" name="debt_amount" id="debt_amount" placeholder="Debts owe you" />
                                            </div>
                                          
                                        </div>
										
										<div class="row">										
											<div class="form-row col-md-6" >
												<label for="val-currency"> Nature of debts <span style="color: red; font-size: 16px;">*</span> </label>
												<input type="text" class="form-control" name="nature_of_debt_documents" id="nature_of_debt_documents" placeholder="Debts owe you" />
                                            </div>
                                          
                                        </div>
										<br />
										
                                    
                                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					
					
                    
                </div>