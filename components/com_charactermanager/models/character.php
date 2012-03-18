<?php
/**
 * Joomla! 1.5 component Character Manager
 *
 * @version $Id: character.php 2011-10-28 10:20:36 svn $
 * @author Nick Swinford
 * @package Joomla
 * @subpackage Character Manager
 * @license Copyright (c) 2011 - All Rights Reserved
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('guild.model.characters');

	class CharactermanagerModelCharacter extends GuildModelCharacters {
		
		function buildWhere() {
			$character = JRequest::getVar('id',0,'','int');
			//$character = $this->getState('character');
			
			$where = " WHERE a.id = ".$character; 
			return $where;
		}
	}