<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	// No direct access
	defined('_JEXEC') or die('Restricted Access');
	
	// Require the base controller and helper
	require_once(JPATH_COMPONENT.DS.'controller.php');
	require_once(JPATH_COMPONENT.DS.'helpers'.DS.'helper.php');
	JHTML::_('stylesheet','com_charactermanager.css','administrator/components/com_charactermanager/media/css/');
	
	// Require specific controll if requested
	if($controller = JRequest::getWord('controller')) {
		$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
		if(file_exists($path)) {
			require_once($path);
		} else {
			$controller = '';
		}
	}

	// Create the controller
	$classname = 'CharacterManagerController'.$controller;
	$controller = new $classname();
	
	// Perform the Reqested task
	$controller->execute(JRequest::getVar('task'));
	
	// Redirect if set by the controller
	$controller->redirect();