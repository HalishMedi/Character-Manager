<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access');
	
	class CharacterManagerModelCharacters extends JModel {
	
		/*
		 * Items total
		 * @var integer
		 */
		var $_total = null;		 
		/*
		 * Pagination object
		 * @var object
		 */
		var $_pagination = null;
		  
		function __construct() {
		
			parent::__construct();
		 
			global $mainframe, $option;
		 
			// Get pagination request variables
			$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
			$limitstart = JRequest::getVar('limitstart',0,'','int');
			$filter_order = $mainframe->getUserStateFromRequest($option.'filter_order','filter_order',null,'cmd' );
			$filter_order_Dir = $mainframe->getUserStateFromRequest($option.'filter_order_Dir','filter_order_Dir',null,'word');
		 
			// In case limit has been changed, adjust it
			$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		 
			$this->setState('limit', $limit);
			$this->setState('limitstart', $limitstart);
			$this->setState('filter_order', $filter_order);
			$this->setState('filter_order_Dir', $filter_order_Dir);
		}
		
		// Builds the query string and returns it
		function _buildQuery() {
			$orderby = $this->_buildContentOrderBy();
			$where = $this->_buildContentWhere();
			$types = $this->getTypes();
			$i = 98;
			$n = 98;
			$query  = " SELECT a.id,a.user_id,a.name,a.rosterchecked,a.published,a.unpublisheddate ";
			foreach($types AS $type) {
				$query .= ",a.".$type." AS ".$type."_id ";
				$query .= ",".chr($i).".name AS ".$type."_name ";
				$i++;
			}
			$query .= " FROM #__char_characters AS a ";
			foreach($types AS $type){
				$query .= " LEFT JOIN #__char_categories AS ".chr($n)." ON ".chr($n).".id = a.".$type." ";
				$n++;
			}
			$query .= $where;
			$query .= $orderby;
			dump($query);
			return $query;
		}
		
		function _buildQueryforTotal(){
			$orderby = $this->_buildContentOrderBy();
			$where = $this->_buildContentWhere();
			
			$query  = " SELECT id";
			$query .= " FROM #__char_characters";
			$query .= $where;
			$query .= $orderby;
			return $query;
		
		}
	
		function getData() {
			// Checks to see if the data exists
			// if it doesn't, it then loads it
			if(empty($this->_data)) {
				$query = $this->_buildQuery();
				$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			}
			return $this->_data;
		}
		
		// Get the list of types from the table
		// and return it as an array
		function getTypes() {
			$db =& JFactory::getDBO();
			if(empty($this->_types)) {
				$query = " SELECT name FROM #__char_types WHERE published = 1 ORDER BY ordering ";
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
		
		// Take a type string and find all categories of that type
		// then turn that object into a list of select options
		function getTypeList($type) {
			$query  = " SELECT * ";
			$query .= " FROM #__char_categories ";
			$query .= " WHERE type = '".$type."' ";
			$query .= " ORDER BY parent, ordering ";
			
			$list = $this->_getList($query);
			
			$options[] = JHTML::_('select.option','',JTEXT::_('- Select '.ucfirst($type).' -'));
			
			foreach($list AS $value) {
				$options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			}
			
			return $options;
		}
		
		function getTotal() {
			// Load the content if it doesn't already exist
			if (empty($this->_total)) {
				$query = $this->_buildQueryforTotal();
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
		
		function _buildContentOrderBy() {
		
			global $mainframe, $option;
			$filter_order     = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'id', 'cmd' );
			$filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );
 
			$orderby = '';
			$filter_order     = $this->getState('filter_order');
			$filter_order_Dir = $this->getState('filter_order_Dir');
			
			//Error checking!  If the ordering is not valid, return NULL!!
			if(!in_array($filter_order,array('id','name','user_id','game','allegiance','class','guild','published'))) {
				$filter_order = NULL;
			}
			if(!in_array($filter_order_Dir,array('ASC','DESC','asc','desc'))) {
				$filter_order_Dir = NULL;
			}
			
			/* Error handling is never a bad thing*/
			if(!empty($filter_order) && !empty($filter_order_Dir) ){
				$orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
			} else {
				$orderby = '';
			}
 
			return $orderby;
		}
		
		function _buildContentWhere() {
			global $mainframe, $option;
			$db	=& JFactory::getDBO();
			$types = $this->getTypes();
			
			//Foreach type get the current state
			foreach($types AS $type) {
				$filter_type = 'filter_'.$type;
				$$filter_type = $mainframe->getUserStateFromRequest($option,$filter_type,$filter_type,0,'int');
			}
			$filter_state = $mainframe->getUserStateFromRequest($option.'filter_state','filter_state','','word');
			$search	= $mainframe->getUserStateFromRequest($option.'search','search','','string');
			
			if (strpos($search, '"') !== false) {
				$search = str_replace(array('=', '<'), '', $search);
			}
			
			$search = JString::strtolower($search);
			
			$where = array();
			// Set in the where clause all the different filters for each type
			foreach($types as $type) {
				$filter_type = 'filter_'.$type;
				if($$filter_type > 0) {
					$where[] = $type.' = '.(int)$$filter_type;
				}
			}
			
			if ($search) {
				$where[] = 'LOWER(name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			}
			if ( $filter_state ) {
				if ( $filter_state == 'P' ) {
					$where[] = 'published = 1';
				} else if ($filter_state == 'U' ) {
					$where[] = 'published = 0';
				}
			}
			
			$where = (count($where) ? ' WHERE '. implode( ' AND ', $where ) : '' );
			
			return $where;
		}
		
		function delete() {
			$ids = JRequest::getVar('id',array(0),'post','array');
			$row =& $this->getTable();
			
			foreach($ids as $id) {
				if(!$row->delete($id)){
					$this->setError($row->getErrorMsg());
					return false;
				}
			}
			return true;
		}
		
		function publish($ids,$value) {
			$table = $this->getTable();
			
			if(!$table->publish($ids,$value)) {
				$this->setError($table->getErrors());
				return false;
			} else {
				return true;
			}
		}
	}