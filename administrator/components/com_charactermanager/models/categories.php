<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	class CharacterManagerModelCategories extends JModel {
	
		function __construct() {
			parent::__construct();
		
			global $mainframe, $option;
 
			$filter_order = $mainframe->getUserStateFromRequest(  $option.'filter_order', 'filter_order', NULL, 'cmd' );
			$filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );
			$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
			$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			$filter_state = $mainframe->getUserStateFromRequest( $option.'filter_state','filter_state','','word');
			$levellimit	= $mainframe->getUserStateFromRequest($option.'levellimit','levellimit',10,'int');
			
			// In case limit has been changed, adjust it
			$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
			$this->setState('filter_order', $filter_order);
			$this->setState('filter_order_Dir', $filter_order_Dir);	
			$this->setState('limit', $limit);
			$this->setState('limitstart', $limitstart);
			$this->setState('levellimit',$levellimit);
		}
		
		function _buildWhere() {
			$filter_state = $this->getState('filter_state');
			$where = '';
			if ($filter_state) {
				if ($filter_state == 'P') {
					$where = ' WHERE published = 1 ';
				} else if ($filter_state == 'U') {
					$where = ' WHERE published = 0 ';
				}
			}
			return $where;
		}
		
		function _buildOrderBy() {
		
				$orderby = '';
				$filter_order     = $this->getState('filter_order');
				$filter_order_Dir = $this->getState('filter_order_Dir');
								
				//Error checking!  If the ordering is not valid, return NULL!!
				if(!in_array($filter_order,array('name','type','published','ordering'))	|| !in_array($filter_order_Dir,array('ASC','DESC','asc','desc'))) {
					$filter_order = NULL;
					$filter_order_Dir = NULL;
				}
				
				// If the ordering is NULL, order defaultly
				if(!empty($filter_order) || !empty($filter_order_Dir) ){
					$orderby = " ORDER BY ".$filter_order." ".$filter_order_Dir.", parent, ordering ";
				} else {
					$orderby = " ORDER BY parent, ordering ";
				}
				
				return $orderby;
		}
	
		function _buildQuery() {
			$orderby = $this->_buildOrderBy();
			$where = $this->_buildWhere();
		
			$query  = " SELECT * ";
			$query .= " FROM jos_char_categories ";
			$query .= $where;
			$query .= $orderby;
			
			return $query;
		}
		
		function getData() {
			// Get Database Object
			$db =& $this->getDBO();
			$levellimit = $this->getState('levellimit');
			
			// Build the query by calling the buildQuery function
			$query = $this->_buildQuery();
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			
			// Establish hierarchy
			$children = array();
			
			// First pass: collect children
			foreach($rows as $row) {
				$pt = $row->parent;
				if($list = @$children[$pt]) {
					$list = $children[$pt];
				} else {
					$list = array();
				}
				array_push($list,$row);
				$children[$pt] = $list;
			}
			// Second pass: get an indent list of the items
			$list = JHTML::_('menu.treerecurse',0,'',array(),$children, max(0,$levellimit-1));
			
			jimport('joomla.html.pagination');
			$total = count($list);
			$limitstart = $this->getState('limitstart');
			$limit = $this->getState('limit');
			$this->_pagination = new JPagination($total,$limitstart,$limit);
			
			// Slice out element based on Paginiation
			$list = array_slice($list,$this->_pagination->limitstart,$this->_pagination->limit);
			
			$data = $list;
			return $data;
		}
		
		function getPagination() {
			if($this->_pagination == NULL) {
				$this->getItems();
			}
			return $this->_pagination;
		}
		
	function publish($ids,$value) {
			$db =& $this->getDBO();
			
			foreach($ids as $id) {
				$query  = " UPDATE #__char_categories ";
				$query .= " SET published = ".$value;
				$query .= " WHERE id = ".$id;
				$db->setQuery($query);
				if(!$db->query($query)) {
					$this->setError($db->getErrorMsg());
					return false;
				}
			}
			return true;
		}
		
		function delete() {
			$ids = JRequest::getVar('id',array(0),'post','array');
			  $row =& $this->getTable();
			
			foreach($ids as $id) {
				if(!$row->delete($id)) {
				$this->setError($row->getErrorMsg());
				return false;
			}
		}
 
    return true;
		}
		
		function store() {
			 $row =& $this->getTable('categories');
 
			$data = JRequest::get( 'post' );
			// Bind the form fields to the table
			if (!$row->bind($data)) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		 
			// Make sure the hello record is valid
			if (!$row->check()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		 
			// Store the web link table to the database
			if (!$row->store()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		 
			return true;
		}
		
		function orderItem($item,$movement) {
			$db =& $this->getDBO();
						
			$query  = " UPDATE #__char_categories ";
			$query .= " SET ordering = ordering + ".$movement;
			$query .= " WHERE id = ".$item; 
			$db->setQuery($query);
			dump($this);
			if(!$db->query()) {
				$this->setError($db->getErrorMsg());
				return false;
				}
			return true;
		}
		
		function setOrder($ids,$order) {
			$total = count($ids);
			$row =& $this->getTable();
			$groupings = array();
			
			// Update ordering values
			for($i=0;$i<$total;$i++) {
				$row->load($ids[$i]);
				// Track parents
				$groupings[] = $row->parent;
				if($row->ordering != $order[$i]) {
					$row->ordering = $order[$i];
					if(!$row->store()) {
						$this->setError($row->getErrorMsg());
						return false;
					}
				}
			}
			
			$groupings = array_unique($groupings);
			foreach($groupings as $group) {
				$row->reorder('parent = '.(int)$group);
			}
			
			return true;
		}
	}