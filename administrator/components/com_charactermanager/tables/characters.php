<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access');
	
	class TableCharacters extends JTable {
		var $id = NULL;
		var $user_id = NULL;
		var $name = NULL;
		var $guild = NULL;
		var $game = NULL;
		var $allegiance = NULL;
		var $class = NULL;
		var $rosterchecked = NULL;
		var $published = NULL;
		var $unpublisheddate = NULL;
	
		function __construct(&$db) {
			parent::__construct('#__char_characters','id',$db);
		}
	}