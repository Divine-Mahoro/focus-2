				<?php
							if(isset($_POST['btnSubmit'])){
								$role = prepare_input($_POST['role']);
								$employeeId= prepare_input($_POST['eid']);
								$upd_qry = "UPDATE EMPLOYEES SET 
											role = '".$role."' 
										   WHERE employee_id = '".$employeeId."'";
								
								$stmt = $dbh->prepare($upd_qry);
								if($stmt->execute()){
									$success_msg = 'Record Updated successfully';
									echo "<meta http-equiv='refresh' content='0;url=staff.php?dir=Admin&page=addingRole&success_msg=".$success_msg."'>";
									//header("Location:submitSuccess.php");
								} else {
									$error_msg = 'Updation failed';
									//echo "<meta http-equiv='refresh' content='0;url=staff.php?dir=Admin&page=addingRole&error_msg=".$error_msg."'>";
								}
							}
							//echo $upd_qry;
				?>
				<!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
						
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Make Attandance</h4>
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
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php echo $main_link; ?>?dir=Admin&page=addingRole" method="POST" name="rsForm" id="rsForm"
									onsubmit="return getDetails();">
                                        <div class="form-row">
									
											
											<div class="col-auto mb-2">
												<select class="custom-select mr-sm-2" name="eid" id="role">
                                                     <option value="0">Select course...</option>
													<?php 
														
															//foreach($dbh->query("select * from teacher_courses order by family_name") as $e){
																//$eid = $e['employee_id'];
															//	$ename = $e['family_name'] . " " . $e['given_name'];
															//	echo '<option value="'.$eid.'">'.$ename.'</option>';
															//}
														
														?>
                                                </select>
                                            </div>
										</div>
										<div class="form-row">
											<div class="stat-widget-one card-body">
												<div class="stat-icon d-inline-block">
													<div id="scandit-barcode-picker">Hello<i class="text-primary border-primary">Scan QR</i></div>
												</div>
											</div>
                                        </div>
										<div id="scandit-barcode-picker">Hello</div>
										<div id="input-container">
											<input type="text" id="scan-input1" />
											<button type="button" id="scan1">SCAN</button>
											<br />
											<input type="text" id="scan-input2" />
											<button type="button" id="scan2">SCAN</button>
										</div>
									
										
                                        <!-- <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        <script type="text/javascript">
		
		function getDetails(){
			let role = document.forms["rsForm"]["role"].value;
			let id = document.forms["rsForm"]["employees"].value;
			alert("selected Employee id:"+id);
			if(id == ""){
				alert("Please select of Employee");
				return false;
			}
			if(role == "0"){
				alert("Please select role of Employee");
				return false;
			}
		}
		[...document.getElementsByTagName('button')].forEach((el) => {
		  el.addEventListener('click', (e) => {
			const num = e.currentTarget.id.match(/\d+$/)[0];
			document.getElementById(`scan-input${num}`).value = "Scan Complete";
		  });
		});
		let scanInput;

    [...document.getElementsByTagName('button')].forEach((el) => {
      el.addEventListener('click', (e) => {
        const num = e.currentTarget.id.match(/\d+$/)[0];
        scanInput = document.getElementById(`scan-input${num}`);
        scan();
      });
    });

    function scan() {
      startScanning();
    }

    function showScanner() {
      scannerContainer.style.opacity = "1";
      scannerContainer.style.zIndex = "1";
    }

    function hideScanner() {
      scannerContainer.style.opacity = "0";
      scannerContainer.style.zIndex = "-1";
    }

    function startScanning() {
      showScanner();
      if (picker) {
        picker.resumeScanning();
      }
    }

    function stopScanning() {
      hideScanner();
      if (picker) {
        picker.pauseScanning();
      }
    }
    // Configure the library and activate it with a license key
    const licenseKey = "AbIxJRFJMxUDQPPR2g+hU6o5am3XB/c0T3JUWcRF1m/QXTb7AVO8OLxoVbaoUIUkegR2gs93wzZZYSh/QVE410c8cW17SNwSmXGA+Elrkwe5KdlvHwLvS7gfaDPbFFvbsxv6nITRKrbGbE+o3S/5ILluRqJ3JFns6ZExINbL3zr8irLfwE1QNFq1OR77Xf4xOkgZj4rDm1Fz88T5AAvNtGfbrfeHPVr40YCYsKC4R5YgO8o02iCuZDoCQFn+yPQ2HZ3ki+44DIfH861WfwkpEO6wTVBwuJbrgQdXnO/S9xC8Jqzr52fPm9bJULORvy4ce+D57+T4VI/rw9yGmxev9EHrbUdCYYBNbTcxpzRG4EpW758d5tnPnXKF+/1NVfvEzL3UAr0W0ols+YhJiO6E/bQJrgBXKxku8ybZ50Ld98zrPQhVek44xTP1PeQ8YhWDL3TjQP3zp5sRQqfrt9nEcJJQl8YhB6TvfYnzHcBHnbzaeG/7ZBIn3Un54SQcYJhoxLNprB9aWJ/FSCDiLtn+tEFBXwTldaJCe5j1OrpVpo8hPAJgZovsmIziIX07UVIYMB3ZlE4k49CB+TO4CW9dgQSQSthTel5Bd8WDI6VRSCOeZuvwqWQmPj0ctb5fJ3ogJPf7hjvkqnYGJRtWvfPSowL5tRiV1y3KSW/mYON95ZS3x9BwKkLWG11nxcW3w0S/jrCqKSbyEw8EBz1QxR8vz7XrgqkLhOYoGMSqlyTPhbNmmgOun2ZgLeN66HirAmSl5hTRg13ww6M1FiLfrDBM+tbYAXvhSVt4KbMTTbtd8Q==";
    // Configure the engine location, as explained on http://docs.scandit.com/stable/web/index.html
    const engineLocation = "https://cdn.jsdelivr.net/npm/scandit-sdk@4.x/build"
    ScanditSDK.configure(licenseKey, {
      engineLocation: engineLocation
    });
    const scannerContainer = document.getElementById("scandit-barcode-picker");
    scannerContainer.style.opacity = "0";
    scannerContainer.style.zIndex = "-1";
    let picker;
    // Create & start the picker
    ScanditSDK.BarcodePicker.create(scannerContainer)
      .then(barcodePicker => {
        picker = barcodePicker;
        // Create the settings object to be applied to the scanner
        const scanSettings = new ScanditSDK.ScanSettings({
          enabledSymbologies: ["ean8", "ean13", "upca", "upce", "code128", "code39"]
        });
        picker.applyScanSettings(scanSettings);
        picker.on("scan", scanResult => {
          stopScanning();
          scanInput.value = scanResult.barcodes[0].data;
        });
        picker.on("scanError", error => alert(error.message));
        picker.resumeScanning();
      })
      .catch(alert);
		
		</script>
<style>
  #scan:after {
    display: none;
  }

</style>