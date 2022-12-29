
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6"> 
                        <div class="card">
                            <div class="card-header">
							<? 
								$course_name = $_GET["course"];
							?>
                                <h4 class="card-title">Scan your QR Code <?php $course_name; ?></h4>
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
								<video id="preview" width="100%"></video>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-6"> 
                        <div class="card">
                            <div class="card-header">
							<? 
							?>
                                <h4 class="card-title">List of Attendance <?php $course_name; ?></h4>
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
								<div style="color:green; font-size: 20px;" id="responseDiv1" align="center"></div>
								<div style="color:red; font-size: 20px;" id="responseDiv2" align="center"></div>
								<div class="col responseDiv3"></div>
                            </div>
							
                            <div class="card-body">
								<input type="hidden" name="response" id="response" readonly="" placeholder="scan qr">
								<?php if(isset($_GET["course"])){?>
									<input type="hidden" value= "<?php echo $_GET["course"]; ?>" id="course" readonly="">
								<?php } else{ ?>
									<input type="text" value= "No Data Found" id="course" readonly="">
								<?php } 
								?>
								<?php
									$course = $_GET["course"];
									
									$course_session = getCourseSession($course);
									$query = "SELECT st.register_user_ID, st.name FROM register_user st, teacher_attandance tat 
											WHERE tat.teaching_session_id = '".$course_session."' and tat.teacher_courses_id = '".$course."' and 
											st.register_user_ID = tat.register_user_ID;";
									$stmt = $dbh->prepare($query);
									$stmt->execute();
									
								?>
								<?php if($stmt->rowCount() > 0){ ?>
								<div id="responseTable">
									<table class="table" style="min-width: 245px">
										<thead class="thead-primary">
											<tr>
												<th>Student ID</th>
												<th>Names</th>
											</tr>
										</thead>
										
										<tbody>
											<?php 
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
													echo '<tr>';
													echo '<td width="10%" style="color:black">'.$row["register_user_ID"].'</td>';
													echo '<td width="20%" style="color:black">'.$row["name"].'</td>';
													echo '</tr>';
												}
												echo '<table width="50%">';
													echo '<tr>';

														echo '<td>';
														$msg = "Attandance list Submitted successfuly";
														echo '<td align="center"><a href="'.$main_link,'?dir=courses&page=allCoursesTeacher&action=allCourse&success_msg='.$msg.'" class="btn" style="left: 120px;" id="submit">Submit</a></td>';
														echo '</tr>';
														echo '<tr>';
														echo '<td>&nbsp;</td>';

														echo '</tr>';
													echo '</table>';
											?>
										</tbody>
										<?php
											} else {
												echo '<br>';
												echo 'No records found.';
											}
										?>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>

			
            
        <script type="text/javascript">
		
		let scanner=new Instascan.Scanner({ video: document.getElementById('preview')});
		Instascan.Camera.getCameras().then(function(cameras){
			if(cameras.length>0){
				scanner.start(cameras[0]);
			}
			else{
				alert("No camera found");
			}
		}).catch(function(e){
			console.error(e);
		});
		scanner.addListener('scan',function(c){
			document.getElementById('response').value=c;
			  var course = $("#course").val();
			  $.ajax({
				url: 'getAttandedData.php',
				method: 'POST',
				data: {c:c, course:course},
				//dataType: 'JSON',
				success: function(data){
					if(data == 0){
						data = "You have alrerady registered.";
						$("#responseDiv1").hide();
						$("#responseDiv2").html(data);
					}else if(data == 1){
						data = "You have been reported in this course.";
						$("#responseDiv1").hide();
						$("#responseDiv2").html(data);
					} else if(data == 2){
						data = "You are not registered in this course.";
						$("#responseDiv1").hide();
						$("#responseDiv2").html(data);
					} else if(data == 3){
						data = "Wrong course selected. Please select a valid course.";
						$("#responseDiv1").hide();
						$("#responseDiv2").html(data);
					}else{
						$("#responseDiv1").html(data);
						//$("#responseTable").load(location.href + " #responseTable");
						location.reload();
					}
				}
			});
		});
		
		if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
		
		</script>