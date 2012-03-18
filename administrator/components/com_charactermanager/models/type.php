<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access');
	
	class CharacterManagerModelType extends JModel {
		
		function __construct() {
			parent::__construct();
		}
		
		function &getData() {
			$db =& JFactory::getDBO();
			$array = JRequest::getVar('id',0,'','array');
			$id = (int)$array[0];
			
			if(empty($data)) {
				$query  = " SELECT * ";
				$query .= " FROM jos_char_types ";
				$query .= " WHERE id = ". $id;
				$db->setQuery($query);
				$data = $db->loadObject();
			}
			if(!$data) {
				$data = new stdClass();
				$data->id = 0;
				$data->name = NULL;
				$data->published = NULL;
				$data->ordering = NULL;
			}
			return $data;
		}
		
		function store($name,$order,$published) {
			$db =& JFactory::getDBO();
			
			$query  = " INSERT INTO `#__char_types` ";
			$query .= " (`name`,`ordering`,`published`) VALUES ";
			$query .= " ('".$name."',".$order.",".$published.") ";
			$db->setQuery($query);
			if(!$db->query($query)) {
				$this->setError($db->getErrorMsg());
				return false;
			}
			
			$query  = " ALTER TABLE `#__char_characters` ";
			$query .= " ADD `".$name."` int(6) NOT NULL DEFAULT '0' ";
			dump($query);
			$db->setQuery($query);
				if(!$db->query($query)) {
					$this->setError($db->getErrorMsg());
					return false;
				}
			return true;
		}
		
		function delete($ids) {
			$db =& JFactory::getDBO();
			
			foreach($ids as $id) {
				$query  = " SELECT `name` ";
				$query .= " FROM `#__char_types` ";
				$query .= " WHERE id = ".$id;
				$db->setQuery($query);
				$type = $db->loadResult($query);
				dump($type,"Type");
				if(empty($type)) {
					$this->setError($db->getErrorMsg());
					return false;
				}
				
				$query  = " DELETE FROM `#__char_types` ";
				$query .= " WHERE id = ".$id; 
				$db->setQuery($query);
				if(!$db->query($query)) {
					$this->setError($db->getErrorMsg());
					return false;
				}
				
				$query  = " ALTER TABLE `#__char_characters` ";
				$query .= " DROP `".$type."`";
				dump($query);
				$db->setQuery($query);
				if(!$db->query($query)) {
					$this->setError($db->getErrorMsg());
					return false;
				}
			}
			return true;
		}	
	}