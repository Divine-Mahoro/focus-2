								<!DOCTYPE html>
								<html lang="en" class="h-100">
								
								<head>
									<title>Scan QR Attandance Test3r</title>
									<script type="text/javascript"></script>
									<link rel="stylesheet" type="text/css" href="https:stackpath.bootstapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
								</head>
								<body>
									<div class="container">
										<h4 class="text-center text-dark">QR-CODE Scan</h4>
										<div class="row">
											<div class="col-md-6">
												<video id="preview" width="100%"></video>
											</div>
											<div class="col-md-6">
												<label>QR CODE VALUE</label>
												<input type="text" name="response" id="response" readonly="" class="form-control">
											</div>
                                        </div>
									</div>
								</body>

<script type="text/javascript">
	alert("Reaching here");
	let scanner=new Instascan.Scanner({video:document.getElelmentById('preview')});
	Instascan.Camera.getCameras().then(function(cameras){
		if(cameras.length>0){
			scanner.start(cameras[0]);
		}
		else{
			alert("No camera found");
		}
	}).catch(function(e){
		console.error(e);
	});
	scanner.addListener('scan',function(e){
		document.getElementById("response").value=c;
	});
</script>