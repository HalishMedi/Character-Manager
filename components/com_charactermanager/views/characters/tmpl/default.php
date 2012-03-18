<?php foreach($this->characters as $character):?>
	<div class="com-cm-row">
		<div class="com-cm-avatar" style="background-image:url('images/characters/<?php echo $character->user_id;?>/<?php echo $character->id; ?>.png');">
			<img id="star-<?php echo $character->id;?>" style="display:none;float:left;" src="components/com_charactermanager/media/images/star-gray.png"/>
			<a href="#" >Upload new Photo</a>
		</div>
		<b>
			<?php echo $character->name;?>
		</b>
		<br/>
			<?php 
				foreach($this->types as $type):
					$type_name = $type->name.'_name'; 
					echo $character->$type_name."<br/>";
				endforeach;
			?>
			<?php echo $character->published;?>
	</div>
<?php endforeach; ?>