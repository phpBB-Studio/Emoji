<?php
/**
 *
 * phpBB Studio - Emoji. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, phpBB Studio, https://www.phpbbstudio.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbbstudio\emoji\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * phpBB Studio - Emoji: Event listener
 */
class listener implements EventSubscriberInterface
{
	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 * @access public
	 * @static
	 */
	static public function getSubscribedEvents()
	{
		return ['core.generate_smilies_after' => 'generate_emoji'];
	}

	/** @var \phpbbstudio\emoji\emoji */
	protected $emoji;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor.
	 *
	 * @param  \phpbbstudio\emoji\emoji		$emoji			phpBB Studio - Emoji data
	 * @param  \phpbb\language\language		$language		Language object
	 * @param  \phpbb\template\template		$template		Template object
	 * @return void
	 * @access public
	 */
	public function __construct(\phpbbstudio\emoji\emoji $emoji, \phpbb\language\language $language, \phpbb\template\template $template)
	{
		$this->emoji	= $emoji;
		$this->language	= $language;
		$this->template	= $template;
	}

	/**
	 * Generate emoji when generating smilies.
	 *
	 * @param  \phpbb\event\data	$event		The event object
	 * @return void
	 * @access public
	 */
	public function generate_emoji($event)
	{
		if ($event['mode'] === 'inline')
		{
			$this->language->add_lang('studio_emoji', 'phpbbstudio/emoji');

			$emoji = [];

			foreach ($this->emoji->categories as $category => $icon)
			{
				$emoji += $this->emoji->map[$category];

				$this->template->assign_block_vars('studio_emoji', [
					'EMOJI'		=> $this->emoji->map[$category],
					'ICON'		=> $icon,
					'PANEL'		=> "emoji-{$category}-panel",
					'TITLE'		=> 'STUDIO_EMOJI_' . utf8_strtoupper($category),
				]);
			}

			$this->template->assign_vars([
				'STUDIO_EMOJI'		=> (string) json_encode($emoji),
				'S_STUDIO_EMOJI'	=> 'emoji-' . key($this->emoji->categories) . '-panel',
				'T_STUDIO_EMOJI'	=> $this->emoji->ext,
				'U_STUDIO_EMOJI'	=> $this->emoji->url,
			]);
		}
	}
}
