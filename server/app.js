require('dotenv').config();
const port = process.env.PORT || 3000;
const { Server } = require('socket.io');
const express = require('express');
const path = require('path');
const cors = require('cors');
const app = express();
const http = require('http').Server(app);
const io = new Server(http, {
	transports: ['websocket', 'polling']
});

const find_value = (arrayName, searchKey, searchValue) => {
	let find = arrayName.findIndex(i => i[searchKey] == searchValue);
	return (find !== -1)?find:false;
}

app.use(cors({ origin : (origin, callback) => { callback(null, true) }, credentials: true })); // Menggunakan cors untuk express.js
app.set('views', path.join(__dirname, 'views')); // Setup view path express.js
app.set('view engine', 'hbs'); // Set view engine untuk express.js
app.use(express.static('public')); // Static directory express.js

app.get('/', function(req, res) {
	res.render('index', { title: 'Judul' });
});

const axios = require('axios');
const data_training = new Array();
const data_count = new Array();
const KNN = require('ml-knn');

global.KNNClassifier; // set KNN Classifier

function getColors() {
	return new Promise((resolve, reject) => {
		// axios.get('http://localhost/extract-color-and-knearest-neighbors/admin/all_data').then(response => {
		axios.get('https://cek-kematangan-alpukat.uinsu.my.id/admin/all_data').then(response => {
			response.data.forEach((data, index) => {
				for (image = 0; image < data.images.length; image++) {
					data_count.push({
						id: data.id,
						images_count: data.images.length,
						colors_count: (data.images.length*16)
					});

					for (color = 0; color < data.images[image].colors.length; color++) {
						var rgb = [
							data.images[image].colors[color].red,
							data.images[image].colors[color].green,
							data.images[image].colors[color].blue
						];

						data_training.push({
							name: data.name+'-'+(data.id)+'-'+(image+1)+'-'+(color+1),
							rgb: rgb
						});
					}
				}

				resolve(data_training);
			});
		});
	});
}

getColors().then(response => {
	const labels = response.map((el, index) => { return el.name });
	const colors = response.map((el, index) => { return el.rgb });
	// var knn = new KNN(colors, labels);
	KNNClassifier = new KNN(colors, labels);
	// var label_data = knn.predict(test_dataset)[0].split('-');
	// var find_label = find_value(data_count, 'id', label_data[1]);
	// var total_data = data_count[find_label].images_count*data_count[find_label].colors_count;
	// var data_found = (parseInt(label_data[2])*parseInt(label_data[3]));
	// console.log(data_found/total_data*100);
});

io.on('connection', function(socket) {
	socket.on('join_client', function() {
		socket.join('client');
	});

	socket.on('join_check', function() {
		socket.join('checker');
	});

	socket.on('check_colors', function(data) {
		var KNN_Prediction = KNNClassifier.predict(data)[0].split('-');
		var find_label = find_value(data_count, 'id', KNN_Prediction[1]);
		var total_data = data_count[find_label].images_count*data_count[find_label].colors_count;
		var data_found = (parseInt(KNN_Prediction[2])*parseInt(KNN_Prediction[3]));
		var data = {
			id: KNN_Prediction[1],
			label: KNN_Prediction[0],
			percent: (data_found/total_data*100),
			knn: KNN_Prediction
		};

		socket.emit('checked_colors', data);
	});

	socket.on('image', function(data) {
		socket.to('checker').emit('check', data);
	});

	socket.on('loaded', function() {
		global.loaded_data = true;
		socket.to('client').emit('loaded');
	});

	socket.on('checked', function(data) {
		var KNN_Prediction = KNNClassifier.predict(data.colors)[0].split('-');
		var find_label = find_value(data_count, 'id', KNN_Prediction[1]);
		var total_data = data_count[find_label].images_count*data_count[find_label].colors_count;
		var data_found = (parseInt(KNN_Prediction[2])*parseInt(KNN_Prediction[3]));
		socket.to(data.socket_id).emit('checked', {
			label: data.result.label,
			percent: (data_found/total_data*100),
			knn: KNN_Prediction
		});
	});
});

const puppeteer = require('puppeteer');

(async () => {
	const browser = await puppeteer.launch({
		args: ['--no-sandbox', '--disable-setuid-sandbox'],
		executablePath: '/usr/bin/google-chrome',
		headless: true
	});
	const page = await browser.newPage();
	var open_page = await page.goto('https://ml5-server.uinsu.my.id');
	console.log(open_page)
})();

http.listen(port);
