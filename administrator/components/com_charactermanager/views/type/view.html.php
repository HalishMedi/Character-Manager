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
 
	class CharacterManagerViewType extends JView {
		
		function display() {

			$data =& $this->get('Data');
			
			if($data->id < 1) {
				JToolBarHelper::title(JText::_('Type').':<small><small>['.JTEXT::_('New').']</small></small>','add_type_48.png');
			} else {
				JToolBarHelper::title(JText::_('Type').':<small><small>['.JTEXT::_('Edit').']</small></small>','edit_type_48.png');
			}
			
			JToolBarHelper::save();
			if ($data->id < 1)  {
				JToolBarHelper::cancel();
			} else {
				// for existing items the button is renamed `close`
				JToolBarHelper::cancel( 'cancel', 'Close' );
			}
			
			$this->assignRef('data',$data);
		
			parent::display();
		}
		
		function ordering(&$row,$id) {
			$db =& JFactory::getDBO();
			
			if($id) {
				$query  = " SELECT ordering AS value, name AS text ";
				$query .= " FROM #__char_types ";
				$query .= " ORDER BY ordering ";
				$order = JHTML::_('list.genericordering',$query);
				$ordering = JHTML::_('select.genericlist',$order,'ordering','class="inputbox" size="1"','value','text',intval($row->ordering));
			} else {
				$ordering = '<input type="hidden" name="ordering" value"'.$row->ordering.'"/>'.JText::_('DESCNEWITEMSLAST');	
			}
			return $ordering;
		}
		
	}