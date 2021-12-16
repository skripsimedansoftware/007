var socket = io();
socket.on('connect', function() {

	// join as checker
	socket.emit('join_check');

	window.knnClassifier = ml5.KNNClassifier();
	window.featureExtractor = ml5.featureExtractor('MobileNet', readyToUse);
	window.serverURL = 'https://cek-kematangan-alpukat.uinsu.my.id';

	function readyToUse() {
		$.ajax({
			url: window.serverURL+'/admin/try',
			type: 'GET',
			dataType: 'JSON',
			crossDomain: true,
			success: function(data) {
				var total_data = data.length;
				$.each(data, function(index, val) {
					// temp image to get image widh & height
					var temp_image = new Image();
					temp_image.onload = function() {
						// temp image loaded
						var img = new Image(this.width, this.height);
						img.onload = function() {
							if ((index+1) == total_data) {
								socket.emit('loaded', {
									data: (index+1),
									total: total_data
								});
							}
							img.crossOrigin = 'anonymous';
							window.knnClassifier.addExample(window.featureExtractor.infer(img), val.title);
						}

						img.src = window.serverURL+'/uploads/'+val.image;
					}

					temp_image.src = window.serverURL+'/uploads/'+val.image;
				});
			},
			error: function(error) {

			}
		});
	}

	socket.on('check', function(data) {
		var temp_image = new Image();
		temp_image.onload = function() {
			// temp image loaded
			var img = new Image(this.width, this.height);
			img.onload = function() {
				const features = window.featureExtractor.infer(img);
				// Use KNN Classifier to classify these features
				knnClassifier.classify(features, (error, result) => {
					console.log(result)
					if (result !== null || result !== undefined) {
						socket.emit('checked', {socket_id: data.socket_id, result: result, colors: data.colors});
					}
				});
			}

			img.src = data.image;
		}

		temp_image.src = data.image;
	});
});