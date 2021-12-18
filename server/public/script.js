window.knnClassifier = ml5.KNNClassifier();
window.featureExtractor = ml5.featureExtractor('MobileNet', readyToUse);
window.serverURL = 'https://cek-kematangan-alpukat.uinsu.my.id';

// function loadTrainedModel() {
// 	window.knnClassifier.load('data-set.json', readyToUse)
// 	readyToUse()
// }

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
	socket.emit('loaded');
	window.knnClassifier.load('data-set.json');
}
