<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
	if ($_SESSION['lang'] == "1") {$_SESSION['noerrpd'] = '<div style="display:block;" id="noerrpd">ДОКУМЕНТ ЗАПОЛНЕН И ОТПРАВЛЕН АДМИНИСТРАЦИИ.</div>';} else {$_SESSION['noerrpd'] = '<div style="display:block;" id="noerrpd">THE DOCUMENT WAS FILLED AND SENT TO THE ADMINISTRATION.</div>';};
	
header("Location: ".$_SERVER['HTTP_REFERER'].'#privatedocs'); ?>