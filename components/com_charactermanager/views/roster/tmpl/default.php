<form action="index.php" method="get">
	<div class="navbar">
		<div class="navbar-inner">
			<div style="width:848px;" class="container">
				<span class="brand">Roster</span>
				    <div class="navbar-search pull-left">
    					<input type="text" name="search" class="search-query" placeholder="Search">
    				</div>
				<ul class="nav pull-right">
					<li><a href="#"><i class="icon-plus icon-white"></i>Add Character</a></li>
					<li><a href="#"><i class="icon-cog icon-white"></i>Edit Character</a></li>
					<li><a href="#"><i class="icon-remove icon-white"></i>Delete Character(s)</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="subnav">
		<ul class="nav nav-pills">
			<li><a>#</a></li>
			<li><a><input type="checkbox" name="toggle" value="" id="checkAll" /></a></li>
			<li><a>ID</a></li>
			<li><a>Name</a></li>
			<li><a>Username</a></li>
			<li><a>Game</a></li>
			<li><a>Class</a></li>
			<li><a>Allegiance</a></li>
			<li><a>Guild</a></li>
			<li><a>Checked</a></li>
			<li><a>Published</a></li>
		</ul>
	</div>
	<div style="clear:both"></div>
	<div class="com-cm-row">
		<div style="width:1%;float:left;padding:0px 5px 0px 5px;font-weight:bold;text-align:center;">#</div>
		<div style="float:left;font-weight:bold;padding:0px 5px 0px 5px;">
			<input type="checkbox" name="toggle" value="" id="checkAll" />
		</div>
		<div style="width:1%;float:left;padding:0px 5px 0px 5px;font-weight:bold;text-align:center;">ID</div>
		<div style="float:left;font-weight:bold;padding:0px 5px 0px 5px;width:10%;text-align:center;">Name</div>
		<div style="float:left;font-weight:bold;padding:0px 5px 0px 5px;width:10%;text-align:center;">User</div>
		<?php foreach($this->types as $type):?>
			<div style="float:left;font-weight:bold;padding:0px 5px 0px 5px;width:10%;text-align:center;"><?php echo ucfirst($type->name);?></div>
		<?php endforeach;?>
		<div style="float:left;font-weight:bold;padding:0px 5px 0px 5px;width:6%;text-align:center;">Checked</div>
		<div style="float:left;font-weight:bold;padding:0px 5px 0px 5px;width:6%;text-align:center;">Published</div>
	</div>
	<div style="clear:both;"></div>
	<?php $i=0; ?>
	<?php foreach($this->characters as $character):?>
		<div class="com-cm-row" style="height:16px;overflow:hidden;padding:2px 0 2px 0;">
			<div style="float:left;padding:0px 5px 0px 5px;width:1%;text-align:right;">
				<?php echo $i+1+$this->pagination->limitstart;?>
			</div>
			<div style="float:left;padding:0px 5px 0px 5px;">
				<input id="cb<?php echo $i ?>" type="checkbox" value="<?php echo $character->id; ?>" name="id[]"/>
			</div>
			<div style="float:left;width:1%;padding:0px 5px 0px 5px;">
				<?php echo $character->id; ?>
			</div>
			<div style="float:left;padding:0px 5px 0px 5px;width:10%;overflow:hidden;" title="<?php echo $character->name;?>">
				<a href="index.php?option=com_charactermanager&view=character&task=edit&id=<?php echo $character->id;?>">
					<?php echo $character->name;?>
				</a>
			</div>
			<div style="float:left;padding:0px 5px 0px 5px;width:10%;overflow:hidden;">
				<?php echo $character->username;?>
			</div>
			<?php foreach($this->types as $type):?>
				<?php $type_name = $type->name.'_name'; ?>
				<div class="com-cm-<?php echo $type->name;?>" style="float:left;padding:0px 5px 0px 5px;width:10%;" title="<?php echo $character->$type_name;?>">
					<?php
						echo $character->$type_name;
					?>
				</div>
			<?php endforeach; ?>
			<div style="float:left;padding:0px 5px 0px 5px;width:6%;">
				<?php echo $character->rosterchecked;?>
			</div>
		<div style="float:left;padding:0px 5px 0px 5px;width:6%">
			<?php
				if($character->published == 1) {
					echo '<img class="com-mm-left com-mm-icon" style="width:16px;margin-left:50%;" src="components/com_charactermanager/media/images/accept.png" alt="Published" title="Published">';
				} else {
					echo '<img class="com-mm-left com-mm-icon" style="width:16px;margin-left:50%;" src="components/com_charactermanager/media/images/cancel.png" alt="Unpublished" title="Unpublished">';
				}
			?>
		</div>
	</div>
	<div style="clear:both"></div>
	<?php $i++; ?>
	<?php endforeach; ?>
	<input type="hidden" name="option" value="com_charactermanager"/>
	<input type="hidden" name="view" value="roster"/>
	<input type="hidden" name="task" value=""/>
	<div class="mmFooter" style="margin-left:25%;position:relative;">
		<?php echo $this->pagination->getPagesCounter();?>
		<?php echo $this->pagination->getPagesLinks();?>
		<?php echo $this->pagination->getLimitBox();?>
	</div>
	<input type="hidden" name="limitstart" value="<?php echo $this->pagination->limitstart;?>"/>
</form>