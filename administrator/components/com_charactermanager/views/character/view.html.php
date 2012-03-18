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
	
	class CharacterManagerViewCharacter extends JView {
	
		function display($tpl = null) {
			// Get the Data
			$data =& $this->get('Data');
			$types =& $this->get('Types');
			
			if($data->id < 1) {
				JToolBarHelper::title(JText::_('Character').':<small><small>['.JTEXT::_('New').']</small></small>','add_character_48.png');
			} else {
				JToolBarHelper::title(JText::_('Character').':<small><small>['.JTEXT::_('Edit').']</small></small>','edit_character_48.png');
			}
			
			JToolBarHelper::save();
			if ($data->id < 1)  {
				JToolBarHelper::cancel();
			} else {
				// for existing items the button is renamed `close`
				JToolBarHelper::cancel( 'cancel', 'Close' );
			}
			
			$this->assignRef('data',$data);
			$this->assignRef('lists',$lists);
			$this->assignRef('types',$types);
			
//			//Add custom CSS to force calender to align
//			$doc =& JFactory::getDocument();
//			$style = '.calendar {'
//					. 'vertical-align:top;'
//					. 'border:none;'
//					. '}'; 
//			$doc->addStyleDeclaration( $style );
			
			// Build select lists
			// Get the model
			$model =& $this->getModel();
			// For each type, get the options from the database
			foreach($types AS $type) {
				$$type = $model->getTypeList($type);
			}
			// For all the options, build the select list with the current value selected
			foreach($types AS $type) {
				$lists[$type] = JHTML::_('select.genericlist',$$type,$type,'style="width:155px;"','value','text',$data->$type);
			}
			
			parent::display($tpl);
		}
	}