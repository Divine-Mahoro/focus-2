                
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
								$query = "select cou.STUDNAME, cou.register_user_ID, cou.course_name 
								from report_students rep, register_course cou 
								where rep.register_user_ID = cou.register_user_ID 
								and rep.teacher_courses_id = cou.course_id 
								and rep.teacher_courses_id = '".$course."'
								and rep.register_user_ID not in (select DISTINCT register_user_ID 
								from approve_student where teacher_courses_id = '".$course."')
								and rep.register_user_ID not in (select DISTINCT register_user_ID 
								from reject_student where teacher_courses_id = '".$course."')";
								$stmt = $dbh->prepare($query);
								$stmt->execute();
								if($stmt->rowCount() > 0){
									$rowC = $stmt->fetch(PDO::FETCH_ASSOC);
									$course_name = $rowC['course_name'];
							?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reported student for <?php echo $course_name; ?></h4>
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
														<th><center>COMMENT</center></th>
														<th><center>ACTION</center></th>
													</tr>
												</thead>
												<tbody>
													<?php 
														$i = 1;
														while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
															$id = $row["register_user_ID"];
															echo '<tr>';
															echo '<td style="color:black"><center>'.$i.'</center></td>';
															echo '<td style="color:black">'.$row["register_user_ID"].'</td>';
															echo '<td style="color:black">'.$row["STUDNAME"].'</td>';
															echo '<td style="color:black"><textarea class="form-control" name="comment" rows="2" id="comment"></textarea></td>';
															echo '<input type="hidden" id="studentId" class="crs_data" value="'.$id.'" />';
															echo '<input type="hidden" id="courseId" class="crs_data" value="'.$course.'" />';
															echo '<td>';
															echo '<a href ="#" id="approve_link" onclick="approve();"><span class="btn btn-success">Approve<span class="btn-icon-right"><i
																		class="fa fa-check"></span></i></a>&nbsp;&nbsp;&nbsp;&nbsp';
															echo '<a href ="#" id="reject_link" onclick="reject();"><span class="btn btn-danger">Reject<span class="btn-icon-right"><i
																		class="fa fa-close"></span></i></a>&nbsp;&nbsp;&nbsp;&nbsp';
															echo '</td>';
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
								
								<!--<a href="attandance_to_excel.php?course=<?php echo $course; ?>" class="printbtn" title="Click to Download the Excel file" style="text-decoration: none;"><i class="fa fa-download" id="d1"></i>&nbsp;Download Excel</a></center>-->
                        </div>
                    </div>
					<?php
						} else {
							echo 'No records found.';
						}
					}
					?>
					
                    
                </div>
          
        <script type="text/javascript">
		
			function approve(){
				var comment=document.getElementById("comment").value;  
				var studentId=document.getElementById("studentId").value; 
				var courseId=document.getElementById("courseId").value; 
				var hrf="approveReportStudent?student="+studentId+"&course="+courseId+"&comment="+comment;
				document.getElementById("approve_link").href=hrf;
			}
			function reject(){
				var comment=document.getElementById("comment").value;  
				var studentId=document.getElementById("studentId").value; 
				var courseId=document.getElementById("courseId").value; 	
				var hrf="rejectReportStudent?student="+studentId+"&course="+courseId+"&comment="+comment;
				document.getElementById("reject_link").href=hrf;
			}
		
		</script>
