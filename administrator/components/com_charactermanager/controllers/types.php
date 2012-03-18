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
 
	class CharacterManagerControllerTypes extends CharacterManagerController {
	
		function __construct() {
			parent::__construct();
 
			// Register Extra tasks
			$this->registerTask('add','edit' );
		}
	
		function display() {
			JRequest::setVar('view','types');
			parent::display();
		}
		
		function edit() {
			JRequest::setVar('controller','types');
			JRequest::setVar('view','type');
			JRequest::setVar('layout','form');
			JRequest::setVar('hidemainmenu',1);
			
			parent::display();
		}
		
		function publish() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$model = $this->getModel('types');
			
			if(!$model->publish($ids,1)) {
				$msg = JText::_('Error: One or more types could not be published.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Type(s) published');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}
		
		function unpublish() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$model = $this->getModel('types');
			
			if(!$model->publish($ids,0)) {
				$msg = JText::_('Error: One or more types could not be unpublished.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Type(s) unpublished');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}
		
		function remove() {
			$model = $this->getModel('type');
			$ids = JRequest::getVar('id',array(),'post','array');
			JArrayHelper::toInteger($ids);
			
			if(!$model->delete($ids)){
				if($model->getError()) {
						$msg = $model->getError();
					} else {
						$msg = JText::_('Error: One or more types could not be deleted.');
					}
				//$msg = JText::_('Error: One or more types could not be deleted.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Type(s) deleted.');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}

		function cancel() {
			$msg = JText::_('Operation Cancelled');
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,'notice');
		}
		
		function save() {
			$name = JRequest::getVar('name','','post','string');
			$order = JRequest::getVar('order','0','post','int');
			$published = JRequest::getVar('published','0','post','int');
			
			$model = $this->getModel('type');
			if(!$model->store($name,$order,$published)){
				if($model->getError()) {
						$msg = $model->getError();
					} else {
						$msg = JText::_('Error: the type could not be saved.');
					}
				//$msg = JText::_('Error: the type could not be saved.');
				$msgType = 'error';
			} else {
				$msg = JText::_('Type saved.');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}
		
		function orderup() {
			$idarr = JRequest::getVar('id',array(),'post','array');
			$id = (int)$idarr[0];
			
			if(empty($id)) {
				$this->setRedirect('index.php?option=com_charactermanager&controller=types',JText::_('No item selected'),'notice');
				return false;
			}
			
			$model =& $this->getModel('types');
			if($model->orderItem($id,-1)) {
				$msg = JText::_('Type moved up');
				$msgType = 'message';
			} else {
				if($model->getError()) {
					$msg = $model->getError();
				} else {
					$msg = JText::_('Type could not be moved up.');
				}
				$msgType = 'error';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}
		
		function orderdown() {
			$idarr = JRequest::getVar('id',array(),'post','array');
			$id = (int)$idarr[0];
			
			if(empty($id)) {
				$this->setRedirect('index.php?option=com_charactermanager&controller=types',JText::_('No item selected'),'notice');
				return false;
			}
			
			$model =& $this->getModel('types');
			if($model->orderItem($id,1)) {
				$msg = JText::_('Type moved down');
				$msgType = 'message';
			} else {
				if($model->getError()) {
					$msg = $model->getError();
				} else {
					$msg = JText::_('Type could not be moved down.');
				}
				$msgType = 'error';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}
		
		function saveorder() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$order = JRequest::getVar('order',array(),'post','array');
			JArrayHelper::toInteger($ids);
			JArrayHelper::toInteger($order);
			
			$model =& $this->getModel('types');
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
			$this->setRedirect('index.php?option=com_charactermanager&controller=types',$msg,$msgType);
		}
		
	}