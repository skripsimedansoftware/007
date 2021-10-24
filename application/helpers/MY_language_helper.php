<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Language
 * @category Helper
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('current_language'))
{
	/**
	 * Get current language
	 */
	function current_language()
	{
		return get_instance()->lang->current_language;
	}
}

if (!function_exists('lang_iso_639_1'))
{
	/**
	 * Language ISO 639-1
	 * Refrence : https://www.w3schools.com/tags/ref_language_codes.asp
	 *
	 * @param      string  $lang   Language (in english)
	 */
	function lang_iso_639_1($lang)
	{
		switch (strtolower($lang))
		{
			case 'arabic':
				return 'ar';
			break;

			case 'armenian':
				return 'hy';
			break;

			case 'azerbaijani':
				return 'az';
			break;

			case 'basque':
				return 'eu';
			break;

			case 'bosnian':
				return 'bs';
			break;

			case 'bulgarian':
				return 'bg';
			break;

			case 'catalan':
				return 'ca';
			break;

			case 'chinese':
				return 'zh';
			break;

			case 'croatian':
				return 'hr';
			break;

			case 'czech':
				return 'cs';
			break;

			case 'danish':
				return 'da';
			break;

			case 'dutch':
				return 'nl';
			break;

			case 'english':
				return 'en';
			break;

			case 'finnish':
				return 'fi';
			break;

			case 'french':
				return 'fr';
			break;

			case 'german':
				return 'de';
			break;

			case 'greek':
				return 'el';
			break;

			case 'gujarati':
				return 'gu';
			break;

			case 'hindi':
				return 'hi';
			break;

			case 'hungarian':
				return 'hu';
			break;

			case 'indonesian':
				return 'id';
			break;

			case 'italian':
				return 'it';
			break;

			case 'japanese':
				return 'ja';
			break;

			case 'khmer':
				return 'km';
			break;

			case 'korean':
				return 'ko';
			break;

			case 'lithuanian':
				return 'lt';
			break;

			case 'marathi':
				return 'mr';
			break;

			case 'norwegian':
				return 'no';
			break;

			case 'polish':
				return 'pl';
			break;

			case 'portuguese':
				return 'pt';
			break;

			case 'romanian':
				return 'ro';
			break;

			case 'russian':
				return 'ru';
			break;

			case 'serbian':
				return 'sr';
			break;

			case 'slovak':
				return 'sk';
			break;

			case 'slovenian':
				return 'sl';
			break;

			case 'spanish':
				return 'es';
			break;

			case 'swedish':
				return 'sv';
			break;

			case 'tamil':
				return 'ta';
			break;

			case 'thai':
				return 'th';
			break;

			case 'turkish':
				return 'tr';
			break;

			case 'ukrainian':
				return 'uk';
			break;

			case 'urdu':
				return 'ur';
			break;

			case 'vietnamese':
				return 'vi';
			break;

			/**
			 * https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
			 */
			case 'filipino':
				return 'tl';
			break;

			case 'portuguese-brazilian':
				return 'pt';
			break;

			case 'simplified-chinese':
				return 'zh-Hans';
			break;

			case 'traditional-chinese':
				return 'zh-Hant';
			break;

			default:
				return FALSE;
			break;
		}
	}
}

/* End of file MY_language_helper.php */
/* Location : ./application/helpers/MY_language_helper.php */