<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	class CharacterManagerModelCharacter extends JModel {
		
		function __construct() {
			parent::__construct();
			
			$array = JRequest::getVar('id',0,'','array');
			$int = (int)$array[0];
			$this->_id = $int;
		}
		
		function &getData() {
			if(empty($this->_data)) {
				$query  = " SELECT * FROM #__char_characters ";
				$query .= " WHERE id = ".$this->_id;
				$this->_db->setQuery($query);
				$this->_data = $this->_db->loadObject();
			}
			if(!$this->_data) {
				$this->_data = new stdClass();
				$this->_data->id = 0;
				$this->_data->user_id = '';
				$this->_data->name = '';
				$this->_data->allegiance = '';
				$this->_data->class = '';
				$this->_data->guild = '';
				$this->_data->rosterchecked = '';
				$this->_data->game = '';
				$this->_data->published = '';
				$this->_data->unpublisheddate = '';
				
			}
			return $this->_data;
		}
		
		function getGames() {
			if(empty($this->_games)) {
				$query = "SELECT * FROM #__adv_games";
				$this->_games = $this->_getList($query);
				
				$options[] = JHTML::_('select.option','',JTEXT::_('- Select Game -'));
				
				foreach($this->_games as $value) {
					$options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
				}
			}
			return $options;
		}
		
		function getAllegiances() {
			if(empty($this->_allegiances)) {
				$query = "SELECT * FROM #__adv_allegiances";
				$this->_allegiances = $this->_getList($query);
			}
			
			$options[] = JHTML::_('select.option','',JTEXT::_('- Select Allegiance -'));
			
			foreach($this->_allegiances as $value) {
				$options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			}
			
			return $options;
		}
		
		function getClasses() {
			if(empty($this->_classes)) {
				$query = "SELECT * FROM #__adv_classes";
				$this->_classes = $this->_getList($query);
			}
			
			$options[] = JHTML::_('select.option','',JTEXT::_('- Select Class -'));
			
			foreach($this->_classes as $value) {
				$options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			}
			
			return $options;
		}
		
		function getGuilds() {
			if(empty($this->_guilds)) {
				$query = "SELECT * FROM #__adv_guild_names";
				$this->_guilds = $this->_getList($query);
			}
			
			$options[] = JHTML::_('select.option','',JTEXT::_('- Select Guild -'));
			
			foreach($this->_guilds as $value) {
				$options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			}
			
			return $options;
		}
		//Get a list of types from the database
		//Turn list into array
		function getTypes() {
			if(empty($this->_types)) {
				$query = "SELECT name FROM #__char_types WHERE published = 1 ORDER BY ordering ";
				$types = $this->_getList($query);
			} else {
				$array = $this->_types;
				return $array;
			}
			foreach($types AS $type) {
				$array[] = $type->name;
			}
			$this->_types = $array;
			return $array;
		}
		//Get all the categories that match the given type
		function getTypeList($type) {
			$query  = " SELECT * ";
			$query .= " FROM #__char_categories ";
			$query .= " WHERE type = '".$type."' ";
			$query .= " ORDER BY parent, ordering ";
			
			$list = $this->_getList($query);
			
			$options[] = JHTML::_('select.option','',JTEXT::_('- Select '.ucfirst($type).' -'));
			
			foreach($list AS $value) {
				$options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name),'value','text');
			}
			
			return $options;
		}
	}