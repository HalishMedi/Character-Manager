<?php

	//No direct access
	defined('_JEXEC') or die('Restricted access');
	// Include Joomla Controller class
	jimport('joomla.application.component.controller');
	
	class GuildControllerCharacters extends JController {
		
		function __construct(){
			//JRequest::setVar('tmpl','component');
			parent::__construct();
		}
		
		/* Task Functions */
		
		function add() {
			
			
		}
		
		function edit() {
			//$character = JRequest::getVar('id',0,'','int');	
			//$model = $this->getModel('character');
			//$model->setState('character',$character);
		
		JRequest::setVar('layout','form');
		parent::display();
			
		}
		
		function delete() {
			
			
		}
		
		function update() {
			
			
		}
		
		function publish() {
			
			
		}
		
		function unpbulish() {
			
			
		}
		
	}