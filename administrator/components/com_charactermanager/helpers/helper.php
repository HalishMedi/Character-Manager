<?php
	/*
	* @package		Character Manager
	* @subpackage	Components
	* @link			http://www.nicholasjohn16.com
	* @license		GNU/GPL
	*/
	
	class CharacterManagerHelper {
	
		function upper($text) {
			if(function_exists('ucfirst')) {
				$text = ucfirst($text);
			} else {
				$text[0] = strtoupper($text[0]);
			}
			return $text;
		}
		
		function lower($text) {
			if(function_exists('lcfirst')) {
				$text = lcfirst($text);
			} else {
				$text[0] = strtolower($text[0]);
			}
			return $text;
		}
	}