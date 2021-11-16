<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Validation
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('valid_json'))
{
	/**
	 * Valid JSON
	 * 
	 * @param  string $json
	 * @return boolean
	 */
	function valid_json($json = NULL)
	{
		json_decode($json);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}

function parse_raw_http_request(array &$a_data)
{
	// read incoming data
	$input = file_get_contents('php://input');

	// grab multipart boundary from content type header
	preg_match('/boundary=(.*)$/', $_SERVER['Content-Disposition'], $matches);
	// $boundary = $matches[1];
	return $matches;

	// // split content by boundary and get rid of last -- element
	// $a_blocks = preg_split("/-+$boundary/", $input);
	// array_pop($a_blocks);

	// // loop data blocks
	// foreach ($a_blocks as $id => $block) {
	// 	if (empty($block))
	// 	{
	// 		continue;
	// 	}

	// 	if (strpos($block, 'application/octet-stream') !== FALSE)
	// 	{
	// 		// match "name", then everything after "stream" (optional) except for prepending newlines 
	// 		preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
	// 	}
	// 	// parse all other fields
	// 	else
	// 	{
	// 	// match "name" and optional value in between newline sequences
	// 		preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
	// 	}
	// 	$a_data[$matches[1]] = $matches[2];
	// }
	// 
}

/* End of file validation_helper.php */
/* Location : ./application/helpers/validation_helper.php */