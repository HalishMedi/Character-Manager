<?php

	// No direct access
	defined('_JEXEC') or die('Restricted access');
	//Include Joomla Model Class
	jimport('joomla.application.component.model');

	class GuildModelCharacters extends JModel {
		
		/* Query Functions */
		
		function getTypes(){
			if(empty($this->types)){
				$db =& JFactory::getDBO();
				$query = " SELECT * FROM #__char_types WHERE published = 1 ORDER BY ordering ";
				$db->setQuery($query);
				$this->types = $db->loadObjectList();
			}

			return $this->types;
		}
		
		function getCategories(){
			if(empty($this->categories)){
				$db =& JFactory::getDBO();
				$query = " SELECT * FROM #__char_categories WHERE published = 1 ORDER BY ordering ";
				$db->setQuery($query);
				$this->categories = $db->loadObjectList();	
			}
			
			return $this->categories;
		}
		
		function buildQuery(){
			//$orderby = $this->buildOrderBy(); 
			$where = $this->buildWhere();
			$types = $this->getTypes();
			$i = 98;
			$n = 98;
			$query  = " SELECT a.id,a.user_id,a.name,z.username,a.rosterchecked,a.published,a.unpublisheddate ";
			foreach($types AS $type) {
				$query .= ",a.".$type->name." AS ".$type->name."_id ";
				$query .= ",".chr($i).".name AS ".$type->name."_name ";
				$i++;
			}
			$query .= " FROM #__char_characters AS a ";
			$query .= " LEFT JOIN #__users AS z ON z.id = a.user_id ";
			foreach($types AS $type){
				$query .= " LEFT JOIN #__char_categories AS ".chr($n)." ON ".chr($n).".id = a.".$type->name." ";
				$n++;
			}
			$query .= $where;
			//$query .= $orderby;
			
			return $query;
		}
		
		function buildWhere(){
			$character = $this->getState('character');
			
			if(isset($character)){
				return " WHERE a.id = ".$character;
			}
//			$user = JRequest::getVar('user', 0, '', 'int');
//			$approved_gids = Array(24,25,31);
//			$current_user =& JFactory::getUser();
//			if(!$user == 0 && in_array($current_user->gid,$approved_gids)){
//				return $query = " WHERE user_id = ".$user;
//			} elseif ($user == 0){
//				return $query = " WHERE user_id = ".$current_user->id;
//			} else {
//				die("You are not authorized to view this resource.");
//				//return $query = " WHERE a.name IS NULL";
//			}
		}
		
		function buildOrderBy(){
			
		}
		
		function getCharacters(){
			$query = $this->buildQuery();
			$result = $this->_getList($query,$this->getState('limitstart'),$this->getState('limit'));
			return $result;
		}
		
		function getCharacter() {
			if(empty($this->character)){
				$db =& JFactory::getDBO();
				$db->setQuery($this->buildQuery());
				$this->character = $db->loadObject();
			}
			return $this->character;
		}
		
		/* Task functions */
		
		function add(){
	  		
	  	}
	  	
	  	function delete(){
	  		$db = $this->getDBO();
	  		$id = JRequest::getVar('id',0,'','int');
	  		$query = " DELETE * FROM `#__char_characters` WHERE id = ".$id;
	  		if($db->setQuery($query)){
	  			return true;
	  		} else {
	  			return false;
	  		}
	  	}
	  	
	  	function edit(){
  		
  		}
  		
  		function publish(){
  			
  		}
  		
  		function unpublish(){
  			
  		}
		
		/* Pagination functions */
		
		function getPagination(){
			// Load the content if it doesn't already exist
			if (empty($this->_pagination)) {
				jimport('joomla.html.pagination');
				$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
			}
			return $this->_pagination;
		}
		
		function buildQueryforTotal(){
			//$orderby = $this->_buildContentOrderBy();
			//$where = $this->_buildContentWhere();
			$query  = " SELECT id";
			$query .= " FROM #__char_characters";
			//$query .= $where;
			//$query .= $orderby;
			return $query;
		
		}
		
		function getTotal(){
			// Load the content if it doesn't already exist
			if (empty($this->total)) {
				$query = $this->buildQueryforTotal();
				$this->total = $this->_getListCount($query);	
			}
			return $this->total;
		}
		
	}