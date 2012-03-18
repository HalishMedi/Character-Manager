<?php
/**
 * Joomla! 1.5 component Character Manager
 *
 * @version $Id: roster.php 2011-10-28 10:20:36 svn $
 * @author Nick Swinford
 * @package Joomla
 * @subpackage Character Manager
 * @license Copyright (c) 2011 - All Rights Reserved
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('guild.model.characters');

	class CharactermanagerModelRoster extends GuildModelCharacters {
		
		function __construct(){
			parent::__construct();
			
			global $mainframe, $option;
			
			$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
			$limitstart = JRequest::getVar('limitstart',0,'','int');
			
			// In case limit has been changed, adjust it
			$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		 
			$this->setState('limit', $limit);
			$this->setState('limitstart', $limitstart);
		}
	}