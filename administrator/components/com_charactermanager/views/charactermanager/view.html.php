<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	// Check to ensure this file is included in Joomla!
	defined('_JEXEC') or die();
 
	jimport( 'joomla.application.component.view' );
 
	class CharacterManagerViewCharacterManager extends JView {
		
		function display($tpl = null) {
			JToolBarHelper::title( JText::_( 'Character Manager' ), 'generic.png' );
			// JToolBarHelper::deleteList();
			// JToolBarHelper::editListX();
			// JToolBarHelper::addNewX();

			// /* Call the state object */
			// $state =& $this->get('state');
			// global $mainframe, $option;
			
			// $filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',		'word'	);
			// $filter_game		= $mainframe->getUserStateFromRequest( $option.'filter_game',		'filter_game',		0,		'int'	);
			// $filter_allegiance	= $mainframe->getUserStateFromRequest( $option.'filter_allegiance',	'filter_allegiance',0,		'int'	);
			// $filter_class		= $mainframe->getUserStateFromRequest( $option.'filter_class',		'filter_class',		0,		'int'	);
			// $filter_guild		= $mainframe->getUserStateFromRequest( $option.'filter_guild',		'filter_guild',		0,		'int'	);
			// $filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'id',	'cmd'	);
			// $filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',		'word'	);
			// $search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',		'string');
	 
			// // Get data from the model
			// $items =& $this->get('Data');
			// $games =& $this->get('Games');
			// $allegiances =& $this->get('Allegiances');
			// $classes =& $this->get('Classes');
			// $guilds =& $this->get('Guilds');
			// $pagination =& $this->get('Pagination');
			
			// // Build filter lists
			// $javascript = 'onchange="document.adminForm.submit();"';
			// $lists['game'] 			= JHTML::_('select.genericlist',$games,'filter_game',$javascript,'value','text',$filter_game);
			// $lists['allegiance'] 	= JHTML::_('select.genericlist',$allegiances,'filter_allegiance',$javascript,'value','text',$filter_allegiance);
			// $lists['class'] 		= JHTML::_('select.genericlist',$classes,'filter_class',$javascript,'value','text',$filter_class);
			// $lists['guild'] 		= JHTML::_('select.genericlist',$guilds,'filter_guild',$javascript,'value','text',$filter_guild);
			// $lists['state'] 		= JHTML::_('grid.state',$filter_state);
			// $lists['search'] 		= $search;
	 
			// // Push data into the template
			// $this->assignRef('items',$items);
			// $this->assignRef('pagination',$pagination);
			// $this->assignRef('lists',$lists);
			
			// /* Get the values from the state object that were inserted in the model's construct function */
			// $lists['order_Dir'] = $state->get('filter_order_Dir');
			// $lists['order']     = $state->get('filter_order');

			parent::display($tpl);
		}
	}