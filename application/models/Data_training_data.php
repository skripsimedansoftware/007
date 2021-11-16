<?php
/**
 * @package Codeigniter
 * @subpackage Data_training_data
 * @category Model
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Data_training_data extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table('data-training-data');
	}

	public function read_in($field, $data)
	{
		if (!empty($data))
		{
			$this->db->where_in($field, $data);
			return $this->db->get($this->table);
		}

		return FALSE;
	}

	public function delete_in($field, $data)
	{
		if (!empty($data))
		{
			$this->db->where_in($field, $data);
			return $this->db->delete($this->table);
		}

		return FALSE;
	}
}

/* End of file Data_training_data.php */
/* Location : ./application/models/Data_training_data.php */