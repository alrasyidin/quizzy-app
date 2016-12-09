<?php

class Redirect {

	public static function to($url){
		header("Location:".$url);
		return new self;
		exit;
	}
}
