<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access'); ?>
	
	<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="admintable" width="100%">
		<tr valign="top">
			<td width="60%">
				<fieldset>
					<legend>
						<?php echo JText::_('Category Details'); ?>
					</legend>
					<table width="100%">
						<?php if($this->data->id) { ?>
							<tr>
								<td class="key" align="right">
										<?php echo JText::_('ID'); ?>:
								</td>
								<td>
									<strong><?php echo $this->data->id; ?></strong>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td class="key" align="right">
								<label for="name">
									<?php echo JText::_('Name'); ?>:
								</label>
							</td>
							<td>
								<input type="text" name="name" id="name" size="32" maxlength="255" value="<?php echo $this->data->name;?>" />
							</td>
						</tr>
						<tr>
							<td class="key" align="right">
								<label for="type">
									<?php echo JText::_('Type'); ?>:
								</label>
							</td>
							<td>
								<input type="text" name="type" id="type" size="32" maxlength="255" value="<?php echo $this->data->type;?>" />
							</td>
						</tr>
						<tr>
							<td class="key" align="right" valign="top">
								<label for="type">
									<?php echo JText::_('Parent'); ?>:
								</label>
							</td>
							<td>
								<?php echo $this->parentlist($this->data); ?>
							</td>
						</tr>
						<tr>
							<td class="key" align="right" valign="top">
								<label for="type">
									<?php echo JText::_('Ordering'); ?>:
								</label>
							</td>
							<td>
								<?php echo $this->ordering($this->data,$this->data->id); ?>
							</td>
						</tr>
						<tr>
							<td class="key" align="right">
								<label for="type">
									<?php echo JText::_('Published'); ?>:
								</label>
							</td>
							<td>
								<input type="radio" name="published" id="published" value="0"/> No
								<input type="radio" name="published" id="published" <?php if($this->data->published==1) {echo "checked=\"checked\"";} ?> value="1"/> Yes
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
			<td width="40%">
				<?php
					echo $this->pane->startPane('cat-pane');
					echo $this->pane->startPanel(JText::_('Basic Parameters'),'basic-pane');
					echo "<div style=\"padding:5px;height:200px\">Nothing here yet.</div>";
					echo $this->pane->endPanel();
					echo $this->pane->startPanel(JText::_('Advanced Parameters'),'advanced-pane');
					echo "<div style=\"padding:5px;height:200px\">Nothing here yet.</div>";
					echo $this->pane->endPanel();
					echo $this->pane->endPane();
				?>
			</td>
		</tr>
	</table>
	<input type="hidden" name="option" value="com_charactermanager" />
	<input type="hidden" name="controller" value="categories" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
</form>