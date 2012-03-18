<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access'); ?>
	
	<form action="index.php" method="post" name="adminForm" id="adminForm">
		<table>
			<tr>
				<td valign="top">
					<fieldset>
						<legend><?php echo JText::_('Username'); ?></legend>
						<input type="text" name="user" size="32" value="<?php echo $this->data->user_id; ?>"/>
					</fieldset>
					<fieldset>
						<legend><?php echo JText::_('Character Name'); ?></legend>
						<input type="text" name="name" size="32" value="<?php echo $this->data->name; ?>"/>
					</fieldset>
					<fieldset>
						<legend><?php echo JText::_('Checked'); ?></legend>
						<?php $date = $this->data->rosterchecked; ?>
						<?php echo JHTML::calendar($date,'rosterchecked','rosterchecked','%Y-%m-%d','size="28"'); ?>
					</fieldset>
				</td>
				<td>
					<?php foreach($this->types as $type) { ?>
						<fieldset>
							<legend><?php echo JText::_(CharacterManagerHelper::upper($type));?></legend>
							<?php echo $this->lists[$type]; ?>
						</fieldset>
					<?php } ?>
				</td>
			</tr>
		</table>
			<input type="hidden" name="option" value="com_charactermanager" />
			<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="controller" value="characters" />
	</form>