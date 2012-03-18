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
	
	jimport('guild.model.characters');

	class CharactermanagerModelCharacters extends GuildModelCharacters {
		/**
		* Items total
		* @var integer
		*/
		var $_total = null;
	  	/**	
	   	* Pagination object
	   	* @var object
	   	*/
	  	var $_pagination = null;
	    /**
		 * Constructor
		 */
	function __construct() {
		parent::__construct();
		$mainframe = JFactory::getApplication();
 
		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');

		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
	 
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
    }
    
	function buildWhere(){
		$user = JRequest::getVar('user', 0, '', 'int');
		$approved_gids = Array(24,25,31);
		$current_user =& JFactory::getUser();
		if(!$user == 0 && in_array($current_user->gid,$approved_gids)){
			return $query = " WHERE user_id = ".$user;
		} elseif ($user == 0){
			return $query = " WHERE user_id = ".$current_user->id;
		} else {
			die("You are not authorized to view this resource.");
			//return $query = " WHERE a.name IS NULL";
		}
	}

}