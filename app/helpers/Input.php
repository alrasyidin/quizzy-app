<?php

class Input {

	public static function get($name){
		$input = $_POST[$name];

		if(is_array($input)){

			foreach ($input as $value) {
				$arrayInputs[] = htmlentities(trim($value, ' '));
			}

			return $arrayInputs;

		} else {

			return htmlentities(trim($input, ' '));

		}
	}

}
