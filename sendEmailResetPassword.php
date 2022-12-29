<?php
	require_once("connection.php");
	require_once("functions.php");
	if(isset($_POST['btnReset'])){
			$entered_employee = prepare_input($_POST['employee_id']);
			$sqls = "SELECT * FROM employees WHERE employee_id = '".$entered_employee."'";  

			$stmts = $dbh->prepare($sqls);
			$stmts->execute();
			if($stmts->rowCount()){
			  $wellsent =0;
			  $notsent =0;
			  while($row = $stmts->fetch(PDO::FETCH_ASSOC)){
				$employee_id = $row['employee_id'];
				$email = $row['email'];
				$family_name = $row['email'];
				
				$url = "http://192.168.14.116:100/tor/resetPassword.php?employee_id=".$employee_id;

				  $to = $email;

				  $subject = 'Reset Password for Asset Declaration Portal';

				  $message = '<p>Dear "'.$family_name.'"</p>';

				 $message .= '<p>Kindly use the link below to reset password.</p>';


				  
				  $message .= '<a href = "'.$url.'">'.$url.'</a></p>';

				  $message .= '<br><p>Best Regards </p>';

				  $headers = "From: Asset Declaration <asset.declaration@rra.gov.rw>\r\n";
				  $headers .= "content-type: text/html\r\n";
					if(mail($to,$subject,$message,$headers)){
						$wellsent += 1;
					}
					else{
						$notsent += 1;
					}
			  }
				  echo"sent=". $wellsent;
				  echo"not sent=". $notsent;
			
				}
		
	}else echo "Action didn't catch";
		$dbh=null;
	
?>