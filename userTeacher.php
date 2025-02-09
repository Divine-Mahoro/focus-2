<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['teacher'])){
	
  header("Location: index");
}

require_once("connection.php");
require_once("functions.php");
$register_user_ID;
if(isset($_SESSION['teacher'])){
  $register_user_ID = $_SESSION['teacher'];
  $sql = "SELECT * FROM register_user where register_user_ID='$register_user_ID'";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $name = $row['NAME'];
  
$main_link="userTeacher"; 
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AUCA MIS </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/logo1.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
	<!-- Material color picker -->
    <link href="./vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="./vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="./vendor/pickadate/themes/default.date.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<!-- Full calender -->
	<link href="./vendor/fullcalendar/css/fullcalendar.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/scandit-sdk@4.x"></script>
	<script src="instascan.min.js"></script>
	<!-- Script to generate qr -->
	<script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>
</head>

<body onclick="console.log('body clicked')">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> 
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
                <!-- <img class="logo-abbr" src="./images/tor-white.png" alt=""> -->
                <!-- <img class="logo-compact" src="./images/asset.png" alt="">-->
                <br><img class="metismenu" src="./images/auca_logo.png" style="width: 200px; height: 50px; align:center;" alt="">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <a href="#" class="brand-logo">
								<!-- <img class="brand-title" src="./images/aucajpg.jpg" style="width: 70px; height: 70px" alt=""> -->
							</a>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <!--<a href="#" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>-->
                                    <a href="logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
					<li><a href="<?php echo $main_link; ?>?dir=courses&page=allCoursesTeacher&action=allCourse" aria-expanded="false"><i
                                class="bi-book-half"></i><span class="nav-text">My Teaching Courses<span class="badge badge-warning ml-1"><?php echo $resultBusiness; ?></span></span></a></li>
					
					<li><a href="<?php echo $main_link; ?>?dir=teacher&page=reportStudent" aria-expanded="false"><i
                                class="bi-card-list"></i><span class="nav-text">Reported Student<span class="badge badge-warning ml-1"><?php echo $resultSold; ?></span></span></a></li>
							
                    
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        
				
		<div class="content-body">
		
            <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
						<h4>Hi, <?php echo $name; ?>!</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">
							
							<?php 
							 if(isset($_GET['dir'])){
								 echo ucfirst($_GET['dir']);
							 }
							?>
							</a></li>
                            <li class="breadcrumb-item active"><a href="#">
							<?php 
							 if(isset($_GET['page'])){
								 echo ucfirst($_GET['page']);
							 }
							?>
							</a></li>
                        </ol>
                    </div>
                </div>
				
			<!-- row -->
            <div class="container-fluid">
                
            <?php
					$path = "pages/login";
					$page = "homeContent";
					$extension  = ".php";
					
					
					
					if(isset($_GET['dir'])){
						$path = "pages/".$_GET['dir']; 
					}
					
					if(isset($_GET['page'])){
						$page = $_GET['page'];
					} 
					
					$selected_file = $path."/".$page.$extension;
					
					if(file_exists($selected_file)){
						
                        include($selected_file);
					} else {
						echo 'Page not found';
					}
					
			?>
                
                

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed for <a href="#" target="_blank">SMART ATTANDANCE</a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>


    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
	<script src="./js/jquery.min.js"></script>
  
  <script type="text/javascript">
  
  $(document).ready(function(){
	  $("#location").on("change",function(){
		  var location = $(this).val();
		  if(location == 1){
			  $("#province").show();
			  $("#district").hide();
			  $("#sector").hide();
			  $("#cell").hide();
			  $("#village").hide();
			  $("#countryValue").val("");
			  $("#cityValue").val("");
			  $.ajax({
				  method: 'post',
				  url: 'getProvinces.php',
				  success: function(response){
					$("#province").empty();
					$("#province").append(response);
				  }
			  });
			  
			$("#countryValue").hide();
			$("#cityValue").hide();
			  
		  } else if(location == 2){
			   $("#province").hide();
			   $("#province").val("");
			   $("#district").hide();
			   $("#district").val("");
			   $("#sector").hide();
			   $("#sector").val("");
			   $("#cell").hide();
			   $("#cell").val("");
			   $("#village").hide();
			   $("#village").val("");
			   $("#countryValue").show();
			   $("#cityValue").show();
		  }
	  });
	  
	  $("#province").on("change",function(){
		  $("#district").show();
		  $("#district").css('required','');
		  $("#sector").hide();
		  $("#sector").val("");
		  $("#cell").hide();
		  $("#cell").val("");
		  $("#village").hide();
		  $("#village").val("");
		  var p = $(this).val();
		   $.ajax({
				  method: 'post',
				  url: 'getDistricts.php',
				  data: {pcode:p},
				  success: function(response){					
					$("#district").empty();
					$("#district").append(response);
				  }
				});
	  });
	  $("#district").on("change",function(){
		  $("#sector").show();
		  $("#sector").css('required','');
		  $("#cell").hide();
		  $("#cell").val("");
		  $("#village").hide();
          $("#village").val("");	  
		   var d = $(this).val();
		   $.ajax({
				  method: 'post',
				  url: 'getSectors.php',
				  data: {dcode:d},
				  success: function(response){					
					$("#sector").empty();
					$("#sector").append(response);
				  }
			  });
		  
	  });
	  $("#sector").on("change",function(){
		  $("#cell").show();
		  $("#cell").css('required','');
		  $("#village").hide();
		  $("#village").val("");
		  
		   var s = $(this).val();
		   $.ajax({
				  method: 'post',
				  url: 'getCells.php',
				  data: {scode:s},
				  success: function(response){					
					$("#cell").empty();
					$("#cell").append(response);
				  }
			  });
	  });
	  $("#cell").on("change",function(){
		  $("#village").show();
		  var c = $(this).val();
		   $.ajax({
				  method: 'post',
				  url: 'getVillages.php',
				  data: {ccode:c},
				  success: function(response){					
					$("#village").empty();
					$("#village").append(response);
				  }
			  });
	  });
	  $("#jointyes").on("change",function(){
		  $("#percentage_of_shares").show();
	  });
	  $("#BusinessUse").on("change",function(){
		  $("#monthly_income").show();
	  });
	  $("#personalUse").on("change",function(){
		  $("#monthly_income").hide();
          $("#monthly_income").val("");
	  });
	  $("#jointno").on("change",function(){
		  $("#percentage_of_shares").hide();
          $("#percentage_of_shares_val").val("");
	  });
	  $("#boughtyes").on("change",function(){
		  $("#bought_seller").show();
		  $("#bought_seller").prop('required',true);
		  $("#bought_amount").show();
		  $("#bought_amount").prop('required',true);
	  });
	  $("#boughtno").on("change",function(){
		  $("#bought_seller").hide();
		  $("#seller_name").val("");
		  $("#bought_amount").hide();
		  $("#buying_price").val("");
	  });
	  $("#loanyes").on("change",function(){
		  $("#loan_bank").show();
		  $("#loan_bank").prop('required',true);
		  $("#loan_clear_date").show();
          $("#loanAmountDiv").show();
		  $("#loan_clear_date").prop('required',true);
		  $("#installmentDiv").show();
		  $("#installmentDiv").prop('required',true);
	  });
	  $("#loanno").on("change",function(){
		  $("#loan_bank").hide();
		  $("#bank_name").val("");
          $("#loanAmountDiv").hide();
          $("#loan_amount").val("");
		  $("#loan_clear_date").hide();
		  $("#mdate").val("");
		  $("#installmentDiv").hide();
		  $("#installment").val("");
	  });
	  $("#is_rent_yes").on("change",function(){
		   $("#monthly_pay").show();
		  $("#monthly_pay").prop('required',true);
		  
	  });
	  
	   $("#is_rent_no").on("change",function(){
		  $("#monthly_pay").hide();
		  $("#monthly_pay_amt").val("");
		  
	  });
	  
	  function listEmployees(){
		  var searchVal = $("#employees").val();
		  alert(searchVal);
	  }
	  
		//$('#fieldToRemove'). removeAttr('required');
		  
	$(".dModalId").click(function(){
		var $el = $(this).closest('tr');
		var resId = $el.find(".res_data").val();
		
		$.ajax({
			url: 'get_immovable_data.php',
			method: 'POST',
			data: {resId:resId},
			dataType: 'JSON',
			success: function(data){
				
				$(".asset_owner_id").html(data.asset_owner_id);
				$(".asset_location_id").html(data.asset_location_id);
				$(".estimated_value").html(data.estimated_value);
				$(".asset_source").html(data.asset_source);
				$(".upi").html(data.upi);
				$(".date_of_aquisition").html(data.date_of_aquisition);
				$(".date_of_acquisition").html(data.date_of_acquisition);
				$(".joint_asset").html(data.joint_asset);
				$(".percentage_of_shares").html(data.percentage_of_shares);
				$(".is_bought").html(data.is_bought);
				$(".seller_name").html(data.seller_name);
				$(".buying_price").html(data.buying_price);
				$(".by_loan").html(data.by_loan);
				$(".bank_name").html(data.bank_name);
				$(".installment").html(data.installment);
				$(".loan_amount").html(data.loan_amount);
				$(".expected_loan_clear_date").html(data.expected_loan_clear_date);
				$(".is_rent").html(data.is_rent);
				$(".monthly_pay").html(data.monthly_pay);
				
			}

		});
	});  
	
	$(".livestockId").click(function(){
		var $el = $(this).closest('tr');
		var resId = $el.find(".res_data").val();
		
		$.ajax({
			url: 'get_livestock_data.php',
			method: 'POST',
			data: {resId:resId},
			dataType: 'JSON',
			success: function(data){
				
				$(".livestock_type").html(data.livestock_type);
				$(".brand").html(data.brand);
				$(".number").html(data.number);
				$(".asset_owner_id").html(data.asset_owner_id);
				$(".asset_location_id").html(data.asset_location_id);
				$(".estimated_value").html(data.estimated_value);
				$(".asset_source").html(data.asset_source);
				$(".date_of_acquisition").html(data.date_of_acquisition);
				$(".joint_asset").html(data.joint_asset);
				$(".percentage_of_shares").html(data.percentage_of_shares);
				$(".is_bought").html(data.is_bought);
				$(".seller_name").html(data.seller_name);
				$(".buying_price").html(data.buying_price);
				$(".by_loan").html(data.by_loan);
				$(".bank_name").html(data.bank_name);
				$(".installment").html(data.installment);
				$(".loan_amount").html(data.loan_amount);
				$(".expected_loan_clear_date").html(data.expected_loan_clear_date);
				$(".estimated_spent_amount").html(data.estimated_spent_amount);
				$(".estimated_income").html(data.estimated_income);
				
			}

		});
	});
	
	$(".vehiclesId").click(function(){
		var $el = $(this).closest('tr');
		var resId = $el.find(".res_data").val();
		
		$.ajax({
			url: 'get_vehicles_data.php',
			method: 'POST',
			data: {resId:resId},
			dataType: 'JSON',
			success: function(data){
				
				$(".vehicle_type").html(data.vehicle_type);
				$(".plate_no").html(data.plate_no );
				$(".asset_owner_id").html(data.asset_owner_id);
				$(".asset_location_id").html(data.asset_location_id);
				$(".asset_source").html(data.asset_source);
				$(".vehicle_value").html(data.vehicle_value);
				$(".car_use").html(data.car_use);
				$(".monthly_income").html(data.monthly_income);
				$(".joint_asset").html(data.joint_asset);
				$(".percentage_of_shares").html(data.percentage_of_shares);
				$(".is_bought").html(data.is_bought);
				$(".seller_name").html(data.seller_name);
				$(".buying_price").html(data.buying_price);
				$(".by_loan").html(data.by_loan);
				$(".bank_name").html(data.bank_name);
				$(".installment").html(data.installment);
				$(".loan_amount").html(data.loan_amount);
				$(".expected_loan_clear_date").html(data.expected_loan_clear_date);
				$(".estimated_spent_amount").html(data.estimated_spent_amount);
				$(".estimated_income").html(data.estimated_income);
				
			}

		});
	});
	
	$(".otherMovableId").click(function(){
		var $el = $(this).closest('tr');
		var resId = $el.find(".res_data").val();
		
		$.ajax({
			url: 'get_otherMovable_data.php',
			method: 'POST',
			data: {resId:resId},
			dataType: 'JSON',
			success: function(data){
				
				$(".movable_type").html(data.movable_type);
				$(".asset_owner_id").html(data.asset_owner_id);
				$(".asset_location_id").html(data.asset_location_id);
				$(".estimated_value").html(data.estimated_value);
				$(".asset_source").html(data.asset_source);
				$(".date_of_acquisition").html(data.date_of_acquisition);
				$(".joint_asset").html(data.joint_asset);
				$(".percentage_of_shares").html(data.percentage_of_shares);
				$(".is_bought").html(data.is_bought);
				$(".seller_name").html(data.seller_name);
				$(".buying_price").html(data.buying_price);
				$(".by_loan").html(data.by_loan);
				$(".bank_name").html(data.bank_name);
				$(".installment").html(data.installment);
				$(".loan_amount").html(data.loan_amount);
				$(".expected_loan_clear_date").html(data.expected_loan_clear_date);
				$(".estimated_spent_amount").html(data.estimated_spent_amount);
				$(".estimated_income").html(data.estimated_income);
				
			}

		});
	});
	//allEmployee
	$("#specificEmployee").on("change",function(){
		$("#specificEmployeesView").show();
	});
	
	$("#allEmployee").on("change",function(){
		  $("#percentage_of_shares").hide();
          $("#percentage_of_shares_val").val("");
	});
	
	$('#bootstrap-data-table').DataTable();
	
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
	
  });
  
  </script>
	<style>
	label{ 
		color: #456;
		
			
	}
	</style>
	<!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="./vendor/moment/moment.min.js"></script>
    <script src="./vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- clockpicker -->
    <script src="./vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
    <!-- asColorPicker -->
    <script src="./vendor/jquery-asColor/jquery-asColor.min.js"></script>
    <script src="./vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
    <script src="./vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
    <!-- Material color picker -->
    <script src="./vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- pickdate -->
    <script src="./vendor/pickadate/picker.js"></script>
    <script src="./vendor/pickadate/picker.time.js"></script>
    <script src="./vendor/pickadate/picker.date.js"></script>



    <!-- Daterangepicker -->
    <script src="./js/plugins-init/bs-daterange-picker-init.js"></script>
    <!-- Clockpicker init -->
    <script src="./js/plugins-init/clock-picker-init.js"></script>
    <!-- asColorPicker init -->
    <script src="./js/plugins-init/jquery-asColorPicker.init.js"></script>
    <!-- Material color picker init -->
    <script src="./js/plugins-init/material-date-picker-init.js"></script>
    <!-- Pickdate -->
    <script src="./js/plugins-init/pickadate-init.js"></script>
    <!-- Sweet alert message -->
    <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="./js/plugins-init/sweetalert.init.js"></script>
</body>

</html>