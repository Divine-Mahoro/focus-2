<?php
	require_once("connection.php");
	require_once("functions.php");
	$insert_msg = '';
	$register_user_ID = $_GET['register_user_ID'];
	$qry = "SELECT * FROM register_user WHERE register_user_ID='".$register_user_ID."'";
	$stmt = $dbh->prepare($qry);
	$stmt->execute();
	$userData = $stmt->fetchAll();
	if(isset($_POST['resetPass'])){
      //print_r($_POST);
      $newpass= prepare_input($_POST['newpass']);
      $password = prepare_input($_POST['password']);
	  $register_user_ID = $_POST['register_user_ID'];
	  if($newpass != $password){
		  $error_msg = '
                    <div class="text-danger" style="margin-left: 15px;">Password is not match</div>
                ';
	  }
	  else{
		  $password = sha1($password);
  
		  $sql = "UPDATE register_user SET PASSWORD='$password' where register_user_ID='$register_user_ID'";
		  $stmt = $dbh->prepare($sql);
		if($stmt->execute()){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$STATUS = $row['STATUS'];
			$register_user_ID = $row['register_user_ID'];
			$role = $row['ROLE'];

			echo "<script>location.assign('index')</script>";
			
		} else {
			 $error_msg = '
					<div class="text-danger" style="margin-left: 15px;"> Password reset failed.</div>
				';
		} 
	  }
      
}

?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AUCA MIS - Reset password</title>
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
                                    <h4 class="text-left text-dark mb-4">Please, enter new password and comfirm it </h4>
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
                                    <form action="resetPassword.php" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-group">
                                            <label><strong>New Password <span class="text-danger">*</span></strong></label>
                                            <input type="password" name="newpass" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Comfirm password <span class="text-danger">*</span></strong></label>
                                            <input type="password" name="password" class="form-control" autocomplete="off">
                                        </div>
                                        <input type="hidden" name="register_user_ID" value="<?php echo $register_user_ID; ?>" />
                                        <div class="text-center">
                                            <button type="submit" name="resetPass" class="btn btn-primary btn-block">Login</button>
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
			alert(ok);
			let newpass = document.forms["rsForm"]["role"].value;
			let comfPass = document.forms["rsForm"]["password"].value;
			//alert("selected Employee id:"+id);
			if(newpass != comfPass){
				alert("Password is not Match, Re-Enter the Password");
				return false;
			}
		}
		
	</script>

</body>

</html>