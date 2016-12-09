<?php

class LanguageController {

	public function index(){
		echo 'language index';
	}

	public function setLang($lang){
		setcookie('lang', $lang, time() + (3600 * 24 * 30), '/');
		header("Location:" . BASEPATH . "quiz/index");
		exit();
	}

}
