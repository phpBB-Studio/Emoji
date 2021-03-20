<?php
/**
 *
 * phpBB Studio - Emoji. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

/**
 * Some characters you may want to copy&paste: ’ » “ ” …
 */
$lang = array_merge($lang, [
	'STUDIO_EMOJI_FIND'			=> 'Find an emoji',
	'STUDIO_EMOJI_NONE'			=> 'No emoji was found.',
	'STUDIO_EMOJI_TOGGLE'		=> 'Toggle emoji',

	'STUDIO_EMOJI_SMILEYS'		=> 'Smileys & Emotion',
	'STUDIO_EMOJI_BODY'			=> 'Body Parts',
	'STUDIO_EMOJI_PEOPLE'		=> 'People & Family',
	'STUDIO_EMOJI_PROFESSION'	=> 'Professions',
	'STUDIO_EMOJI_ACTION'		=> 'Actions',
	'STUDIO_EMOJI_NATURE'		=> 'Animals & Nature',
	'STUDIO_EMOJI_FOOD'			=> 'Food & Drinks',
	'STUDIO_EMOJI_TRAVEL'		=> 'Travel & Places',
	'STUDIO_EMOJI_ACTIVITY'		=> 'Activities',
	'STUDIO_EMOJI_OBJECTS'		=> 'Objects',
	'STUDIO_EMOJI_SYMBOLS'		=> 'Symbols',
	'STUDIO_EMOJI_FLAGS'		=> 'Flags',
]);
