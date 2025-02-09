<?php 
            $error_msg = '';
            $success_msg = '';
            $warning_msg = '';
            
            

            if(isset($_POST['btnSubmit'])){
                //print_r($_POST);
                $business_type = prepare_input($_POST['business_type']);
                $capital = prepare_input($_POST['capital']);
                $annual_turnover = prepare_input($_POST['annual_turnover']);
                $annual_profit = prepare_input($_POST['annual_profit']);

                $tableName = "business_declaration";
                $fieldsNames = array(
                    "employee_id",
                    "declaration_period_id",
                    "business_type",
                    "capital",
                    "annual_turnover",
                    "annual_profit",
                    "declaration_date"
                     );
                     $fieldsValues = array(
						$employee_id,
                        getDeclarationPeriodId(),
                        $business_type,
                        $capital,
                        $annual_turnover,
                        $annual_profit,
                        date("Y-m-d H:i:s")
                        );	

                        if(getDeclarationPeriodId() != NULL){
                            if(insertRecord($tableName,$fieldsNames,$fieldsValues)>0){
                                $success_msg = 'Record inserted successfully';
                            } else {
                                $error_msg = 'Error occurs while inserting record';
                            }
                        } else {
                            $error_msg = 'It is not period of declaration now!';
                        }
            }
            
        ?>
				<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/businessAsset/forms/businessForms.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM business_declaration
								 WHERE business_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/businessEditForms.php");
				} else {
					$query = "SELECT * FROM business_declaration
							  WHERE employee_id = '".$_SESSION['employee']."'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
				?>
				

				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
				
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
								<?php echo $upd_qry;?>
								<div class="col-12">
									<div class="card">
									<div class="card-body">
									
										<div class="table-responsive my-3 align-items-center">
										<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=businessAsset&page=business&action=add"> Add</a></span></div>
											<table id="example2" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th><center>Business Type</center></th>
														<th><center>Capital</center></th>
														<th>Annual Turnover</th>
														<th>Annual Profit</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
															$id = $row["business_declaration_id"];
															echo '<tr>';
															echo '<td style="color:black"><center>'.$row["business_type"].'</center></td>';
															echo '<td style="color:black"><center>'.$row["capital"].'</center></td>';
															echo '<td style="color:black">'.$row["annual_turnover"].'</td>';
															echo '<td style="color:black">'.$row["annual_profit"].'</td>';
															echo '<input type="hidden" class="res_data" value="'.$id.'" />';
															echo '<td>';
															echo '<a href="editBusiness.php?edit='.$id.'"><i class="fa fa-pencil text-dark" aria-hidden="true"></i></a>&nbsp;&nbsp;';
															echo '<a href="./pages/businessAsset/deleteBusiness.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
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
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=businessAsset&page=business&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								?>
					</div>
				</div>
        <!--**********************************
            Content body end
        ***********************************-->
