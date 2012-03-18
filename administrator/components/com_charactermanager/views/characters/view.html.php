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
 
	class CharacterManagerViewCharacters extends JView {
		
		function display($tpl = null) {
			JToolBarHelper::title( JText::_( 'Characters' ), 'characters_48.png' );
			JToolBarHelper::deleteList("Are you sure?","remove");
			JToolBarHelper::editListX();
			JToolBarHelper::addNewX();
			JToolBarHelper::publish();
			JToolBarHelper::unpublish();

			global $mainframe, $option;
			
			/* Call the state object */
			$state =& $this->get('state');
			
			// Get data from the model
			$data =& $this->get('Data');
			$pagination =& $this->get('Pagination');
			$names =& $this->get('Names');
			$types =& $this->get('Types');
			
			$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',		'word'	);
			$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'',	'cmd'	);
			$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',		'word'	);
			$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',		'string');
			foreach($types as $type) {
				$filter_type = 'filter_'.$type;
				$$filter_type = $mainframe->getUserStateFromRequest($option,$filter_type,$filter_type,0,'int');
			}
			
			// Build filter lists
			$javascript = 'onchange="document.adminForm.submit();"';
			$model =& $this->getModel();
			//Get the list for each type
			foreach($types AS $type) {
				$$type = $model->getTypeList($type);
			}
			//Turn each type list into a select drop down list dynamically
			foreach($types AS $type) {
				$filter = 'filter_'.$type;
				$lists[$type] = JHTML::_('select.genericlist',$$type,$filter,$javascript,'value','text',$$filter);
			}
			$lists['state'] 		= JHTML::_('grid.state',$filter_state);
			$lists['search'] 		= $search;
			
			// Push data into the template
			$this->assignRef('items',$data);
			$this->assignRef('pagination',$pagination);
			$this->assignRef('lists',$lists);
			$this->assignRef('names',$names);
			$this->assignRef('types',$types);
			
			/* Get the values from the state object that were inserted in the model's construct function */
			$lists['order_Dir'] = $state->get('filter_order_Dir');
			$lists['order']     = $state->get('filter_order');

			parent::display($tpl);
		}
	}