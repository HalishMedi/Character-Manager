<?php

	// No direct access
	defined('_JEXEC') or die('Restricted access');
	//Include Joomla View class
	jimport( 'joomla.application.component.view');
	
	class GuildViewCharacters extends JView {
		
		function selectListFor($type,$position) {
//			$types =& $this->get('Types');
//			$categories =& $this->get('Categories');
//			foreach($types as $type){
//				${$type->name} = '<fieldset><legend>'.ucfirst($type->name).'</legend>';
//				${$type->name} .= '<select id="'.$type->name.'" name="'.$type->name.'">';
//				${$type->name} .= '<option value="">Select a '.ucfirst($type->name).'</option>';
//			}
//			foreach($types as $type){
//				foreach($categories as $category){
//					if($category->type_id == $type->id){
//						${$type->name} .= '<option value="' . $category->id . '" class="parent-'.$category->parent.'">' . $category->name . '</option>';
//					}
//				}
//			}
//			foreach($types as $type){
//				${$type->name} .= '</select></fieldset>';	
//			}
//			
//			$lists = "";
//			foreach($types as $type){
//				$lists .= ${$type->name};
//			}
//
//			return $lists;
		}
		
		function dropDownsforTypes(){
			$types = $this->get('Types');
			$categories = $this->get('Categories');
			
			dump($types,'Types');
			dump($categories,'Categories');
			
			$dropDown = "<ul>";
			foreach($types as $type){
				$dropDown .= "<li>Select ".ucfirst($type->name);
				$dropDown .= "<ol>";
				foreach($categories as $category) {
					if($category->type == $type->name) {
						$dropDown .= "<li>".$category->name."</li>";
					}
				}
				$dropDown .= "</ol></li>";
			}
			$dropDown .= "</ul>";
			dump($dropDown,'dropDown');
			return $dropDown;
		}
	}