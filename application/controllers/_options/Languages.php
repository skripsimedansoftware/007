<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends CI_Controller {

	public function available()
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->lang->available_languages()));
	}

	public function on_system()
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->lang->system_languages()));
	}
}

/* End of file Languages.php */
/* Location: ./application/controllers/_options/Languages.php */