<?php 
$error_msg = '';
$success_msg = '';
$warning_msg = '';

if(isset($_GET['fileId'])){
	$fileId = $_GET['fileId'];
	$filename = getFieldValueById("document_name","incorporeal_debt_declarations",$fileId);
	$fileType = getFieldValueById("document_type","incorporeal_debt_declarations",$fileId);
	$fileSize = getFieldValueById("document_size","incorporeal_debt_declarations",$fileId);
	$user_dir = "uploads/".$employee_id;
	$filepath = $user_dir.'/'.$filename;
	
	echo '$filename '.$filename; echo '<br>';
	echo '$fileType '.$fileType; echo '<br>';
	echo '$filepath '.$filepath; echo '<br>';
	
	if(file_exists($filepath)) {

		//Define header information
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: 0");
		header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
		header('Content-Length: ' . filesize($filepath));
		header('Pragma: public');

		//Clear system output buffer
		flush();

		//Read the size of the file
		readfile($filepath);

		//Terminate from the script
		die();
	}
	else {
		echo "File does not exist.";
	}

	
} else if(isset($_POST['btnSubmit'])){
    //print_r($_POST);
    $nature_of_debt_documents = prepare_input($_POST['nature_of_debt_documents']);
    $debt_amount = prepare_input($_POST['debt_amount']);
	if(isset($_FILES['file'])){
		$file_name = $_FILES['file']['name'];
		$file_tmp_name = $_FILES['file']['tmp_name'];
		$file_type = $_FILES['file']['type'];
		$file_size = $_FILES['file']['size'];
		$file_error = $_FILES['file']['error'];					
					
		$allowedFileTypes = array("jpeg","jpg","png","pdf");              
        $fileExt = explode('.',$file_name);
        $fileActualExt = strtolower(end($fileExt));
        $file_upload_msg = '';   
        if(in_array($fileActualExt,$allowedFileTypes)){
            if($file_error === 0){
                if($file_size < 5242880){
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $user_dir = "uploads/".$employee_id;
					if (!is_dir($user_dir))
					{
						rmkdir($user_dir);
					}
					
                    $fileDestination = $user_dir."/".$fileNameNew;
					                    
                    if(move_uploaded_file($file_tmp_name, $fileDestination)){ // Upload file file in specified directory
                        $file_upload_msg .= $file_name . " upload is complete.<br />";
						
						$tableName = "incorporeal_debt_declarations";
						$fieldsNames = array(
                            "employee_id",
                            "declaration_period_id",
                            "nature_of_debt_documents",
                            "debt_amount",
                            "document_name",
                            "document_type",
							"document_size",
							"document_path",
							"declaration_date"
						);
						$fieldsValues = array(
                            $employee_id,
                            getDeclarationPeriodId(),
                            $nature_of_debt_documents,
                            $debt_amount,
							$fileNameNew,
							$file_type,
							$file_size,
							$fileDestination,
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
						
                    } else {
                        $error_msg = "move_uploaded_file function failed for " . $file_name . "<br />";
                    }
                } else {
                    $error_msg = "Your file is too big! (".($file_size/1024)." KB)<br />";
                }
            } else {
                $error_msg = "There was an error uploading your file!<br />";
            }
        } else {
            //$error_msg = "You cannot upload files of this type!<br />";
			$error_msg = $file_name;
		}
	} else { $error_msg = "No file"; }

}                    

?>
       
                
            <?php if(!(isset($_GET['action']) and $_GET['action']=="add")){ ?>
				<?php } else { ?>
						
			<?php } ?>

			<?php 
				if(isset($_GET["action"]) and $_GET["action"]="add"){
					include("pages/incorporeal/forms/deptInInstitutionForm.php");
				} else if(isset($_GET["action"]) and $_GET["action"]="edit"){
					$id = $_GET["edit"];
					$edit_qry = "SELECT * FROM incorporeal_debt_declarations
								 WHERE incorporeal_debt_declaration_id='".$id."'";
					$stmt = $dbh->prepare($edit_qry);
					$stmt->execute();
					if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);						
					}
					echo 'ID= '.$id;
					include("forms/sharesInSocietyEditForm.php");
				} else {
					$query = "SELECT * FROM incorporeal_debt_declarations
							  WHERE employee_id = '".$_SESSION['employee']."'";
					$stmt = $dbh->prepare($query);
					$stmt->execute();
			?>
				

				<div class="row">
                    <div class="col-xl-6 col-xxl-12"> 
				
							<div class="card-body">
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
                                <div class="table-responsive">
								<div><span class="pull-right btn btn-primary"><a href="<?php echo $main_link; ?>?dir=incorporeal&page=deptInInstitution&action=add"> Add</a></span></div>
                                    <table id="example2" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nature of Debt</th>
												<th>Debt amount</th>
                                                <th align="center">Location</th>
												<th>Document</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												echo $user_dir;
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
													$id = $row["incorporeal_debt_declaration_id"];
													$doc_path = $row["document_path"];;
													$doc_name = $row["document_name"];
												
													echo $file;
													echo '<tr>';
													echo '<td>'.$row["nature_of_debt_documents"].'</td>';
													echo '<td>'.$row["debt_amount"].'</td>';
													if($row["asset_location_id"] == 1){
														echo '<td>Rwanda</td>';
													} else {
														echo '<td>Abroad</td>';
													}
													echo '<td><a href="'.$main_link.'?dir=incorporeal&page=deptInInstitution&fileId='.$id.'"><img src="images/download.jfif" width="20" /></a></td>';
													echo '<input type="hidden" class="res_data" value="'.$id.'" />';
													echo '<td>';
													echo '<a href="./pages/incorporeal/deleteDebtInInstitution.php?delete='.$id.'" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';													
													echo '</td>';
													echo '</tr>';
												}
												
											?>
                                          
                                        </tbody>
										
                                       
                                   	 </table>
                                </div>


                            </div>
								<?php
									} else {
										echo '<div><span class="pull-right btn btn-primary"><a href="'.$main_link.'?dir=movable&page=money&action=add"> Add</a></span></div>';
										echo 'No records found.';
									}
								}
								
								?>
					</div>
				</div>    