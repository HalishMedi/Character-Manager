<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	class CharacterManagerModelCharacterManager extends JModel {
	
		// /*
		 // * Items total
		 // * @var integer
		 // */
		// var $_total = null;		 
		// /*
		 // * Pagination object
		 // * @var object
		 // */
		// var $_pagination = null;
		  
		// function __construct() {
		
			// parent::__construct();
		 
			// global $mainframe, $option;
		 
			// // Get pagination request variables
			// $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
			// $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
			
			// $filter_order     = $mainframe->getUserStateFromRequest(  $option.'filter_order', 'filter_order', 'id', 'cmd' );
			// $filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );
		 
			// // In case limit has been changed, adjust it
			// $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		 
			// $this->setState('limit', $limit);
			// $this->setState('limitstart', $limitstart);
			// $this->setState('filter_order', $filter_order);
			// $this->setState('filter_order_Dir', $filter_order_Dir);
		// }
	
		// // Builds the query string and returns it
		// function _buildQuery() {
			// $orderby = $this->_buildContentOrderBy();
			// $where = $this->_buildContentWhere();
			
			// $query = " SELECT
						// #__adv_character_names.id,
						// #__adv_character_names.name AS name,
						// #__adv_character_names.user_id,
						// #__adv_guild_names.name AS guild,
						// #__adv_allegiances.name AS allegiance,
						// #__adv_classes.name AS class,
						// #__adv_games.name AS game,
						// #__adv_character_names.published";
			// $query .=" FROM jos_adv_character_names
						// LEFT JOIN #__adv_guild_names ON #__adv_guild_names.id = #__adv_character_names.guild
						// LEFT JOIN #__adv_allegiances ON #__adv_allegiances.id = #__adv_character_names.allegiance
						// LEFT JOIN #__adv_classes ON #__adv_classes.id = #__adv_character_names.class
						// LEFT JOIN #__adv_games ON #__adv_games.id = #__adv_character_names.game ";
			// $query .= $where;
			// $query .= $orderby;
			
			// return $query;
		// }
	
		// function getData() {
			// // Checks to see if the data exists
			// // if it doesn't, it then loads it
			// if(empty($this->_data)) {
				// $query = $this->_buildQuery();
				// $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			// }
			// return $this->_data;
		// }
		
		// function getGames() {
			// if(empty($this->_games)) {
				// $query = "SELECT * FROM #__adv_games";
				// $this->_games = $this->_getList($query);
				
				// $options[] = JHTML::_('select.option','',JTEXT::_('- Select Game -'));
				
				// foreach($this->_games as $value) {
					// $options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
				// }
			// }
			// return $options;
		// }
		
		// function getAllegiances() {
			// if(empty($this->_allegiances)) {
				// $query = "SELECT * FROM #__adv_allegiances";
				// $this->_allegiances = $this->_getList($query);
			// }
			
			// $options[] = JHTML::_('select.option','',JTEXT::_('- Select Allegiance -'));
			
			// foreach($this->_allegiances as $value) {
				// $options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			// }
			
			// return $options;
		// }
		
		// function getClasses() {
			// if(empty($this->_classes)) {
				// $query = "SELECT * FROM #__adv_classes";
				// $this->_classes = $this->_getList($query);
			// }
			
			// $options[] = JHTML::_('select.option','',JTEXT::_('- Select Class -'));
			
			// foreach($this->_classes as $value) {
				// $options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			// }
			
			// return $options;
		// }
		
		// function getGuilds() {
			// if(empty($this->_guilds)) {
				// $query = "SELECT * FROM #__adv_guild_names";
				// $this->_guilds = $this->_getList($query);
			// }
			
			// $options[] = JHTML::_('select.option','',JTEXT::_('- Select Guild -'));
			
			// foreach($this->_guilds as $value) {
				// $options[] = JHTML::_('select.option',$value->id,JTEXT::_($value->name));
			// }
			
			// return $options;
		// }
		
		// function getTotal() {
			// // Load the content if it doesn't already exist
			// if (empty($this->_total)) {
				// $query = $this->_buildQuery();
				// $this->_total = $this->_getListCount($query);	
			// }
			// return $this->_total;
		// }
		
		// function getPagination() {
			// // Load the content if it doesn't already exist
			// if (empty($this->_pagination)) {
				// jimport('joomla.html.pagination');
				// $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
			// }
			// return $this->_pagination;
		// }
		
		// function _buildContentOrderBy() {
		
			// global $mainframe, $option;
			// $filter_order     = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'id', 'cmd' );
			// $filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );
 
			// $orderby = '';
			// $filter_order     = $this->getState('filter_order');
			// $filter_order_Dir = $this->getState('filter_order_Dir');
 
			// /* Error handling is never a bad thing*/
			// if(!empty($filter_order) && !empty($filter_order_Dir) ){
				// $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
			// }
 
			// return $orderby;
		// }
		
		// function _buildContentWhere() {
			// global $mainframe, $option;
			
			// $db					=& JFactory::getDBO();
			// $filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',		'word'	);
			// $filter_game		= $mainframe->getUserStateFromRequest( $option.'filter_game',		'filter_game',		0,		'int'	);
			// $filter_allegiance	= $mainframe->getUserStateFromRequest( $option.'filter_allegiance',	'filter_allegiance',0,		'int'	);
			// $filter_class		= $mainframe->getUserStateFromRequest( $option.'filter_class',		'filter_class',		0,		'int'	);
			// $filter_guild		= $mainframe->getUserStateFromRequest( $option.'filter_guild',		'filter_guild',		0,		'int'	);
			// $filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'id',	'cmd'	);
			// $filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',		'word'	);
			// $search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',		'string');
			
			// if (strpos($search, '"') !== false) {
				// $search = str_replace(array('=', '<'), '', $search);
			// }
			
			// $search = JString::strtolower($search);
			
			// $where = array();

			// if ($filter_game > 0) {
				// $where[] = '#__adv_character_names.game = '.(int) $filter_game;
			// }
			// if ($filter_allegiance > 0) {
				// $where[] = '#__adv_character_names.allegiance = '.(int) $filter_allegiance;
			// }
			// if ($filter_class > 0) {
				// $where[] = '#__adv_character_names.class = '.(int) $filter_class;
			// }
			// if ($filter_guild > 0) {
				// $where[] = '#__adv_character_names.guild = '.(int) $filter_guild;
			// }
			// if ($search) {
				// $where[] = 'LOWER(#__adv_character_names.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
			// }
			// if ( $filter_state ) {
				// if ( $filter_state == 'P' ) {
					// $where[] = 'published = 1';
				// } else if ($filter_state == 'U' ) {
					// $where[] = 'published = 0';
				// }
			// }
			// $where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

			// return $where;
		// }
	}