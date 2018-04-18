<html><head>
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {echo '../images/userpics/userfavicon.png';} else {echo '../images/favicon.png';}; ?>" type="image/x-icon"> <!-- Фавикон сайта -->
<script src="../libs/scripts/js/jquery-3.3.1.js"></script> <!-- Подключение Ajax -->
<script src="../libs/scripts/js/granim.js"></script> <!-- Подключение Granim -->
<link rel="stylesheet" href="../css/index.css" type="text/css"> <!-- Подключение таблицы стилей главной страницы-->
<link rel="stylesheet" href="../css/fonts.css" type="text/css"> <!-- Подключение таблицы стилей шрифтов -->
<link rel="stylesheet" href="../css/install_form.css" type="text/css"> <!-- Подключение таблицы стилей для формы установки -->
<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) { header('Location: /'); } ?> <!-- Проверка настроена ли система -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloader.php')); ?> <!-- Прелоадер -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/granim/granim2.php'));?> <!-- Граним -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?> <!-- Важная штука -->
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Статья';} else {echo 'Article';}; ?></title>
</head>
<body>
	<?php $thelistofnews = R::findOne($tableprefix.'_news', "id = ?", array($_GET['id'])); ?>
		<div class="bignewsblock">
		<p style="text-align: center; margin: 10px 0; font: bold 60px yanonereg; text-transform: uppercase; border: none; background: ghostwhite;"><?php echo $thelistofnews['nameofnews']; ?></p>
		<div class="newsimgblock" style="width: 700px; height: 300px;  border-radius: 2px 0 0 2px; <?php if ($thelistofnews['picofnews'] == "defaultpic") {echo "background-image: url(../images/defaultpic";} else {echo 'background-image: url(../images/newspics/'.$thelistofnews['picofnews'];}; ?>.png);"></div>
			
			<div style="text-align: center; margin: 10px 0; padding: 8px; font: 200 normal 24px yanonereg; text-transform: uppercase; border: none; background: ghostwhite;">
				<div style="text-align: center; background: rgba(255,90,197,0.42)"><span><?php if ($_SESSION['lang'] == "1") {echo 'Опубликовано:';} else {echo 'Published:';}; ?> <?php echo $thelistofnews['dateofnews'];?></span></div>
			<p><?php echo $thelistofnews['insideofnews']; ?></p>
				<div style="text-align: center; background: rgba(255,90,197,0.42)"><span><?php if ($_SESSION['lang'] == "1") {echo 'Автор:';} else {echo 'Author:';}; ?> <?php echo $thelistofnews['author'];?></span></div>
				<hr class="space">
				<a class="backlink" href="/system/#ads"><?php if ($_SESSION['lang'] == "1") {echo 'Вернуться назад';} else {echo 'Go back';}; ?></a>
				<hr class="space">
			</div>
		</div>
</body>
</html>
