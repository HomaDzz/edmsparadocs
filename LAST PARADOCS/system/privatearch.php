<html><head>
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {echo '../images/userpics/userfavicon.png';} else {echo '../images/favicon.png';}; ?>" type="image/x-icon"> <!-- Фавикон сайта -->
<script src="../libs/scripts/js/jquery-3.3.1.js"></script> <!-- Подключение Ajax -->
<script src="../libs/scripts/js/granim.js"></script> <!-- Подключение Granim -->
<link rel="stylesheet" href="../css/index.css" type="text/css"> <!-- Подключение таблицы стилей главной страницы-->
<link rel="stylesheet" href="../css/fonts.css" type="text/css"> <!-- Подключение таблицы стилей шрифтов -->
<link rel="stylesheet" href="../css/install_form.css" type="text/css"> <!-- Подключение таблицы стилей для формы установки -->
<link rel="stylesheet" href="../css/tables.css" type="text/css"> <!-- Подключение таблицы стилей вкладок-->
<style>
.grayline {
	padding: 5px;
	background-color: rgba(197,146,111,0.30);
	outline: 1px solid rgba(0,0,0,0.20);
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;
}
	
	.downlink {
	color: green;
	text-decoration: none;
	margin-bottom: 3px;
}

.downlink:hover {
	color: red;
}

.downlink:active {
	color: orangered;
}
</style>
<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) { header('Location: /'); } ?> <!-- Проверка настроена ли система -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloader.php')); ?> <!-- Прелоадер -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/granim/granim2.php'));?> <!-- Граним -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?> <!-- Важная штука -->
<?php $user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));?>
<?php  if (($user['group'] != "moder") && ($user['group'] != "admin")) {header('Location: /');};  ?>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Архив';} else {echo 'Archive';}; ?></title>
</head>
<body>
	<?php $thelistofnews = R::findall($tableprefix.'_privatedocs', 'WHERE arched = 1'); ?>
		<div class="bignewsblock">
		<p style="text-align: center; margin: 10px 0; font: bold 60px yanonereg; text-transform: uppercase; border: none; background: khaki;"><?php if ($_SESSION['lang'] == "1") {echo 'Архив приватных документов';} else {echo 'Archive of private documents';}; ?></p>
			<?php if ($_SESSION['modersend'] == 5)  {echo $_SESSION['modnoerrors']; unset($_SESSION['modnoerrors']); unset($_SESSION['modersend']);}; ?>
			<div style="text-align: center; margin: 10px 0; padding: 8px; font: 200 normal 24px yanonereg; text-transform: uppercase; border: none; background: ghostwhite;">
				<?php if (!empty($thelistofnews)) : ?>
				<table class="tftable" border="1">
				<?php if ($_SESSION['lang'] == "1") {echo '<tr><th>№</th><th>Документ</th><th>Автор</th><th>Дата архивирования</th><th>Доступ</th><th></th></tr>';} else {echo '<tr><th>№</th><th>Document</th><th>Author</th><th>Date of archiving</th><th>Recourse</th><th></th></tr>';}; ?>
				
				<?php foreach ($thelistofnews as $thenews) {
				++$zzxx;
				$doclink = '/system/downloaddoc.php?id='.$thenews['thefileid'].'&ta=5&type='.$thenews['thedoc'];
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
				echo $thenews['id'];
				echo '</td>';
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
				echo $thenews['thedoc'];
				echo '</td>';
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
				echo $thenews['thereseiver'];
				echo '</td>';
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
				echo date("d-m-y H:i:s", $thenews['archtime']);
				echo '</td>';
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
				if ($_SESSION['lang'] == "1") {echo '<a class="downlink" href="'.$doclink.'">Скачать</a>';} else {echo '<a class="downlink" href="'.$doclink.'">Download</a>';};
				
				echo '</td>';
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
				if ($_SESSION['lang'] == "1") {echo '<a onclick="return  confirm(\'Вы уверены что хотите удалить документ?\')" class="downlink" title="Удалить" href="deletedoc.php?id='.$thenews['id'].'&tyof=5">X</a>';} else {echo '<a class="downlink" title="Delete" onclick="return  confirm(\'Are you sure you want to delete the document?\')" href="deletedoc.php?id='.$thenews['id'].'&tyof=5">X</a>';};
				
				echo '</td>';
				echo '</tr>';
				};
				?> 
				</table>
				<?php else : ?>
				<?php if ($_SESSION['lang'] == "1") {echo '<p class="grayline" style="color: black;">Документов нет.</p>';} else {echo '<p class="grayline" style="color: black;">There are no documents.</p>';}; ?>
				
				<?php endif; ?>
				<hr class="space">
				<?php if ($_SESSION['lang'] == "1") {echo '<a class="backlink" href="/system/#modersend">Вернуться назад</a>';} else {echo '<a class="backlink" href="/system/#modersend">Go back</a>';}; ?>
				
				<hr class="space">
			</div>
		</div>
</body>
</html>
