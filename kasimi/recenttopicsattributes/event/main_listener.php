<?php

/**
 *
 * Recent Topics - Attributes. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018 kasimi - https://kasimi.net
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kasimi\recenttopicsattributes\event;

use ernadoo\qte\qte;
use phpbb\event\data;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	/** @var qte */
	protected $qte;

	/**
	 * @param qte $qte
	 */
	public function __construct(
		qte $qte = null
	)
	{
		$this->qte = $qte;
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return [
			'paybas.recenttopics.modify_tpl_ary' => 'recenttopics_modify_tpl_ary',
		];
	}

	/**
	 * @param data $event
	 */
	public function recenttopics_modify_tpl_ary(data $event)
	{
		if ($this->qte)
		{
			$tpl_ary = $event['tpl_ary'];
			$tpl_ary['TOPIC_ATTRIBUTE'] = $this->qte->attr_display($event['row']['topic_attr_id'], $event['row']['topic_attr_user'], $event['row']['topic_attr_time']);
			$event['tpl_ary'] = $tpl_ary;
		}
	}
}
