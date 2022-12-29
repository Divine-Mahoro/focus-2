
       
                <?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/Admin/reports/test.php");
				}
				?>
				
                <!-- row -->
				<?php 
				  $sql = "SELECT COUNT(*) AS EMPLOYEE FROM employees ";
				  $stmt = $dbh->prepare($sql);
				  $stmt->execute();
				  $row = $stmt->fetch(PDO::FETCH_ASSOC);
				  $name = $row['EMPLOYEE'];
				  
				  $sql2 = "SELECT COUNT(*) EMPLOYEE_ALL FROM employees WHERE account_status = 'Enabled'";
				  $stmt2 = $dbh->prepare($sql2);
				  $stmt2->execute();
				  $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
				  $name2 = $row2['EMPLOYEE_ALL'];
				  
				  $submitted = "SELECT COUNT(*) AS SUBMIT FROM employees WHERE submitted_status = 1";
				  $stmtSubmitted = $dbh->prepare($submitted);
				  $stmtSubmitted->execute();
				  $rowSubmitted = $stmtSubmitted->fetch(PDO::FETCH_ASSOC);
				  $submittedRes = $rowSubmitted['SUBMIT'];
				  
				?>
                <div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
                        <div class="card">
                            <div class="card-body">
							<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=Admin&page=adminLink&action=add"> Add</a></span></div>
                                <div class="basic-form">
                                    <div id="links_content" style="min-height:490px;overflow-y: auto; font-color:#0b6a90;">
							<table width="60%" align="center" border="1">
								<tr bgcolor="#D3D3D3"></tr>
								<tr>
									<th colspan="2" style="align:center;" bgcolor="#0b6a90" class="Tabl1Hdr1"><center>System Admin</center>
										</th>
								</tr>
								<tr>
									<td style="color:black" align="center">Submited Employee <span class="badge badge-pill badge-primary"><?php echo $submittedRes . ' OF ' . $name; ?></span></td>
									<td style="color:black" align="center">Declared Process Employee<span class="badge badge-pill badge-primary"> <?php echo $name2 . ' OF ' . $name; ?></span></td>
								</tr>
									<td style="color:black" align="center">Undeclered employee</td>
									<td style="color:black" align="center"><a href="staff.php?dir=Admin&page=adminLink&action=unSbmt">Unsubmitted Employee</a></td>
								</tr>
								

							</table>
						</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        

