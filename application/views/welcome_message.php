<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo ucfirst(lang('welcome_to')) ?> CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	</style>
</head>
<body>

<div id="container">
	<h1>Camera Display <button id="opencamera">Open Camera</button></h1>
	<center>
	<video id="video" style="border: 4px solid red;"></video>
	</center>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).on('click', '#opencamera', (function(event) {
	event.preventDefault();
	openCamera();
}));

var video = document.getElementById('video');

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

function openCamera() {
	navigator.mediaDevices.getUserMedia({ video: true, audio: false }).then(stream => {
		if ('srcObject' in video) {
			video.srcObject = stream;
		} else {
			video.src = window.URL.createObjectURL(stream);
		}

		video.onloadedmetadata = function(e) {
			video.play();
		}
	}, console.log);
}
</script>
</html>
