<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access');
	
	class CharacterManagerModelTypes extends JModel {
		
		function __construct() {
			parent::__construct();	
			
			global $mainframe, $option;
 
			// Get pagination request variables
			$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
			$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
			// In case limit has been changed, adjust it
			$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
			$this->setState('limit', $limit);
			$this->setState('limitstart', $limitstart);
		}

		protected function buildQuery() {
			$query = " SELECT * FROM #__char_types ORDER BY ordering ";
			return $query;
		}

		function getData() {
			if(empty($this->_data)) {
				$query = $this->buildQuery();
				$this->data = $this->_getList($query,$this->getState('limitstart'),$this->getState('limit'));	
			}
			return $this->data;
		}
		
		function getTotal() {
		 	// Load the content if it doesn't already exist
		 	if (empty($this->_total)) {
		 	    $query = $this->buildQuery();
		 	    $this->_total = $this->_getListCount($query);	
		 	}
		 	return $this->_total;
	  	}
	  	
		 function getPagination() {
		 	// Load the content if it doesn't already exist
		 	if (empty($this->_pagination)) {
		 	    jimport('joomla.html.pagination');
		 	    $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		 	}
		 	return $this->_pagination;
  		}
  		
		function orderItem($item,$movement) {
			$db =& $this->getDBO();
						
			$query  = " UPDATE #__char_types ";
			$query .= " SET ordering = ordering + ".$movement;
			$query .= " WHERE id = ".$item; 
			$db->setQuery($query);
			
			if(!$db->query()) {
				$this->setError($db->getErrorMsg());
				return false;
				}
			return true;
		}
		
		/**
		 * Takes in a set of ids and the order for those ids
		 * and updates the table accordingly
		 * @param int array $ids
		 * @param int array $order
		 * @return boolean
		 */
		function setOrder($ids,$order) {
			$db =& $this->getDBO();
			$total = count($ids);
			
			// Take the IDs array and Order array
			// and places each ID into a keyed position
			// matching the given order position
			for($i = 0;$i < $total;$i++) {
				$ordering[$order[$i]] = $ids[$i];
			}
			// Sorts the array based on the position
			// so lower order values are first
			// and higher order values are last
			ksort($ordering);
			
			// Takes each ID and updates it in the table
			// based on the current value of variable i
			// This way, ordering is always lowest number possible
			$i = 1;
			foreach($ordering as $order) {
				$query  = " UPDATE #__char_types ";
				$query .= " SET ordering = ".$i;
				$query .= " WHERE id = ".$order;
			
				$db->setQuery($query);
				if(!$db->query()) {
					$this->setError($db->getErrorMsg());
					return false;
				}
				$i++;
			}
			return true;
		}
		
		function publish($ids,$value) {
			$db =& $this->getDBO();
			
			foreach($ids as $id) {
				$query  = " UPDATE #__char_types ";
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
	}