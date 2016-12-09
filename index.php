<?php

/*
 * Quizzy: php quiz system
 * @author sameh abdel moneim
 * @authoeUrl http://www.github.com/seniorsam
 */

// error_reporting(0);

/*---------------------------
 * Configuration file
 ----------------------------*/

include 'app/config/configinfo.php';

/*---------------------------
 * Helpers files
 ----------------------------*/

include 'app/helpers/Autoloader.php';

/*---------------------------
 * Bootstrap file
 ----------------------------*/

// include 'app/helpers/Bootstrap.php';
new Bootstrap();
