<?php 
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$qryEdit = "SELECT * FROM semester WHERE semester_id='".$id."'";
		$stmtEdit = $dbh->prepare($qryEdit);
		$stmtEdit->execute();
		if($result = $stmtEdit->fetch(PDO::FETCH_ASSOC)){
			extract($result);
		}
		
	} else if(isset($_POST['btnEdit'])){
		$declaration_period_id = $_POST['declaration_period_id'];
		$start_date = prepare_input($_POST['start_date']);
		$end_date = prepare_input($_POST['end_date']);
		
		$qryUpd = "UPDATE semester 
				   SET start_date='".$start_date."', end_date='".$end_date."' 
				   WHERE semester_id = '".$declaration_period_id."'";
		$stmtUpd = $dbh->prepare($qryUpd);
		
		if($stmtUpd->execute()){
			$success_msg = 'Period updated';
		} else {
			$warning_msg = 'Error. Updation failure.';
		}
		
		
	} else if(isset($_POST['btnSubmit'])){
		$start_date = prepare_input($_POST['start_date']);
		$end_date = prepare_input($_POST['end_date']);
		
		//$yearOfDec = date("Y",strtotime($start_date));
		$yearOfSem = date("Y");
		$qry = "INSERT INTO semester(
					start_date,
					end_date,
					semester_year
					) VALUES (
						'".$start_date."',
						'".$end_date."',
						'".$yearOfSem."'
					)";
		$stmt = $dbh->prepare($qry);								
		if($stmt->execute()){
			$success_msg = 'Period created successfully';
		}else{
			$error_msg = 'Error occur while creating period';
		}
	}
?>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Declaration Periods</h4>
                            </div>
                            <?php 
								if(isset($success_msg) && $success_msg != ''){
									echo '<p class="text-success ml-4">'.$success_msg.'</p>';
								} else if(isset($warning_msg) && $warning_msg != ''){
									echo '<p class="text-warning ml-4">'.$warning_msg.'</p>';
								} else if(isset($error_msg) && $error_msg != ''){
									echo '<p class="text-danger ml-4">'.$error_msg.'</p>';
								}
							?>
                            <div class="card-body">
								<div class="basic-form">
								
									<?php if(isset($_GET['action']) and $_GET['action'] == "edit"){ ?>
									<form action="<?php echo $main_link; ?>?dir=Admin&page=createSemester" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											<div class="form-group col-md-2" id="loan_clear_date">
												<label>Start Date<span class="text-danger">*</span></label>
												<input type="date" name="start_date" id = "start_date" class="form-control" value="<?php echo $start_date; ?>" required />
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
												<label>End Date<span class="text-danger">*</span></label>
												<input type="date" name="end_date" id = "end_date" class="form-control" value="<?php echo $end_date; ?>" required />
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
											<label><span style="background-color:white; width: 50px; color:white;">Create New period</span></label>
											<input type="hidden" name="declaration_period_id" value="<?php echo $semester_id; ?>" />
											<button type="submit" name="btnEdit" class="btn btn-primary">UPDATE</button>
											</div>
                                        </div>										
                                        
                                    </form>
                      
									<?php } else { ?>
									
									 <form action="<?php echo $main_link; ?>?dir=Admin&page=createSemester" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
											<div class="form-group col-md-2" id="loan_clear_date">
												<label>Start Date<span class="text-danger">*</span></label>
												<input type="date" name="start_date" id = "start_date" class="form-control" placeholder="yyyy-mm-dd" required />
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
												<label>End Date<span class="text-danger">*</span></label>
												<input type="date" name="end_date" id = "end_date" class="form-control" placeholder="yyyy-mm-dd" required />
                                            </div>
											<div class="form-group col-md-2" id="loan_clear_date">
											<label><span style="background-color:white; width: 50px; color:white;">Create New period</span></label>
											<button type="submit" name="btnSubmit" class="btn btn-primary">Create New period</button>
											</div>
                                        </div>										
                                        
                                    </form>
									<?php } ?>
									
									<?php 
									$currYear = date("Y");
									$query = "SELECT * FROM semester WHERE semester_year >= ".$currYear;
									echo '<ul>';
									foreach($dbh->query($query) as $p){
										$pid = $p["semester_id"];
										$y1 = date("Y",strtotime($p["start_date"]));
										$m1 = date("M",strtotime($p["start_date"]));
										$d1 = date("d",strtotime($p["start_date"]));
										
										$y2 = date("Y",strtotime($p["end_date"]));
										$m2 = date("M",strtotime($p["end_date"]));
										$d2 = date("d",strtotime($p["end_date"]));
										
										$periodFrom = $d1 . " " . $m1 . " " . $y1;
										$periodTo = $d2 . " " . $m2 . " " . $y2;
										echo '<li class="p-1">'.$periodFrom . ' - ' . $periodTo;
										echo '<span class=" ml-2 p-1 label label-default rounded"><a href="'.$main_link.'?dir=Admin&page=createSemester&edit='.$pid.'&action=edit" style="color: #345;">MODIFY</a></span>';
										echo '</li>';
									}
									echo '</ul>';
									?>
									
                                </div>
							</div>
						</div>
					</div>
				</div>