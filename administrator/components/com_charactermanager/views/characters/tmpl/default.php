<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	defined('_JEXEC') or die('Restricted access'); ?>
	
	<form id="adminForm" action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_('Filter'); ?>:
				<input type="text" name="search" id="search" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';
								this.form.getElementById('filter_game').value='';
								this.form.getElementById('filter_allegiance').value='';
								this.form.getElementById('filter_class').value='';
								this.form.getElementById('filter_guild').value='';
								this.form.getElementById('filter_state').value='';
								this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
					foreach($this->types as $type) {
						echo $this->lists[$type];
					}
					echo $this->lists['state'];
				?>
			</td>
		</tr>
	</table>
	<div id="editcell">
		<table class="adminlist">
			<thead>
				<tr>
					<th width="20px">
						<?php echo JText::_( 'NUM' ); ?>
					</th>
					<th width="25px">
						<?php echo JHTML::_( 'grid.sort', 'ID', 'id', $this->lists['order_Dir'], $this->lists['order']); ?>
					</th>
					<th width="20px">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
					</th>
					<th>
						<?php echo JHTML::_( 'grid.sort', 'Name', 'name', $this->lists['order_Dir'], $this->lists['order']); ?>
					</th>
					<th>
						<?php echo JHTML::_( 'grid.sort', 'User ID', 'user_id', $this->lists['order_Dir'], $this->lists['order']); ?>
					</th>
					<?php foreach($this->types as $type) { ?>
					<th>
						<?php echo JHTML::_('grid.sort',CharacterManagerHelper::upper($type),CharacterManagerHelper::lower($type),$this->lists['order_Dir'],$this->lists['order']); ?>
					</th>
					<?php } ?>
					<th width="50px">
						<?php echo JHTML::_( 'grid.sort', 'Published', 'published', $this->lists['order_Dir'], $this->lists['order']); ?>
					</th>
				</tr>            
			</thead>
			<?php
				$k = 0;
				$i = 0;
				foreach($this->items as &$row) {
			?>
					<tr class="<?php echo "row" . $k; ?>">
						<td>
							<?php echo $i+1+$this->pagination->limitstart;?>
						</td>
						<td>
							<?php echo $row->id; ?>
						</td>
						<td>
							<?php echo JHTML::_('grid.id',$i,$row->id,false,'id'); ?>
						</td>
						<td>
							<?php $link = JRoute::_("index.php?option=com_charactermanager&controller=characters&task=edit&id=" . $row->id); ?>
							<?php echo "<a href=\"" . $link . "\">" . $row->name . "</a>"; ?>
						</td>
						<td>
							<?php 
								// $user =& JFactory::getUser($row->user_id);
								// echo $user->username; 
								echo $row->user_id;
							?>
						</td>
						<?php foreach($this->types as $type) { ?>
						<td>
							<?php
								$current = $type."_name"; 
								echo $row->$current;
							?>
						</td>
						<?php } ?>
						<td align="center">
							<?php echo JHTML::_('grid.published',$row,$i); ?>
						</td>
					</tr>
			<?php
					$i++;
					$k = 1 - $k;
				}
			?>
			<tfoot>
				<tr>
					<td colspan="<?php echo count($this->types)+6; ?>"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>
	</div>

	<input type="hidden" name="option" value="com_charactermanager" />
	<input type="hidden" name="controller" value="characters" />
	<input type="hidden" name="view" value="characters" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>