<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Narrow Jumbotron Template for Bootstrap</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url('assets/bootstrap-3.4.1/css/bootstrap.min.css') ?>" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
	/* Space out content a bit */
	body {
		padding-top: 20px;
		padding-bottom: 20px;
	}

	/* Everything but the jumbotron gets side spacing for mobile first views */
	.header,
	.marketing,
	.footer {
		padding-right: 15px;
		padding-left: 15px;
	}

	/* Custom page header */
	.header {
		padding-bottom: 20px;
		border-bottom: 1px solid #e5e5e5;
	}

	.header h3 {
		margin-top: 0;
		margin-bottom: 0;
		line-height: 40px; /* Make the masthead heading the same height as the navigation */
	}

	/* Custom page footer */
	.footer {
		padding-top: 19px;
		color: #777;
		border-top: 1px solid #e5e5e5;
	}

	/* Customize container */
	@media (min-width: 768px) {
		.container {
			max-width: 730px;
		}
	}
	.container-narrow > hr {
		margin: 30px 0;
	}

	/* Main marketing message and sign up button */
	.jumbotron {
		text-align: center;
		border-bottom: 1px solid #e5e5e5;
		margin-bottom: -40px;
	}

	.jumbotron .btn {
		/*padding: 14px 24px;*/
		font-size: 21px;
	}

	/* Supporting marketing content */
	.marketing {
		margin: 40px 0;
	}

	.marketing p + h4 {
		margin-top: 28px;
	}

	/* Responsive: Portrait tablets and up */
	@media screen and (min-width: 768px) {
		/* Remove the padding we set earlier */
		.header,.marketing,
		.footer {
			padding-right: 0;
			padding-left: 0;
		}

		.header {
			margin-bottom: 30px;
		}

		.jumbotron {
			border-bottom: 0;
		}
	}

	.palette {
		background-color: red;
		min-height: 40px;
		min-width: 120px;
		max-height: 40px;
		max-width: 120px;
		line-height: 35px;
		display: flex;
		justify-content: center;
		border: 1px solid black;
		float: left;
		margin-left: 1.5px;
		margin-top: 1.8px;
	}

	video {
		margin-top: -80px;
		margin-bottom: -40px;
	}
	</style>
</head>

<body>

	<div class="container">
		<div class="header clearfix">
			<nav>
				<ul class="nav nav-pills pull-right">
					<li class="<?php echo $this->router->fetch_method() == 'index'?'active':'' ?>"><a href="#">Home</a></li>
					<li class="<?php echo $this->router->fetch_method() == 'about'?'active':'' ?>"><a href="#">About</a></li>
					<li class="<?php echo $this->router->fetch_method() == 'login'?'active':'' ?>"><a href="#">Login</a></li>
				</ul>
			</nav>
			<h3 class="text-muted">Skripsi</h3>
		</div>

		<div class="row focus_content">
			<div class="jumbotron">
				<h1>Cek Kematangan Buah Alpukat</h1>
				<p class="lead">Dengan mengizinkan browser mengakses kamera anda maka sistem pengecekkan buah alpukat siap untuk anda gunakan</p>
				<p>
					<a class="btn open-camera btn-lg btn-success" href="#" role="button">Buka Kamera</a>
				</p>
			</div>
		</div>
		<div class="row" id="palettes"></div>
		<div class="row">
			<div class="col-lg-6">
				<img id="image" style="visibility:hidden;">
			</div>
			<div class="col-lg-6">
				<canvas id="canvas" style="visibility:hidden;"></canvas>
			</div>
		</div>
		<footer class="footer">
			<p>&copy; <?php echo date('Y') ?> Universitas Islam Negeri Sumatera Utara, Medan, Sumatera Utara.</p>
		</footer>
	</div>
</body>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/JQuery/jquery-3.6.0.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/ColorThief/color-thief.js') ?>"></script>
<script type="text/javascript">
function drawCanvas(canvas, img) {
	canvas.width = getComputedStyle(canvas).width.split('px')[0];
	canvas.height = getComputedStyle(canvas).height.split('px')[0];
	let ratio  = Math.min(canvas.width / img.width, canvas.height / img.height);
	let x = (canvas.width - img.width * ratio) / 2;
	let y = (canvas.height - img.height * ratio) / 2;
	canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
	canvas.getContext('2d').drawImage(img, 0, 0, img.width, img.height, x, y, img.width * ratio, img.height * ratio);
}

if (!('mediaDevices' in navigator)) {
	navigator.mediaDevices = {}
}

if (!('getUserMedia' in navigator.mediaDevices)) {
	navigator.mediaDevices.getUserMedia = function(constraints) {
		var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

		if (!getUserMedia) {
			return new Promise.reject(new Error('can get user media'));
		}

		return new Promise((resolve, reject) => {
			getUserMedia.call(navigator, constraints, resolve, reject);
		});
	}
}

var html_element = {
	button_open_camera: {
		rear: '<a class="btn open-camera btn-lg btn-success" href="#" role="button">Buka Kamera</a>',
		front: '<a class="btn open-camera btn-lg btn-success" href="#" role="button">Buka Kamera</a>',
		default: '<a class="btn open-camera btn-lg btn-success" href="#" role="button">Buka Kamera</a>'
	}
}

$(document).on('click', '.open-camera', function(event) {
	event.preventDefault();
	$('.jumbotron').empty();
	// $('.jumbotron').append();
	var _video = $('<video id="video" width="600" height="600" autoplay></video>');
	_video.appendTo($('.jumbotron'));
	// $('.jumbotron').append(html_element.button_open_camera.default);
	var video = document.getElementById('video');
	openCamera('environment');
	$('.jumbotron').prepend('<h3 style="margin-top:-6%">Status Alpukat</h3>')

	function openCamera(type) {
		navigator.mediaDevices.getUserMedia({ video: { facingMode: type }, audio: false }).then(stream => {
			if ('srcObject' in video) {
				video.srcObject = stream;
			} else {
				video.src = window.URL.createObjectURL(stream);
			}

			var mediaStreamTrack = stream.getVideoTracks()[0];
			var imageCapture = new ImageCapture(mediaStreamTrack);

			setInterval(function() {
				imageCapture.grabFrame().then(imageBitmap => {
					const canvas = document.getElementById('canvas');
					canvas.width = imageBitmap.width;
					canvas.height = imageBitmap.height;
					drawCanvas(canvas, imageBitmap);

					const image = document.getElementById('image');
					image.src = canvas.toDataURL();

					image.addEventListener('load', function() {
						var colorThief = new ColorThief();
						var colorArray = colorThief.getPalette(image, 18);
						$('#palettes').empty();
						colorArray.forEach((el, index) => {
							$('#palettes').append('<div class="palette" style="background-color: rgb('+el[0]+', '+el[1]+', '+el[2]+'); height: 200px; width: 200px; float:left;"></div>');
						});
					});
				})
				.catch(console.log);
			}, 1000);

			video.onloadedmetadata = function(e) {
				video.play();
			}
		}, console.log)
	}
});
</script>
</html>
