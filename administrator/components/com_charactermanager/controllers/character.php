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
	
	class CharacterManagerControllerCharacter extends CharacterManagerController {
	
		function __construct() {
			//parent::__construct();
			// Register Extra tasks
			//$this->registerTask('add','edit');
			dump("Character controller used! Fix!!");
			dumpTrace();
		}
	
		// Sets the view and layout when the edit task is called
		// To make changes to Edit button, modify edit method in Characters controller
		// function edit() {
			// JRequest::setVar('view','character');
			// JRequest::setVar('layout','form');
			// JRequest::setVar('hidemainmenu',1);
			
			// parent::display();
		// }
		
		// function cancel() {
			// $msg = JText::_('Operation Cancelled');
			// $this->setRedirect('index.php?option=com_charactermanager&controller=characters',$msg,'notice');
		// }
	}