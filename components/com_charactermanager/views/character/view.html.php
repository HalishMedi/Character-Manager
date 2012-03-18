<?php
	/**
	 * Joomla! 1.5 component Character Manager
	 *
	 * @version 
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
	class CharactermanagerViewCharacter extends GuildViewCharacters {
		
		function display() {
			$character =& $this->get('Character');
			$types =& $this->get('Types');
		
			$this->assignRef('character',$character);
			$this->assignRef('types', $types);
			
			parent::display();
		}
		
	}
