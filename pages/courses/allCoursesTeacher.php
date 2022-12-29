<!-- row -->
<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					
					$query = "SELECT * FROM teacher_courses where register_user_ID ='$register_user_ID'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Teaching Rwanda</h4>
                            </div>
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
															$id = $row["teacher_courses_id"];
															echo '<tr>';
															echo '<td width="20%" style="color:black">'.$row["COURSE_NAME"].'</td>';
															echo '<td width="20%"style="color:black">'.$row["TEACHER"].'</td>';
															echo '<td width="15%" style="color:black">'.$row["TERM"].'</td>';
															echo '<td width="40%">';
															if($main_link == 'userHod'){
																echo '<a href="./pages/scan/createSessionHod?course='.$id.'" onclick="return confirm(\'Are you sure you want to create session?\');"><span class="badge badge-success">create session</span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
															}else{
																echo '<a href="./pages/scan/createSession?course='.$id.'" onclick="return confirm(\'Are you sure you want to create session?\');"><span class="badge badge-success">create session</span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
															}
															echo '</td>';
															echo '</tr>';
														}
														
													?>
												  
												</tbody>
										</table>
                                </div>
                            </div>
							<!--<center><button onclick="printContent('printdiv')" class="print1" title="Click to Print"><i class="fa fa-print" id="p1"></i>&nbsp;Print</button>&nbsp;&nbsp;
								<a href="declareProcess_to_excel.php" target="_blank" class="printbtn" title="Click to Download the Excel file" style="text-decoration: none;"><i class="fa fa-download" id="d1"></i>&nbsp;Download Excel</a></center>-->
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