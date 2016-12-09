<?php

spl_autoload_register(function($class){

	$directories = [
		HELPERS,
		CONTROLLERS,
		MODELS
	];

	foreach ($directories as $directory) {

		if (file_exists($directory . $class . '.php')){
			include $directory . $class . '.php';
		}

	}

});
