<?php

class Controller {

    public function callModel($model) {
        $modelPath = MODELS . $model . '.php';
        if (file_exists($modelPath)) {
            require $modelPath;
            return new $model;
        } else {
            echo 'Error loading the model';
        }
    }

    public function callView($view, $template, $data = null) {
        $templatePath = VIEWS . $template . '.php';
        $viewPath = VIEWS . $view . '.php';

        // get the view content
        if(file_exists($viewPath) && file_exists($templatePath)) {
            $viewData = $this->bufferFile($viewPath, $data);
            $templateData = $this->bufferFile($templatePath, $viewData, 1);
            return $templateData;
        } else {
            echo 'Error loading the view';
        }

    }

    public function bufferFile($file, $data, $langInfo = null) {
            ob_start();
			// set the languages info
			$lang = $this->setLangInfo($langInfo);
			$content = $data;
            include $file;
            $fileData = ob_get_contents();
            ob_end_clean();
            return $fileData;
    }

	public function setLangInfo($langInfo){
		if($langInfo != null){
			if(isset($_COOKIE['lang'])) {
				switch ($_COOKIE['lang']) {
					case 'ar':
						include CONFIG . 'configar.php';
						break;
					case 'en':
						include CONFIG . 'configen.php';
						break;
					default:
						include CONFIG . 'configen.php';
						break;
				}
			} else {
				// default language is english
				include CONFIG . 'configen.php';
			}

			return $lang;
		}


	}

}
