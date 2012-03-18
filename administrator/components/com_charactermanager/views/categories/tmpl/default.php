<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
		<table>
			<tr>
				<td align="left" width="100%">
					<?php echo JText::_( 'Filter' ); ?>:
					<input type="text" name="search" id="search" value="<?php //echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
					<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
					<button onclick="document.getElementById('search').value='';this.form.getElementById('levellimit').value='10';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
				</td>
				<td nowrap="nowrap">
					<?php
					echo JText::_('Max Levels');
					echo $this->lists['levellist'];
					echo $this->lists['state'];
					?>
				</td>
			</tr>
		</table>
		<table class="adminlist">
			<thead>
				<tr>
					<th width="5">
						<?php echo JText::_( 'Num' ); ?>
					</th>
					<th width="20">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->data)+1; ?>);" />
					</th>
					<th>
						<?php echo JHTML::_('grid.sort', 'Name', 'name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th width="10%">
						<?php echo JHTML::_('grid.sort', 'Type', 'type', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th width="90px">
						<?php echo JHTML::_('grid.sort', 'Order', 'ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
						<?php if ($this->ordering) echo JHTML::_('grid.order',$this->data); ?>
					</th>
					<th width="20px" >
						<?php echo JHTML::_('grid.sort', 'Published', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
				</tr>            
			</thead>
			<tbody>
				<?php
					$k = 0;
					$i = 0;
					$n = count($this->data);
					$rows =& $this->data;
					
					foreach ($rows as $row) {
				?>
				<tr class="<?php echo "row" . $k; ?>">
					<td>
						<?php echo $i+1+$this->pagination->limitstart;?>
					</td>
					<td>
						<?php echo JHTML::_('grid.id',$i,$row->id,false,'id'); ?>
					</td>
					<td>
						<span class="editlinktip hasTip" title="<?php echo JText::_("Edit");?>::<?php echo $row->name; ?>">
							<a href="<?php echo JRoute::_("index.php?option=com_charactermanager&controller=categories&task=edit&id=".$row->id);?>">
								<?php echo $row->treename; ?>
							</a>
						</span>
					</td>
					<td>
						<?php echo $row->type; ?>
					</td>
					<td class="order" nowrap="nowrap" >
						<span>
							<?php echo $this->pagination->orderUpIcon( $i,$row->parent == 0 || $row->parent == @$rows[$i-1]->parent, 'orderup', 'Move Up', $this->ordering); ?>
						</span>
						<span>
							<?php echo $this->pagination->orderDownIcon( $i, $n, $row->parent == 0 || $row->parent == @$rows[$i+1]->parent, 'orderdown', 'Move Down', $this->ordering ); ?>
						</span>
						<?php $disabled = $this->ordering ?  '' : 'disabled="disabled"'; ?>
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?> class="text_area" style="text-align:center" />
					</td>
					<td align="center">
						<?php echo JHTML::_('grid.published',$row,$i); ?>
					</td>
				</tr>
				<?php
					$k = 1 - $k;
					$i++;
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
			
		</table>
	</div>
 
	<input type="hidden" name="option" value="com_charactermanager" />
	<input type="hidden" name="controller" value="categories" />
	<input type="hidden" name="view" value="categories" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />

</form>