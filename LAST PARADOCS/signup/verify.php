<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {echo '../images/userpics/userfavicon.png';} else {echo '../images/favicon.png';}; ?>" type="image/x-icon"> <!-- Фавикон сайта -->
<script src="../libs/scripts/js/jquery-3.3.1.js"></script> <!-- Подключение Ajax -->
<script src="../libs/scripts/js/granim.js"></script> <!-- Подключение Granim -->
<link rel="stylesheet" href="../css/system.css" type="text/css"> <!-- Подключение таблицы стилей -->
<link rel="stylesheet" href="../css/form.css" type="text/css"> <!-- Подключение таблицы стилей -->
<link rel="stylesheet" href="../css/fonts.css" type="text/css"> <!-- Подключение таблицы стилей шрифтов -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloader.php')); ?>
<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) { header('Location: /'); } ?>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?>
<?php if (isset($_SESSION['logged_user'])) { header('Location: /system/#ads'); } ?>
<?php if (empty($_SESSION['second_step'])) { header('Location: index.php'); } ?>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Подтверждение';} else {echo 'Confirm';}; ?></title>
</head>
<body>
<?php if (empty($_SESSION['posted']) and isset($_SESSION['second_step']))   {
$_SESSION['activatingcode'] = rand();
$to = $_SESSION['email'];
	if ($_SESSION['lang'] == "1") {$subject = "Код подтверждения для регистрации в системе \"".$sitename."\"";
$message = 'Здравствуйте, '.$_SESSION['fio'].'!<br>Ваш код подтверждения для регистрации: '.$_SESSION['activatingcode'];
$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: АИС ". $sitename ." <".$sitemail.">\r\n";} else {$subject = "Confirmation code for register at AIS \"".$sitename."\"";
$message = 'Hello, '.$_SESSION['fio'].'!<br>Your confirmation code for register: '.$_SESSION['activatingcode'];
$headers = "Content-type: text/html; charset=UTF-8 \r\n";
$headers .= "From: AIS ". $sitename ." <".$sitemail.">\r\n";};
$result = mail($to, $subject, $message, $headers);
$_SESSION['posted'] ='1';} ?>


<?php
$kod = R::findOne($tableprefix.'_invites', "kod = ?", array($_SESSION['kod']));
$account_data = $_POST;
if ( isset($account_data['do_resend']) ) {
$_SESSION['activatingcode'] = rand();
$to = $_SESSION['email'];
if ($_SESSION['lang'] == "1") {$subject = "Повторный код подтверждения для регистрации в системе \"".$sitename."\"";
$message = 'Здравствуйте, '.$_SESSION['fio'].'!<br>Ваш повторный код подтверждения для регистрации: '.$_SESSION['activatingcode'];
$headers = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers .= "From: АИС ". $sitename ." <".$sitemail.">\r\n";
$result = mail($to, $subject, $message, $headers);
$_SESSION['resend'] = '<div id="formpopup"><p>Повторный код отправлен.<br>Предыдущий код теперь недействителен.<br>Обязательно проверьте не попало ли наше письмо в <span class="bold">спам</span>.</p></div>';} else {$subject = "Repeated confirmation code for register in AIS \"".$sitename."\"";
$message = 'Hello, '.$_SESSION['fio'].'!<br>Your repeated confirmation code for register in AIS: '.$_SESSION['activatingcode'];
$headers = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers .= "From: AIS ". $sitename ." <".$sitemail.">\r\n";
$result = mail($to, $subject, $message, $headers);
$_SESSION['resend'] = '<div id="formpopup"><p>Repeated code sent.<br>The previous code is now invalid.<br>Be sure to check if our letter has got into the <span class="bold">spam</span>.</p></div>';};

}
if ( isset($account_data['do_change']) ) {
unset($_SESSION['second_step']);
unset($_SESSION['posted']);
header('Location: index.php');
}
if( isset($account_data['do_verify']) )
{
	$errors = array();
	if ($account_data['acceptkod'] != $_SESSION['activatingcode']) {
		if ($_SESSION['lang'] == "1") {$errors[] = 'Неверный код';} else {$errors[] = 'Invalid code';};
		
	}
	if (empty($errors)) 
	{
		$user = R::xdispense($tableprefix.'_users');
		$user->fio=$_SESSION['fio'];
		$user->login=$_SESSION['login'];
		$user->email=$_SESSION['email'];
		$user->showinco="0";
		$user->secretword=password_hash($_SESSION['word'], PASSWORD_DEFAULT);
		if ($registerbycode == "1") {
		if ($kod['type'] == "special") {$user->activatedcode="!!! (".$kod['kod'].")";} else {$user->activatedcode=$kod['kod'];};};
		$user->group="default";
		$user->password= password_hash($_SESSION['password'], PASSWORD_DEFAULT);
		$user->join_date=time();
		R::store($user);
		if ($registerbycode == "1") {
		if ($kod['type'] != "special") {
		$kod->status = 1;
		}; R::store($kod);}
		$to2 = $_SESSION['email'];
		if ($_SESSION['lang'] == "1") {$subject2 = 'Регистрация в АИС "'. $sitename.'"';
		$message2 = 'Ура, Вы только что зарегистрировались в АИС "'. $sitename .'" !<br>Ваши данные для входа в систему:<br><br>Логин: '.$_SESSION['login'].'<br>Пароль: '.$_SESSION['password'].'<br><br>Во избежание несанкционированного доступа к вашим личным данным никому не показывайте это письмо.<br>Спасибо что вы с нами! :)';
		$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
		$headers2 .= "From: АИС ". $sitename ." <".$sitemail.">\r\n";
		$result2 = mail($to2, $subject2, $message2, $headers2);
		$_SESSION['success'] = '<div id="formpopup"><p><span class="bold">Вы зарегистрировались!</span><br>Письмо с данными для входа отправлено на указанную почту.</p></div>';} else {$subject2 = 'Check in at AIS "'. $sitename.'"';
		$message2 = 'Hooray, you just registered at AIS "'. $sitename .'" !<br>Your login information:<br><br>Login: '.$_SESSION['login'].'<br>Password: '.$_SESSION['password'].'<br><br>To prevent unauthorized access to your personal data, do not show this letter to anyone.<br>Thank you for being with us! :)';
		$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
		$headers2 .= "From: АИС ". $sitename ." <".$sitemail.">\r\n";
		$result2 = mail($to2, $subject2, $message2, $headers2);
		$_SESSION['success'] = '<div id="formpopup"><p><span class="bold">You just registered!</span><br>A login data has been sent to the specified mail.</p></div>';};
		
		header('Location: /system/#ads');
	} else 
	{
		echo'<div id="errors">'.array_shift($errors). '</div>';
	}
};
?>
<form id="feedback-form" action="verify.php" method="POST">
	<? if (isset($_SESSION['resend'])) {
	echo $_SESSION['resend'];}; 
	unset($_SESSION['resend']);?>
	<h5 id="formlogo"><?php if ($_SESSION['lang'] == "1") {echo 'Подтверждение';} else {echo 'Confirm';}; ?></h5>
	<hr class="space"/>
	<?php if ($_SESSION['lang'] == "1") {echo 'На электронную почту <span class="bold">' .$_SESSION['email'] .'</span> отправлен код. Введите этот код в окне ниже:';} else {echo 'A code was sent to the mail <span class="bold">'.$_SESSION['email'].'</span>. Please, enter it bellow:';};  ?>
	<hr class="space"/>
	<input id="codeinput" class="inputs" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Код подтверждения с почты';} else {echo 'Confirmation code from mail';}; ?>" type="text" name="acceptkod"  value="<?php echo @$account_data['acceptkod'];?>">
	<button id="resend" title="<?php if ($_SESSION['lang'] == "1") {echo 'Отправить код повторно';} else {echo 'Resend code';}; ?>" type="submit" name = "do_resend"></button><button id="change" title="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить данные';} else {echo 'Change register data';}; ?>" type="submit" name = "do_change"></button>
	<hr class="space"/>
	<button id="submitFF" type="submit" name = "do_verify"><?php if ($_SESSION['lang'] == "1") {echo 'Зарегестрироваться';} else {echo 'Check in';}; ?></button>
</form>
</body>
</html>