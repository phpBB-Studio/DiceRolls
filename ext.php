<?php
/**
 * phpBB Studio's Dice extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019 phpBB Studio <https://www.phpbbstudio.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace phpbbstudio\dice;

class ext extends \phpbb\extension\base
{
	/**
	 * Check whether the extension can be enabled.
	 * Provides meaningful(s) error message(s) and the back-link on failure.
	 * CLI compatible
	 *
	 * @return bool
	 * @access public
	 */
	public function is_enableable()
	{
		$is_enableable = true;

		$user = $this->container->get('user');
		$user->add_lang_ext('phpbbstudio/dice', 'ext_require');
		$lang = $user->lang;

		if (!(phpbb_version_compare(PHPBB_VERSION, '3.2.5', '>=') && phpbb_version_compare(PHPBB_VERSION, '3.3.0@dev', '<')))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_PHPBB_VERSION', '3.2.5', '3.3.0@dev');
			$is_enableable = false;
		}

		if (!phpbb_version_compare(PHP_VERSION, '5.5', '>='))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_PHP_VERSION', '5.5');
			$is_enableable = false;
		}

		$streams = stream_get_wrappers();

		if (!in_array('glob', $streams))
		{
			$lang['EXTENSION_NOT_ENABLEABLE'] .= '<br>' . $user->lang('ERROR_GLOB_STREAM');
			$is_enableable = false;
		}

		$user->lang = $lang;

		return $is_enableable;
	}
}
