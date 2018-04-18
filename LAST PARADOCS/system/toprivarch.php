<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));
if (($user['group'] == "moder") || ($user['group'] == "admin")) {
	$docfrompriv = R::findOne($tableprefix.'_privatedocs', 'id = ?', array($_GET['id']));
	$docfrommain = R::findOne($tableprefix.'_docs', 'id = ?', array($docfrompriv['thefileid']));
	R::trash($docfrommain);
	$docfrompriv->arched = "1";
	$docfrompriv->archtime = time();
	R::store($docfrompriv);
	if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/system/arch/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/system/arch/'), 0755);};
	if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/system/arch/.htaccess'))) {
	$connectingw = 'Deny from all';
	$fpw = fopen($_SERVER['DOCUMENT_ROOT'].('/system/arch/.htaccess'), 'w');
	$testw = fwrite($fpw, $connectingw);
	fclose($fpw);
	};
	$_SESSION['modersend'] = 2;
	if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Документ перенесён в архив.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">The document has been moved to the archive.</div>';};
	
	$oldpath = ($_SERVER['DOCUMENT_ROOT'].('/system/userdocs/'.$docfrompriv['thefileid'].'.docx'));
	$newpath = ($_SERVER['DOCUMENT_ROOT'].('/system/arch/'.$docfrompriv['thefileid'].'.docx'));
	rename($oldpath, $newpath);
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/system/#modersend');
} else {header('Location: http://'.$_SERVER['HTTP_HOST']);};
?>