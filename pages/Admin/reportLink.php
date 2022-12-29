                
				<!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Filter report by course</h4>
								<?php 
									if(isset($_GET['success_msg']) && $_GET['success_msg'] != ''){
										echo '<p class="text-success">'.$_GET['success_msg'].'</p>';
									} else if(isset($_GET['warning_msg']) && $_GET['warning_msg'] != ''){
										echo '<p class="text-warning">'.$_GET['warning_msg'].'</p>';
									} else if(isset($_GET['error_msg']) && $_GET['error_msg'] != ''){
										echo '<p class="text-danger">'.$_GET['error_msg'].'</p>';
									} else if(isset($success_msg) && $success_msg != ''){
										echo '<p class="text-success">'.$success_msg.'</p>';
									} else if(isset($warning_msg) && $warning_msg != ''){
										echo '<p class="text-success">'.$warning_msg.'</p>';
									}  else if(isset($error_msg) && $error_msg != ''){
										echo '<p class="text-success">'.$error_msg.'</p>';
									}
								?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="#" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
									
											
											<div class="col-auto mb-2">
												<select class="custom-select mr-sm-2" name="course" id="course">
                                                     <option value="0">Select user...</option>
													 <?php 
														
															foreach($dbh->query("select * from teacher_courses order by COURSE_NAME") as $e){
																$id = $e['teacher_courses_id'];
																$tea = $e['TEACHER'];
																$name = $e['COURSE_NAME'] . " by " . $e['TEACHER'];
																echo '<option width="20%" id="course" name="course" style="color:black" value="'.$id.'">'.$name.'</option>';
															}
														
													?>
                                                </select>
                                            </div>
											
											<div class="col-auto mb-2">
												<button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                            </div>
                                            
                                        </div>
										
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-12 col-xxl-12">
						<?php 
							if(isset($_POST['btnSubmit'])){
								//print_r($_POST);
								$course= prepare_input($_POST['course']);
								$query = "select * from register_course where course_id = '".$course."' 
									and register_user_ID in (select distinct register_user_ID 
									from teacher_attandance WHERE teacher_courses_id = '".$course."')";
								$stmt = $dbh->prepare($query);
								$stmt->execute();
								if($stmt->rowCount() > 0){
									$rowC = $stmt->fetch(PDO::FETCH_ASSOC);
									$course_name = $rowC['course_name'];
							?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List of Sitting students in Exam for <?php echo $course_name; ?></h4>
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
							
							<?php  ?>
                            <div class="card-body">
                                <div class="table-responsive my-4 align-items-center">
								   <table id="example2" class="display" style="min-width: 945px">
												<thead>
													<tr>
														<th><center>S/N</center></th>
														<th>STUDENT ID</center></th>
														<th>STUDENT NAME</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														$i = 1;
														while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
															$id = $row["register_course_id"];
															echo '<tr>';
															echo '<td style="color:black"><center>'.$i.'</center></td>';
															echo '<td style="color:black">'.$row["register_user_ID"].'</td>';
															echo '<td style="color:black">'.$row["STUDNAME"].'</td>';
															echo '</tr>';
															$i++;
														}
														
													?>
												  
												</tbody>
										</table>
										<input type="hidden" id="crs_data" class="crs_data" value="<?php echo $course; ?>" />
                                </div>
                            </div>
							<center>
							<!--<button onclick="printContent('printdiv')" class="print1" title="Click to Print"><i class="fa fa-print" id="p1"></i>&nbsp;Print</button>&nbsp;&nbsp;-->
								
								<a href="attandance_to_excel.php?course=<?php echo $course; ?>" class="printbtn" title="Click to Download the Excel file" style="text-decoration: none;"><i class="fa fa-download" id="d1"></i>&nbsp;Download Excel</a></center>
                        </div>
                    </div>
					<?php
						} else {
							echo 'No records found.';
						}
					}
					?>
					
                    
                </div>
            <style type="text/css">
.print1{
	background-color: #289;
    border-radius: 8px;
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 15px;
}
.print1:hover{background-color:#FFF; color: #289;}

.print1 #p1{display: none;}
.print1:hover #p1{display: inline;}
.printbtn{
    background-color: #006;
    border-radius: 12px;
    border: none;
    color: white;
    padding: 6px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 15px;
 }
 .printbtn:hover{background-color:#FFF; color: #006;}

 .printbtn #d1{display: none;}
 .printbtn:hover #d1{display: inline;}
 .printbtn:visited{color: white;}
 .button{
    text-decoration: none;
    background-color: #03a9f4;
    color:#fff;
    padding: 10px 15px;
    border:none;
    margin-top: 10px;
    border-radius: 24px;
    transition: 0.25s;
    outline:none;
    cursor:pointer;
}
.button:hover{
    background-color: green;
}
</style>
        <script type="text/javascript">
		
		function getDetails(){
			let course = document.forms["rsForm"]["course"].value;
			alert("selected Employee id:"+course);
			if(course == "0" || course = 0){
				alert("Please select course to filter");
				return false;
			}
			
		}
		
		</script>
