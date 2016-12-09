<?php

class Session {

	public static function start(){
		(!isset($_SESSION)) ? session_start() : NULL ;
		return new self;
	}

	public static function create($key,$value){
		$_SESSION[$key] = $value;
	}

	public static function get($key){
		$value = (isset($_SESSION[$key])) ? $_SESSION[$key] : NULL;
		return $value;
	}

	public static function end(){
		session_destroy();
	}
	
}
