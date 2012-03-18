<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	class CharacterManagerModelCategory extends JModel {
	
		function __construct() {
			parent::__construct();
		}
	
		function &getData() {
			$db =& JFactory::getDBO();
			$array = JRequest::getVar('id',0,'','array');
			$id = (int)$array[0];
			
			if(empty($data)) {
				$query  = " SELECT * ";
				$query .= " FROM jos_char_categories ";
				$query .= " WHERE id = ". $id;
				$db->setQuery($query);
				$data = $db->loadObject();
			}
			if(!$data) {
				$data = new stdClass();
				$data->name = NULL;
				$data->type = NULL;
				$data->parent = NULL;
				$data->published = NULL;
				$data->ordering = NULL;
				$data->id = 0;
			}
			
			return $data;
		}
		
		function getParents() {
			$db =& JFactory::getDBO();
			
			$query = 'SELECT *' .
				 	 ' FROM #__char_categories' .
				 	 ' ORDER BY parent, ordering';
			$db->setQuery($query);
			$items = $db->loadObjectList();
	 
			return $items;
		}
		
		
		
	}