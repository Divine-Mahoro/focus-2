

				<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
							<div class="card-header"><h4 class="card-title">Reported Notification</h4></div>
							<div class="card-body">
								<div class="email-list mt-4">
									<?php 
										foreach($dbh->query("select DISTINCT rep.register_user_ID, rep.teacher_courses_id, cou.course_name, cou.TEACHER, rep.date 
												from report_students rep, register_course cou where rep.teacher_courses_id = cou.course_id and 
												rep.register_user_ID = '".$register_user_ID."' and rep.teacher_courses_id in 
												(select course_id from register_course where register_user_ID = '".$register_user_ID."')") as $e){
											$course_name = $e['course_name'];
											$teacher = $e['TEACHER'];
											$insert_date = $e['date'];
									?>
									<div class="message">
										<div>
											<div class="d-flex message-single">
												<div class="custom-control custom-checkbox pl-4">
													<input type="checkbox">
												</div>
												<div class="ml-2">
													<button class="border-0 bg-transparent align-middle p-0"><i
														class="fa fa-star" aria-hidden="true"></i></button>
												</div>
											</div>
											<a href="email-read.html" class="col-mail col-mail-2">
												<div class="subject">You have been reported in <?php echo $course_name; ?> by <?php echo $teacher; ?>.</div>
												<div class="pull-right"><?php echo $insert_date; ?></div>
											</a>
										</div>
									</div>
									<?php } ?>
									<?php 
										foreach($dbh->query("select DISTINCT apr.register_user_ID, apr.teacher_courses_id, cou.course_name, cou.TEACHER, apr.date 
											from approve_student apr, register_course cou where apr.teacher_courses_id = cou.course_id and 
											apr.register_user_ID = '".$register_user_ID."' and apr.teacher_courses_id in 
											(select course_id from register_course where register_user_ID = '".$register_user_ID."')") as $e){
											$course_name = $e['course_name'];
											$teacher = $e['TEACHER'];
											$insert_date = $e['date'];
									?>
									<div class="message">
										<div>
											<div class="d-flex message-single">
												<div class="custom-control custom-checkbox pl-4">
													<input type="checkbox">
												</div>
												<div class="ml-2">
													<button class="border-0 bg-transparent align-middle p-0"><i
														class="fa fa-star" aria-hidden="true"></i></button>
												</div>
											</div>
											<a href="email-read.html" class="col-mail col-mail-2">
												<div class="subject">You have been approved in <?php echo $course_name; ?> by <?php echo $teacher; ?>.</div>
												<div class="pull-right"><?php echo $insert_date; ?></div>
											</a>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>