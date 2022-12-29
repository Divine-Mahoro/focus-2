<?php
require_once("connection.php");
require_once("functions.php");
$insert_msg = '';
$error_msg = '';
$warning_msg = '';
$curr_period_id = getSemesterId();
if(isset($_POST['sign_in'])){
	$user_name= prepare_input($_POST['user_name']);
    $password = prepare_input($_POST['password']);
    $PASS_CRYP = sha1($password);
	$sql = "select role from register_user where register_user_ID = '$user_name'";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	if($stmt->rowCount()){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$user_role = $row['role'];
	
		//$user_role=getFieldValueById("ROLE","register_user",$user_name);
		//print_r();
		if($curr_period_id == NULL && $user_role == "student" ){
			$warning_msg = '
							<div class="text-warning" style="margin-left: 15px;">Sorry. This is wrong semester, contact System admin</div>
						';
		} else if($curr_period_id == NULL && $user_role == "teacher"){
			$warning_msg = '
							<div class="text-warning" style="margin-left: 15px;">Sorry. This is wrong semester, contact System admin</div>
						';
		}else {
	  
			$sql = "SELECT * FROM register_user where register_user_ID='$user_name' AND PASSWORD='$password' OR register_user_ID='$user_name' AND PASSWORD='$PASS_CRYP'";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			if($stmt->rowCount()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$PASSWORD = $row['PASSWORD'];
				$register_user_ID = $row['register_user_ID'];	
				$role = $row['ROLE'];
				$STATUS == $row['STATUS'];
				echo "$role";
				if($register_user_ID == $PASSWORD){
					 echo "<script>location.assign('resetPassword?register_user_ID=".$register_user_ID."')</script>";
				}
				else if($role == "student" || $role == "Student"){
					session_start();
					session_start();
					$_SESSION['student'] = $register_user_ID;
					$_SESSION['main_link'] = "userStudent";
					echo "<script>location.assign('userStudent')</script>";
						
				}else if($role == "teacher" || $role == "Teacher"){
					session_start();
					$_SESSION['teacher'] = $register_user_ID;
					$_SESSION['main_link'] = "userTeacher";
					echo "<script>location.assign('userTeacher')</script>";
						
				}else if($role == "hod" || $role == "hod"){
					session_start();
					$_SESSION['hod'] = $register_user_ID;
					$_SESSION['main_link'] = "userHod";
					echo "<script>location.assign('userHod')</script>";
						
				} else if($role == "Admin"){
					session_start();
					$_SESSION['Admin'] = $register_user_ID;
					$_SESSION['main_link'] = "userAdmin";
					echo "<script>location.assign('userAdmin')</script>";
				}else{
					$warning_msg = '
						<div class="text-warning" style="margin-left: 15px;">User not found option</div>
					';
				}
				
			}else {
					 $error_msg = '
							<div class="text-danger" style="margin-left: 15px;">Error! Incorrect ID or Password.</div>
						';
					//echo "<script>location.assign('index')</script>";
				} 
		}
	}
}
/*
if(isset($_GET['reset_pwd']) && $_GET['reset_pwd'] == "success"){
    $insert_msg = '
                <div class="text-success" style="margin-left: 15px;">Your was Updated Successfully</div>
            ';
  }
*/
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AUCA MIS - Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/logo1.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-4">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
								<img src="./images/auca_logo.png" style="width: 300px; height: 80px; align:center;" alt=""/> 
                                    <h4 class="text-left text-dark mb-4"><center>SMART ATTENDANCE</center></h4>
                                    <div>                                        
                                            <?php 
                                                if(isset($success_msg) && (!empty(trim($success_msg)))){
                                                    echo '<p class="text-success">'.$success_msg.'</p>';
                                                } else if(isset($error_msg) && (!empty(trim($error_msg)))){
                                                    echo '<p class="text-danger">'.$error_msg.'</p>';
                                                } else if(isset($warning_msg) && (!empty(trim($warning_msg)))){
                                                    echo '<p class="text-warning">'.$warning_msg.'</p>';
                                                } else if(isset($_GET['success_msg']) && (!empty(trim($_GET['success_msg'])))){
                                                    echo '<p class="text-success">'.$_GET['success_msg'].'</p>';
                                                } else if(isset($_GET['error_msg']) && (!empty(trim($_GET['error_msg'])))){
                                                    echo '<p class="text-danger">'.$_GET['error_msg'].'</p>';
                                                } else if(isset($_GET['warning_msg']) && (!empty(trim($_GET['warning_msg'])))){
                                                    echo '<p class="text-warning">'.$_GET['warning_msg'].'</p>';
                                                }
                                            ?>                                    
                                    </div>
                                    <form action="index.php" method="POST" name="rsForm" id="rsForm"
									    onSubmit="return getDetails();">
                                        <div class="form-group">
                                            <label><strong>Employee ID <span class="text-danger">*</span></strong></label>
                                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter your ID" required />
											</div>
                                        <div class="form-group">
                                            <label><strong>Password <span class="text-danger">*</span></strong></label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" required />
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <!--<div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div>-->
                                            <!--<div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>-->
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="sign_in" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <!--<div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="./page-register.html">Sign up</a></p>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
	
	<script type="text/javascript">
		
                    function getDetails(){
                        
						let user_name = document.forms["rsForm"]["user_name"].value;
                    }
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
    </script>
</body>

</html>