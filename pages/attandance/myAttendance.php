<!-- row -->
<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					
					$query = "SELECT * FROM register_course where register_user_ID ='$register_user_ID'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Courses</h4>
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
							
							<?php if($stmt->rowCount() > 0){ ?>
                            <div class="card-body">
                                <div class="table-responsive my-4 align-items-center">
								<div><button class="pull-right btn btn-primary type="button" onclick="history.back();"> Back</button></div>
                                    <table id="example2" class="display" style="min-width: 245px">
												<thead>
													<tr>
														<th>     Course Name</th>
														<th>     Teacher</th>
														<th>Term</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
															$id = $row["course_id"];
															echo '<tr>';
															echo '<td width="20%" style="color:black">'.$row["course_name"].'</td>';
															echo '<td width="20%"style="color:black">'.$row["TEACHER"].'</td>';
															echo '<td width="15%" style="color:black">'.$row["TERM"].'</td>';
															echo '<td width="40%">';
															if($main_link == 'userAdmin'){
																echo '<a href="showAdmin.php?course='.$register_user_ID.'"><span class="badge badge-success">Attend</span></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
															}
															if($main_link == 'userStudent'){
																echo '<a href="showStudent?course='.$register_user_ID.'"><span class="badge badge-success">Attend</span></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
															}
															echo '</td>';
															
															
															echo '</tr>';
														}
														
													?>
												  
												</tbody>
										</table>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
						} else {
							echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=immovable&page=fishPond&action=add"> Add</a></span></div>';
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

<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>