<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage URL
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @param	string	$uri
 * @param   boolean $query_string
 * @param	string	$protocol
 * @return	string
 */
function site_url($uri = '', $query_string = FALSE, $protocol = NULL)
{
	return get_instance()->config->site_url($uri, $protocol).(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?get_http_build_query():FALSE);
}

/**
 * Base URL
 *
 * Create a local URL based on your basepath.
 * Segments can be passed in as a string or an array, same as site_url
 * or a URL to a file can be passed in, e.g. to an image file.
 *
 * @param	string	$uri
 * @param   boolean $query_string
 * @param	string	$protocol
 * @return	string
 */
function base_url($uri = '', $query_string = FALSE, $protocol = NULL)
{
	return get_instance()->config->base_url($uri, $protocol).(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?get_http_build_query():FALSE);
}

/**
 * Get current URL
 * 
 * @param  boolean $query_string
 * @return string
 */
function current_url($query_string = TRUE)
{
	return base_url(!empty(uri_string())?uri_string().config_item('url_suffix'):'').(filter_var($query_string, FILTER_VALIDATE_BOOLEAN)?get_http_build_query():FALSE);
}

if (!function_exists('language_link'))
{
	/**
	 * Get link to change language
	 * 
	 * @param  string $language
	 * @return string
	 */	
	function language_link($language)
	{
		return current_url(FALSE).get_http_build_query(array('language' => $language));
	}	
}

if (!function_exists('get_http_build_query'))
{
	/**
	 * HTTP build query
	 * 
	 * @param  array $new_query
	 * @return string
	 */
	function get_http_build_query($new_query = array())
	{
		$query_string = http_build_query(array_merge(get_instance()->input->get(), $new_query));
		return (!empty($query_string))?'?'.$query_string:FALSE;
	}
}

if (!function_exists('base64image_to_file'))
{
	function base64image_to_file($string)
	{
		$string = str_replace('data:image/png;base64,', '', $string);
		$string = str_replace(' ', '+', $string);
		$data 	= base64_decode($string);
		$file 	= FCPATH. 'uploads/' . uniqid() . '.png';
		return file_put_contents($file, $data);
	}
}

/* End of file MY_url_helper.php */
/* Location : ./application/helpers/MY_url_helper.php */