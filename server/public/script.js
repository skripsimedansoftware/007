window.knnClassifier = ml5.KNNClassifier();
window.featureExtractor = ml5.featureExtractor('MobileNet', loadTrainedModel);
window.serverURL = 'https://cek-kematangan-alpukat.uinsu.my.id';

function loadTrainedModel() {
	knnClassifier.load('model.json', readyToUse)
}

var socket = io();
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

function saveDataSet() {
	socket.emit('loaded');
	const dataset = knnClassifier.getClassifierDataset();
	if (knnClassifier.mapStringToIndex.length > 0) {
		Object.keys(dataset).forEach((key) => {
			if (knnClassifier.mapStringToIndex[key]) {
				dataset[key].label = knnClassifier.mapStringToIndex[key];
			}
		});
	}

	const tensors = Object.keys(dataset).map((key) => {
	const t = dataset[key];
		if (t) {
			return t.dataSync();
		}
		return null;
	});

	socket.emit('save_data', JSON.stringify({ dataset, tensors }));
}

function readyToUse() {
	socket.emit('loaded');
	// $.ajax({
	// 	url: window.serverURL+'/admin/try',
	// 	type: 'GET',
	// 	dataType: 'JSON',
	// 	crossDomain: true,
	// 	success: function(data) {
	// 		var total_data = data.length;
	// 		$.each(data, function(index, val) {
	// 			// temp image to get image widh & height
	// 			var temp_image = new Image();
	// 			temp_image.onload = function() {
	// 				// temp image loaded
	// 				var img = new Image(this.width, this.height);
	// 				img.onload = function() {
	// 					img.crossOrigin = 'Anonymous';
	// 					window.knnClassifier.addExample(window.featureExtractor.infer(img), val.title);
	// 					if ((index+1) == total_data) {
	// 						saveDataSet();
	// 					}
	// 				}

	// 				img.src = 'https://alpukat-files.uinsu.my.id/'+val.image;
	// 			}

	// 			temp_image.src = 'https://alpukat-files.uinsu.my.id/'+val.image;
	// 		});
	// 	},
	// 	error: function(error) {

	// 	}
	// });
}
