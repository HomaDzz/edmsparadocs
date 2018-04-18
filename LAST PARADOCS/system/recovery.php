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
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloader.php')); ?> <!-- Прелоадер -->
<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) { header('Location: /'); } ?> <!-- Проверка настроена ли система -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?> <!-- Важная штука -->
<?php if (isset($_SESSION['logged_user'])) { header('Location: /system/#ads'); } ?>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Сброс пароля';} else {echo 'Password reset';}; ?></title>
</head>
<body>
<?php $account_data = $_POST;
$kod = R::findOne($tableprefix.'_users', "email = ?", array($account_data['email']));
if( isset($account_data['do_recovery']) )
{
	$errors = array();
	$user = R::findOne($tableprefix.'_users', 'email = ?', array($account_data['email']));
		if( $user)
		{
			if ($secretwordmethod == "1") {if(password_verify(mb_strtolower($account_data['secretword']), $user->secretword))
			{	
				$newpass = rand();
				$user->password= password_hash($newpass, PASSWORD_DEFAULT);
				$to2 = $user['email'];
				if ($_SESSION['lang'] == "1") {
					$subject2 = 'Восстановление пароля в АИС "'.$sitename.'"';
				$message2 = 'Завершена процедура восстановления доступа к вашему аккаунту.<br>Ваши новые данные для входа в систему:<br><br>Логин: '.$user['login'].'<br>Пароль: '.$newpass.'<br><br>Во избежание несанкционированного доступа к вашим личным данным никому не показывайте это письмо.<br>Поменять пароль самостоятельно вы можете в настройках вашего аккаунта.';
				$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
				$headers2 .= "From: Система \"".$sitename."\" <".$sitemail.">\r\n";
				$result2 = mail($to2, $subject2, $message2, $headers2);
				$_SESSION['successrec'] = '<div id="formpopup"><p><span class="bold">Ваш пароль сброшен!</span><br>Письмо с новым паролем отправлено на Вашу почту.</p></div>';
				}
				else {
					$subject2 = 'Password recovery at AIS "'.$sitename.'"';
				$message2 = 'The procedure for restoring access to your account has been completed.<br>Your new login information:<br><br>Login: '.$user['login'].'<br>Пароль: '.$newpass.'<br><br>To prevent unauthorized access to your personal data, do not show this email to anyone.<br>You can change the password yourself in your account settings.';
				$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
				$headers2 .= "From: System \"".$sitename."\" <".$sitemail.">\r\n";
				$result2 = mail($to2, $subject2, $message2, $headers2);
				$_SESSION['successrec'] = '<div id="formpopup"><p><span class="bold">Your password has been reset!</span><br>A letter with a new password sent to your mail.</p></div>';
				};
				R::store($user);
				header("Location: /system/#ads");
			} else {
				if ($_SESSION['lang'] == "1") {$errors[] = 'Фраза восстановления не подходит';} else {$errors[] = 'Recovery phrase does not fit';};
				
			}} else {$newpass = rand();
				$user->password= password_hash($newpass, PASSWORD_DEFAULT);
				$to2 = $user['email'];
				if ($_SESSION['lang'] == "1") {
					$subject2 = 'Восстановление пароля в АИС "'.$sitename.'"';
				$message2 = 'Завершена процедура восстановления доступа к вашему аккаунту.<br>Ваши новые данные для входа в систему:<br><br>Логин: '.$user['login'].'<br>Пароль: '.$newpass.'<br><br>Во избежание несанкционированного доступа к вашим личным данным никому не показывайте это письмо.<br>Поменять пароль самостоятельно вы можете в настройках вашего аккаунта.';
				$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
				$headers2 .= "From: Система \"".$sitename."\" <".$sitemail.">\r\n";
				$result2 = mail($to2, $subject2, $message2, $headers2);
				$_SESSION['successrec'] = '<div id="formpopup"><p><span class="bold">Ваш пароль сброшен!</span><br>Письмо с новым паролем отправлено на Вашу почту.</p></div>';
				}
				else {
					$subject2 = 'Password recovery at AIS "'.$sitename.'"';
				$message2 = 'The procedure for restoring access to your account has been completed.<br>Your new login information:<br><br>Login: '.$user['login'].'<br>Password: '.$newpass.'<br><br>To prevent unauthorized access to your personal data, do not show this email to anyone.<br>You can change the password yourself in your account settings.';
				$headers2 = "Content-type: text/html; charset=UTF-8 \r\n";
				$headers2 .= "From: System \"".$sitename."\" <".$sitemail.">\r\n";
				$result2 = mail($to2, $subject2, $message2, $headers2);
				$_SESSION['successrec'] = '<div id="formpopup"><p><span class="bold">Your password has been reset!</span><br>A letter with a new password sent to your mail.</p></div>';
				};
				R::store($user);
				header("Location: /system/#ads");}
			
		} else
		{
			if ($_SESSION['lang'] == "1") {$errors[] = 'Электронная почта указана неверно';} else {$errors[] = 'Email is invalid';};
		}
		if (!empty($errors)) { 
			echo'<div id="errors">'.array_shift($errors).'</div>';
		} 
	}
	?>

<form id="feedback-form" action="recovery.php" method="POST">
	<span class="closespan"><a class="close" href="/system/#ads" title="<?php if ($_SESSION['lang'] == "1") {echo 'Вернуться на предыдущую страницу';} else {echo 'Go back';}; ?>"><img src="../images/close.png" height="30px"></a></span>
	 <?php if ($_SESSION['lang'] == "1") {echo '<h5 id="formlogo">Сброс пароля</h5>';} else {echo '<h5 id="formlogo">Password reset</h5>';}; ?>
	<hr class="space2"/>
	<input class="inputs" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Электронная почта';} else {echo 'Email';}; ?>" type="email" name="email" value="<?php echo @$account_data['email'];?>">
	<?php if ($secretwordmethod == "1") : ?>
	<hr class="space"/>
	<input class="inputs" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Фраза восстановления';} else {echo 'Recovery phrase';}; ?>" type="text" name="secretword" value="<?php echo @$account_data['secretword'];?>">
	<? endif; ?>
	<hr class="space2"/>
	<button id="submitFF" type="submit" name = "do_recovery"><?php if ($_SESSION['lang'] == "1") {echo 'Продолжить';} else {echo 'Continue';}; ?></button>
</form>
</body>
</html>