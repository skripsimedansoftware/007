window.knnClassifier = ml5.KNNClassifier();
window.featureExtractor = ml5.featureExtractor('MobileNet', readyToUse);
window.serverURL = 'https://cek-kematangan-alpukat.uinsu.my.id';

var socket = io({ transports: ['websocket', 'polling'] });
socket.on('connect', function() {
	// join as checker
	socket.emit('join_check');

	socket.on('check', function(data) {
		var temp_image = new Image();
		temp_image.onload = function() {
			// temp image loaded
			var img = new Image(this.width, this.height);
			img.onload = function() {
				const features = window.featureExtractor.infer(img);
				// Use KNN Classifier to classify these features
				window.knnClassifier.classify(features, (error, result) => {
					socket.emit('checked', {socket_id: data.socket_id, result: result, colors: data.colors});
				});
			}

			img.src = data.image;
		}

		temp_image.src = data.image;
	});
});


function readyToUse() {
	window.knnClassifier.load('data-set.json');
	window.knnClassifier.load('data-train.json');
	$.ajax({
		url: window.serverURL+'/admin/all_data',
		type: 'GET',
		dataType: 'JSON',
		success: (data) => {
			data.forEach(async (el, index) => {
				for (i = 0; i < el.images.length; i++) {
					var load_image = new Promise((resolve, reject) => {
						const img_temp = new Image();
						img_temp.onload = () => resolve(img_temp)
						img_temp.crossOrigin = 'anonymous';
						img_temp.src = 'https://alpukat-files.uinsu.my.id/'+el.images[i].file
					});
					const img = await load_image;
					const features = featureExtractor.infer(img);
					socket.emit('loaded', el.name);
					// Add an example with a label to the KNN Classifier
					knnClassifier.addExample(features, el.name);
				}
			});
		}
	});
}
