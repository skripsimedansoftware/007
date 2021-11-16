<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Phpml\Classification\KNearestNeighbors;

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');

		// $samples = [[255, 10], [255, 20], [255, 30]];
		// $labels = ['r', 'g', 'b'];

		// $classifier = new KNearestNeighbors(1);
		// $classifier->train($samples, $labels);
		// echo "<pre>";
		// print_r ($classifier);
		// echo "</pre>";

		// // echo $classifier->predict([255, 3]);
		// echo "<pre>";
		// print_r ($classifier->predict([255, 13]));
		// echo "</pre>";
	}
}
