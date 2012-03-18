<?php
/**
 * Joomla! 1.5 component Character Manager
 *
 * @version $Id: controller.php 2011-10-28 10:20:36 svn $
 * @author Nick Swinford
 * @package Joomla
 * @subpackage Character Manager
 * @license Copyright (c) 2011 - All Rights Reserved
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('guild.view.characters');

/**
 * HTML View class for the Member Manager component
 */
class CharactermanagerViewCharacters extends GuildViewCharacters {
	
	function display(){
		$items = $this->get('Characters');
		$items = json_encode($items);
		echo $items;
		parent::display();
	}
	
}