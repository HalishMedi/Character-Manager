<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	// Check to ensure this file is included in Joomla!
	defined('_JEXEC') or die();
 
	jimport('joomla.application.component.view');
	jimport('joomla.html.pane');
 
	class CharacterManagerViewCategory extends JView {
	
		function display() {
			$data =& $this->get('Data');
			$parentlist =& $this->get('ParentList');
			
			if($data->id < 1) {
				JToolBarHelper::title(JText::_('Category').':<small><small>['.JTEXT::_('New').']</small></small>','add_category_48.png');
			} else {
				JToolBarHelper::title(JText::_('Category').':<small><small>['.JTEXT::_('Edit').']</small></small>','edit_category_48.png');
			}
			JToolBarHelper::save();
			if($data->id < 1) {
				JToolBarHelper::cancel();
			} else {
				JToolBarHelper::cancel('cancel','Close');
			}
			
			// Add slider pane
			$pane = &JPane::getInstance('sliders', array('allowAllClose' => true));
			$this->assignRef('pane', $pane);
			
			$this->assignRef('data',$data);
			$this->assignRef('parentlist',$parentlist);
			
			parent::display();
		}
		
		function parentlist(&$row) {
			$items =& $this->get('Parents');
			
			// Eastablish the hiearchy
			$children = array();
			//dump($items);
			// First pass: collect cildren
			if($items) {
				foreach($items as $item) {
					if($item->id != $row->id) {
						$pt = $item->parent;
						$list = @$children[$pt] ? $children[$pt] : array();
						array_push($list,$item);
						$children[$pt] = $list;
					}
				}
			}
			
			// Second pass: get an indent list of the items
			$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
			
			// Assemble menu itmes to the array
			$menuitems = array();
			$menuitems[] = JHTML::_('select.option','0',JText::_('Top'));

			foreach($list as $item) {
				$menuitems[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename );
			}
			$output = JHTML::_('select.genericlist', $menuitems, 'parent', 'class="inputbox" size="10"', 'value', 'text', $row->parent );
	 
			return $output;
		}
		
		function ordering(&$row,$id) {
			$db =& JFactory::getDBO();
	 
			if ($id) {
				$query = 'SELECT ordering AS value, name AS text'
				. ' FROM #__char_categories'
				. ' WHERE parent = '.(int) $row->parent
				. ' ORDER BY ordering';
				$order = JHTML::_('list.genericordering',  $query );
				$ordering = JHTML::_('select.genericlist',   $order, 'ordering', 'class="inputbox" size="1"', 'value', 'text', intval( $row->ordering ) );
			} else {
				$ordering = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />'. JText::_( 'DESCNEWITEMSLAST' );
			}
			return $ordering;
		}
	
	}