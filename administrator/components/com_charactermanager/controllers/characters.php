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
 
	class CharacterManagerControllerCharacters extends CharacterManagerController {
    
		function display($tpl = NULL) {
			JRequest::setVar('view','characters');
			parent::display($tpl);
		}
		
		function edit() {
			JRequest::setVar('controller','characters');
			JRequest::setVar('view','character');
			JRequest::setVar('layout','form');
			JRequest::setVar('hidemainmenu',1);
			
			parent::display();
		}
		
		function add() {
			JRequest::setVar('controller','characters');
			JRequest::setVar('view','character');
			JRequest::setVar('layout','form');
			JRequest::setVar('hidemainmenu',1);
			
			parent::display();
		}
		
		function cancel() {
			$msg = JText::_('Operation Cancelled');
			$this->setRedirect('index.php?option=com_charactermanager&controller=characters',$msg,'notice');
		}
		
		function publish() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$model = $this->getModel('characters');
			
			if(!$model->publish($ids,1)) {
				$msg = JText::_('Error: One or more characters could not be published.');
				$msgType = 'notice';
			} else {
				$msg = JText::_('Character(s) published');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=characters',$msg,$msgType);
		}
		
		function unpublish() {
			$ids = JRequest::getVar('id',array(),'post','array');
			$model = $this->getModel('characters');
			
			if(!$model->publish($ids,0)) {
				$msg = JText::_('Error: One or more characters could not be unpublished.');
				$msgType = 'notice';
			} else {
				$msg = JText::_('Character(s) unpublished');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=characters',$msg,$msgType);
		}
		
		function remove() {
			$model = $this->getModel('characters');
			if(!$model->delete()){
				$msg = JText::_('Error: One or more characters could not be deleted.');
				$msgType = 'notice';
			} else {
				$msg = JText::_('Characters(s) deleted.');
				$msgType = 'message';
			}
			$this->setRedirect('index.php?option=com_charactermanager&controller=characters',$msg,$msgType);
		}
	}