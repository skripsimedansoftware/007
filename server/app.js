require('dotenv').config();
const port = process.env.PORT || 3000;
const { Server } = require('socket.io');
const puppeteer = require('puppeteer');
const express = require('express');
const path = require('path');
const cors = require('cors');
const app = express();
const http = require('http').Server(app);
const io = new Server(http, {
	transports: ['websocket', 'polling']
});
const os = require('os');

app.use(cors({ origin : (origin, callback) => { callback(null, true) }, credentials: true }));
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'hbs');
app.use(express.static('public'));

app.get('/', function(req, res) {
	res.render('index', { title: 'Judul' });
});

io.on('connection', function(socket) {
	socket.on('join_client', function() {
		socket.join('client');
	});

	socket.on('join_check', function() {
		socket.join('checker');
	});

	socket.on('image', function(data) {
		socket.to('checker').emit('check', data);
	});

	socket.on('loaded', function() {
		socket.to('client').emit('loaded');
	});

	socket.on('checked', function(data) {
		socket.to(data.socket_id).emit('debug', data);
		socket.to(data.socket_id).emit('checked', data.result);
	});
});

(async () => {
	const browser = await puppeteer.launch({
		args: ['--no-sandbox', '--disable-setuid-sandbox'],
		headless: true
	});
	const page = await browser.newPage();
	var open_page = await page.goto('103.102.154.10:'+port);
})();

http.listen(port);
