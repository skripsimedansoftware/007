<?php
/**
 * @package Codeigniter
 * @subpackage Data_training_name
 * @category Model
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Data_training_name extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table('data-training-name');
	}
}

/* End of file Data_training_name.php */
/* Location : ./application/models/Data_training_name.php */