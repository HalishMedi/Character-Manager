<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	// No direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );
 
	jimport('joomla.application.component.controller');
 
	class CharacterManagerControllerCategories extends CharacterManagerController {
	
		function __construct() {
			parent::__construct();
 
			// Register Extra tasks
			$this->registerTask('add','edit' );
		}
	
		function display() {
			JRequest::setVar('view','categories');
			parent::display();
		}
		
		function edit() {
			JRequest::setVar('controller','categories');
			JRequest::setVar('view','category');
			JRequest::setVar('layout','form');
			JRequest::setVar('hidemainmenu',1);
			
			parent::display();
		}
		
		function publish() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$model = $this->getModel('categories');
			
			if(!$model->publish($ids,1)) {
				$msg = JText::_('Error: One or more categories could not be published.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Category(s) published');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}
		
		function unpublish() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$model = $this->getModel('categories');
			
			if(!$model->publish($ids,0)) {
				$msg = JText::_('Error: One or more categories could not be unpublished.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Category(s) unpublished');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}
		
		function remove() {
			$model = $this->getModel('categories');
			if(!$model->delete()){
				$msg = JText::_('Error: One or more categories could not be deleted.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Category(s) deleted.');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}

		function cancel() {
			$msg = JText::_('Operation Cancelled');
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,'notice');
		}
		
		function save() {
			$model = $this->getModel('categories');
			if(!$model->store()){
				$msg = JText::_('Error: the category could not be saved.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Category saved.');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}
		
		function orderup() {
			$idarr = JRequest::getVar('id',array(),'post','array');
			$id = (int)$idarr[0];
			
			if(empty($id)) {
				$this->setRedirect('index.php?option=com_charactermanager&controller=categories',JText::_('No item selected'),'notice');
				return false;
			}
			
			$model =& $this->getModel('categories');
			if($model->orderItem($id,-1)) {
				$msg = JText::_('Category moved up');
				$msgType = 'message';
			} else {
				if($model->getError()) {
					$msg = $model->getError();
				} else {
					$msg = JText::_('Category could not be moved up.');
				}
				$msgType = 'error';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}
		
		function orderdown() {
			$idarr = JRequest::getVar('id',array(),'post','array');
			$id = (int)$idarr[0];
			
			if(empty($id)) {
				$this->setRedirect('index.php?option=com_charactermanager&controller=categories',JText::_('No item selected'),'notice');
				return false;
			}
			
			$model =& $this->getModel('categories');
			if($model->orderItem($id,1)) {
				$msg = JText::_('Category moved down');
				$msgType = 'message';
			} else {
				if($model->getError()) {
					$msg = $model->getError();
				} else {
					$msg = JText::_('Category could not be moved down.');
				}
				$msgType = 'error';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}
		
		function saveorder() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$order = JRequest::getVar('order',array(),'post','array');
			JArrayHelper::toInteger($ids);
			JArrayHelper::toInteger($order);
			
			$model =& $this->getModel('categories');
			if($model->setOrder($ids,$order)) {
				$msg = JText::_('New ordering saved');
				$msgType = 'message';
			} else {
				if($model->getError()) {
					$msg = $model->getError();
				} else {
					$msg = JText::_('Ordering save failed.');
				}
				$msgType = 'error';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=categories',$msg,$msgType);
		}
		
	}