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

	public function try()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('data-training-image', 'data-training-image.data-training-name = data-training-name.id');
		return $this->db->get();
	}
}

/* End of file Data_training_name.php */
/* Location : ./application/models/Data_training_name.php */