<?php
$reseivers = $_POST['theusersprivate'];
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));
if (($user['group'] == 'admin') || ($user['group'] == 'moder')) {
	$theftime = $_POST['privatedate'];
	foreach($reseivers as $reseiver) {
	$kok = R::xdispense($tableprefix.'_privatedocs');
			$kok->thereseiver=$reseiver;
			$kok->thenow=time();
			$kok->thedate=((strtotime($theftime)));
			$kok->thedoc=$_POST['theprivatedoc'];
			$kok->thesender=$user['fio'];
			if (!empty($_POST['privatemessage'])) $kok->themessage=$_POST['privatemessage'];
			$kok->arched="0";
			$kok->thestatus="0";
			R::store($kok);
		$adressed = R::findOne($tableprefix.'_users', 'fio = ?', array($reseiver));
		$to2 = $adressed['email'];
				if ($_SESSION['lang'] == "1") {$subject2 = 'Необходимо заполнить документы в АИС "'.$sitename.'"';
				$message2 = 'Здравствуйте!<br> Пользователь '.$user['fio'].' отправил Вам документ "<strong>'.$_POST['theprivatedoc'].'</strong>" на заполнение сроком до <strong>'.$theftime.'</strong>.';
				if (!empty($_POST['privatemessage'])) {$message2 .= '<br><br><strong>Приложенное сообщение:</strong><br>'.$_POST['privatemessage'];};
				$message2 .= '<br><br><a href="http://'.$_SERVER['HTTP_HOST'].'/system/#privatedocs">Перейти к заполнению</a>';
				$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
				$headers2 .= "From: Система \"".$sitename."\" <".$sitemail.">\r\n";}
		else {$subject2 = 'You must fill out the documents at AIS "'.$sitename.'"';
				$message2 = 'Hello!<br> User '.$user['fio'].' sent you a document "<strong>'.$_POST['theprivatedoc'].'</strong>" to fill until <strong>'.$theftime.'</strong>.';
				if (!empty($_POST['privatemessage'])) {$message2 .= '<br><br><strong>Attached message:</strong><br>'.$_POST['privatemessage'];};
				$message2 .= '<br><br><a href="http://'.$_SERVER['HTTP_HOST'].'/system/#privatedocs">Go to the filling</a>';
				$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
				$headers2 .= "From: System \"".$sitename."\" <".$sitemail.">\r\n";};
				
				$result2 = mail($to2, $subject2, $message2, $headers2);
		$_SESSION['modersend'] = 2;
		if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Документы на исполнение отправлены.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Documents for execution have been sent.</div>';};
		
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/system/#modersend');
};	
} else {header('Location: http://'.$_SERVER['HTTP_HOST']);};
?>