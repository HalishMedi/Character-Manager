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
class CharactermanagerViewCharacters extends GuildViewCharacters {
	
	function display($tmpl = null) {
		
		JHTML::stylesheet('characters.css','components/com_charactermanager/media/css/');
		JHTML::script('charactermanager.js','components/com_charactermanager/media/js/',true);
		
		$characters =& $this->get('Characters');
		$types =& $this->get('Types');
		$pagination =& $this->get('Pagination');
		
		//Change $items to $characters
		$this->assignRef('characters',$characters);
		$this->assignRef('types',$types);
		$this->assignRef('pagination',$pagination);
		
        parent::display($tmpl);
    }
}