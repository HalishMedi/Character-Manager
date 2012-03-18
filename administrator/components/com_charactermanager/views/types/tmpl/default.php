<?php defined('_JEXEC') or die('Restricted acces'); ?> 

<form action="index.php" method="post" name="adminForm">
	<div id="editcell">
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
						<?php echo JText::_('Name'); ?>
					</th>
					<th width="90px">
						<?php echo JText::_('Order'); ?>
						<?php echo JHTML::_('grid.order',$this->data); ?>
					</th>
					<th width="20px">
						<?php echo JText::_('Published'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$k = 0;
					$i = 0;
					$n = count($this->data);
					$rows =& $this->data;
					
					foreach($rows as $row) {
				?>
				<tr class="<?php echo "row".$k; ?>">
					<td>
						<?php echo $i+1+$this->pagination->limitstart; ?>
					</td>
					<td>
						<?php echo JHTML::_('grid.id',$i,$row->id,false,'id'); ?>
					</td>
					<td>
						<span class="editlinktip hasTip" title="<?php echo JText::_('Edit');?>::<?php echo CharacterManagerHelper::upper($row->name); ?>">
							<a href="index.php?option=com_charactermanager&controller=types&task=edit&id=<?php echo $row->id; ?>">
								<?php echo $row->name; ?>
							</a>
						</span>
					</td>
					<td class="order" nowrap="nowrap">
						<span>
							<?php echo $this->pagination->orderUpIcon($i,$i > 0,'orderup','Move Up',TRUE); ?>
						</span>
						<span>
							<?php echo $this->pagination->orderDownIcon($i,$n,$i < $n,'orderdown','Move Down',TRUE); ?>
						</span>
						<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align:center" />
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
      				<td colspan="5"><?php echo $this->pagination->getListFooter(); ?></td>
    			</tr>
  			</tfoot>
		</table>
	</div>
	
	<input type="hidden" name="option" value="com_charactermanager" />
	<input type="hidden" name="controller" value="types" />
	<input type="hidden" name="view" value="types" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	
</form>