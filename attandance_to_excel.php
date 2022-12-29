<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['Admin'])){
  header("Location: index.php");
}

require_once("connection.php");
require_once("functions.php");

header('Content-type: application/vnd-ms-excel');
$filename ="Attandance_List.xls";
header("Content-Disposition:attachment;filename=\"$filename\"");

?>
				<?php
				if(isset($_GET['course'])){
					$course= $_GET['course'];
					$queCourse = "select * from register_course where course_id = '".$course."'";
					$stmtCourse = $dbh->prepare($queCourse);
					$stmtCourse->execute();
					if($rowCourse=$stmtCourse->fetch(PDO::FETCH_ASSOC)){
						$courseName = $rowCourse["course_name"];
						$teacher = $rowCourse["TEACHER"];
						$courseId = $rowCourse["course_id"];
						$printed_date = date('Y-m-d H:i:s');
					
					
					$query = "select * from register_course where course_id = '".$course."' 
									and register_user_ID in (select distinct register_user_ID 
									from teacher_attandance WHERE teacher_courses_id = '".$course."')";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
						
                        <div class="card">
                            <center><div class="card-header">
								<img src="images/auca_logo.png" style="width: 200px; height: 50px; align:center;" alt="">
                                <h4 class="card-title">FACULTY OF INFORMATION TECHNOLOGY</h4>
								<u><h4 class="card-title">EXAMINATION ATTENDANCE LIST</h4></u>
                            </div></center>
                            <?php 
								if(isset($success_msg) && $success_msg != ''){
									echo '<p class="text-success">'.$success_msg.'</p>';
								} else if(isset($warning_msg) && $warning_msg != ''){
									echo '<p class="text-warning">'.$warning_msg.'</p>';
								} else if(isset($error_msg) && $error_msg != ''){
									echo '<p class="text-danger">'.$error_msg.'</p>';
								}
							?>
							
							<?php if($stmt->rowCount() > 0){ ?>
                            <div class="card-body">
                                <div class="table-responsive my-4 align-items-center">
								<table id="example2" class="display" style="min-width: 945px" border="1">
												<thead>
													<tr>
														<th colspan="2">COURSE CODE</th>
														<th colspan="2"><?php echo $courseName; ?></th>
														<th>DATE: <?php echo $printed_date; ?> </th>
													</tr>
													<tr>
														<th colspan="2">Teacher name</th>
														<th colspan="2"><?php echo $teacher; ?></th>
														<th>GROUPE:--- </th>
													</tr>
													<tr>
														<th colspan="2">Course name</th>
														<th colspan="2"><?php echo $courseName; ?></th>
														<th>ROOM:--- </th>
													</tr>
													<tr>
														<th><center>S/N</center></th>
														<th><center>STUDENT ID</center></th>
														<th>STUDENT NAME</th>
														<th>BOOKLET NO</th>
														<th>SIGNATURE</th>
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
															echo '<td style="color:black"></td>';
															echo '<td style="color:black"></td>';
															echo '</tr>';
															$i++;
														}
														
													?>
												  
												</tbody>
								</table>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
					}
				}
			}
					?>
					</div>
					
					
            