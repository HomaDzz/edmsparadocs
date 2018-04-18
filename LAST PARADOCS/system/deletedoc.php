<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$user = R::findOne($tableprefix.'_users', 'login =?', array($_SESSION['logged_user']));
if ($_GET['tyof'] == "1") {
$kek = R::findOne($tableprefix.'_docs', 'id =?', array($_GET['id']));
if ($kek['owner'] == $_SESSION['logged_user']) {
	R::trash($kek);
	unlink(($_SERVER['DOCUMENT_ROOT']).('/system/userdocs/'.$_GET['id'].'.docx'));
	if ($_SESSION['lang'] == "1") {$_SESSION['noerrcd'] = '<div style="display:block;" id="noerrcd">ВАШ ДОКУМЕНТ УДАЛЁН.</div>';} else {$_SESSION['noerrcd'] = '<div style="display:block;" id="noerrcd">YOUR DOCUMENT WAS REMOVED.</div>';};
	
	header("Location: ".$_SERVER['HTTP_REFERER'].'#docs');
};}

if ($_GET['tyof'] == "2") {
$kek = R::findOne($tableprefix.'_privatedocs', 'id =?', array($_GET['id']));
if (($user['group'] == "moder") || ($user['group'] == "admin"))  {
	R::trash($kek);
	$_SESSION['modersend'] = 2;
	if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Указ на исполнение отменён.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Decree for execution canceled.</div>';};
	
	header("Location: ".$_SERVER['HTTP_REFERER'].'#modersend');
};};

if ($_GET['tyof'] == "3") {
$kek = R::findOne($tableprefix.'_news', 'id =?', array($_GET['id']));
if (($user['group'] == "moder") || ($user['group'] == "admin"))  {
	unlink(($_SERVER['DOCUMENT_ROOT']).('/images/newspics/'.$kek['picofnews'].'.png'));
	R::trash($kek);
	$_SESSION['modersend'] = 3;
	if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Новость удалена.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">The article was deleted.</div>';};
	
	header("Location: ".$_SERVER['HTTP_REFERER'].'#moderaddnews');
};};

if ($_GET['tyof'] == "4") {
$kek = R::findOne($tableprefix.'_privatedocs', 'id =?', array($_GET['id']));
$kek2 = R::findOne($tableprefix.'_docs', 'id =?', array($kek['thefileid']));
if (($user['group'] == "moder") || ($user['group'] == "admin"))  {
	unlink(($_SERVER['DOCUMENT_ROOT']).('/system/userdocs/'.$kek['thefileid'].'.docx'));
	R::trash($kek);
	R::trash($kek2);
	$_SESSION['modersend'] = 2;
	if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Документ удалён.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">DOCUMENT WAS REMOVED.</div>';};
	
	header("Location: ".$_SERVER['HTTP_REFERER'].'#modersend');
};};

if ($_GET['tyof'] == "5") {
$kek = R::findOne($tableprefix.'_privatedocs', 'id =?', array($_GET['id']));
if (($user['group'] == "moder") || ($user['group'] == "admin"))  {
	unlink(($_SERVER['DOCUMENT_ROOT']).('/system/arch/'.$kek['thefileid'].'.docx'));
	R::trash($kek);
	$_SESSION['modersend'] = 5;
	if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Документ удалён из системы.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">DOCUMENT WAS REMOVED FROM SYSTEM.</div>';};
	header('Location: http://'.$_SERVER['HTTP_HOST'].'/system/privatearch.php');
};};

?>