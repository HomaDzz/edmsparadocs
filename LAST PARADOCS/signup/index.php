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
<?php if (($_SESSION['second_step']) != '1') : ?>
<?php if (isset($_SESSION['logged_user'])) { header('Location: /system/#ads'); } ?>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Регистрация';} else {echo 'Check in';}; ?></title>
</head>
<body>
<?php
$account_data = $_POST;
$kod = R::findOne($tableprefix.'_invites', "kod = ?", array($account_data['kod']));
if( isset($account_data['do_signup']) )
{
	$errors = array();
	if (!preg_match('|^[A-Za-z0-9]+$|i', $account_data['login'])) {
		if ($_SESSION['lang'] == "1") {$errors[] = 'В поле логина содержатся недопустимые символы. Разрешена только латиница и цифры';} else {$errors[] = 'The login field contains invalid characters. Only Latin and numbers are allowed';};
		
	}
	if ($_SESSION['lang'] == "1") {if (!preg_match('|^[абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$|i', $account_data['surname'])) {
		$errors[] = 'В поле фамилии содержатся недопустимые символы. Разрешена только кириллица';
	}
	
	if (!preg_match('|^[абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$|i', $account_data['firstname'])) {
		$errors[] = 'В поле имени содержатся недопустимые символы. Разрешена только кириллица';
	}
	
	if (!preg_match('|^[абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$|i', $account_data['thirdname'])) {
		$errors[] = 'В поле отчества содержатся недопустимые символы. Разрешена только кириллица';
	}} else {if (!preg_match('|^[abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+$|i', $account_data['surname'])) {
		$errors[] = 'The surname field contains invalid characters. Only Latin is allowed';
	}
	
	if (!preg_match('|^[abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+$|i', $account_data['firstname'])) {
		$errors[] = 'The name field contains invalid characters. Only Latin is allowed';
	}
	
	if ($account_data['thirdname'] != "") {
			 if (!preg_match('|^[abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ]+$|i', $account_data['thirdname'])) {
		$errors[] = 'The middle name field contains invalid characters. Only Latin is allowed';
	}};};
	

	if ($account_data['password_2'] !=$account_data['password']) {
		if ($_SESSION['lang'] == "1") {$errors[] = 'Пароли не совпадают';} else {$errors[] = 'Passwords do not match';};
		
	}
	if (R::count($tableprefix.'_users', "login = ?", array($account_data['login']))>0)
	{
		if ($_SESSION['lang'] == "1") {$errors[] = 'Этот логин уже используется';} else {$errors[] = 'Selected login already in use';};
		
	}
	if (R::count($tableprefix.'_users', "email = ?", array($account_data['email']))>0)
	{
		if ($_SESSION['lang'] == "1") {$errors[] = 'Этот адрес используется';} else {$errors[] = 'Selected email already in use';};
	}
	if ($registerbycode == "1") {if (empty($kod))
	{
		if ($_SESSION['lang'] == "1") {$errors[] = 'Введенный код не существует';} else {$errors[] = 'Entered code does not exist';};
	}
	if ($kod['status'] == 1)
	{
		if ($_SESSION['lang'] == "1") {$errors[] = 'Введенный код уже активирован';} else {$errors[] = 'Entered code already activated';};
	}};
	
	if (empty($errors)) 
	{
		$_SESSION['login'] = $account_data['login'];
		$_SESSION['email'] = $account_data['email'];
		if ($_SESSION['lang'] == "1") {$_SESSION['fio'] = $account_data['surname'].' '.$account_data['firstname'].' '.$account_data['thirdname'];} else {$_SESSION['fio'] = $account_data['surname'].' '.$account_data['firstname']; if ($account_data['thirdname'] !="") {$_SESSION['fio'] .= ' '.$account_data['surname'];};};
		
		$_SESSION['password'] = $account_data['password'];
		$_SESSION['word'] = mb_strtolower($account_data['secretword']);
		if ($registerbycode == "1") {
		$_SESSION['kod'] = $account_data['kod'];};
		$_SESSION['second_step'] = 1;
		header('Location: verify.php');
	} else 
	{
		echo'<div id="errors">'.array_shift($errors). '</div>';
	}
};
?>

<form id="feedback-form" action=" " method="POST">
	<span class="closespan"><a class="close" href="/system/#ads" title="<?php if ($_SESSION['lang'] == "1") {echo 'Вернуться на предыдущую страницу';} else {echo 'Go back';}; ?>"><img src="../images/close.png" height="30px"></a></span>
	<h5 id="formlogo"><?php if ($_SESSION['lang'] == "1") {echo 'Регистрация';} else {echo 'Check in';}; ?></h5>
	<hr class="space2"/>
	<input class="inputs" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Логин';} else {echo 'Login';}; ?>" type="text" name="login" value="<?php echo @$account_data['login'];?>">
	<hr class="space"/>
	<input class="inputs" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Фамилия';} else {echo 'Surname';}; ?>" type="text" name="surname" value="<?php echo @$account_data['surname'];?>">
	<hr class="space"/>
	<input class="inputs" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Имя';} else {echo 'Name';}; ?>" type="text" name="firstname" value="<?php echo @$account_data['firstname'];?>">
	<hr class="space"/>
	<input class="inputs" <?php if ($_SESSION['lang'] == "1") {echo 'required';}?> placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Отчество';} else {echo 'Middle name (if exist)';}; ?>" type="text" name="thirdname" value="<?php echo @$account_data['thirdname'];?>">
	<hr class="space"/>
	<input class="inputs" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Электронная почта';} else {echo 'Email';}; ?>" type="email" name="email" value="<?php echo @$account_data['email'];?>">
	<hr class="space"/>
	<input class="inputs" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Пароль';} else {echo 'Password';}; ?>" type="password" name="password">
	<hr class="space"/>
	<input class="inputs" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Подтверждение пароля';} else {echo 'Re-enter password';}; ?>" type="password" name="password_2">	
	<hr class="space"/>
	<input class="inputs" id="what1" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Фраза восстановления';} else {echo 'Recovery phrase';}; ?>" type="text" name="secretword" value="<?php echo @$account_data['secretword'];?>"> <a id="what" title="<?php if ($_SESSION['lang'] == "1") {echo 'Фраза восстановления необходима для восстановления доступа к аккаунту в случае его утери, если данная опция включена в системе';} else {echo '
The recovery phrase is required to restore access to the account if it is lost, if this option is enabled in the system';}; ?>"></a>
	<?php if ($registerbycode == "1") : ?>
	<hr class="space"/>
	<input class="inputs" id="what2" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Код регистрации';} else {echo 'Register code';}; ?>" type="text" name="kod" value="<?php echo @$account_data['kod'];?>"><a id="what" title="<?php if ($_SESSION['lang'] == "1") {echo 'Код для регистрации в системы должен выдать администратор';} else {echo 'The code for registration in the system must be issued by the administrator';}; ?>"></a>
	<?php endif; ?>
	<hr class="space"/>
	<?php if ($_SESSION['lang'] == "1") {echo '<input id="check" type="checkbox"/><label id="checktext">Я соглашаюсь с <a href="Terms_and_permissions.docx" title="Страница с правилами" id="ruleslink">правилами веб ресурса</a> и даю одобрение на обработку своих персональных данных.</label>';} else {echo '<input id="check" type="checkbox"/><label id="checktext">I agree <a href="Terms_and_permissions.docx" title="Rules page" id="ruleslink">rules of site</a> and I give approval for the processing of my personal data.</label>';}; ?>
	
	<hr class="space2"/>
	<button id="submitFFreg" type="submit" name = "do_signup"><?php if ($_SESSION['lang'] == "1") {echo 'Продолжить';} else {echo 'Continue';}; ?></button>
</form>
<?php else : ?>
<?php
header('Location: verify.php');
?>
<?php endif;  ?>
</body>
</html>