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
 
	class CharacterManagerViewTypes extends JView {
		
		function display() {
			JToolBarHelper::title( JText::_( 'Types' ), 'types_48.png' );
			JToolBarHelper::deleteList('Are you sure?','remove');
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();
			JToolBarHelper::publish();
			JToolBarHelper::unpublish();
			
			JHTML::_('behavior.tooltip');
			
			// Get the data
			$data =& $this->get('Data');
			$pagination =& $this->get('Pagination');
			// Send the data to the template
			$this->assignRef('data',$data);
			$this->assignRef('pagination',$pagination);
			
			parent::display();
		}
		
	}