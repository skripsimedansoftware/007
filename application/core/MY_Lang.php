<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Language
 * @category Libraries
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class MY_Lang extends CI_Lang
{
	/**
	 * Refactor: base language provided inside system/language
	 * 
	 * @var string
	 */
	public $base_language;

	public $current_language;

	public function __construct()
	{
		parent::__construct();

		$this->base_language = config_item('language');
		$this->current_language = array_key_exists('language', $_COOKIE)?$_COOKIE['language']:$this->base_language;
	}

	/**
	 * Get base language
	 * 
	 * @return string
	 */
	public function get_base_language()
	{
		return $this->base_language;
	}

	/**
	 * Set current language
	 * 
	 * @param string $language
	 */
	public function set_current_language($language = '')
	{
		$this->current_language = $language;
	}

	/**
	 * Get current language
	 * 
	 * @return string
	 */
	public function get_current_language()
	{
		return $this->current_language;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Load a language file, with fallback to english.
	 *
	 * @param	mixed	$langfile	Language file name
	 * @param	string	$idiom		Language name (english, etc.)
	 * @param	bool	$return		Whether to return the loaded array of translations
	 * @param 	bool	$add_suffix	Whether to add suffix to $langfile
	 * @param 	string	$alt_path	Alternative path to look for the language file
	 * @return	void|string[]	Array containing translations, if $return is set to TRUE
	 */
	public function load($langfile, $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
		if (empty($idiom))
		{
			$idiom = $this->get_current_language();
		}

		if (is_array($langfile))
		{
			foreach ($langfile as $value)
			{
				$this->load($value, $idiom, $return, $add_suffix, $alt_path);
			}

			return;
		}

		$langfile = str_replace('.php', '', $langfile);

		if ($add_suffix === TRUE)
		{
			$langfile = preg_replace('/_lang$/', '', $langfile) . '_lang';
		}

		$langfile .= '.php';

		if (empty($idiom) OR ! preg_match('/^[a-z_-]+$/i', $idiom))
		{
			$config = & get_config();
			$idiom = empty($config['language']) ? $this->base_language : $config['language'];
		}

		if ($return === FALSE && isset($this->is_loaded[$langfile]) && $this->is_loaded[$langfile] === $idiom)
		{
			return;
		}

		// load the default language first, if necessary
		// only do this for the language files under system/
		$basepath = SYSDIR . 'language/' . $this->base_language . '/' . $langfile;

		if (($found = file_exists($basepath)) === TRUE)
		{
			include($basepath);
		}

		// Load the base file, so any others found can override it
		$basepath = BASEPATH . 'language/' . $idiom . '/' . $langfile;
		
		if (($found = file_exists($basepath)) === TRUE)
		{
			include($basepath);
		}

		// Do we have an alternative path to look in?
		if ($alt_path !== '')
		{
			$alt_path .= 'language/' . $idiom . '/' . $langfile;
			if (file_exists($alt_path))
			{
				include($alt_path);
				$found = TRUE;
			}
		}
		else
		{
			foreach (get_instance()->load->get_package_paths(TRUE) as $package_path)
			{
				$language_path = $package_path.'language/' . $idiom . '/' . $langfile;
				if ($basepath !== $language_path && file_exists($language_path))
				{
					include($language_path);
					$found = TRUE;
					break;
				}
				else
				{
					if (file_exists($package_path.'language/' . $this->base_language . '/' . $langfile))
					{
						include($package_path.'language/' . $this->base_language . '/' . $langfile);
						$found = TRUE;
						$idiom = $this->base_language;
						log_message('info', 'Language file loaded: language/' . $idiom . '/' . $langfile.' - using default language:'.$this->base_language);
						break;
					}
				}
			}
		}

		if ($found !== TRUE)
		{
			$langfile = str_replace(['_lang', '.php'], ['','.json'], $langfile);

			if (file_exists(ASSETS_PATH.'/languages/'.$idiom.'/'.$langfile))
			{
				$found = TRUE;

				if (valid_json(file_get_contents(ASSETS_PATH.'/languages/'.$idiom.'/'.$langfile)))
				{
					foreach (json_decode(file_get_contents(ASSETS_PATH.'/languages/'.$idiom.'/'.$langfile)) as $key => $value)
					{
						$lang[$key] = $value;
					}
				}
			}
			elseif (file_exists(ASSETS_PATH.'/languages/'.$this->base_language.'/'.$langfile))
			{
				$found = TRUE;
				$idiom = $this->base_language;

				if (valid_json(file_get_contents(ASSETS_PATH.'/languages/'.$this->base_language.'/'.$langfile)))
				{
					foreach (json_decode(file_get_contents(ASSETS_PATH.'/languages/'.$this->base_language.'/'.$langfile)) as $key => $value)
					{
						$lang[$key] = $value;
					}
				}
			}
			else
			{
				log_message('error', 'Unable to load the requested language file: languages/' . $idiom . '/' . $langfile);
			}
		}

		if (!isset($lang) OR ! is_array($lang))
		{
			log_message('error', 'Language file contains no data: languages/' . $idiom . '/' . $langfile);

			if ($return === TRUE)
			{
				return array();
			}

			return;
		}

		if ($return === TRUE)
		{
			return $lang;
		}

		$this->is_loaded[$langfile] = $idiom;
		$this->language = array_merge($this->language, $lang);

		log_message('info', 'Language file loaded: languages/' . $idiom . '/' . $langfile);
		return TRUE;
	}

	/**
	 * Language line
	 *
	 * Fetches a single line of text from the language array
	 *
	 * @param	string	$line		Language line key
	 * @param	bool	$log_errors	Whether to log an error message if the line is not found
	 * @return	string	Translation
	 */
	public function line($line, $log_errors = TRUE)
	{
		$value = isset($this->language[$line]) ? $this->language[$line] : FALSE;

		if ($value === FALSE)
		{
			$loaded_files = array_map(function($file) {
				return str_replace(['.php', '.json'], '', $file);
			}, array_keys($this->is_loaded));

			$languages = array();

			foreach ($loaded_files as $file)
			{
				$languages_file = $this->load($file, $this->base_language, TRUE);
				$languages = array_merge($languages, $languages_file);

				if (isset($languages_file[$line]))
				{
					// found key on file
					if ($log_errors)
					{
						log_message('error', 'Could not find the language line "'.$line.'" in file "'.$file.'" for "'.$this->current_language.'" language');
					}
				}
			}

			$value = isset($languages[$line]) ? $languages[$line] : FALSE;
		}

		// Because killer robots like unicorns!
		if ($value === FALSE && $log_errors === TRUE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}

		return $value;
	}

	/**
	 * System languages
	 * 
	 * @return array
	 */
	public function system_languages()
	{
		return array_values(array_filter(array_map(function($language){
			return rtrim(stripslashes($language), '/');
		}, array_keys(directory_map(APPPATH.'language')))));
	}

	/**
	 * Available languages
	 * 
	 * @return array
	 */
	public function available_languages()
	{
		return array_values(array_filter(array_map(function($language){
			return rtrim(stripslashes($language), '/');
		}, array_keys(directory_map(ASSETS_PATH.DIRECTORY_SEPARATOR.'languages')))));
	}
}

/* End of file MY_Lang.php */
/* Location : ./application/core/MY_Lang.php */