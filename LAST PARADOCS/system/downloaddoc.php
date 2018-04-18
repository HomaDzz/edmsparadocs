<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$kek = R::findOne($tableprefix.'_docs', 'id =?', array($_GET['id']));
$keki = R::findOne($tableprefix.'_users', 'login =?', array($_SESSION['logged_user']));
if (($kek['owner'] == $_SESSION['logged_user']) || ($keki['group'] == "moder") || ($keki['group'] == "admin")) {
	if (isset($_GET['ta'])) {$file = $_SERVER['DOCUMENT_ROOT'].'/system/arch/'.$_GET['id'].'.docx';} else {$file = $_SERVER['DOCUMENT_ROOT'].'/system/userdocs/'.$_GET['id'].'.docx';};
 	header ("Content-Type: application/octet-stream");
 	header ("Accept-Ranges: bytes");
 	header ("Content-Length: ".filesize($file));  
 	header ("Content-Disposition: attachment; filename=".$_GET['type'].".docx");  
 	readfile($file);
}
?>