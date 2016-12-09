<!Doctype html>
<html>
    <head>
		<meta charset="UTF-8">
        <title><?= $lang['title'] ?></title>
        <link rel="stylesheet" href="<?= CSS ?>style.css" />
		<?php if( isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'ar'): ?>
			<link rel="stylesheet" href="<?= CSS ?>style-ar.css" />
		<?php endif; ?>
    </head>
    <body>
        <div class="container">

          <div class="header-banner push-down">
            <h1><?= $lang['mainTitle'] ?></h1>
            <p><?= $lang['titleBrief'] ?></p>
          </div>
          <div class="header-nav">
            <ul>
				<li><a href="<?= BASEPATH ?>quiz/index">All quizes</a></li>
				<!-- <li><a href="?= BASEPATH ? language/setLang/ar">عربي</a></li> -->
				<li><a href="<?= BASEPATH ?>language/setLang/en">English</a></li>
				<li><a href="<?= BASEPATH ?>dashboard/index">Manage</a></li>
				<div class="clearfix"></div>
            </ul>
          </div>
