<?php
/**
 * Joomla! 1.5 component Character Manager
 *
 * @version $Id: controller.php 2011-10-28 10:20:36 svn $
 * @author Nick Swinford
 * @package Joomla
 * @subpackage Character Manager
 * @license Copyright (c) 2011 - All Rights Reserved
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Require specific controller if requested
if($controller = JRequest::getWord('view')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if(file_exists($path)) {
		require_once($path);
	} else {
		$controller = '';
	}
}
// Initialize the controller
$classname = 'CharactermanagerController'.$controller;
$controller = new $classname();

// Require specific helper if avaliable
if($helper = JRequest::getWord('view')) {
	$path = JPATH_COMPONENT.DS.'helpers'.DS.$helper.'.php';
	if(file_exists($path)) {
		require_once($path);	
	}
}
//Perform the Request task
$controller->execute(JRequest::getWord('task'));

// Redirect if set by the controller
$controller->redirect();