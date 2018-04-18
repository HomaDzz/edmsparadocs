<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));
if ($user['group'] == 'admin') {
	$changeuser = R::findOne($tableprefix.'_users', 'login = ?', array($_GET['name']));
	if ($_GET['doing'] == "1") {
		$changeuser->group = "moder";
		R::store($changeuser);
		if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div style="display:block;" id="noerrcd">Пользователю выданы права модератора.</div>';} else {$_SESSION['admnoerrors'] = '<div style="display:block;" id="noerrcd">The user has been granted the rights of the moderator.</div>';};
		
		header("Location: ".$_SERVER['HTTP_REFERER'].'#adm');
	}
	if ($_GET['doing'] == "2") {
		$changeuser->group = "default";
		R::store($changeuser);
		if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div style="display:block;" id="noerrcd">С пользователя сняты права модератора.</div>';} else {$_SESSION['admnoerrors'] = '<div style="display:block;" id="noerrcd">Users rights of the moderator have been removed.</div>';};
		header("Location: ".$_SERVER['HTTP_REFERER'].'#adm');
	}
} else {header('Location: http://'.$_SERVER['HTTP_HOST']);};
?>