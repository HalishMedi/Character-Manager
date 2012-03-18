<?php
/**
 * Joomla! 1.5 component Character Manager
 *
 * @version 
 * @author Nick Swinford
 * @package Joomla
 * @subpackage Character Manager
 * @license Copyright (c) 2011 - All Rights Reserved
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('guild.view.characters');

	/**
	 * HTML View class for the Member Manager component
	 */
	class CharactermanagerViewRoster extends GuildViewCharacters {

		function display($tmpl = null) {
			
			JHTML::script('form.js','components/com_charactermanager/media/js/',true);
			JHTML::stylesheet('bootstrap.css','components/com_charactermanager/media/css/');
			
			$characters =& $this->get('Characters');
			$types		=& $this->get('Types');
			$pagination =& $this->get('Pagination');
			
			
			$this->assignRef('characters',$characters);
			$this->assignRef('types', $types);
			$this->assignRef('pagination',$pagination);
			
			parent::display($tmpl);
		}
	}