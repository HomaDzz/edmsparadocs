<!DOCTYPE html>
<html style="height: 100%; background: linear-gradient(to bottom, #E0B992, #88CBE5)">
<head>
<meta charset="utf-8">
<script src="../libs/scripts/js/jquery-3.3.1.js"></script> <!-- Подключение Ajax -->
<link href="../libs/scripts/select2/select2.min.css" rel="stylesheet" />
<script src="../libs/scripts/select2/select2.min.js"></script>
<style>
	.box { 
		width: 470px;  height: 460px; border: 4px solid black; background: gainsboro; position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; border-radius: 10px;
	}
	.header {
		text-align: center; margin: 10px 0; font: bold 30px yanonereg; text-transform: uppercase; border-bottom: 1px solid black; border-top: 1px solid black; background: ghostwhite; user-select: none;
	}
	.name {
		text-align: center; margin: 10px 0; font: normal 20px yanonereg; text-transform: uppercase; border-bottom: 1px solid black; border-top: 1px solid black; background: #9D9DFF; user-select: none;
	}
	.space {
		display: block; height: 20px; border: 0; background: transparent; overflow: hidden; clear: both;
	}
	.search {
		width: 335px; margin: 3px auto; height: 28px; 
	}
	
	.searchout {
		background: rgba(255,0,110,0.50); border-bottom: 1px solid black; border-top: 1px solid black; height: 34px;
	}
	
	.find {
		height: 26px;
		outline: none;
		border: none;
		background-color: transparent;
		background-image: url(../images/look.png);
		background-size: 20px;
		background-position: center;
		background-repeat: no-repeat;
	}
	.find:hover {
		background-color: yellow;
	}
	
	.infostr {
		background: rgba(58,226,206,0.50); border-bottom: 1px solid black; border-top: 1px solid black; margin: 5px 0; padding: 5px 0; font: normal 20px yanonereg; text-align: center;
	}
	
	.boxinfo {
		width: 95%;
		margin: 0 auto;
		background: beige;
		border: 1px dashed black;
		min-height: 300px;
	}
	
</style>
<link rel="shortcut icon" href="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {echo '../images/userpics/userfavicon.png';} else {echo '../images/favicon.png';}; ?>" type="image/x-icon"> <!-- Фавикон сайта -->
<link rel="stylesheet" href="../css/fonts.css" type="text/css"> <!-- Подключение таблицы стилей шрифтов -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloadermin.php')); ?> <!-- Подключение прелоадера -->
<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) { header('Location: /'); } ?> <!-- Проверка настроена ли система -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?> <!-- Коннект к базе и прочая важная штука -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<?php if (!isset($_SESSION['logged_user'])) { header('Location: /'); } ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Телефонный справочник';} else {echo 'Phonebook';}; ?></title>
</head>
<body>
<div class="box">
<h1 class="header"><?php if ($_SESSION['lang'] == "1") {echo 'Телефонный справочник';} else {echo 'Phonebook';}; ?></h1>
<?php 
?>
<div class="searchout">
<div class="search"><p style="font: normal 22px yanonereg; width: 100px; padding: 0; margin: 0 5px 0 0; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'ПОЛЬЗОВАТЕЛЬ';} else {echo 'USER';}; ?></p>
<form method="get" action="" id="subsf">
<select required id="selectItemT" name="person" class="js-example-basic-single" style="height: 28px; margin-left: 5px; float: left; width: 200px;">
<?php
$admuserslists = R::findAll($tableprefix.'_users', 'WHERE login != ?', array($_SESSION['logged_user']));
	
foreach($admuserslists as $admuserslist) {
echo '<option id="'.str_replace(" ", "_", $admuserslist['fio']).'" name="'.str_replace(" ", "_", $admuserslist['fio']).'">'.$admuserslist['fio'].'</option>';
};
?>
</select> <input title="<?php if ($_SESSION['lang'] == "1") {echo 'Искать пользователя';} else {echo 'Look for user';}; ?>" class="find" type="submit" name="search" value="&#160&#160&#160">
</form>
</div>
</div>
<?php
	if (!isset($_GET['person'])) {$valu = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));} else {$valu = R::findOne($tableprefix.'_users', 'fio = ?', array($_GET['person']));}
?>
	<?php if (!empty($valu) && ($valu['showinco'] == "1")) : ?>
	<div class="name">
	<?php if (isset($_GET['person'])) {if ($_SESSION['lang'] == "1") {echo 'ПРОСМОТР: '.$_GET['person'];} else {echo 'LOOKING: '.$_GET['person'];};} else {if ($_SESSION['lang'] == "1") {echo 'ВЫ';} else {echo 'YOU';};}; ?>
	</div>
	<div class="boxinfo">
	<h2 style="text-align: center; font-family: yanonereg;">↓ <?php if ($_SESSION['lang'] == "1") {echo 'ДАННЫЕ';} else {echo 'DATA';}; ?> ↓</h2>
	<p class="infostr"><?php if ($_SESSION['lang'] == "1") {echo 'Электронная почта:';} else {echo 'Email:';}; ?> <?php echo $valu['email']; ?></p>
	<p class="infostr"><?php if ($_SESSION['lang'] == "1") {echo 'Номер телефона:';} else {echo 'Telephone number:';}; ?> <?php
		if ($_SESSION['lang'] == "1") {
			if ($valu['telnumber'] == "") {echo 'Не указан';} else if ($valu['telnumber'] == "none") {echo 'Отсутствует';} else {echo $valu['telnumber'];};
		} else {
			if ($valu['telnumber'] == "") {echo 'Not specified';} else if ($valu['telnumber'] == "none") {echo 'Absent';} else {echo $valu['telnumber'];};
		};?></p>
	<hr class="space">
	<?php
	if ($_SESSION['lang'] == "1") {
		echo '<div style="width: 170px; margin: 0 auto; overflow: hidden">';
			if ( isset($valu['vk']) && (($valu['vk'] != "") && ($valu['vk'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Страница во Вконтакте" href="https://vk.com/'.$valu['vk'].'"><image class="soclogosvk" src="../images/vklogo.png" width="50"></a>';} else {echo '<a target="_blank" style="margin-right: 10px;" title="Страница во Вконтакте"><image style="filter: grayscale(100%);" src="../images/vklogo.png" width="50"></a>';};
			if ( isset($valu['odnok']) && (($valu['odnok'] != "") && ($valu['odnok'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Страница в Одноклассниках" href="https://ok.ru/'.$valu['odnok'].'"><image class="soclogosok" src="../images/oklogo.png" width="50"></a>';} else {echo '<a target="_blank" style="margin-right: 10px;" title="Страница в Одноклассниках"><image style="filter: grayscale(100%);" src="../images/oklogo.png" width="50"></a>';};
			if ( isset($valu['telega']) && (($valu['telega'] != "") && ($valu['telega'] != "none"))) {echo '<a target="_blank" title="Страница в Телеграме" href="https://t.me/'.$valu['telega'].'"><image class="soclogostelega" src="../images/telegramlogo.png" width="50"></a>';} else {echo '<a target="_blank" title="Страница в Телеграме"><image style="filter: grayscale(100%);" src="../images/telegramlogo.png" width="50"></a>';};
			echo '</div>';
	} else {
		echo '<div style="width: 170px; margin: 0 auto; overflow: hidden">';
			if ( isset($valu['vk']) && (($valu['vk'] != "") && ($valu['vk'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Page at vk.com" href="https://vk.com/'.$valu['vk'].'"><image class="soclogosvk" src="../images/vklogo.png" width="50"></a>';} else {echo '<a target="_blank" style="margin-right: 10px;" title="Page at vk.com"><image style="filter: grayscale(100%);" src="../images/vklogo.png" width="50"></a>';};
			if ( isset($valu['odnok']) && (($valu['odnok'] != "") && ($valu['odnok'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Page at ok.ru" href="https://ok.ru/'.$valu['odnok'].'"><image class="soclogosok" src="../images/oklogo.png" width="50"></a>';} else {echo '<a target="_blank" style="margin-right: 10px;" title="Page at ok.ru"><image style="filter: grayscale(100%);" src="../images/oklogo.png" width="50"></a>';};
			if ( isset($valu['telega']) && (($valu['telega'] != "") && ($valu['telega'] != "none"))) {echo '<a target="_blank" title="Page at Telegram" href="https://t.me/'.$valu['telega'].'"><image class="soclogostelega" src="../images/telegramlogo.png" width="50"></a>';} else {echo '<a target="_blank" title="Page at Telegram"><image style="filter: grayscale(100%);" src="../images/telegramlogo.png" width="50"></a>';};
			echo '</div>';
	};
	?>	
	</div>
	<?php elseif ($valu['showinco'] == "0") : ?>
	<div class="name">
	<?php if (isset($_GET['person'])) {if ($_SESSION['lang'] == "1") {echo 'ПРОСМОТР: '.$_GET['person'];} else {echo 'LOOKING: '.$_GET['person'];};} else {if ($_SESSION['lang'] == "1") {echo 'ВЫ';} else {echo 'YOU';};}; ?>
	</div>
	<hr class="space">
	<div style="background: red; margin: 70px auto; font: bold 40px yanonereg; text-align: center;">
	<?php if ($_SESSION['lang'] == "1") {echo 'ПОЛЬЗОВАТЕЛЬ СКРЫЛ<br>СВОИ ДАННЫЕ.';} else {echo 'THE USER HIDDEN<br>HIS DATA';}; ?>
	</div>
	<?php else : ?>
	<div class="name">
	<?php if (isset($_GET['person'])) {if ($_SESSION['lang'] == "1") {echo 'ПРОСМОТР: '.$_GET['person'];} else {echo 'LOOKING: '.$_GET['person'];};} else {if ($_SESSION['lang'] == "1") {echo 'ВЫ';} else {echo 'YOU';};}; ?>
	</div>
	<div style="background: red; margin: 70px auto; font: bold 40px yanonereg; text-align: center;">
	<?php if ($_SESSION['lang'] == "1") {echo 'ТАКОГО ПОЛЬЗОВАТЕЛЯ<br>НЕ СУСЩЕСТВУЕТ.';} else {echo 'THE USER DOES<br>NOT EXIST';}; ?>
	</div>
	<?php endif; ?>
</div>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/select/select.php')); ?> <!-- Скрипт селектов -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/select2/select2.php')); ?> <!-- Скрипт селектов -->
<script>
$(document).ready(function() {
  $('#subsf').on('change', function() {
    var $form = $(this).closest('form');
    $form.find('input[type=submit]').click();
  });
});
</script>
</body>
</html>