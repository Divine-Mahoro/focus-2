                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Send Email</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="sendEmail.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
										<div class="form-row">
											<div class="form-group col-md-3" required>
												<label>All Employee <span class="text-danger">*</span></label>
												<label class="radio-inline" id="allEmployee">
													<input type="radio" value="allEmployee" name="employee" id="allEmployee"></label>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-3" required>
												<label>specific Employee <span class="text-danger">*</span></label>
												<label class="radio-inline" id="jointyes">
													<input type="radio" value="specific" name="employee" id="jointyes"></label>
												
											</div>
											<div class="form-group col-md-2" id="percentage_of_shares" style="display:none;">
                                                <label>Enter Employee ID <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="employee_id" name="entered_employee">
                                            </div>
										</div>
										
										</div>
                                        
                                    
                                        <button type="submit" name="sbmtEmail" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
						
                    </div>
					
					
                    
                </div>
				<script type="text/javascript">
				$("#specificEmployee").on("change",function(){
					$("#specificEmployeesView").show();
				});
				</script>
            
        <!--**********************************
            Content body end
        ***********************************-->
