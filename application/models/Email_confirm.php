<?php
/**
 * @package Codeigniter
 * @subpackage Email_confirm
 * @category Model
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Angeli;

class Email_confirm extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->set_table('email_confirm');
	}

	public function new($user_uid = NULL, $confirm_code = '1337', $type = 'reset-password') {
		$this->db->insert('email_confirm', array('type' => $type, 'user_uid' => $user_uid, 'confirm_code' => $confirm_code, 'expire_date' => nice_date(unix_to_human(strtotime('+ 1 day')), 'Y-m-d H:i:s')));
	}

	public function detail($where) {
		return $this->db->get_where('email_confirm', $where);
	}

	public function confirm($confirm_code)
	{
		return $this->db->update('email_confirm', array('status' => 'confirmed'), array('confirm_code' => $confirm_code));
	}
}

/* End of file Email_confirm.php */
/* Location : ./application/models/Email_confirm.php */