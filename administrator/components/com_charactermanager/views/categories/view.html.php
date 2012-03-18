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
 
	class CharacterManagerViewCategories extends JView {
	
		function display() {
			global $mainframe, $option;
		
			JToolBarHelper::title( JText::_( 'Categories' ), 'categories_48.png' );
			JToolBarHelper::deleteList('Are you sure?','remove');
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();
			JToolBarHelper::publish();
			JToolBarHelper::unpublish();
			
			// Get the data
			$data =& $this->get('Data');
			//$lists =& $this->get('Lists');
			$pagination =& $this->get('Pagination');
			
			$state =& $this->get('state');
			
			$filter_state = $mainframe->getUserStateFromRequest( $option.'filter_state','filter_state','','word');
			$levellimit	= $mainframe->getUserStateFromRequest($option.'levellimit','levellimit',10,'int');
			
			$lists['order_Dir'] = $state->get( 'filter_order_Dir' );
			$lists['order']     = $state->get( 'filter_order' );
			$lists['state'] = JHTML::_('grid.state',$filter_state);
			$lists['levellist'] = JHTML::_('select.integerlist',1,20,1,'levellimit','size="1" onchange="document.adminForm.submit();"', $levellimit );
			
			$ordering = ($lists['order'] == 'ordering');
			
			JHTML::_('behavior.tooltip');
			
			// Send the data to the template
			$this->assignRef('data',$data);
			$this->assignRef('lists',$lists);
			$this->assignRef('pagination',$pagination);
			$this->assignRef('ordering',$ordering);
			
			parent::display();
		}
	
	}