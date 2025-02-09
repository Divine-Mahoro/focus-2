<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate QR Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <style>
        body, html {
            height: 100%;
            width: 100%;
        }
        .bg {
            background-image: url("images/bg.jpg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body class="bg">
    <div class="container" id="panel">
        <br><br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color: white; padding: 20px; box-shadow: 10px 10px 5px #888;">
                <div class="panel-heading">
                    <h1>Generate QR-code in PHP</h1>
                </div>
                <hr>
                <div id="qrbox" style="text-align: center;">
                    <img src="generate.php?text=<?php echo $_GET['text']?>" alt="">
                </div>
                <hr>
				<input type="text" id="scan-input1" />
				<button type="button" id="scan1">SCAN</button>
				<br />
				<input type="text" id="scan-input2" />
				<button type="button" id="scan2">SCAN</button>
                <a href="index.php">Generate One More...</a>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    function showCamera(toast) {
        Android.showCamera(toast);
    }
	[...document.getElementsByTagName('button')].forEach((el) => {
	  el.addEventListener('click', (e) => {
		const num = e.currentTarget.id.match(/\d+$/)[0];
		document.getElementById(`scan-input${num}`).value = "Scan Complete";
	  });
	})
</script>