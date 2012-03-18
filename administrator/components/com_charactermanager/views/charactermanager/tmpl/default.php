<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access'); ?>
	<div id="cpanel" style="width:55%;">
		<div class="icon">
			<a href="index.php?option=com_charactermanager&controller=characters">
				<?php echo JHTML::_('image', 'administrator/components/com_charactermanager/media/icons/characters_48.png', NULL, NULL ); ?>	
				<span style="font-weight:bold">Characters</span>
			</a>
		</div>
		<div class="icon">
			<a href="index.php?option=com_charactermanager&controller=categories">
				<?php echo JHTML::_('image', 'administrator/components/com_charactermanager/media/icons/categories_48.png', NULL, NULL ); ?>
				<span style="font-weight:bold">Categories</span>
			</a>
		</div>
		<div class="icon">
			<a href="index.php?option=com_charactermanager&controller=types">
				<?php echo JHTML::_('image', 'administrator/components/com_charactermanager/media/icons/types_48.png', NULL, NULL ); ?>
				<span style="font-weight:bold">Types</span>
			</a>
		</div>
	</div>