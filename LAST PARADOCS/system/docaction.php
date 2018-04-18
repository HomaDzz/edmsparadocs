<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));
if (($user['group'] == 'admin') || ($user['group'] == 'moder')) {
	$kek = R::findOne($tableprefix.'_docs', 'id =?', array($_GET['id']));
	if ($_GET['doing'] == "1") {
		$kek->status = "2";
		R::store($kek);
		$_SESSION['modersend'] = 1;
		if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<hr class="space"><div style="display:block;" id="modnoerrors">Документ утверждён.</div><hr class="space">';} else {$_SESSION['modnoerrors'] = '<hr class="space"><div style="display:block;" id="modnoerrors">The document was approved.</div><hr class="space">';};
		
		header("Location: ".$_SERVER['HTTP_REFERER'].'#moder');
	}
	if ($_GET['doing'] == "2") {
		$kek->status = "3";
		$kek->refres = $_GET['mess'];
		R::store($kek);
		if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<hr class="space"><div style="display:block;" id="modnoerrors">Заявка на утверждение документа отклонена.</div><hr class="space">';} else {$_SESSION['modnoerrors'] = '<hr class="space"><div style="display:block;" id="modnoerrors">Application for approval of the document was rejected.</div><hr class="space">';};
		$_SESSION['modersend'] = 1;
		header("Location: ".$_SERVER['HTTP_REFERER'].'#moder');
	}
} else {header('Location: http://'.$_SERVER['HTTP_HOST']);};
?>