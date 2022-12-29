<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['student'])){
	
  header("Location: index");
}

require_once("connection.php");
require_once("functions.php");
$register_user_ID;
if(isset($_SESSION['student'])){
  $register_user_ID = $_SESSION['student'];
  $sql = "SELECT * FROM register_user where register_user_ID='$register_user_ID'";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $name = $row['NAME'];
  
$main_link="userStudent"; 
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
							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
								<div class="dropdown-menu dropdown-menu-right">
								<?php 
														
									foreach($dbh->query("select DISTINCT rep.register_user_ID, rep.teacher_courses_id, cou.course_name, cou.TEACHER, rep.date 
											from report_students rep, register_course cou where rep.teacher_courses_id = cou.course_id and 
											rep.register_user_ID = '".$register_user_ID."' and rep.teacher_courses_id in 
											(select course_id from register_course where register_user_ID = '".$register_user_ID."')") as $e){
										$course_name = $e['course_name'];
										$teacher = $e['TEACHER'];
										$insert_date = $e['date'];
								?>
                                
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="<?php echo $main_link; ?>?dir=students&page=inbox">
                                                    <p>You have been reported in <strong><?php echo $course_name; ?> by <?php echo $teacher; ?>.</strong>
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time"><?php echo $insert_date; ?></span>
                                        </li>
                                    </ul>
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
                                
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="<?php echo $main_link; ?>?dir=students&page=inbox">
                                                    <p>You have been approved in <strong><?php echo $course_name; ?> by <?php echo $teacher; ?>.</strong>
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time"><?php echo $insert_date; ?></span>
                                        </li>
                                    </ul>
									<?php } ?>
                                    <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
							
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
					<li><a href="<?php echo $main_link; ?>?dir=courses&page=allCourses&action=allCourse" aria-expanded="false"><i
                                class="bi-book-half"></i><span class="nav-text">Courses<span class="badge badge-warning ml-1"><?php echo $resultBusiness; ?></span></span></a></li>
					<li><a href="<?php echo $main_link; ?>?dir=students&page=inbox" aria-expanded="false"><i
                                class="bi-inbox"></i><span class="nav-text">Inbox<span class="badge badge-warning ml-1"><?php echo $resultSold; ?></span></span></a></li>
					<li><a href="<?php echo $main_link; ?>?dir=calender&page=timeTable" aria-expanded="false"><i
                                class="bi-calendar"></i><span class="nav-text">Timetable<span class="badge badge-warning ml-1"><?php echo $resultSold; ?></span></span></a></li>
					
					
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
					
					//$default_page = "pages/immovable/residentialHouses.php";
					
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
                <p>Copyright © Designed &amp; Developed for <a href="#" target="_blank">SMART ATTENDANCE</a> 2022</p>
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

	<!-- Demo scripts -->
    <script src="./js/styleSwitcher.js"></script>



    <script src="./vendor/jqueryui/js/jquery-ui.min.js"></script>
    <script src="./vendor/moment/moment.min.js"></script>

    <script src="./vendor/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="./js/plugins-init/fullcalendar-init.js"></script>
	
	
    <script src="./js/dashboard/dashboard-1.js"></script>
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
	<script src="./js/jquery.min.js"></script>
  
  <script type="text/javascript">
  
  $(document).ready(function(){	  
  
	/* $(".dModalId").click(function(){
		alert (we reach here);
		var $el = $(this).closest('tr');
		var crsId = $el.find(".crs_data").val();
		alert (we reach here);
		$.ajax({
			url: 'getAverageCourse.php',
			method: 'POST',
			data: {crsId:crsId},
			dataType: 'JSON',
			success: function(data){
				
				$(".course_name").html(data.course_name);
				$(".session").html(data.session);
				$(".attended_session").html(data.attended_session);
				
			}

		});
	}); */

	$(".dModalId").click(function(){
		var $el = $(this).closest('tr');
		var course = $el.find(".crs_data").val();
		var user = $("#user").val();
		$.ajax({
			url: 'getAverageCourse.php',
			method: 'POST',
			data: {course:course, user:user},
			dataType: 'JSON',
			success: function(data){
				$(".course_name").html(data.course_name);
				$(".session").html(data.session);
				$(".attended_session").html(data.attended_session);
			}

		});
	});  	
	
	
	
	//$('#bootstrap-data-table').DataTable();
	
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