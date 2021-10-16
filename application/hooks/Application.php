<?php
/**
 * @package Codeigniter
 * @subpackage Application
 * @category Hook
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Booting;

class Application
{
	/**
	 * Initialize language
	 *
	 * @author Agung Dirgantara <agungmasda29@gmail.com>
	 */
	public function language($files = array())
	{
		$ci =& get_instance();

		if (!empty($ci->input->get('language')) && in_array($ci->input->get('language'), array('english', 'indonesian')))
		{
			$language = $ci->input->get('language');
		}
		elseif (!empty(get_cookie('language')))
		{
			$language = get_cookie('language');
		}
		else
		{
			$language = $ci->lang->base_language;
		}

		$ci->lang->set_current_language($language);
		$ci->input->set_cookie(array(
			'name'   => 'language',
			'value'  => $language,
			'expire' => 86400,
			'path'   => '/',
			'secure' => FALSE
		));

		log_message('info','Site language intialized : '.$language);

		if (!empty($files))
		{
			foreach ($files as $file)
			{
				$ci->load->language($file, $language);
			}
		}
	}
}

/* End of file Application.php */
/* Location : ./application/hooks/booting/Application.php */