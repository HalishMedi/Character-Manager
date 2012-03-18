<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access');
	
	class TableTypes extends JTable {
		var $id = NULL;
		var $name = '';
		var $ordering = 0;
		var $published = 0;
	
		function __construct(&$db) {
			parent::__construct('#__char_types','id',$db);
		}
	}