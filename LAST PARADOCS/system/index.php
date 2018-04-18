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
<link rel="stylesheet" href="../css/tabs.css" type="text/css"> <!-- Подключение таблицы стилей вкладок-->
<link rel="stylesheet" href="../css/tables.css" type="text/css"> <!-- Подключение таблицы стилей вкладок-->
<link rel="stylesheet" href="../css/checkboxes.css" type="text/css"> <!-- Подключение таблицы стилей чекбоксов-->
<link href="../libs/scripts/select2/select2.min.css" rel="stylesheet" />
	

	

<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloader.php')); ?> <!-- Подключение прелоадера -->
<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) { header('Location: /'); } ?> <!-- Проверка настроена ли система -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?> <!-- Коннект к базе и прочая важная штука -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<?php if (isset($_SESSION['logged_user'])) : ?>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/tabs/tabs.php')); ?> <!-- Скрипт вкладок -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/tabs/defaultopen.php')); ?>

</head>
<body>
	<?php if ($_SESSION['lang'] == "1") : ?>
<script src="../libs/scripts/select2/select2.min.js"></script>
<? else : ?>
<script src="../libs/scripts/select2/eng_select2.min.js"></script>
<? endif; ?>
<?php 
$user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));
function fullRemove_ff($path,$t="1") {
			$rtrn="1";
    		if (file_exists($path) && is_dir($path)) {
			$dirHandle = opendir($path);
			while (false !== ($file = readdir($dirHandle))) {
            if ($file!='.' && $file!='..') {
                $tmpPath=$path.'/'.$file;
                chmod($tmpPath, 0777);
                if (is_dir($tmpPath)) {
                    fullRemove_ff($tmpPath);
                } else {
                    if (file_exists($tmpPath)) {
                        unlink($tmpPath);
								}
							}
						}
					}
					closedir($dirHandle);
					if ($t=="1") {
						if (file_exists($path)) {
							rmdir($path);
						}
					}
				} else {
					$rtrn="0";
				}
				return $rtrn;
			};?>
<?php if (isset($_POST['erasesystemm'])) : ?>
<?php	
	if (isset($_POST['delarchfromsystem'])) {$erasedir = (($_SERVER['DOCUMENT_ROOT']) . ('/system/arch/')); fullRemove_ff($erasedir,1);};
	if (isset($_POST['deluserdocsfromsystem'])) {$erasedir = (($_SERVER['DOCUMENT_ROOT']) . ('/system/userdocs/')); fullRemove_ff($erasedir,1); R::wipe($tableprefix.'_docs');};
	if (isset($_POST['deluserinfofromsystem'])) {R::wipe($tableprefix.'_users');};
	if (isset($_POST['delpicsfromsystem'])) {$erasedir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/')); fullRemove_ff($erasedir,1);};
	if (isset($_POST['delnewsfromsystem'])) {$erasedir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/newspics/')); fullRemove_ff($erasedir,1); R::wipe($tableprefix.'_news');};
	if (isset($_POST['deltemplatesfromsystem'])) {$erasedir = (($_SERVER['DOCUMENT_ROOT']) . ('/templates/')); $erasedir2 = (($_SERVER['DOCUMENT_ROOT']) . ('/privatetemplates/')); fullRemove_ff($erasedir2,1); fullRemove_ff($erasedir,1);};
	R::wipe($tableprefix.'_invites');
	R::wipe($tableprefix.'_options');
	R::wipe($tableprefix.'_privatedocs');
	R::wipe($tableprefix.'_loginstory');
	unlink(($_SERVER['DOCUMENT_ROOT']).('/libs/installed.php'));
	unset($_SESSION['logged_user']);
	?>
	
	<script>
			window.location.replace("/system/rd.php");
	</script>
	
<?php endif; ?>
<?php
$account_data = $_POST;		
	
if (isset($account_data['save_more_admin'])) {
	if (!isset($account_data['disablemainpage'])) {$sitemainpagestatusopt->sitevalue='1'; R::store($sitemainpagestatusopt); $mainpagestatus = $sitemainpagestatusopt['sitevalue']; };
	if (!isset($account_data['disableloginauth'])) {$loginauthopt->sitevalue='1'; R::store($loginauthopt); $loginauth = $loginauthopt['sitevalue']; };
	if (!isset($account_data['disablesecretword'])) {$secretwordmethodopt->sitevalue='1'; R::store($secretwordmethodopt); $secretwordmethod = $secretwordmethodopt['sitevalue']; };
	if (!isset($account_data['disablecodes'])) {$registerbycodeopt->sitevalue='1'; R::store($registerbycodeopt); $registerbycode = $registerbycodeopt['sitevalue']; };
	if (isset($account_data['disablemainpage'])) {$sitemainpagestatusopt->sitevalue='0'; R::store($sitemainpagestatusopt); $mainpagestatus = $sitemainpagestatusopt['sitevalue']; };
	if (isset($account_data['disableloginauth'])) {$loginauthopt->sitevalue='0'; R::store($loginauthopt); $loginauth = $loginauthopt['sitevalue']; };
	if (isset($account_data['disablesecretword'])) {$secretwordmethodopt->sitevalue='0'; R::store($secretwordmethodopt); $secretwordmethod = $secretwordmethodopt['sitevalue']; };
	if (isset($account_data['disablecodes'])) {$registerbycodeopt->sitevalue='0'; R::store($registerbycodeopt); $registerbycode = $registerbycodeopt['sitevalue']; };
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Изменения применены.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Changes applied.</div>';};
};
	
if (isset($account_data['deldoplogo'])) {
	$file = (($_SERVER['DOCUMENT_ROOT']).('/images/userpics/userlogolittle.png'));
	unlink($file);
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Дополнительный логотип удалён.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Additional logo was removed.</div>';};
	

};
	
if (isset($account_data['dellogo'])) {
	$file = (($_SERVER['DOCUMENT_ROOT']).('/images/userpics/userlogo.png'));
	unlink($file);
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Основной логотип удалён.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Main logo was removed.</div>';};
	
};
	
if (isset($account_data['delfavicon'])) {
	$file = (($_SERVER['DOCUMENT_ROOT']).('/images/userpics/userfavicon.png'));
	unlink($file);
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Фавикон удалён.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Favicon was removed.</div>';};
	
};
	
if (isset($account_data['updatesitename'])) { 
	$sitenaming = R::findOne($tableprefix.'_options', 'siteoption = ?', array('sitename'));
	$sitenaming->sitevalue=$account_data['newsitename'];
	R::store($sitenaming);
	$sitename = $account_data['newsitename'];
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Название обновлено.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">System name was changed.</div>';};
	
};
	
if (isset($account_data['updatesitefavicon'])) {
	if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'), 0755);};
    $uploaddir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'));       
    $prev = $uploaddir.basename('userfavicon.png');
    copy($_FILES['newsitefavicon']['tmp_name'], $prev);
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Фавикон установлен.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Favicon was installed.</div>';};
	
};
	
if (isset($account_data['updatesitelogo'])) {
	if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'), 0755);};
    $uploaddir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'));       
    $prev = $uploaddir.basename('userlogo.png');
    copy($_FILES['newsitelogo']['tmp_name'], $prev);
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Основной логотип установлен.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Main logo was installed.</div>';};
	
};
	
if (isset($account_data['updatesitelittlelogo'])) {
	if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'), 0755);};
    $uploaddir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'));       
    $prev = $uploaddir.basename('userlogolittle.png');
    copy($_FILES['newsitelittlelogo']['tmp_name'], $prev);
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Дополнительный логотип установлен.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Additional logo was installed.</div>';};
	
};
	
if (isset($account_data['updatesitemail'])) { 
	$sitemailing = R::findOne($tableprefix.'_options', 'siteoption = ?', array('sitemail'));
	$sitemailing->sitevalue=$account_data['newsitemail'];
	R::store($sitemailing);
	$sitemail = $account_data['newsitemail'];
	if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Почта системы обновлена.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">System email was installed.</div>';};
	
};

	
if (isset($account_data['delvk'])) {
	$user->vk='';
	R::store($user);
	unset($account_data);
	header("Location: ".$_SERVER['REQUEST_URI']);
};
	
if (isset($account_data['deltelnumber'])) {
	$user->telnumber='';
	R::store($user);
	unset($account_data);
	header("Location: ".$_SERVER['REQUEST_URI']);
};
	
if (isset($account_data['delok'])) {
	$user->odnok='';
	R::store($user);
	unset($account_data);
	header("Location: ".$_SERVER['REQUEST_URI']);
};
	
if (isset($account_data['deltel'])) {
	$user->telega='';
	R::store($user);
	unset($account_data);
	header("Location: ".$_SERVER['REQUEST_URI']);
};
	
if (isset($account_data['save_more'])) {
	if (isset($account_data['showincontacts'])) {$user->showinco='1'; R::store($user); $mainpagestatus = $sitemainpagestatusopt['sitevalue']; };
	if (!isset($account_data['showincontacts'])) {$user->showinco='0'; R::store($user); $mainpagestatus = $sitemainpagestatusopt['sitevalue']; };
	if (!isset($account_data['disablevk']) && $account_data['disablevk'] == '' && empty($user['vk']) ) {$user->vk='none'; };
	if (!isset($account_data['disabletelnumber']) && $account_data['disabletelnumber'] == '' && empty($user['telnumber']) ) {$user->telnumber='none'; };
	if (!isset($account_data['disableok']) && $account_data['disableok'] == '' && empty($user['odnok']) ) {$user->odnok='none';};
	if (!isset($account_data['disabletel']) && $account_data['disabletel'] == '' && empty($user['telega']) ) {$user->telega='none';};
	if (isset($account_data['vk']) && $user['vk'] != 'none') {$user->vk=$account_data['vk'];};
	if (isset($account_data['telnumber']) && $user['telnumber'] != 'none') {$user->telnumber=$account_data['telnumber'];};
	if (isset($account_data['odnok']) && $user['odnok'] != 'none') {$user->odnok=$account_data['odnok'];};
	if (isset($account_data['telega']) && $user['telega'] != 'none') {$user->telega=$account_data['telega'];};
	$user->more=$account_data['more'];
	R::store($user);
	if ($_SESSION['lang'] == "1") {$_SESSION['noerrors'] = '<div id="noerrors">Изменения применены.</div>';} else {$_SESSION['noerrors'] = '<div id="noerrors">Changes applied.</div>';};
	
	header("Location: ".$_SERVER['REQUEST_URI']);
};
	
if (isset($account_data['change_pass_butt'])) 
	{
		$errors = array();
		if (password_verify($account_data['old_password'], $user->password)) { if ($account_data['new_password'] == $account_data['new_password2']) {
			
			$user->password = password_hash($account_data['new_password'], PASSWORD_DEFAULT);
			R::store($user);
			
			if ($_SESSION['lang'] == "1") {$_SESSION['noerrors'] = '<div id="noerrors">Пароль обновлён.</div>';} else {$_SESSION['noerrors'] = '<div id="noerrors">Password was updated.</div>';};
			
			} else {if ($_SESSION['lang'] == "1") {$errors[] = 'Пароли не совпадают.';} else {$errors[] = 'Re-entered password is not valid.';};};} else {if ($_SESSION['lang'] == "1") {$errors[] = 'Текущий пароль введён неправильно.';} else {$errors[] = 'Current password is valid.';};};
		
		if (!empty($errors)) {
			$_SESSION['errors'] = '<div id="errors">'.array_shift($errors).'</div>';
		};};
	
if (isset($account_data['change_word_butt'])) 
	{
		$errors = array();
			if (password_verify($account_data['old_password'], $user->password))
					{$user->secretword = password_hash(mb_strtolower($account_data['new_secretword']), PASSWORD_DEFAULT);
					R::store($user);
					 if ($_SESSION['lang'] == "1") {$_SESSION['noerrors'] = '<div id="noerrors">Фраза восстановления обновлена.</div>';} else {$_SESSION['noerrors'] = '<div id="noerrors">Recovery phrase updated.</div>';};
					}
			else {if ($_SESSION['lang'] == "1") {$errors[] = 'Пароль введён неправильно.';} else {$errors[] = 'Password is not valid.';};};
		if (!empty($errors)) {
			$_SESSION['errors'] = '<div id="errors">'.array_shift($errors).'</div>';
		};};
	
if (isset($account_data['change_email_butt'])) 
	{
		$errors = array();
			if (password_verify($account_data['old_password'], $user->password))
			{ if (($user['email'] != $account_data['new_email'])) { if (!isset($_SESSION['verify'])) { if (((R::count($tableprefix.'_users', "email = ?", array($account_data['new_email']))<1)) && ($user['email'] != $account_data['new_email'])) {
						$_SESSION['new_email'] = $account_data['new_email'];
						$_SESSION['actcode'] = rand();
						$to = $_SESSION['new_email'];
				
						if ($_SESSION['lang'] == "1") {$subject = "Код подтверждения для смены почты аккаунта в системе \"".$sitename."\"";
						$message = 'Здравствуйте, '.$user['fio'].'!<br>Ваш код подтверждения для привязки новой почты к аккаунту: '.$_SESSION['actcode'].'<br><br> Если это письмо было отправлено Вам случайно - пожалуйста, проигнорируйте его.';
						$headers = "Content-type: text/html; charset=UTF-8 \r\n";
						$headers .= "From: АИС ". $sitename ." <".$sitemail.">\r\n";} else {$subject = "Confirmation code for email change procedure at AIS \"".$sitename."\"";
						$message = 'Hello, '.$user['fio'].'!<br>Your verification code for linking new mail to your account: '.$_SESSION['actcode'].'<br><br>If this email was sent to you by accident - please ignore it.';
						$headers = "Content-type: text/html; charset=UTF-8 \r\n";
						$headers .= "From: AIS ". $sitename ." <".$sitemail.">\r\n";};
						
				
				
						$result = mail($to, $subject, $message, $headers);
						$_SESSION['verify'] ='1';}
						else {if ($_SESSION['lang'] == "1") {$errors[] = 'Кто-то уже использует эту почту.';} else {$errors[] = 'This email already in use by someone.';}; };} 
						else {if ($_SESSION['lang'] == "1") {$errors[] = 'Процесс смены почты уже идёт.';} else {$errors[] = 'The process of changing mail is already underway.';};};}
			 			else {if ($_SESSION['lang'] == "1") {$errors[] = 'Вы уже используете эту почту.';} else {$errors[] = 'This email already linked to your account.';}; };}
						else {if ($_SESSION['lang'] == "1") {$errors[] = 'Пароль введён неправильно.';} else {$errors[] = 'Password is not valid.';};  };};
					 if (!empty($errors)) {$_SESSION['errors'] = '<div id="errors">'.array_shift($errors).'</div>';}
	
if (isset($account_data['verify_butt'])) {
	$errors = array();
	if ($account_data['user_actcode'] == $_SESSION['actcode']) {$user->email= $_SESSION['new_email']; R::store($user);if ($_SESSION['lang'] == "1") {$_SESSION['noerrors'] = '<div id="noerrors">Почта обновлена.</div>';} else {$_SESSION['noerrors'] = '<div id="noerrors">Email was updated.</div>';};  unset($_SESSION['verify']); unset($_SESSION['new_email']); unset($_SESSION['actcode']);}
	else {if ($_SESSION['lang'] == "1") {$errors[] = 'Код введён неправильно';} else {$errors[] = 'Code is not valid';}; };
	if (!empty($errors)) {
			$_SESSION['errors'] = '<div id="errors">'.array_shift($errors).'</div>';};
};
	
if (isset($account_data['delverify'])) {
	unset($_SESSION['verify']); unset($_SESSION['new_email']); unset($_SESSION['actcode']);
};
	
if (isset($account_data['repeatverify'])) {
						$_SESSION['actcode'] = rand();
						$to = $_SESSION['new_email'];
						if ($_SESSION['lang'] == "1") {$subject = "Повторный код подтверждения для смены почты аккаунта в системе \"".$sitename."\"";
						$message = 'Здравствуйте, '.$user['fio'].'!<br>Ваш повторный код подтверждения для привязки новой почты к аккаунту: '.$_SESSION['actcode'].'<br><br> Если это письмо было отправлено Вам случайно - пожалуйста, проигнорируйте его.';
						$headers = "Content-type: text/html; charset=UTF-8 \r\n";
						$headers .= "From: АИС ". $sitename ." <".$sitemail.">\r\n";
						$result = mail($to, $subject, $message, $headers);
						$_SESSION['noerrors'] = '<div id="noerrors">Повторный код отправлен. Предыдущий код теперь недействителен. Не забудьте проверить, не попало ли наше письмо в спам.</div>';} else {$subject = "Repeated confirmation code for email change procedure at AIS \"".$sitename."\"";
						$message = 'Hello, '.$user['fio'].'!<br>Your repeated verification code for linking new mail to your account: '.$_SESSION['actcode'].'<br><br> If this email was sent to you by accident - please ignore it..';
						$headers = "Content-type: text/html; charset=UTF-8 \r\n";
						$headers .= "From: AIS ". $sitename ." <".$sitemail.">\r\n";
						$result = mail($to, $subject, $message, $headers);
						$_SESSION['noerrors'] = '<div id="noerrors">The duplicate code was sent. The previous code is now invalid. Do not forget to check if our letter was spammed.</div>';};
	
						
};

if (isset($account_data['template_next_step'])) {
	$_SESSION['creating_template'] = 1;
	$_SESSION['nameoftemplate'] = $_POST['nameoftemplate'];
	$_SESSION['valueofstrings'] = $_POST['valueofstrings'];
	$_SESSION['templateinfo'] = $_POST['templateinfo'];
	$_SESSION['typeofnewtemplate'] = $_POST['typeofnewtemplate'];
};
	
if (isset($account_data['clear_creating_template'])) {
	unset($_SESSION['creating_template']);
	unset($_SESSION['nameoftemplate']);
	unset($_SESSION['valueofstrings']);
	unset($_SESSION['templateinfo']);
	unset($_SESSION['typeofnewtemplate']);
};

if (isset($account_data['template_next_step_two'])) {
	if ($_SESSION['typeofnewtemplate'] == "3") {$templatefolder = 'privatetemplates';} else {$templatefolder = 'templates';};
	if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/'.$templatefolder.'/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/'.$templatefolder.'/'), 0755);};
		$arraystringtochange = array();
		$arrayinfostringtochange = array();
	for ($d = 1; $d <= $_SESSION['valueofstrings']; $d++)
	{
		$_SESSION['stringtochange'.$d] = $_POST['stringtochange'.$d];
		$_SESSION['infostringtochange'.$d] = $_POST['infostringtochange'.$d];
		$thetype = $_POST['selected'.$d];
		$arraystringtochange[] = '$filed = str_replace(\''.($_POST['stringtochange'.$d]).'\', $_POST[\'newstr'.$d.'\'], $filed)';
		if ($thetype == 'date') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required type="date" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'number') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required type="number" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'text') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required type="text" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'workname') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required type="text" value="<? echo $sitename ?>" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'systemname') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input type="text" readonly value="<? echo \'АИС \'.$sitename ?>" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'userfio') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required type="text" value="<?php echo $user[\'fio\']; ?>" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'currentdate') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required type="date" readonly value="<?php echo date("Y-m-d"); ?>" name="newstr'.$d.'"><br><br>';};
		if ($thetype == 'idofdocument') {$arrayinfostringtochange[] = $_POST['infostringtochange'.$d].': <input required readonly value="<?php echo (++$totaldocs[\'sitevalue\']); ?>" type="number" name="newstr'.$d.'"><br><br>';};
	};
	mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/'.$templatefolder.'/'.$_SESSION['nameoftemplate'].'/'), 0755);
	
	if ($_SESSION['lang'] == "1") {$templateoptions = '
			<?php
			$typeoftemplate = '.$_SESSION['typeofnewtemplate'].';
			if(isset($_POST[\''.str_replace(" ", "_", $_SESSION['nameoftemplate']).'_template\'])) : ?>
			<?php
			if (!file_exists(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/\'))) {mkdir(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/\'), 0755);};
			mkdir(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/unpackeddocx/\'), 0755);
			if ($typeoftemplate == 3) {$foldoftemp = $prividocfile[\'thedoc\'];} else {$foldoftemp = $file;}
			$zip = new ZipArchive();
			 if ($zip->open((($_SERVER[\'DOCUMENT_ROOT\']) . (\'/'.$templatefolder.'/\'.$foldoftemp.\'/document.zip\'))) === true) {
			$zip->extractTo(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/unpackeddocx/\'));
			$zip->close();
			  }
			$filename = (($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/unpackeddocx/word/document.xml\'));
			$filed = file_get_contents($filename);
			'.implode(";", $arraystringtochange).';
			file_put_contents($filename, $filed);
			$rootPath = realpath(\'userdocs/\'.$user[\'login\'].\'/unpackeddocx\');
			$zipq = new ZipArchive();
			$zipq->open(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/file\'.$user[\'login\'].\'.zip\'), ZipArchive::CREATE | ZipArchive::OVERWRITE);
			$filesq = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($rootPath),
				RecursiveIteratorIterator::LEAVES_ONLY
			);

			foreach ($filesq as $nameq => $fileq)
			{
				if (!$fileq->isDir())
				{
					$filePath = $fileq->getRealPath();
					$relativePath = substr($filePath, strlen($rootPath) + 1);
					$zipq->addFile($filePath, $relativePath);
				}
			}

			$zipq->close();
			$dirtodelete = (($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\']));
			fullRemove_ff($dirtodelete,1);
			
			$newdocs = R::xdispense($tableprefix.\'_docs\');
			$newdocs->owner=$user[\'login\'];
			$newdocs->nameofdoc=$foldoftemp;
			$newdocs->timeofcreate=time();
			if ($typeoftemplate == 3) {$whatdoneinfo = \'Отсутствует\';} else {$whatdoneinfo = $_POST[\'willdocinfo\'];}
			$newdocs->infoofdoc=$whatdoneinfo;
			if ($typeoftemplate == "1") {$newdocs->status="1";}
			else if ($typeoftemplate == "2") {$newdocs->status="0";}
			else if ($typeoftemplate == "3") {$newdocs->status="4";};
			R::store($newdocs);
			$thevd = R::count($tableprefix.\'_docs\');
			rename((($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/file\'.$user[\'login\'].\'.zip\')), (($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$newdocs[\'id\'].\'.docx\')));
			$totaldocs->sitevalue = ++$totaldocs[\'sitevalue\'];
			R::store($totaldocs);
			if ($typeoftemplate == "3") {
			$prdocf = R::FindOne($tableprefix.\'_privatedocs\', \'id=?\', array($prividocfile[\'id\']));
			$prividocfile->thestatus="1";
			$prividocfile->thefileid=$newdocs[\'id\'];
			R::store($prividocfile);
			}
			$_SESSION[\'noerrcd\'] = \'<div style="display:block;" id="noerrcd">ДОКУМЕНТ ЗАПОЛНЕН И ДОБАВЛЕН В ВАШ АРХИВ.</div>\';
			if (!file_exists(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/.htaccess\'))) {
			$connectingw = \'Deny from all\';
			$fpw = fopen($_SERVER[\'DOCUMENT_ROOT\'].(\'/system/userdocs/.htaccess\'), \'w\');
			$testw = fwrite($fpw, $connectingw);
			fclose($fpw);
			};
			
			?>
			<?php if ($typeoftemplate == 3) : ?>
			<script>
			window.location.replace("/system/done.php");
			</script>
			<?php endif; ?>
			<?php endif; ?>
			
			<form method="post" action="">
			<h3>Описание:</h3>
			<span style="width: 400px; margin: 0 auto;"><p>'.$_SESSION['templateinfo'].'</p></span>
			<?php if ($typeoftemplate == "1") {echo \'<br><span><p style="color: red;">Требует утверждения администратора для получения.</p></span>\';}; ?>
			<hr class="space2">	
			'.implode(" ", $arrayinfostringtochange).'<?php if ($typeoftemplate != "3") {echo \'Ваша заметка для документа: <input pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" required type="text"name="willdocinfo"><br><br>\';}; ?>
			<input style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 216px;" type="submit" name="'.str_replace(" ", "_", $_SESSION['nameoftemplate']).'_template" value="Заполнить документ">
			</form>
			';} else {$templateoptions = '
			<?php
			$typeoftemplate = '.$_SESSION['typeofnewtemplate'].';
			if(isset($_POST[\''.str_replace(" ", "_", $_SESSION['nameoftemplate']).'_template\'])) : ?>
			<?php
			if (!file_exists(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/\'))) {mkdir(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/\'), 0755);};
			mkdir(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/unpackeddocx/\'), 0755);
			if ($typeoftemplate == 3) {$foldoftemp = $prividocfile[\'thedoc\'];} else {$foldoftemp = $file;}
			$zip = new ZipArchive();
			 if ($zip->open((($_SERVER[\'DOCUMENT_ROOT\']) . (\'/'.$templatefolder.'/\'.$foldoftemp.\'/document.zip\'))) === true) {
			$zip->extractTo(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/unpackeddocx/\'));
			$zip->close();
			  }
			$filename = (($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\'].\'/unpackeddocx/word/document.xml\'));
			$filed = file_get_contents($filename);
			'.implode(";", $arraystringtochange).';
			file_put_contents($filename, $filed);
			$rootPath = realpath(\'userdocs/\'.$user[\'login\'].\'/unpackeddocx\');
			$zipq = new ZipArchive();
			$zipq->open(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/file\'.$user[\'login\'].\'.zip\'), ZipArchive::CREATE | ZipArchive::OVERWRITE);
			$filesq = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($rootPath),
				RecursiveIteratorIterator::LEAVES_ONLY
			);

			foreach ($filesq as $nameq => $fileq)
			{
				if (!$fileq->isDir())
				{
					$filePath = $fileq->getRealPath();
					$relativePath = substr($filePath, strlen($rootPath) + 1);
					$zipq->addFile($filePath, $relativePath);
				}
			}

			$zipq->close();
			$dirtodelete = (($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$user[\'login\']));
			fullRemove_ff($dirtodelete,1);
			
			$newdocs = R::xdispense($tableprefix.\'_docs\');
			$newdocs->owner=$user[\'login\'];
			$newdocs->nameofdoc=$foldoftemp;
			$newdocs->timeofcreate=time();
			if ($typeoftemplate == 3) {$whatdoneinfo = \'Not set\';} else {$whatdoneinfo = $_POST[\'willdocinfo\'];}
			$newdocs->infoofdoc=$whatdoneinfo;
			if ($typeoftemplate == "1") {$newdocs->status="1";}
			else if ($typeoftemplate == "2") {$newdocs->status="0";}
			else if ($typeoftemplate == "3") {$newdocs->status="4";};
			R::store($newdocs);
			$thevd = R::count($tableprefix.\'_docs\');
			rename((($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/file\'.$user[\'login\'].\'.zip\')), (($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/\'.$newdocs[\'id\'].\'.docx\')));
			$totaldocs->sitevalue = ++$totaldocs[\'sitevalue\'];
			R::store($totaldocs);
			if ($typeoftemplate == "3") {
			$prdocf = R::FindOne($tableprefix.\'_privatedocs\', \'id=?\', array($prividocfile[\'id\']));
			$prividocfile->thestatus="1";
			$prividocfile->thefileid=$newdocs[\'id\'];
			R::store($prividocfile);
			}
			$_SESSION[\'noerrcd\'] = \'<div style="display:block;" id="noerrcd">DOCUMENT COMPLETED AND ADDED TO YOUR ARCHIVE.</div>\';
			if (!file_exists(($_SERVER[\'DOCUMENT_ROOT\']) . (\'/system/userdocs/.htaccess\'))) {
			$connectingw = \'Deny from all\';
			$fpw = fopen($_SERVER[\'DOCUMENT_ROOT\'].(\'/system/userdocs/.htaccess\'), \'w\');
			$testw = fwrite($fpw, $connectingw);
			fclose($fpw);
			};
			
			?>
			<?php if ($typeoftemplate == 3) : ?>
			<script>
			window.location.replace("/system/done.php");
			</script>
			<?php endif; ?>
			<?php endif; ?>
			
			<form method="post" action="">
			<h3>Описание:</h3>
			<div style="width: 400px; margin: 0 auto;"><p>'.$_SESSION['templateinfo'].'</p></div>
			<?php if ($typeoftemplate == "1") {echo \'<br><span><p style="color: red;">Requires administrator approval to obtain.</p></span>\';}; ?>
			<hr class="space2">	
			'.implode(" ", $arrayinfostringtochange).'<?php if ($typeoftemplate != "3") {echo \'Your note for the document: <input pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" required type="text"name="willdocinfo"><br><br>\';}; ?>
			<input style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 216px;" type="submit" name="'.str_replace(" ", "_", $_SESSION['nameoftemplate']).'_template" value="Complete the document">
			</form>
			';};
	
	
			$fp = fopen($_SERVER['DOCUMENT_ROOT'].('/'.$templatefolder.'/'.$_SESSION['nameoftemplate'].'/optionfortemplate.php'), 'w');
			$test = fwrite($fp, $templateoptions);
			fclose($fp);
	
			if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/'.$templatefolder.'/'.$_SESSION['nameoftemplate'].'/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/'.$templatefolder.'/'.$_SESSION['nameoftemplate'].'/'), 0755);};
    		$uploaddir = (($_SERVER['DOCUMENT_ROOT']) . ('/'.$templatefolder.'/'.$_SESSION['nameoftemplate'].'/'));       
    		$prev = $uploaddir.basename('document.zip');
     		copy($_FILES['templatedocument']['tmp_name'], $prev);
			unset($_SESSION['creating_template']);
			unset($_SESSION['nameoftemplate']);
			unset($_SESSION['valueofstrings']);
			unset($_SESSION['templateinfo']);
			unset($_SESSION['typeofnewtemplate']);
			if ($_SESSION['lang'] == "1") {$_SESSION['noerrct'] = '<div id="noerrct">ШАБЛОН СОЗДАН И ДОБАВЛЕН В СПИСОК ДОСТУПНЫХ ТИПОВ ДОКУМЕНТОВ.</div>';} else {$_SESSION['noerrct'] = '<div id="noerrct">TEMPLATE CREATED AND ADDED TO THE LIST OF AVAILABLE TYPES OF DOCUMENTS.</div>';};
			
};
	
				if (isset($_POST['updatespecialkodik'])) {
				$thespecialkodik = R::findOne($tableprefix.'_invites', 'type = ?', array('special'));
				if (isset($thespecialkodik)) {$thespecialkodik->kod=$_POST['specialkodik']; R::store($thespecialkodik);} else {$stspk = R::xdispense($tableprefix.'_invites'); $stspk->kod = $_POST['specialkodik']; $stspk->type = 'special'; $stspk->status = "0"; R::store($stspk);} 
					if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Специальный код установлен.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Special code installed.</div>';};
					}
					
				if (isset($_POST['disablespecialkodik'])) { $dspk = R::findOne($tableprefix.'_invites', 'type = ?', array('special')); R::trash($dspk); 
				if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Специальный код отключён и удалён.</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Special code is disabled and deleted.</div>';};										   
				};
?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Система';} else {echo 'System';}; ?></title>

	<?php if ($_SESSION['lang'] == "1") : ?>
<ul class="navigation">
	<a title="Вернуться на главную страницу" href="/"><img id="headerpic" src="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogolittle.png'))) {echo '../images/userpics/userlogolittle.png';} else {echo '../images/paradocslogolittle.png';}; ?>" width="202px"></a>
	<?php if ($user['group'] == "admin") {echo '<li class="nav-item"><a title="Панель администратора" id="red" href="#adm">Система</a></li>';} ?>
	<?php if (($user['group'] == "admin") || ($user['group'] == "moder")) {echo '<li class="nav-item"><a id="blue" title="Панель модератора" href="#moder">Модерация</a></li>';} ?>
	<li class="nav-item"><a href="#ads" title="Новостная лента">Новости</a></li>
    <li class="nav-item"><a href="#docs" title="Архив и генерация документов">Документы</a></li>
	<li class="nav-item"><a href="#lk" title="Параметры Вашей учётной записи">Кабинет</a></li>
	<li class="nav-item"><a onclick="window.open(this.href,this.target,'width=520,height=505,scrollbars=0');return false;" href="/system/contacts.php" style="color: yellow" title="Контактные данные пользователей">Справочник</a></li>
	<?php if (($user['group'] == "admin") || ($user['group'] == "moder")) {echo '<li class="nav-item"><a style="color: lime;" title="Архив скрытых документов" href="/system/privatearch.php">Архив</a></li>';} ?>
	<li class="nav-item"><a href="../libs/logout.php" title="Завершение сессии">Выйти</a></li>
	<div id="footer">
		<div id="textbox">
			<p><span class="logged">© 2018 PARADOCS COMPANY</span><br>Курсовой проект<br>Система разработана @HomaDzz.<br>Все права защищены.<br><?php if (isset ($_SESSION['logged_user'])) { echo '<span class="logged">Вы вошли как '.$_SESSION['logged_user'].'.</span>'; }; ?></p>
		</div>
	</div>
</ul>
<? else : ?>
<ul class="navigation">
	<a title="Back to the main page" href="/"><img id="headerpic" src="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogolittle.png'))) {echo '../images/userpics/userlogolittle.png';} else {echo '../images/eng_paradocslogolittle.png';}; ?>" width="202px"></a>
	<?php if ($user['group'] == "admin") {echo '<li class="nav-item"><a title="Admin panel" id="red" href="#adm">System</a></li>';} ?>
	<?php if (($user['group'] == "admin") || ($user['group'] == "moder")) {echo '<li class="nav-item"><a id="blue" title="Moderator panel" href="#moder">Moderation</a></li>';} ?>
	<li class="nav-item"><a href="#ads" title="News feed">News</a></li>
    <li class="nav-item"><a href="#docs" title="Archive and document generation">Documents</a></li>
	<li class="nav-item"><a href="#lk" title="Your Account Settings">Account</a></li>
	<li class="nav-item"><a onclick="window.open(this.href,this.target,'width=520,height=505,scrollbars=0');return false;" href="/system/contacts.php" style="color: yellow" title="Contact information of users">Phonebook</a></li>
	<?php if (($user['group'] == "admin") || ($user['group'] == "moder")) {echo '<li class="nav-item"><a style="color: lime;" title="
Archive of hidden documents" href="/system/privatearch.php">Archive</a></li>';} ?>
	<li class="nav-item"><a href="../libs/logout.php" title="End of session">Logout</a></li>
	<div id="footer">
		<div id="textbox">
			<p><span class="logged">© 2018 PARADOCS COMPANY</span><br>Course project<br>System created by @HomaDzz.<br>All rights reserved.<br><?php if (isset ($_SESSION['logged_user'])) { echo '<span class="logged">You are authorized as '.$_SESSION['logged_user'].'.</span>'; }; ?></p>
		</div>
	</div>
</ul>
<? endif; ?>

	
	
<input title="<?php if ($_SESSION['lang'] == "1") {echo 'Меню';} else {echo 'Menu';}; ?>" type="checkbox" checked id="nav-trigger" class="nav-trigger" />
<label class="openmenu" for="nav-trigger"></label>
<div class="content">
	<?php $gotprivatedocs = R::findAll($tableprefix.'_privatedocs',' thereseiver = ? and thestatus = 0', array($user['fio'] )); if (!empty($gotprivatedocs)) : ?>
	<div title="<?php if ($_SESSION['lang'] == "1") {echo 'Необходимо заполнить документы';} else {echo 'You must fill out the documents';}; ?>" class="gotprivdocs"><span style="display: table-cell; vertical-align: middle; height: 54px;"><img style="padding-top:4px;" src="../images/warning.png" height="54";></span>
	<span style="display: table-cell; vertical-align: middle;"><h3 style="font-family: yanonereg; padding: 3px;"><a href="#privatedocs" class="warninglink"><?php if ($_SESSION['lang'] == "1") {echo 'Необходимо заполнить документы';} else {echo 'You must fill out the documents';}; ?></h3></a></span>
	</div>
	<div id="privatedocs">
		<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Документы на исполнение:';} else {echo 'Documents for execution:';}; ?></p></div>
		<div class="erasesystem" style="background: rgba(10,10,10,0.10);  text-align: center;">
		<div style="float: left; text-align: left; width: 120px; border: 2px solid black;">
			<div><span style="height: 5px; background: green">&#160&#160&#160</span> - <?php if ($_SESSION['lang'] == "1") {echo 'Более 5 дней';} else {echo 'More than 5 days';}; ?></div>
			<div><span style="height: 5px; background: blue">&#160&#160&#160</span> - <?php if ($_SESSION['lang'] == "1") {echo 'От 2 до 5 дней';} else {echo 'From 2 to 5 days';}; ?></div>
			<div><span style="height: 5px; background: red">&#160&#160&#160</span> - <?php if ($_SESSION['lang'] == "1") {echo 'Менее 2 дней';} else {echo 'Less than 2 days';}; ?></div>
		</div><p style="font: normal 25px yanonereg; position: relative; left: -65px;"><span style="text-decoration: underline;"><?php if ($_SESSION['lang'] == "1") {echo 'Администрация прислала Вам документы,<br>которые необходимо заполнить.';} else {echo 'The administration has sent you documents,<br>that need to be filled out.';}; ?></span></p>
		
		</div>
		<?php if (isset($_SESSION['noerrpd'])) {echo $_SESSION['noerrpd']; unset($_SESSION['noerrpd']);}; ?>
		<hr class="space">
		<div class="erasesystem" style="background: ghostwhite;  text-align: center;">
			
			<div style="font-family: yanonereg; display: table; margin: 0 auto; background: rgba(255,103,0,0.20); border: 2px solid black; border-radius: 0 10px 0 10px; padding: 4px 6px;"><h1>↓ <?php if ($_SESSION['lang'] == "1") {echo 'Список';} else {echo 'List';}; ?> ↓</h1></div>
			<hr class="space2">
		
			
					<?php
					$prividocfiles = R::findAll($tableprefix.'_privatedocs',' thereseiver = ? and thestatus = 0', array( $user['fio'] ));
					foreach ($prividocfiles as $prividocfile) {
					++$idli;
					$countlfco = $prividocfile['thedate'] - time();
					$showhrs = intdiv($countlfco, 3600);
					if ($countlfco <= 172800) {$lsco = "red";} else if ($countlfco >= 432000) {$lsco = "green";} else {$lsco = "blue";};
					if ($idli % 2 == 0) {$lco = "turquoise";} else {$lco = "coral";};
					echo '<div class="erasesystem"  style="background:'.$lco.'; margin:5px 0; border-radius: 20px; text-align: center;"><div class="spoiler folded"><a class="pdoclink" href="javascript:void(0);"> '.mb_strtoupper($prividocfile['thedoc']).' (<span style="color:'.$lsco.'">!!!</span>)</a></div>
					<div class="spoiler-text" style="background-image: url(../images/privatedocpattern.png); border: 2px dotted black;  border-radius: 20px;  margin-top: 5px;">';
					echo '<hr class="space">';
					if ($_SESSION['lang'] == "1") {echo '<div style="display: table; margin: 0 auto;">
					<div class="erasesystem" style="float: left; margin-right: 5px; width: 300px; background: ghostwhite; border-color: black;">
					<span class="bold">Тип документа:</span> '.$prividocfile['thedoc'].'<br>
					<span class="bold">Прислал:</span> '.$prividocfile['thesender'].'<br>
					<span class="bold">Времени осталось:</span> '.$showhrs.' ч<br>';
					if (!empty($prividocfile['themessage'])) {echo '<br><span class="bold">Сообщение:</span> <div style="display: table; margin: 0 auto;">'.$prividocfile['themessage'].'</div>';};} else {echo '<div style="display: table; margin: 0 auto;">
					<div class="erasesystem" style="float: left; margin-right: 5px; width: 300px; background: ghostwhite; border-color: black;">
					<span class="bold">Type of document:</span> '.$prividocfile['thedoc'].'<br>
					<span class="bold">Sent by:</span> '.$prividocfile['thesender'].'<br>
					<span class="bold">Time left:</span> '.$showhrs.' h<br>';
					if (!empty($prividocfile['themessage'])) {echo '<br><span class="bold">Message:</span> <div style="display: table; margin: 0 auto;">'.$prividocfile['themessage'].'</div>';};};
					
					echo '</div>';
					echo '<div style="float: left; background: ghostwhite; border: 3px solid black; padding: 5px;">';
					include($_SERVER['DOCUMENT_ROOT'].('/privatetemplates/'.$prividocfile['thedoc'].'/optionfortemplate.php'));
					echo '</div>';
					echo '</div>';
					echo '<hr class="space">';
					echo '</div>';
					echo '</div>';
					};
					?>
		
		</div>
	</div>
	<?php endif; ?>
	<div id="privatedocs">
		<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Документы на исполнение:';} else {echo 'Documents for execution:';}; ?></p></div>
		<?php if (isset($_SESSION['noerrpd'])) {echo $_SESSION['noerrpd']; unset($_SESSION['noerrpd']);}; ?>
		<div style="display: table; height: 800px; margin: 0 auto;"><h1 style="display: table-cell; vertical-align: middle; height: 100px; font-family: yanonereg; "><img src="../images/sadcat4.png" height="100" style="margin: 0 5px -10px; height: 100px;"><?php if ($_SESSION['lang'] == "1") {echo 'Все документы заполнены';} else {echo 'All documents are filled out';}; ?></h1></div>
	</div>
	<div id="ads">
		<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Новости';} else {echo 'News';}; ?></p></div>
		<?php if (($user['group'] == "admin") || (($user['group'] == "moder"))) : ?>
		<div class="addnews"><a href="#moderaddnews" style="text-decoration: none;">
		<img src="../images/plus.png" style="width: 25px; height: 25px; margin: 3px 30px 0;">
			<p style="color: black; margin-bottom: 5px;"><?php if ($_SESSION['lang'] == "1") {echo 'Управление новостями';} else {echo 'Managing news';}; ?></p></a></div>
		<?php endif; ?>
		<?php
	$thelistofnews = R::findall($tableprefix.'_news');
		
	if (empty($thelistofnews)) {if ($_SESSION['lang'] == "1") {echo '<div style="display: flex; height: 720px;"><h1 style="font-family: yanonereg; margin: auto; height: 100px;"><img src="../images/sadcat5.png" height="100" style="margin: 0 5px -10px;">Администратор еще не добавил новости :(</h1></div>';} else {echo '<div style="display: flex; height: 720px;"><h1 style="font-family: yanonereg; margin: auto; height: 100px;"><img src="../images/sadcat5.png" height="100" style="margin: 0 5px -10px;">The administrator has not added any news yet :(</h1></div>';}; } else {$thelistofnews = array_reverse($thelistofnews);
		if ($_SESSION['lang'] == "1") {foreach ($thelistofnews as $thenews) {
			echo '<hr class="space">';
			++$zzxx;
			if ($zzxx % 2 == 0) {echo '<div class="newsblock" style="background-color: #E4E4FF;">';} else {echo '<div class="newsblock" style="background-color: gainsboro;">';};
			if ($zzxx % 2 == 0) {if ($thenews['picofnews'] == "defaultpic") {echo '<div class="newsimgblock" style="border-right: 3px solid black; margin-right: 10px; float: left; border-radius: 2px 0 0 2px; background-image: url(../images/defaultpic.png);"></div>';} else {echo '<div class="newsimgblock" style="border-right: 3px solid black; margin-right: 10px;float: left; border-radius: 2px 0 0 2px; background-image: url(../images/newspics/'.$thenews['picofnews'].'.png);"></div>';};} else {
				{if ($thenews['picofnews'] == "defaultpic") {echo '<div class="newsimgblock" style="border-left: 3px solid black;	margin-left: 10px; border-radius:  0 2px 2px 0; float: right; background-image: url(../images/defaultpic.png);"></div>';} else {echo '<div class="newsimgblock" style="border-left: 3px solid black;	margin-left: 10px; border-radius:  0 2px 2px 0; float: right; background-image: url(../images/newspics/'.$thenews['picofnews'].'.png);"></div>';};}
			};
			echo '<div class="newstext">';
			if ($zzxx % 2 == 0) {echo '<h1 class="newshead" style="text-align: left; background: linear-gradient(to left, rgba(0,169,220,0), rgba(0,169,220,1));">'.$thenews['nameofnews'].'</h1>';} else {
				echo '<h1 class="newshead" style="text-align: right;  background: linear-gradient(to right, rgba(0,169,220,0), rgba(0,169,220,1));">'.$thenews['nameofnews'].'</h1>';};
				if ($zzxx % 2 == 0) {echo '<div class="newsdop" style=" display: table; right: 0; top: 0; border-left: 2px solid black; border-radius:  0 5px 0 0; text-align: right; padding-right: 5px;">';} else { echo '<div class="newsdop" style="left: 0; border-right: 2px solid black; top: 0; border-radius: 5px 0 0 0; text-align: left; padding-left: 5px;">';};
				echo '<span class="newsdate" Style="height: 48px; display: table-cell; vertical-align: middle;">Дата: '.$thenews['dateofnews'].'<span>';
				echo '</div>';
				if ($zzxx % 2 == 0) {echo '<a title="Открыть статью" href="ad.php?id='.$thenews['id'].'" class="gotonewslink" style=" right: 0; bottom: 0; border-radius: 10px  0 2px 0 ; border-left: 4px dashed black;">Читать полностью</a>';} else {echo '<a title="Открыть статью" href="ad.php?id='.$thenews['id'].'" class="gotonewslink" style=" left: 0; border-radius: 0 10px 0 2px; bottom: 0; border-right: 4px dashed black;">Читать полностью</a>';}
				echo '<p class="littlenew">'.$thenews['mininsideofnews'].'</p>';
			echo '</div>';
			echo '</div>';
		};} else {foreach ($thelistofnews as $thenews) {
			echo '<hr class="space">';
			++$zzxx;
			if ($zzxx % 2 == 0) {echo '<div class="newsblock" style="background-color: #E4E4FF;">';} else {echo '<div class="newsblock" style="background-color: gainsboro;">';};
			if ($zzxx % 2 == 0) {if ($thenews['picofnews'] == "defaultpic") {echo '<div class="newsimgblock" style="border-right: 3px solid black; margin-right: 10px; float: left; border-radius: 2px 0 0 2px; background-image: url(../images/defaultpic.png);"></div>';} else {echo '<div class="newsimgblock" style="border-right: 3px solid black; margin-right: 10px;float: left; border-radius: 2px 0 0 2px; background-image: url(../images/newspics/'.$thenews['picofnews'].'.png);"></div>';};} else {
				{if ($thenews['picofnews'] == "defaultpic") {echo '<div class="newsimgblock" style="border-left: 3px solid black;	margin-left: 10px; border-radius:  0 2px 2px 0; float: right; background-image: url(../images/defaultpic.png);"></div>';} else {echo '<div class="newsimgblock" style="border-left: 3px solid black;	margin-left: 10px; border-radius:  0 2px 2px 0; float: right; background-image: url(../images/newspics/'.$thenews['picofnews'].'.png);"></div>';};}
			};
			echo '<div class="newstext">';
			if ($zzxx % 2 == 0) {echo '<h1 class="newshead" style="text-align: left; background: linear-gradient(to left, rgba(0,169,220,0), rgba(0,169,220,1));">'.$thenews['nameofnews'].'</h1>';} else {
				echo '<h1 class="newshead" style="text-align: right;  background: linear-gradient(to right, rgba(0,169,220,0), rgba(0,169,220,1));">'.$thenews['nameofnews'].'</h1>';};
				if ($zzxx % 2 == 0) {echo '<div class="newsdop" style=" display: table; right: 0; top: 0; border-left: 2px solid black; border-radius:  0 5px 0 0; text-align: right; padding-right: 5px;">';} else { echo '<div class="newsdop" style="left: 0; border-right: 2px solid black; top: 0; border-radius: 5px 0 0 0; text-align: left; padding-left: 5px;">';};
				echo '<span class="newsdate" Style="height: 48px; display: table-cell; vertical-align: middle;">Date: '.$thenews['dateofnews'].'<span>';
				echo '</div>';
				if ($zzxx % 2 == 0) {echo '<a title="Open the article" href="ad.php?id='.$thenews['id'].'" class="gotonewslink" style=" right: 0; bottom: 0; border-radius: 10px  0 2px 0 ; border-left: 4px dashed black;">Open the article</a>';} else {echo '<a title="Open the article" href="ad.php?id='.$thenews['id'].'" class="gotonewslink" style=" left: 0; border-radius: 0 10px 0 2px; bottom: 0; border-right: 4px dashed black;">Open the article</a>';}
				echo '<p class="littlenew">'.$thenews['mininsideofnews'].'</p>';
			echo '</div>';
			echo '</div>';
		};};
		
	};
	?>
	</div>
	<div id="lk">
		<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Мой кабинет';} else {echo 'My account';}; ?></p></div>
		<div class="tabs">
			<button class="tablinkss" onclick="openTabs(event, 'infotab')" id="defaultOpens"><?php if ($_SESSION['lang'] == "1") {echo 'Информация';} else {echo 'Information';}; ?></button>
			<button class="tablinkss" onclick="openTabs(event, 'securitytab')"><?php if ($_SESSION['lang'] == "1") {echo 'Безопасность';} else {echo 'Security';}; ?></button>
			</div>
			<div id="infotab" class="tabcontents" style="font: normal 18px yanonereg;">
				<?php if (isset($_SESSION['errors'])) {echo $_SESSION['errors']; unset($_SESSION['errors']);}; ?>
				<?php if (isset($_SESSION['noerrors'])) {echo $_SESSION['noerrors']; unset($_SESSION['noerrors']);}; ?>
				<?php if (isset($_SESSION['verify'])) : ?>
				<div class="warning">
				<h2><?php if ($_SESSION['lang'] == "1") {echo 'Подтверждение:';} else {echo 'Confirmation:';}; ?></h2>
				<hr class="space">
				<form action="" name="verify_email" method="POST">
				<p style="font: normal 24px yanonereg;"><?php if ($_SESSION['lang'] == "1") {echo 'Для окончания процедуры изменения почтового адреса,<br> введите код подтверждения, отправленный на адрес';} else {echo 'To end the procedure for changing the mailing address,<br>enter the confirmation code sent to the addres';}; ?> <span class="bold">'<?php echo $_SESSION['new_email']; ?>'</span></p><br>
				<input pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" style="margin-left: 3px; height: 26px; width: 216px;" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Введите код в этом окне';} else {echo 'Enter the code in this window';}; ?>" type="text" name="user_actcode">
				<?php if ($_SESSION['lang'] == "1") {echo '<input style="margin-left: 3px; height: 26px; width: 216px;" type="submit" name="verify_butt" value="Подтвердить"><input class="bigdelbut" type="submit" name="delverify" value=" " title="Отменить привязку"><input class="repbut" type="submit" name="repeatverify" value=" " title="Отправить код повторно">';} else {echo '<input style="margin-left: 3px; height: 26px; width: 216px;" type="submit" name="verify_butt" value="Confirm"><input class="bigdelbut" type="submit" name="delverify" value=" " title="Сancel linking"><input class="repbut" type="submit" name="repeatverify" value=" " title="Resend code">';}; ?>
				</form>
				</div>
				<?php endif; ?>
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Основное';} else {echo 'Basic';}; ?></h2></div>
				<hr class="space">
				<hr>
				<div class="bigger">
				<p class="grayline"><span class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'Инициалы';} else {echo 'Fullname';}; ?>: </span><span class="coso"><?php if (!empty($user['fio'])) {echo $user['fio'];} else {if ($_SESSION['lang'] == "1") { echo 'Не задано';} else {echo 'Not set';};}; ?></span></p>
				<p class="darkline"><span class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'Логин';} else {echo 'Login';}; ?>: </span><span class="coso"><?php echo $user['login']; ?></span></p>
				<p class="grayline"><span class="bold"><?php if ($_SESSION['lang'] == "1") {if ($_SESSION['lang'] == "1") {echo '';} else {echo '';};  echo 'Электронная почта';} else {echo 'Email';}; ?>: </span><span class="coso"><?php echo substr($user['email'], 0, 3).'***'.stristr($user['email'], '@');
				?></span> <span style="color: red;"><? if (isset($_SESSION['new_email'])) {if ($_SESSION['lang'] == "1") {echo '(После подтверждения изменится на '.$_SESSION['new_email'].')';} else {echo '(After confirmation will change to '.$_SESSION['new_email'].')';};  };?></span></p>
				<p class="darkline"><span class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'Дата и время регистрации';} else {echo 'Date and time of registration';}; ?>: </span><span class="coso"><?php echo date("d-m-Y H:i:s", $user['join_date']); ?></span></p>
				<p class="grayline"><span class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'Код регистрации';} else {echo 'Register code';}; ?>: </span><span class="coso"><?php if (!empty($user['activatedcode'])) {echo $user['activatedcode'];} else {if ($_SESSION['lang'] == "1") {echo 'Не использовался при регистрации';} else {echo 'Not used when registering';};  }; ?></span></p>
				<p class="darkline"><span class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'Тип аккаунта';} else {echo 'Account type';}; ?>: </span><span class="coso"><?php if (($user['group']) == ("admin")) : if ($_SESSION['lang'] == "1") {echo 'Администратор';} else {echo 'Administrator';}; elseif (($user['group']) == ("default")) : if ($_SESSION['lang'] == "1") {echo 'Пользователь';} else {echo 'User';};  elseif (($user['group']) == ("moder")) : if ($_SESSION['lang'] == "1") {echo 'Модератор';} else {echo 'Moderator';};  endif; ?></span></p>
				</div>
				<hr class="space">
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Дополнительно';} else {echo 'Extra';}; ?></h2></div>
				<hr class="space">
				<hr>
				<div class="bigger">
				
				<form action="" method="POST">
				<div class="grayline" style="position: relative; height: 32px;">
				<div class="bold" style="font: bold 18px yanonereg; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Отображать мои данные в "Справочнике"';} else {echo 'Display my contact data in the "Phonebook"';}; ?>:</div><div style="float: left;margin-top: 3px; margin-left: 5px;"><input class="admchb" type="checkbox" name="showincontacts" <?php if ($user['showinco'] == '1') {echo 'checked';} ?> title="<?php if ($_SESSION['lang'] == "1") {echo 'Выключить\\Включить';} else {echo 'OFF\\ON';}; ?>"/></div>
				</div>
					
				<?php if ($_SESSION['lang'] == "1") : ?>
				<p class="darkline"><span class="bold">Номер телефона: </span><?php if (empty($user['telnumber']))
				: echo '<br><textarea maxlength="11" minlength="11" id="ftea" type="number" class="telnumber" name="telnumber" placeholder="Введите номер телефона"></textarea> <input class="chb" type="checkbox" name="disabletelnumber" checked value=" " title="Выключить">';
				elseif (($user['telnumber']) == ("none")) : echo 'отсутствует <input class="delbut" type="submit" name="deltelnumber" value="" title="Изменить">';
				else : echo '<span>'.$user['telnumber'].'</span><input class="delbut" type="submit" name="deltelnumber" value=" " title="Изменить">'; endif; ?></p>	
					
				<p class="grayline"><span class="bold">Вконтакте: </span><?php if (empty($user['vk']))
				: echo '<br><textarea name="vk" placeholder="Введите айди страницы"></textarea> <input class="chb" type="checkbox" name="disablevk" checked value="1" title="Выключить">';
				elseif (($user['vk']) == ("none")) : echo 'отсутствует <input class="delbut" type="submit" name="delvk"  value="" title="Изменить">';
				else : echo '<a href="https://vk.com/'.$user['vk'].'">'.$user['vk'].'</a><input class="delbut" type="submit" name="delvk" value=" " title="Изменить">'; endif; ?></p>
					
				<p class="darkline"><span class="bold">Одноклассники: </span><?php if (empty($user['odnok']))
				: echo '<br><textarea name="odnok" placeholder="Введите айди страницы"></textarea> <input class="chb" type="checkbox" name="disableok" checked value="2" title="Выключить">';
				elseif (($user['odnok']) == ("none")) : echo 'отсутствует <input class="delbut" type="submit" name="delok"  value=" " title="Изменить">';
				else : echo '<a href="https://ok.ru/'.$user['odnok'].'">'.$user['odnok'].'</a><input class="delbut" type="submit" name="delok" value=" " title="Изменить">'; endif; ?></p>
					
				<p class="grayline"><span class="bold">Telegram: </span><?php if (empty($user['telega']))
				: echo '<br><textarea name="telega" placeholder="Введите логин"></textarea> <input class="chb" type="checkbox" name="disabletel" checked value="3" title="Выключить">';
				elseif (($user['telega']) == ("none")) : echo 'отсутствует <input class="delbut" type="submit" name="deltel"  value=" " title="Изменить">';
				else : echo '<a href="https://telegram.me/'.$user['telega'].'">'.$user['telega'].'</a><input class="delbut" type="submit" name="deltel" value=" " title="Изменить">'; endif; ?></p>
					
				<div class="darkline">
				<p class="bold">Заметки:</p>
				<textarea class="big" name="more" placeholder="Здесь можно ввести любую информацию."><?php if (!empty($user['more'])) {echo $user['more'];}; ?></textarea><br>
				</div>
				<? else : ?>
				<p class="darkline"><span class="bold">Telephone number: </span><?php if (empty($user['telnumber']))
				: echo '<br><textarea maxlength="11" minlength="11" id="ftea" type="number" class="telnumber" name="telnumber" placeholder="Enter telephone number"></textarea> <input class="chb" type="checkbox" name="disabletelnumber" checked value=" " title="Disable">';
				elseif (($user['telnumber']) == ("none")) : echo 'Does not exist <input class="delbut" type="submit" name="deltelnumber" value="" title="Change">';
				else : echo '<span>'.$user['telnumber'].'</span><input class="delbut" type="submit" name="deltelnumber" value=" " title="Change">'; endif; ?></p>	
					
				<p class="grayline"><span class="bold">VK: </span><?php if (empty($user['vk']))
				: echo '<br><textarea name="vk" placeholder="Enter id of page"></textarea> <input class="chb" type="checkbox" name="disablevk" checked value="1" title="Disable">';
				elseif (($user['vk']) == ("none")) : echo 'Does not exist <input class="delbut" type="submit" name="delvk"  value="" title="Change">';
				else : echo '<a href="https://vk.com/'.$user['vk'].'">'.$user['vk'].'</a><input class="delbut" type="submit" name="delvk" value=" " title="Change">'; endif; ?></p>
					
				<p class="darkline"><span class="bold">Odnoklassniki: </span><?php if (empty($user['odnok']))
				: echo '<br><textarea name="odnok" placeholder="Enter id of page"></textarea> <input class="chb" type="checkbox" name="disableok" checked value="2" title="Disable">';
				elseif (($user['odnok']) == ("none")) : echo 'Does not exist <input class="delbut" type="submit" name="delok"  value=" " title="Change">';
				else : echo '<a href="https://ok.ru/'.$user['odnok'].'">'.$user['odnok'].'</a><input class="delbut" type="submit" name="delok" value=" " title="Change">'; endif; ?></p>
					
				<p class="grayline"><span class="bold">Telegram: </span><?php if (empty($user['telega']))
				: echo '<br><textarea name="telega" placeholder="Enter login"></textarea> <input class="chb" type="checkbox" name="disabletel" checked value="3" title="Disable">';
				elseif (($user['telega']) == ("none")) : echo 'Does not exist <input class="delbut" type="submit" name="deltel"  value=" " title="Change">';
				else : echo '<a href="https://telegram.me/'.$user['telega'].'">'.$user['telega'].'</a><input class="delbut" type="submit" name="deltel" value=" " title="Change">'; endif; ?></p>
					
				<div class="darkline">
				<p class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'Заметки';} else {echo 'Notes';}; ?>:</p>
				<textarea maxlength="256" class="big" name="more" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Здесь можно ввести любую информацию';} else {echo 'Save any type of information here';}; ?>."><?php if (!empty($user['more'])) {echo $user['more'];}; ?></textarea><br>
				</div>
				<? endif; ?>
				
				<hr class="space">
				<input type="submit" style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 216px;" name="save_more" value="<?php if ($_SESSION['lang'] == "1") {echo 'Применить изменения';} else {echo 'Save changes';}; ?>">
				</form>
				</div>
			</div>
			<script>
			$('#ftea').keypress(function(e) {
				var a = [];
				var k = e.which;
				for (i = 48; i < 58; i++)
					a.push(i);
				if (!(a.indexOf(k)>=0))
					e.preventDefault();
			});
			</script>
				<div id="securitytab" class="tabcontents">
				<hr class="space">
				<div class="erasesystem" style="display: flow-root">
				<div class="bigger" style="float: left; margin-right: 50px;">

					<div style=" display: table; margin: 0 auto;  background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Фраза восстановления';} else {echo 'Recovery phrase';}; ?></h2></div>
					<hr class="space">
					<hr style="width: 190px;">
					<div class="grayline" style="width: 190px; height: 219px;">
					<div class="changeform">
						<form action="" method="POST">
							<hr class="space2">
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="password" name="old_password" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Текущий пароль';} else {echo 'Current password';}; ?>"><br><br>
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="text" name="new_secretword" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Новая фраза';} else {echo 'New phrase';}; ?>">
							<hr class="space2">
							<input style="background-color:rgba(255,0,4,0.36);" class="changebut" name="change_word_butt" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить';} else {echo 'Change';}; ?>">
							<br><p style="text-align: center; font: 100 normal 12px yanonereg;">* - <?php if ($_SESSION['lang'] == "1") {echo 'регистр не важен';} else {echo 'any register';}; ?></p>
						</form>
						</div>
					</div>
				</div>
				<div class="bigger" style="float: left; margin-right: 50px;">

					<div style=" display: table; margin: 0 auto;  background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Пароль аккаунта';} else {echo 'Account password';}; ?></h2></div>
					<hr class="space">
					<hr style="width: 190px;">
					<div class="darkline" style="width: 190px;">
					<div class="changeform">
						<form action="" method="POST">
							<hr class="space2">
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="password" name="old_password" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Текущий пароль';} else {echo 'Current password';}; ?>"><br><br>
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="password" name="new_password" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Новый пароль';} else {echo 'New password';}; ?>"><br><br>
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="password" name="new_password2" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Подтверждение пароля';} else {echo 'Repeat password';}; ?>">
							<hr class="space2">
							<input style="background-color:rgba(255,0,4,0.36);" class="changebut" name="change_pass_butt" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить';} else {echo 'Change';}; ?>">
						</form>
						</div>
					</div>
				</div>
				<div class="bigger" style="float: left; margin: 0 0 50px;">

					<div style=" display: table; margin: 0 auto;  background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Почтовый адрес';} else {echo 'Email';}; ?></h2></div>
					<hr class="space">
					<hr style="width: 190px;">
					<div class="grayline" style="width: 190px; height: 219px;">
					<div class="changeform">
						<form action=""method="POST">
							<hr class="space2">
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="password" name="old_password" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Текущий пароль';} else {echo 'Current password';}; ?>"><br><br>
							<input required pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="changeinp" type="email" name="new_email" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Новый адрес';} else {echo 'New email';}; ?>">
							<hr class="space2">
							<input style="background-color:rgba(255,0,4,0.36);" class="changebut" name="change_email_butt" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить';} else {echo 'Change';}; ?>">
							<br><p style="text-align: center; font: 100 normal 12px yanonereg;">* - <?php if ($_SESSION['lang'] == "1") {echo 'требует подтверждения';} else {echo 'requires confirmation';}; ?></p>
						</form>
						</div>
					</div>
				</div>
			</div>
			<hr class="space">
			<div class="erasesystem">
			<div style=" display: table; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'История авторизаций';} else {echo 'History of authorizes';}; ?></h2></div>
			<hr class="space">
			<?php
			$lostoris = R::findAll($tableprefix.'_loginstory', 'user = ?', array($_SESSION['logged_user']));
			$lostoris = array_reverse($lostoris);
			echo '<table class="tftable" border="1" style="width: 672px;">';
				if ($_SESSION['lang'] == "1") {echo '<tr><th>№</th><th>Адрес</th><th>Время</th><th>Место</th></tr>';} else {echo '<tr><th>№</th><th>Adress</th><th>Time</th><th>Place</th></tr>';};
			
			foreach($lostoris as $lostori) if (++$rrtt <=5) {
			++$zzxx;
			echo '<tr>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $rrtt;
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $lostori['numip'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo date("d-m-y H:i:s", $lostori['thetime']);
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $lostori['city'];
			echo '</td>';
			echo '</tr>';
			};
			echo '</table>';
			?>
			</div>
			</div>
	</div>
	<div id="docs">
		<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Мои документы';} else {echo 'My documents';}; ?></p></div>
		<div style="padding-top: 5px; height: 38px;    border-bottom: 1px solid #868686;">
		<input type="checkbox" id="template-trigger" class="template-trigger"/><label title="Создать новый документ" class="templatelabel" for="template-trigger"><?php if ($_SESSION['lang'] == "1") {echo 'СОЗДАТЬ НОВЫЙ ДОКУМЕНТ';} else {echo 'CREATE A NEW DOCUMENT';}; ?></label>
		<div class="displaytemplate"><p style="font: normal 22px yanonereg; width: 214px; padding: 0; margin: 0 10px 0; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'ВЫБЕРИТЕ ТИП ДОКУМЕНТА';} else {echo 'SELECT A TYPE OF TEMPLATE';}; ?></p>
		<select id="selectItem" class="js-example-basic-single" style="width: 200px; height: 28px; margin-left: 8px; float: left;"></div>
		<?php
			$files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/templates'), array('..', '.'));
			foreach($files as $file) {
			echo '<option id="'.str_replace(" ", "_", $file).'">'.$file.'</option>';
			};
		?>
		</select>
		</div>
		</div>
		<hr class="space">
		<?php if (($user['group'] == "admin") || (($user['group'] == "moder"))) : ?>
		<div class="addnews" style="border-color: blue"><a href="#templates" style="text-decoration: none;">
		<img src="../images/plus.png" style="width: 25px; height: 25px; margin: 3px 30px 0;">
			<p style="color: black; margin-bottom: 5px;"><?php if ($_SESSION['lang'] == "1") {echo 'Управление шаблонами';} else {echo 'Template management';}; ?></p></a></div>
		<?php endif; ?>
		<div class="templateblock">
			<?php
			foreach($files as $file) {
			echo '<div style="margin-bottom: 20px; text-allign: center; border: 2px solid gray; padding: 10px; background-color: #E7DCD3" class="'.str_replace(" ", "_", $file).'">';
			include($_SERVER['DOCUMENT_ROOT'].('/templates/'.$file.'/optionfortemplate.php'));
			echo '</div>';
			};
			?>
			<?php if (isset($_SESSION['noerrcd'])) {echo $_SESSION['noerrcd']; unset($_SESSION['noerrcd']);}; ?>
			<?php
			$docfiles = R::findAll($tableprefix.'_docs',' owner = ? ', array( $user['login'] ));
			if (empty($docfiles)) {echo '<span display: flexbox; class="saddy"><h1 style="margin: auto; height: 100px;"><img src="../images/sadcat2.png" height="100" style="margin: 0 5px -10px;">У Вас еще нет документов :(</h1></span>';} else {
				if ($_SESSION['lang'] == "1") {echo '<div class="docslist" style="display: block">
			<div style=" display: table; margin: 0 auto; background: rgba(255,103,0,0.20); border: 2px solid black; border-radius: 0 10px 0 10px; padding: 4px 6px;"><h1>Архив документов:</h1></div>
			<hr class="space">';} else {echo '<div class="docslist" style="display: block">
			<div style=" display: table; margin: 0 auto; background: rgba(255,103,0,0.20); border: 2px solid black; border-radius: 0 10px 0 10px; padding: 4px 6px;"><h1>Archive of documents:</h1></div>
			<hr class="space">';};
			
			echo '<table class="tftable" border="1">';
				if ($_SESSION['lang'] == "1") {echo '<tr><th>Документ</th><th>Заметка</th><th>Дата</th><th>Статус</th><th></th></tr>';} else {echo '<tr><th>Document</th><th>Note</th><th>Date</th><th>Status</th><th></th></tr>';};
			
				if ($_SESSION['lang'] == "1") {foreach($docfiles as $docfile) {
			++$zzxx;
			$doclink = '/system/downloaddoc.php?id='.$docfile['id'].'&type='.$docfile['nameofdoc'];
				if ($docfile['refres'] !="none") {$refres = mb_strtolower($docfile['refres']);} else {$refres = "не указана";}
			if ($docfile['status'] == 0) {$thestatusofdoc = 'Доступно <a style="color: green; text-decoration: none; margin-bottom: 3px;" href="'.$doclink.'">(скачать)</a>';}
			else if ($docfile['status'] == 1) {$thestatusofdoc = '<span style="color: brown;">Ожидание утверждения</span>';}
			else if ($docfile['status'] == 2) {$thestatusofdoc = '<span style="color: blue;">Утверждено</span> (<a class="downlink" href="'.$doclink.'">скачать</a>)';}
			else if ($docfile['status'] == 3) {$thestatusofdoc = '<span style="color: red;">Отклонено</span> (<span onclick="return alert(\'Причина отказа:\\n'.$refres.'\')" title="Причина: '.$refres.'" class="downlink2" style="cursor: pointer;">?</span>)';}
			else if ($docfile['status'] == 4) {$thestatusofdoc = '<span style="color: purple;">Отправлено администрации</span> (<a class="downlink" href="'.$doclink.'">скачать</a>)';}
			echo '<tr>';
			if ($docfile['status'] == 4) {echo '<td style="background: pink;">'.$docfile['nameofdoc'].' (Скрытый)</td>';} else {
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">'.$docfile['nameofdoc'].'</td>';} else {echo '<td style="background: #E4E4FF;">'.$docfile['nameofdoc'].'</td>';};};
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $docfile['infoofdoc'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo date("d-m-Y H:i:s", $docfile['timeofcreate']);
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $thestatusofdoc;
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo '<a onclick="return  confirm(\'Вы уверены что хотите удалить документ?\')" class="downlink" href="deletedoc.php?id='.$docfile['id'].'&tyof=1">X</a>';
			echo '</td>';
			echo '</tr>';
			};} else {foreach($docfiles as $docfile) {
			++$zzxx;
			$doclink = '/system/downloaddoc.php?id='.$docfile['id'].'&type='.$docfile['nameofdoc'];
				if ($docfile['refres'] !="none") {$refres = mb_strtolower($docfile['refres']);} else {$refres = "not set";}
			if ($docfile['status'] == 0) {$thestatusofdoc = 'Available <a style="color: green; text-decoration: none; margin-bottom: 3px;" href="'.$doclink.'">(download)</a>';}
			else if ($docfile['status'] == 1) {$thestatusofdoc = '<span style="color: brown;">Waiting for approval</span>';}
			else if ($docfile['status'] == 2) {$thestatusofdoc = '<span style="color: blue;">Approved</span> (<a class="downlink" href="'.$doclink.'">download</a>)';}
			else if ($docfile['status'] == 3) {$thestatusofdoc = '<span style="color: red;">Disapproved</span> (<span onclick="return alert(\'Rejection reason:\\n'.$refres.'\')" title="Reason: '.$refres.'" class="downlink2" style="cursor: pointer;">?</span>)';}
			else if ($docfile['status'] == 4) {$thestatusofdoc = '<span style="color: purple;">Was sent to administration</span> (<a class="downlink" href="'.$doclink.'">download</a>)';}
			echo '<tr>';
			if ($docfile['status'] == 4) {echo '<td style="background: pink;">'.$docfile['nameofdoc'].' (Hidden)</td>';} else {
				if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">'.$docfile['nameofdoc'].'</td>';} else {echo '<td style="background: #E4E4FF;">'.$docfile['nameofdoc'].'</td>';};};
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $docfile['infoofdoc'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo date("d-m-Y H:i:s", $docfile['timeofcreate']);
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $thestatusofdoc;
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo '<a onclick="return  confirm(\'Are you sure you want to delete the document?\')" class="downlink" href="deletedoc.php?id='.$docfile['id'].'&tyof=1">X</a>';
			echo '</td>';
			echo '</tr>';
			};};
			echo '</table></div>';};
			?>
		</div>
	</div>
	
<?php if (($user['group'] == "admin") || (($user['group'] == "moder"))) : ?>
	<div id="moder">
	<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Модерация';} else {echo 'Moderation';}; ?></p></div>
	<div style="border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">
	<div class="forsimpletabs">
		<input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Утверждение';} else {echo 'Approval';}; ?>" style="background: #ccc" /><input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Скрытые документы';} else {echo 'Hidden documents';}; ?>" onclick="location.href='#modersend';" /><input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Шаблоны';} else {echo 'Templates';}; ?>" onclick="location.href='#templates';" /><input class="modertab" onclick="location.href='#moderaddnews';" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Новости';} else {echo 'News';}; ?>" />
		</div>
	<?php if ($_SESSION['modersend'] == 1)  {echo $_SESSION['modnoerrors']; unset($_SESSION['modnoerrors']); unset($_SESSION['modersend']);}; ?>
	<div class="erasesystem" style=" margin:5px; text-align: center;">
		<div style=" display: table; margin: 0 auto; background: rgba(255,103,0,0.20); border: 2px solid black; border-radius: 0 10px 0 10px; padding: 4px 6px;"><h1><?php if ($_SESSION['lang'] == "1") {echo 'Заявки на утверждение';} else {echo 'Applications for approval';}; ?>:</h1></div>
		<hr class="space">
			<?php
			$docfilesee = R::findAll($tableprefix.'_docs',' status = ? ', array('1'));
			
			if (empty($docfilesee)) {if ($_SESSION['lang'] == "1") {echo '<div style="display: flex; height: 464px;"><h1 style="margin: auto; height: 100px;"><img src="../images/sadcat.png" height="100" style="margin: 0 5px -10px;">Заявки отсутствуют :(</h1></div>';} else {echo '<div style="display: flex; height: 464px;"><h1 style="margin: auto; height: 100px;"><img src="../images/sadcat.png" height="100" style="margin: 0 5px -10px;">No Requests :(</h1></div>';}; } else {
			echo '<table class="tftable" style="margin: 0 auto 5px; width: 99%; " border="1">';
			if ($_SESSION['lang'] == "1") {echo '<tr><th>Документ</th><th>Пользователь</th><th>Дата</th><th>Просмотр</th><th>Действие</th></tr>';} else {echo '<tr><th>Document</th><th>User</th><th>Date</th><th>Review</th><th>Action</th></tr>';};
			
			foreach($docfilesee as $docfileee) {
				++$zzxx;
			$doclinkee = '/system/downloaddoc.php?id='.$docfileee['id'].'&type='.$docfileee['nameofdoc'];
			echo '<tr>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $docfileee['nameofdoc'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			$fioofthisuser = R::findOne($tableprefix.'_users', 'login = ?', array($docfileee['owner']));
			echo $fioofthisuser['fio'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo date("d-m-Y H:i:s", $docfileee['timeofcreate']);
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			if ($_SESSION['lang'] == "1") {echo '<a class="downlink" href="'.$doclinkee.'">Скачать</a>';} else {echo '<a class="downlink" href="'.$doclinkee.'">Download</a>';};
			
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			if ($_SESSION['lang'] == "1") {echo '<a class="acceptdoc" onclick="return  confirm(\'Вы уверены что хотите принять заявку на утверждение документа?\')" href="docaction.php?id='.$docfileee['id'].'&doing=1">Принять</a> / <a class="refusedoc" onclick="
			var mess = prompt(\'Укажите причину отклонения\', \'\');
			if (mess === \'\') { mess = \'none\'};
			document.location.href = \'docaction.php?id='.$docfileee['id'].'&doing=2&mess=\'+mess;">Отклонить</a>';} else {echo '<a class="acceptdoc" onclick="return  confirm(\'Are you sure that you want to accept the application for approval of the document?\')" href="docaction.php?id='.$docfileee['id'].'&doing=1">Accept</a> / <a class="refusedoc" onclick="
			var mess = prompt(\'Enter the reason for the rejection\', \'\');
			if (mess === \'\') { mess = \'none\'};
			document.location.href = \'docaction.php?id='.$docfileee['id'].'&doing=2&mess=\'+mess;">Decline</a>';};
			
			echo '</td>';
			echo '</tr>';
			};
			echo '</table>';};
			?>
		</div>
	</div>
	</div>
	<div id="modersend">
	<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Модерация';} else {echo 'Moderation';}; ?></p></div>
	<div style="border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">
	<div style="display:flow-root">
	<div class="forsimpletabs">
		<input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Утверждение';} else {echo 'Approval';}; ?>" onclick="location.href='#moder';" /><input class="modertab" style="background: #ccc" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Скрытые документы';} else {echo 'Hidden documents';}; ?>" /><input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Шаблоны';} else {echo 'Templates';}; ?>" onclick="location.href='#templates';" /><input class="modertab" onclick="location.href='#moderaddnews';" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Новости';} else {echo 'News';}; ?>" />
		</div>
		<?php if ($_SESSION['modersend'] == 2)  {echo $_SESSION['modnoerrors']; unset($_SESSION['modnoerrors']); unset($_SESSION['modersend']);}; ?>
		<div id="hzw1" class="erasesystem" style="float: right; margin: 5px; text-align: center; width: 37%;">
		<div style=" display: table; margin: 0 auto; background: rgba(255,103,0,0.20); border: 2px solid black; border-radius: 0 10px 0 10px; padding: 4px 6px;"><h1><?php if ($_SESSION['lang'] == "1") {echo 'Отправка документа';} else {echo 'Sending a document';}; ?>:</h1></div>
		<hr class="space2">
		<form method="post" action="sendprivate.php">
		<h3 style="margin-bottom: 3px;"><?php if ($_SESSION['lang'] == "1") {echo 'Исполнители';} else {echo 'Executors';}; ?>: </h3><select required class="js-example-basic-multiple" style="margin-left: 10px;  width: 200px" name="theusersprivate[]" multiple="multiple">
		<?php
						$admuserslistsccc = R::findAll($tableprefix.'_users');
						foreach($admuserslistsccc as $admuserslistccc) {
						echo '<option id="'.str_replace(" ", "_", $admuserslistccc['login']).'">'.$admuserslistccc['fio'].'</option>';
						};
					?>
		</select>
		<hr class="space">
		<h3 style="margin-bottom: 3px;"><?php if ($_SESSION['lang'] == "1") {echo 'Тип документа';} else {echo 'Type of the document';}; ?>: </h3><select  required  class="js-example-basic-single" style="width: 200px" name="theprivatedoc">
		<?php
			$filesccc = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/privatetemplates'), array('..', '.'));
			foreach($filesccc as $fileccc) {
			echo '<option id="'.str_replace(" ", "_", $fileccc).'">'.$fileccc.'</option>';
			};
		?>
		</select>
		<hr class="space">
		<?php $mindat = date("Y-m-d",(time()) + 86400);?>
		<h3><?php if ($_SESSION['lang'] == "1") {echo 'Срок исполнения';} else {echo 'Period of execution';}; ?>: </h3><input  required  name="privatedate" style="width: 200px; border: 1px solid #aaa; border-radius: 4px; height: 28px;" type="date" min="<?php echo $mindat; ?>">
		<hr class="space">
		<h3 style="margin-bottom: 3px;"><?php if ($_SESSION['lang'] == "1") {echo 'Сообщение для исполнителей';} else {echo 'Message for executors';}; ?>: </h3><textarea placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Ваше сообщение';} else {echo 'Your message';}; ?>" name="privatemessage" style="width: 260px; height: 70px; resize: none; border: 1px solid #aaa; border-radius: 4px;"></textarea>
			<hr class="space">
			<input type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Отправить';} else {echo 'Send';}; ?>" name="send_private" style="background-color: rgba(255,0,4,0.36);margin-left: 3px; height: 26px;width: 216px;">
		</form>
		</div>
		<div id="hzw2" class="erasesystem" style=" display: table-cell; float: left; margin: 5px; text-align: center; width: 60%;">
		<div style=" display: table; margin: 0 auto; background: rgba(255,103,0,0.20); border: 2px solid black; border-radius: 0 10px 0 10px; padding: 4px 6px;"><h1><?php if ($_SESSION['lang'] == "1") {echo 'Активные исполнители';} else {echo 'Active executors';}; ?>:</h1></div>
		<hr class="space2">
		<?php
			$pridocs = R::findAll($tableprefix.'_privatedocs', 'WHERE arched != "1"');
			if (empty($pridocs)) {if ($_SESSION['lang'] == "1") {echo '<div id="hzw3" style="display: flex;"><h1 style="margin: auto; height: 100px;"><img src="../images/sadcat3.png" height="100" style="margin: 0 5px -10px;">Список пуст :(</h1></div>';} else {echo '<div id="hzw3" style="display: flex;"><h1 style="margin: auto; height: 100px;"><img src="../images/sadcat3.png" height="100" style="margin: 0 5px -10px;">List is empty :(</h1></div>';};  } else {
			echo '<table class="tftable" style="margin: 0 auto 5px; width: 99%; " border="1">';
			if ($_SESSION['lang'] == "1") {echo '<tr><th>№</th><th>Документ</th><th>Пользователь</th><th>Дата указа</th><th>Срок исполнения</th><th>Статус</th></tr>';} else {echo '<tr><th>№</th><th>Document</th><th>Users</th><th>Decree Date</th><th>Period of execution</th><th>Status</th></tr>';};
			
			foreach($pridocs as $pridoc) if ($xxaa++ <10) {
			++$zzxx;
			echo '<tr>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $pridoc['id'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $pridoc['thedoc'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo $pridoc['thereseiver'];
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo date("d-m-y", $pridoc['thenow']);
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			echo date("d-m-y", $pridoc['thedate']);
			echo '</td>';
			if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
			if ($_SESSION['lang'] == "1") {if ($pridoc['thestatus'] == 0) {$pridocstatus= 'Ожидание (<a onclick="return  confirm(\'Вы уверены что хотите отменить исполнение документа?\')" class="downlink" href="deletedoc.php?id='.$pridoc['id'].'&tyof=2">отменить</a>)';} else if ($pridoc['thestatus'] == 1) {$pridocstatus= 'Заполнено (<a class="downlink" href="downloaddoc.php?id='.$pridoc['thefileid'].'&type='.$pridoc['thedoc'].'">скачать</a> | <a class="downlink2" href="deletedoc.php?id='.$pridoc['id'].'&tyof=4" onclick="return  confirm(\'Вы действительно хотите удалить документ?\')">удалить</a> | <a onclick="return  confirm(\'Вы действительно хотите перенести документ в архив?\')" class="downlink" href="toprivarch.php?id='.$pridoc['id'].'">в архив</a>)';} ;} else {if ($pridoc['thestatus'] == 0) {$pridocstatus= 'Waiting (<a onclick="return  confirm(\'Are you sure you want to cancel the document execution?\')" class="downlink" href="deletedoc.php?id='.$pridoc['id'].'&tyof=2">cancel</a>)';} else if ($pridoc['thestatus'] == 1) {$pridocstatus= 'Filled (<a class="downlink" href="downloaddoc.php?id='.$pridoc['thefileid'].'&type='.$pridoc['thedoc'].'">download</a> | <a class="downlink2" onclick="return  confirm(\'Are you sure want to delete the document?\')" href="deletedoc.php?id='.$pridoc['id'].'&tyof=4">delete</a> | <a onclick="return  confirm(\'Are you sure want to replace the document to archive?\')" class="downlink" href="toprivarch.php?id='.$pridoc['id'].'">to archive</a>)';} ;};
			echo $pridocstatus;
			echo '</td>';
			echo '</tr>';
			};
			echo '</table>';};
			?>
		
		</div>
		
		</div>
	</div>
		</div>
	<div id="moderaddnews">
	<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Управление новостями';} else {echo 'News management';}; ?></p></div>
	<div style="border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">
	<div class="forsimpletabs">
		<input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Утверждение';} else {echo 'Approval';}; ?>" onclick="location.href='#moder';" /><input class="modertab" onclick="location.href='#modersend';" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Скрытые документы';} else {echo 'Hidden documents';}; ?>" /><input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Шаблоны';} else {echo 'Templates';}; ?>" onclick="location.href='#templates';" /><input class="modertab" style="background: #ccc" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Новости';} else {echo 'News';}; ?>" />
	</div>
	<?php if ($_SESSION['modersend'] == 3)  {echo $_SESSION['modnoerrors']; unset($_SESSION['modnoerrors']); unset($_SESSION['modersend']);}; ?>
	<hr class="space">
	<div style="margin:5px;">
	<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Добавление';} else {echo 'Adding';}; ?></h2></div>
	<div>
	<div title="<?php if ($_SESSION['lang'] == "1") {echo 'Открыть форму для добавления статьи';} else {echo 'Open form for adding an article';}; ?>" style="margin-left: 120px; margin-right: 10px;" class="spoiler openspo"><a style="text-decoration: none; " href="javascript:void(0);"><img src="../images/plus.png" height="41"></a></div>
		<div class="spoiler-text">
	<hr class="space">
	<form class="addnewsform"  method="post" action="addnews.php" enctype="multipart/form-data" >
	<div class="darkline" style="margin-left:10px; margin-right: 10px;">
	<h2 style="font-family: yanonereg; margin-bottom: 4px;" ><?php if ($_SESSION['lang'] == "1") {echo 'Заголовок';} else {echo 'Header';}; ?>:</h2>
	<input maxlength="25" pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" required type="text" name="newsname" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Название новости';} else {echo 'Name of article';}; ?>">
	</div>
	<hr class="space">
	<div class="darkline" style="margin-left:10px; margin-right: 10px;">
	<h2 style="font-family: yanonereg; margin-bottom: 4px;"><?php if ($_SESSION['lang'] == "1") {echo 'Дата';} else {echo 'Date';}; ?>:</h2>
	<input required type="date" name="newsdate" value="<?php $minidate = date("Y-m-d",time()); echo $minidate; ?>" min="<?php echo $minidate; ?>">
		</div>
	<hr class="space">
	<div class="darkline" style="margin-left:10px; margin-right: 10px;">
	<h2 style="font-family: yanonereg; margin-bottom: 4px;"><?php if ($_SESSION['lang'] == "1") {echo 'Картинка';} else {echo 'Picture';}; ?>:</h2>
	<div class="box" style="margin-top: 3px;">
					<input type="file" name="newspicture" id="file-1" class="inputfile inputfile-1" />
					<label for="file-1" class="forfileee"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span><?php if ($_SESSION['lang'] == "1") {echo 'Выбрать файл';} else {echo 'Choose file';}; ?></span></label>
	</div>
	<?php if ($_SESSION['lang'] == "1") {echo '<script src="../libs/scripts/customfileinput/custom-file-input.js"></script>';} else {echo '<script src="../libs/scripts/customfileinput/eng_custom-file-input.js"></script>';}; ?>
		</div>
	<hr class="space">
	<div class="darkline" style="margin-left:10px; margin-right: 10px;">
	<h2 style="font-family: yanonereg; margin-bottom: 4px;" ><?php if ($_SESSION['lang'] == "1") {echo 'Краткое описание';} else {echo 'Short description';}; ?>:</h2>
		<div style="margin: 0 auto 5px;width: 80px; border-radius: 10px; background: rgba(255,0,4,0.05); border: 1px solid black;"><a title="<?php if ($_SESSION['lang'] == "1") {echo 'Жирный текст';} else {echo 'Bold text';}; ?>" onClick="insertT(document.getElementById('wheretoinsert1'), '<strong></strong>');"><img src="../images/bbbuts/bold.png" class="bbtags" height="20"></a><a title="<?php if ($_SESSION['lang'] == "1") {echo 'Подчёркнутый текст';} else {echo 'Underlined text';}; ?>" onClick="insertT(document.getElementById('wheretoinsert1'), '<u></u>');"><img src="../images/bbbuts/underline.png" class="bbtags" height="20"></a><a title="<?php if ($_SESSION['lang'] == "1") {echo 'Курсивный текст';} else {echo 'Italic text';}; ?>" onClick="insertT(document.getElementById('wheretoinsert1'), '<i></i>');"><img src="../images/bbbuts/koso.png" class="bbtags" height="20"></a></div>
	<textarea maxlength="500" id="wheretoinsert1" required name="mininside" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Будет отображаться до открытия новостной статьи';} else {echo 'Will be displayed before the news article opens';}; ?>"></textarea>
		</div>
	<hr class="space">
	<div class="darkline" style="margin-left:10px; margin-right: 10px;">
		<h2 style="font-family: yanonereg; margin-bottom: 4px;" ><?php if ($_SESSION['lang'] == "1") {echo 'Содержание';} else {echo 'Content';}; ?>:</h2>
		<div style="margin: 0 auto 5px;width: 80px; border-radius: 10px; background: rgba(255,0,4,0.05); border: 1px solid black;"><a title="<?php if ($_SESSION['lang'] == "1") {echo 'Жирный текст';} else {echo 'Bold text';}; ?>" onClick="insertT(document.getElementById('wheretoinsert2'), '<strong></strong>');"><img src="../images/bbbuts/bold.png" class="bbtags" height="20"></a><a title="<?php if ($_SESSION['lang'] == "1") {echo 'Подчёркнутый текст';} else {echo 'Underlined text';}; ?>" onClick="insertT(document.getElementById('wheretoinsert2'), '<u></u>');"><img src="../images/bbbuts/underline.png" class="bbtags" height="20"></a><a title="<?php if ($_SESSION['lang'] == "1") {echo 'Курсивный текст';} else {echo 'Italic text';}; ?>" onClick="insertT(document.getElementById('wheretoinsert2'), '<i></i>');"><img src="../images/bbbuts/koso.png" class="bbtags" height="20"></a></div>
	<textarea id="wheretoinsert2" required name="inside" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Будет отображаться при открытии статьи';} else {echo 'Will be displayed when you open the article';}; ?>"></textarea>
		</div>
	<hr class="space">
		<input type="submit"  style="background-color:rgba(255,0,4,0.36); margin-left: 13px; height: 26px; width: 216px;" value="<?php if ($_SESSION['lang'] == "1") {echo 'Добавить статью';} else {echo 'Add article';}; ?>">
	</form>
		<script src="../libs/scripts/insert/insert.js"></script>
		</div>
		
	</div>
		<hr class="space">
	<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Список доступных новостей';} else {echo 'List of available news';}; ?></h2></div>
	<div>
	<?php
	$listofnews = R::findall($tableprefix.'_news');
	if (empty($listofnews)) {if ($_SESSION['lang'] == "1") {echo '<hr class="space"><p class="grayline" style="color: black;">Доступных новостей нет.</p>';} else {echo '<hr class="space"><p class="grayline" style="color: black;">No available news.</p>';};  } else {
		echo '<hr class="space">';
		echo '<table class="tftable" style="margin: 0 auto 5px; width: 99%; " border="1">';
		if ($_SESSION['lang'] == "1") {echo '<tr><th>№</th><th>Заголовок</th><th>Дата публикации</th><th>Автор</th><th>Картинка</th><th></th></tr>';} else {echo '<tr><th>№</th><th>Header</th><th>Date of publishing</th><th>Author</th><th>Picture</th><th></th></tr>';};
		
	foreach ($listofnews as $newsfromlist) {
		++$zzyy;
		echo '<tr>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		echo $zzyy;
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		echo $newsfromlist['nameofnews'];
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		echo $newsfromlist['dateofnews'];
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		echo $newsfromlist['author'];
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		if ($newsfromlist['picofnews'] == "defaultpic") {if ($_SESSION['lang'] == "1") {echo '<p>Отсутствует</p>';} else {echo '<p>Not set</p>';};  } else {if ($_SESSION['lang'] == "1") {echo '<a class="downlink" href="../images/newspics/'.$newsfromlist['picofnews'].'.png" target="_blank">Посмотреть</a>';} else {echo '<a class="downlink" href="../images/newspics/'.$newsfromlist['picofnews'].'.png" target="_blank">Look</a>';}; 
		}
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		if ($_SESSION['lang'] == "1") {echo '<a class="downlink" onclick="return  confirm(\'Вы уверены что хотите удалить статью?\')" title="Удалить" href="deletedoc.php?id='.$newsfromlist['id'].'&tyof=3">X</a>';} else {echo '<a class="downlink" onclick="return  confirm(\'Are you sure you want to delete the article?\')" title="Delete" href="deletedoc.php?id='.$newsfromlist['id'].'&tyof=3">X</a>';};
		echo '</td>';
		echo '</tr>';
	};
	echo '</table>';
	};
	?>
	</div>
	</div>
		</div>
		</div>
	
<?php endif; ?>
<?php if (($user['group'] == "admin") || ($user['group'] == "moder")) : ?>
	<div id="templates">
	<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Управление шаблонами';} else {echo 'Templates management';}; ?></p></div>
	<div style="border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">
	<div class="forsimpletabs">
		<input class="modertab" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Утверждение';} else {echo 'Approval';}; ?>" onclick="location.href='#moder';" /><input class="modertab" onclick="location.href='#modersend';" type="button" value="<?php if ($_SESSION['lang'] == "1") {echo 'Скрытые документы';} else {echo 'Hidden documents';}; ?>" /><input class="modertab" type="button" style="background: #ccc"  value="<?php if ($_SESSION['lang'] == "1") {echo 'Шаблоны';} else {echo 'Templates';}; ?>"  /><input class="modertab" type="button" onclick="location.href='#moderaddnews';" value="<?php if ($_SESSION['lang'] == "1") {echo 'Новости';} else {echo 'News';}; ?>" />
	</div>
		<div style="margin: 5px;">
		<?php if (isset($_SESSION['errct'])) {echo $_SESSION['errct']; unset($_SESSION['errct']);}; ?>
		<?php if (!isset($_SESSION['creating_template'])) : ?>
		<hr class="space">
		<?php if (isset($_SESSION['noerrct'])) {echo $_SESSION['noerrct']; unset($_SESSION['noerrct']);}; ?>
		<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Добавление';} else {echo 'Adding';}; ?></h2></div>

	<div title="Открыть форму для добавления шаблона" style="margin-left: 120px; margin-right: 10px;" class="spoiler openspo"><a style="text-decoration: none; " href="javascript:void(0);"><img src="../images/plus.png" height="41"></a></div>
		<div class="spoiler-text">
	<div class="addtemlatewindow">
		<form method="post" enctype="multipart/form-data" action="">
		<div class="creatingtemplateform">
		<h1 style="text-align: center; font-family: yanonereg;"><?php if ($_SESSION['lang'] == "1") {echo 'ПЕРВЫЙ ЭТАП';} else {echo 'FIRST STEP';}; ?></h1>
		<hr style="margin: 5px 0;">
		<div class="grayline"><p><span style="border-bottom: 1px dotted black; font-size: 25px;" class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'ВЫБЕРИТЕ НАЗВАНИЕ ШАБЛОНА';} else {echo 'CHOOSE NAME FOR THE TEMPLATE';}; ?></span><br><?php if ($_SESSION['lang'] == "1") {echo 'Это название будет отображаться в списке доступных типов на странице создания документа';} else {echo 'This name will be displayed in the list of available types on the document creation page';}; ?>:</p>
		<input required type="text" id="nameoftemplate" name="nameoftemplate" pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$">
		</div>
		<hr style="margin: 5px 0;">
		<div class="darkline">
		<p><span style="border-bottom: 1px dotted black; font-size: 25px;" class="bold"><?php if ($_SESSION['lang'] == "1") {echo 'ЗАПОЛНИТЕ ОПИСАНИЕ';} else {echo 'FILL DESCRIPTION';}; ?></span><br><?php if ($_SESSION['lang'] == "1") {echo 'Оно будет отображаться над полями ввода при выборе этого типа документа';} else {echo 'It will be displayed above the input fields when this type of document is selected';}; ?>:</p>
		<textarea style="text-align: center; padding: 2px;margin-top: 2px;resize: none; height: 80px; width: 300px;" required type="text" id="templateinfo" name="templateinfo"></textarea>
		</div>
		<hr style="margin: 5px 0;">
		<?php if ($_SESSION['lang'] == "1") {echo '<div class="grayline"><p><span style="border-bottom: 1px dotted black; font-size: 25px;" class="bold">ВВВЕДИТЕ КОЛИЧЕСТВО СТРОК</span><br>Это количество зависит от количества <span style="border-bottom: 1px solid black">не одинаковых</span> строк формата <span class="bold">"ИЗМЕНЯЕМАЯ_СТРОКА"</span> в загружаемом шаблоне.</p>
		<input type="number" required id="valueofstrings" min="1" max="999" name="valueofstrings">
		</div>';} else {echo '<div class="grayline"><p><span style="border-bottom: 1px dotted black; font-size: 25px;" class="bold">ENTER THE VALUE OF STRINGS</span><br>This number depends on the number of <span style="border-bottom: 1px solid black">non-identical</span> lines in the format <span class="bold">"CHANGED_STRING"</span> in the uploadable template.</p>
		<input type="number" required id="valueofstrings" min="1" max="999" name="valueofstrings">
		</div>';}; ?>
		
		<?php if ($_SESSION['lang'] == "1") {echo '<div class="darkline"><p><span style="border-bottom: 1px dotted black; font-size: 25px;" class="bold">ВЫБЕРИТЕ ТИП ИСПОЛЬЗОВАНИЯ ДОКУМЕНТА</span><br>Этот параметр отвечает за необходимость документа быть утверждённым администратором для его получения.</p>
		<select name="typeofnewtemplate" required>
		<option value="1">Требует утверждение</option>
		<option value="2">Не требует утверждение</option>
		<option  value="3">Скрытый</option>
		</select>
		</div>';} else {echo '<div class="darkline"><p><span style="border-bottom: 1px dotted black; font-size: 25px;" class="bold">SELECT THE TYPE OF USE OF THE DOCUMENT</span><br>This parameter is responsible for the need for the document to be approved by the administrator to receive it.</p>
		<select name="typeofnewtemplate" required>
		<option value="1">Require approval</option>
		<option value="2">Does not require approval</option>
		<option  value="3">Hidden</option>
		</select>
		</div>';}; ?>
		
		<hr style="margin: 5px 0;">
		<input type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Продолжить';} else {echo 'Continue';}; ?>" class="template_next_step" name="template_next_step">
		</div>
		</form>
		</div>
		</div>
		<hr class="space">
		<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Список доступных шаблонов';} else {echo 'List of available templates';}; ?></h2></div>
	<div>
	<?php
			$templatezz = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/templates'), array('..', '.'));
			$privtemplatezz = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/privatetemplates'), array('..', '.'));
	if (empty($templatezz) && empty($privtemplatezz)) { if ($_SESSION['lang'] == "1") {echo '<hr class="space"><p class="grayline" style="color: black;">Доступных шаблонов нет.</p>';} else {echo '<hr class="space"><p class="grayline" style="color: black;">There are no available templates.</p>';}; } else {
		echo '<hr class="space">';
		echo '<table class="tftable" style="margin: 0 auto 5px; width: 99%; " border="1">';
		if ($_SESSION['lang'] == "1") {echo '<tr><th>Название</th><th>Тип</th><th></th></tr>';} else {echo '<tr><th>Name</th><th>Type</th><th></th></tr>';};
		
	foreach($templatezz as $templatez) {
		++$zzyy;
		echo '<tr>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		echo $templatez;
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		if ($_SESSION['lang'] == "1") {echo 'Открытый';} else {echo 'Open';};
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		if ($_SESSION['lang'] == "1") {echo '<a class="downlink" onclick="return  confirm(\'Вы уверены что хотите удалить шаблон?\')" title="Удалить" href="deletetemplate.php?name='. $templatez.'&type=1">X</a>';} else {echo '<a class="downlink" onclick="return  confirm(\'Are you sure you want to delete the template?\')" title="Delete" href="deletetemplate.php?name='. $templatez.'&type=1">X</a>';};
		
		echo '</td>';
		echo '</tr>';
	};
	foreach($privtemplatezz as $privtemplatezz) {
		++$zzyy;
		echo '<tr>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		echo $privtemplatezz;
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		if ($_SESSION['lang'] == "1") {echo 'Скрытый';} else {echo 'Hidden';};
		echo '</td>';
		if ($zzyy % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
		if ($_SESSION['lang'] == "1") {echo '<a class="downlink" onclick="return  confirm(\'Вы уверены что хотите удалить шаблон?\')" title="Delete" href="deletetemplate.php?name='. $privtemplatezz.'&type=2">X</a>';} else {echo '<a class="downlink" onclick="return  confirm(\'Are you sure you want to delete the template?\')" title="Delete" href="deletetemplate.php?name='. $privtemplatezz.'&type=2">X</a>';};
		
		echo '</td>';
		echo '</tr>';
	};
	echo '</table>';
	};
	?>
	</div>
		<?php endif; ?>
		<?php if (($_SESSION['creating_template']) == 1) : ?>
		<hr class="space">
		<div style="min-width: 500px;" class="creatingtemplateform">
		<h1 style="text-align: center; font-family: yanonereg;"><?php if ($_SESSION['lang'] == "1") {echo 'ВТОРОЙ ЭТАП';} else {echo 'SECOND STEP';}; ?></h1><form method="post" action=""><input class="changeoldopt" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo '(Изменить предыдущие параметры)';} else {echo '(Change previous settings)';}; ?>" name="clear_creating_template"></form>
		<hr style="margin: 5px 0;">
		<div class="darkline">
		<p><?php if ($_SESSION['lang'] == "1") {echo 'Выбранное название шаблона';} else {echo 'Selected name of template';}; ?>: "<?php echo $_SESSION['nameoftemplate'];?>"</p>
		</div>
		<hr style="margin: 5px 0;">
		<div class="grayline">
		<p><?php if ($_SESSION['lang'] == "1") {echo 'Выбранное количество строк на замену';} else {echo 'Selected value of strings to change';}; ?>: "<?php echo $_SESSION['valueofstrings'];?>"</p>
		</div>
		<hr style="margin: 5px 0;">
		<div class="darkline">
		<form method="post"  enctype="multipart/form-data" action="">
		<h4><?php if ($_SESSION['lang'] == "1") {echo 'Выберите подготовленныый файл шаблона документа';} else {echo 'Select ready template of document';}; ?>:</h4>
		<input required accept=".docx" name="templatedocument" type="file">
		</div>
		<hr style="margin: 5px 0;">
		<div class="grayline">
		<h4 style="margin-bottom: 10px;"><?php if ($_SESSION['lang'] == "1") {echo 'Заполните поля строк которые следует заменять при создании документа, их описание и тип';} else {echo 'Fill in the fields of the lines to be replaced when creating the document, their description and type';}; ?>:</h4>
		<?php
		for ($d = 1; $d <= $_SESSION['valueofstrings']; $d++)
		  {
			if ($_SESSION['lang'] == "1") { echo 'Строка #' . $d . '  <input  required placeholder="ПРИМЕР_СТРОКИ" name="stringtochange'.$d.'" type="text"> Описание строки:  <input required placeholder="Пример описания" name="infostringtochange'.$d.'" type="text"> Тип: 
		  <select required name="selected'.$d.'">
		  <option value="date">Дата</option>
		  <option value="number">Число</option>
		  <option value="text">Текст</option>
		  <option value="workname">Название системы</option>
		  <option value="systemname">Подпись системы</option>
		  <option value="userfio">ФИО пользователя</option>
		  <option value="currentdate">Текущая дата</option>
		  <option value="idofdocument">Номер документа</option>
	      </select>
		  <hr class="space">';} else { echo 'String #' . $d . '  <input  required placeholder="EXAMPLE_STRING" name="stringtochange'.$d.'" type="text"> Description of string:  <input required placeholder="Exampla of description" name="infostringtochange'.$d.'" type="text"> Type: 
		  <select required name="selected'.$d.'">
		  <option value="date">Date</option>
		  <option value="number">Value</option>
		  <option value="text">Text</option>
		  <option value="workname">Name of system</option>
		  <option value="systemname">Signature of the system</option>
		  <option value="userfio">User\'s fullname</option>
		  <option value="currentdate">The current date</option>
		  <option value="idofdocument">Document Number</option>
	      </select>
		  <hr class="space">';};
		 
		  };
		?>
			</div>
		<input style="margin-top: 5px;" type="submit" class="template_next_step_two" name="template_next_step_two">
		</div>
		</form>
		<?php endif; ?>
	</div>
	</div>
	</div>
	
	
<?php endif; ?>
<?php if ($user['group'] == "admin") : ?>

	<div id="adm">
		<div class="pageword"><p><?php if ($_SESSION['lang'] == "1") {echo 'Администрирование';} else {echo 'Administrating';}; ?></p></div>
			<div class="tab">
			<button class="tablinks" onclick="openTab(event, 'optiontab')" id="defaultOpen"><?php if ($_SESSION['lang'] == "1") {echo 'Параметры сайта';} else {echo 'Site options';}; ?></button>
			<button class="tablinks" onclick="openTab(event, 'codetab')"><?php if ($_SESSION['lang'] == "1") {echo 'Коды регистрации';} else {echo 'Registration codes';}; ?></button>
			<button class="tablinks" onclick="openTab(event, 'userstab')"><?php if ($_SESSION['lang'] == "1") {echo 'Пользователи';} else {echo 'Users';}; ?></button>
			<button class="tablinks" onclick="openTab(event, 'erasetab')"><?php if ($_SESSION['lang'] == "1") {echo 'Сброс системы';} else {echo 'System reset';}; ?></button>
			</div>
		
			<div id="userstab" class="tabcontent" style=" display: table;">
			<div class="bigger">
			<hr class="space">
			<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Информация об аккаунтах пользователей';} else {echo 'Information about user accounts';}; ?></h2></div>
			<hr class="space">
			<div style="height: 28px;"><p style="font: normal 22px yanonereg; width: 100px; padding: 0; margin: 0 20px 0 0; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'ПОЛЬЗОВАТЕЛЬ';} else {echo 'USER';}; ?></p>
			<select id="selectItemT" class="js-example-basic-single" style="height: 28px; margin-left: 20px; float: left; width: 200px;">
			
					<?php
						$admuserslists = R::findAll($tableprefix.'_users', 'WHERE login != ?', array($_SESSION['logged_user']));
						foreach($admuserslists as $admuserslist) {
						echo '<option id="'.str_replace(" ", "_", $admuserslist['login']).'">'.$admuserslist['login'].'</option>';
						};
					?>
			</select>
			</div>
			<hr class="space">
			<div class="templateblock2">
			<?php
			if ($_SESSION['lang'] == "1") {foreach($admuserslists as $admuserslist) {
			echo '<div style="font: normal 18px yanonereg; margin-right: 10px; text-allign: center; border: 2px solid gray; padding: 10px;" class="'.str_replace(" ", "_", $admuserslist['login']).'" style="position: absolute;">';
			echo '<p class="grayline"><span class="bold">Инициалы: </span><span class="coso">'.$admuserslist['fio'].'</span></p><br>';
			echo '<p class="darkline"><span class="bold">Логин: </span><span class="coso">'.$admuserslist['login'].'</span></p><br>';
			echo '<p class="grayline"><span class="bold">Электронная почта: </span><span class="coso">'.$admuserslist['email'].'</span></p><br>';
			if ($admuserslist['telnumber'] == "") {echo '<p class="grayline"><span class="bold">Номер телефона: </span><span class="coso">Не указан</span></p><br>';} else if ($admuserslist['telnumber'] == "none") {echo '<p class="grayline"><span class="bold">Номер телефона: </span><span class="coso">Отсутствует</span></p><br>';} else {
			echo '<p class="grayline"><span class="bold">Номер телефона: </span><span class="coso">'.$admuserslist['telnumber'].'</span></p><br>';};
			echo '<p class="darkline"><span class="bold">Дата и время регистрации: </span><span class="coso">'.date("d-m-Y H:i:s", $admuserslist['join_date']).'</span></p><br>';
			if (!empty($admuserslist['activatedcode'])) {$reggkode = $admuserslist['activatedcode'];} else { $reggkode = 'Не использовался при регистрации';}
			echo '<p class="grayline"><span class="bold">Код регистрации: </span><span class="coso">'.$reggkode.'</span></p><br>';
			if ($admuserslist['group'] == 'default') {$regusergroup = 'Обычный';} else if ($admuserslist['group'] == 'admin') {$regusergroup = 'Администратор';} else if ($admuserslist['group'] == 'moder') {$regusergroup = 'Модератор';};
			echo '<p class="darkline"><span class="bold">Тип аккаунта: </span><span class="coso">'.$regusergroup.'</span> ';
			if ($admuserslist['group'] == 'default') {echo '<a style="margin-left: 8px; font: normal 16px yanonereg; color: brown;" href="makeusergroup.php?name='.$admuserslist['login'].'&doing=1">(присвоить права модератора)</a>';} else if ($admuserslist['group'] == 'moder') {echo '<a style="margin-left: 8px; font: normal 16px yanonereg; color: brown;" href="makeusergroup.php?name='.$admuserslist['login'].'&doing=2">(снять права модератора)</a>';}
			echo '</p>';
			echo '<hr class="space"><span>';
			if ( isset($admuserslist['vk']) && (($admuserslist['vk'] != "") && ($admuserslist['vk'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Страница во Вконтакте" href="https://vk.com/'.$admuserslist['vk'].'"><image class="soclogosvk" src="../images/vklogo.png" width="50"></a>';};
			if ( isset($admuserslist['odnok']) && (($admuserslist['odnok'] != "") && ($admuserslist['odnok'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Страница в Одноклассниках" href="https://ok.ru/'.$admuserslist['odnok'].'"><image class="soclogosok" src="../images/oklogo.png" width="50"></a>';};
			if ( isset($admuserslist['telega']) && (($admuserslist['telega'] != "") && ($admuserslist['telega'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Страница в Телеграме" href="https://t.me/'.$admuserslist['telega'].'"><image class="soclogostelega" src="../images/telegramlogo.png" width="50"></a>';};
			echo '</span>';
			echo '</div>';
			};} else {foreach($admuserslists as $admuserslist) {
			echo '<div style="font: normal 18px yanonereg; margin-right: 10px; text-allign: center; border: 2px solid gray; padding: 10px;" class="'.str_replace(" ", "_", $admuserslist['login']).'" style="position: absolute;">';
			echo '<p class="grayline"><span class="bold">Fullname: </span><span class="coso">'.$admuserslist['fio'].'</span></p><br>';
			echo '<p class="darkline"><span class="bold">Login: </span><span class="coso">'.$admuserslist['login'].'</span></p><br>';
			echo '<p class="grayline"><span class="bold">Email: </span><span class="coso">'.$admuserslist['email'].'</span></p><br>';
			if ($admuserslist['telnumber'] == "") {echo '<p class="grayline"><span class="bold">Telephone number: </span><span class="coso">Не указан</span></p><br>';} else if ($admuserslist['telnumber'] == "none") {echo '<p class="grayline"><span class="bold">Telephone number: </span><span class="coso">Отсутствует</span></p><br>';} else {
			echo '<p class="grayline"><span class="bold">Telephone number: </span><span class="coso">'.$admuserslist['telnumber'].'</span></p><br>';};
			echo '<p class="darkline"><span class="bold">Date and time of registration: </span><span class="coso">'.date("d-m-Y H:i:s", $admuserslist['join_date']).'</span></p><br>';
			if (!empty($admuserslist['activatedcode'])) {$reggkode = $admuserslist['activatedcode'];} else { $reggkode = 'Not used when registering';}
			echo '<p class="grayline"><span class="bold">Registration code: </span><span class="coso">'.$reggkode.'</span></p><br>';
			if ($admuserslist['group'] == 'default') {$regusergroup = 'Default';} else if ($admuserslist['group'] == 'admin') {$regusergroup = 'Administrator';} else if ($admuserslist['group'] == 'moder') {$regusergroup = 'Moderator';};
			echo '<p class="darkline"><span class="bold">Type of account: </span><span class="coso">'.$regusergroup.'</span> ';
			if ($admuserslist['group'] == 'default') {echo '<a style="margin-left: 8px; font: normal 16px yanonereg; color: brown;" href="makeusergroup.php?name='.$admuserslist['login'].'&doing=1">(assign moderator rights)</a>';} else if ($admuserslist['group'] == 'moder') {echo '<a style="margin-left: 8px; font: normal 16px yanonereg; color: brown;" href="makeusergroup.php?name='.$admuserslist['login'].'&doing=2">(off rights of the moderator)</a>';}
			echo '</p>';
			echo '<hr class="space"><span>';
			if ( isset($admuserslist['vk']) && (($admuserslist['vk'] != "") && ($admuserslist['vk'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Page at VK.COM" href="https://vk.com/'.$admuserslist['vk'].'"><image class="soclogosvk" src="../images/vklogo.png" width="50"></a>';};
			if ( isset($admuserslist['odnok']) && (($admuserslist['odnok'] != "") && ($admuserslist['odnok'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Page at OK.RU" href="https://ok.ru/'.$admuserslist['odnok'].'"><image class="soclogosok" src="../images/oklogo.png" width="50"></a>';};
			if ( isset($admuserslist['telega']) && (($admuserslist['telega'] != "") && ($admuserslist['telega'] != "none"))) {echo '<a target="_blank" style="margin-right: 10px;" title="Account at Telegram" href="https://t.me/'.$admuserslist['telega'].'"><image class="soclogostelega" src="../images/telegramlogo.png" width="50"></a>';};
			echo '</span>';
			echo '</div>';
			};};
			
			?>
			</div>
			</div>
			</div>
			
			<div id="codetab" class="tabcontent">
				<div class="bigger">
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Генерация кодов регистрации';} else {echo 'Generation of registration codes';}; ?></h2></div>
				<hr class="space">
				<div>
				<form method="post" action="" class="erasesystem" style="width: 48%; float: left; text-align: center;">
					<h2><?php if ($_SESSION['lang'] == "1") {echo 'Обычные коды';} else {echo 'Simple codes';}; ?>:</h2>
				<label for="valueofregcodes"><?php if ($_SESSION['lang'] == "1") {echo 'Количество кодов для регистрации';} else {echo 'Value of registration codes';}; ?>:</label><input style="margin-left: 10px; width: 50px;" required id="valueofregcodes" min="1" value="1" type="number" name="valueofregcodes">
					<p><?php if ($_SESSION['lang'] == "1") {echo 'Пример генерируемого кода';} else {echo 'Example of generating code';}; ?>: <?php $wtz = uniqid('', true); echo $wtz; ?></p>
				<input style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 205px;" name="generateregcodes" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Сгенерировать';} else {echo 'Generate';}; ?>">
				<?php if (isset($_POST['generateregcodes'])) : ?>
					<hr class="space2">
					<p style = "font: normal 20px yanonereg;"><?php if ($_SESSION['lang'] == "1") {echo 'Список сгенерированных кодов';} else {echo 'List of generated codes';}; ?>:</p>
					<table class="tftable" border="1">
					<?php if ($_SESSION['lang'] == "1") {echo '<tr><th>№</th><th>Код</th></tr>';} else {echo '<tr><th>№</th><th>Code</th></tr>';}; ?>
					
					<?php
					for ($d = 1; $d <= $_POST['valueofregcodes']; $d++) {
					++$zzxx;
					$generatedcode = uniqid('', true);
					$kod = R::xdispense($tableprefix.'_invites');
					$kod->kod=$generatedcode;
					$kod->type="default";
					$kod->status=0;
					R::store($kod);
					echo '<tr>';
					if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
					echo '<div>'.$d.'</div>';
					echo '</td>';
					if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
					echo '<div>'.$generatedcode.'</div>';
					echo '</td>';
					echo '</tr>';
					};
					?>
					</tr>
					</table>
					
				<?php if ($_SESSION['lang'] == "1") {$_SESSION['admnoerrors'] = '<div id="admnoerrors">Новые коды сгенерированы. Список находится во вкладке "Коды регистрации".</div>';} else {$_SESSION['admnoerrors'] = '<div id="admnoerrors">New codes are generated. The list is in the "Registration codes" tab.</div>';};   endif; ?>
				</form>
				<form method="post" action="" class="erasesystem" style="width: 48%; float: right; text-align: center;">
				<?php $thespecialkodik = R::findOne($tableprefix.'_invites', 'type = ?', array('special'));?>
					<h2><?php if ($_SESSION['lang'] == "1") {echo 'Специальный код';} else {echo 'Special code';}; ?>:</h2>
				<label for="specialkodik"><?php if ($_SESSION['lang'] == "1") {echo 'Текущий';} else {echo 'Curent';}; ?>:</label><input style="margin-left: 10px; width: 200px;" required id="specialkodik" <?php if (isset($thespecialkodik['kod'])) {echo 'value="'.$thespecialkodik['kod'].'"';}?> placeholder="<?php if (!isset($thespecialkodik['kod'])) {if ($_SESSION['lang'] == "1") { echo 'Отключён';} else { echo 'Disabled';};}?>" type="text" name="specialkodik">
					<p><?php if ($_SESSION['lang'] == "1") {echo 'Не блокируется после использования';} else {echo 'Not blocks after use';}; ?>.</p>
				<input style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 102px;" name="updatespecialkodik" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Обновить';} else {echo 'Update';}; ?>"><input style="background-color: rgba(78,78,78,0.3); margin-left: 3px; height: 26px; width: 102px;" name="disablespecialkodik" type="submit" value="<?php if ($_SESSION['lang'] == "1") {echo 'Отключить';} else {echo 'Disable';}; ?>">
				</form>
				</div>
			</div>
			<div class="bigger">
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Существующие коды';} else {echo 'Existing codes';}; ?></h2></div>
				<hr class="space">
				<div  class="erasesystem">
				
				<?php $allregcodes =  R::getAll( 'SELECT * FROM '.$tableprefix.'_invites' );
					if (empty($allregcodes)) {if ($_SESSION['lang'] == "1") {echo '<p class="grayline" style="color: black;">Нет сгенерированных кодов.</p>';} else {echo '<p class="grayline" style="color: black;">No generated codes.</p>';};  } else {
					if ($_SESSION['lang'] == "1") {echo '<table class="tftable" border="1">
					<tr><th>Код</th><th>Статус</th><th>Тип</th></tr>';} else {echo '<table class="tftable" border="1">
					<tr><th>Code</th><th>Status</th><th>Type</th></tr>';};
					
					foreach( $allregcodes as $allregcode) {
					++$zzxx;
					if ($allregcode['status'] == "0") {if ($_SESSION['lang'] == "1") {$regcodestatus = '<div>Не активирован</div>';} else {$regcodestatus = '<div>Not activated</div>';}; } else {if ($_SESSION['lang'] == "1") {$regcodestatus = '<div style="background-color: rgba(229,19,0,0.51)">Активирован';} else {$regcodestatus = '<div style="background-color: rgba(229,19,0,0.51)">Activated';};  };
					if ($allregcode['type'] == "special") {if ($_SESSION['lang'] == "1") {$regcodetype = '<div style="background-color: gold;">Специальный</div>';} else {$regcodetype = '<div style="background-color: gold;">Special</div>';};  } else {if ($_SESSION['lang'] == "1") {$regcodetype = '<div>Обычный</div>';} else {$regcodetype = '<div>Default</div>';};};
					echo '<tr>';
					if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
					echo '<div>'.$allregcode['kod'].'</div>';
					echo '</td>';
					if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
					echo $regcodestatus;
					echo '</td>';
					if ($zzxx % 2 == 0) {echo '<td style="background: gainsboro;">';} else {{echo '<td style="background: #E4E4FF;">';};};
					echo $regcodetype;
					echo '</td>';
					echo '</tr>';
					};
					echo '</table>';
					};
				?>
				
				</div>
			</div>	
			</div>	
			
			<div id="erasetab" class="tabcontent">
			<div class="bigger">
			<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Сброс';} else {echo 'Reset';}; ?></h2></div>
				<hr class="space">
			<?php if ($_SESSION['lang'] == "1") {echo '<p style = "font: normal 16px yanonereg;">На этой вкладке можно выбрать параметры для сброса системы. После завершения процедуры система вернется к первоначальному (в зависимости от выбранных параметров) состоянию до её настройки. Прежние таблицы останутся в базе данных, вы сможете их использовать снова по желанию.<span style="border-bottom: 1px solid black;"> Удалённые данные невозможно вернуть, помните это.</span></p>';} else {echo '<p style = "font: normal 16px yanonereg;">On this tab, you can select the parameters to reset the system. After the procedure is completed, the system will return to the initial state (depending on the selected parameters) before setting it. The former tables will remain in the database, you can use them again at will.<span style="border-bottom: 1px solid black;"> Deleted data can not be returned, remember this.</span></p>';}; ?>
			
			</div>
				<hr class="space">
				
			<?php if ($_SESSION['lang'] == "1") : ?>
<form method="post" action="" class="erasesystem">
				<h3>Я хочу удалить:</h3>
				<hr class="space">
				<ul class="vibordelete">
				<li class="nolist"><input id="deluserdocsfromsystem" name="deluserdocsfromsystem" value="1" type="checkbox"><label for="deluserdocsfromsystem">Документы всех пользователей</label></li>
				<li class="nolist"><input id="deluserinfofromsystem" name="deluserinfofromsystem" value="2" type="checkbox"><label for="deluserdocsfromsystem">Данные пользователей</label></li>
				<li class="nolist"><input id="delarchfromsystem" name="delarchfromsystem" value="2" type="checkbox"><label for="deluserdocsfromsystem">Документы из скрытого архива</label></li>
				<li class="nolist"><input id="deltemplatesfromsystem" name="deltemplatesfromsystem" value="3" type="checkbox"><label for="deltemplatesfromsystem">Все шаблоны документов</label></li>
				<li class="nolist"><input id="delnewsfromsystem" name="delnewsfromsystem" value="5" type="checkbox"><label for="deltemplatesfromsystem">Все новости и картинки к ним</label></li>
				<li class="nolist"><input id="delpicsfromsystem" name="delpicsfromsystem" value="4" type="checkbox"><label for="delpicsfromsystem">Фавикон и логотипы</label></li>
				</ul>
				<hr class="space">
				<h4>Помимо выбранных параметров будут удалены:</h4>
				<ul>
				<li>Все коды регистрации</li>
				<li>История IP-адресов пользователя</li>
				<li>Изменения стандартных параметров системы</li>
				<li>Название предприятия\системы</li>
				<li>Почта системы</li>
				<li>Сведения о количестве созданных документов</li>
				<li>Списки исполнительных документов</li>
				</ul>
				<hr class="space">
				<input onclick="return  confirm('Вы уверены что хотите сбросить систему с выбранными параметрами?')" style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 320px;" name="erasesystemm" type="submit" value="Вернуть систему к первоначальному состоянию">
			</form>
			<? else : ?>
<form method="post" action="" class="erasesystem">
				<h3>I want to delete:</h3>
				<hr class="space">
				<ul class="vibordelete">
				<li class="nolist"><input id="deluserdocsfromsystem" name="deluserdocsfromsystem" value="1" type="checkbox"><label for="deluserdocsfromsystem">All user's documents</label></li>
				<li class="nolist"><input id="deluserinfofromsystem" name="deluserinfofromsystem" value="2" type="checkbox"><label for="deluserdocsfromsystem">All user's data</label></li>
				<li class="nolist"><input id="delarchfromsystem" name="delarchfromsystem" value="2" type="checkbox"><label for="deluserdocsfromsystem">All documents from hidden archive</label></li>
				<li class="nolist"><input id="deltemplatesfromsystem" name="deltemplatesfromsystem" value="3" type="checkbox"><label for="deltemplatesfromsystem">All document's templates</label></li>
				<li class="nolist"><input id="delnewsfromsystem" name="delnewsfromsystem" value="5" type="checkbox"><label for="deltemplatesfromsystem">All news and their pictures</label></li>
				<li class="nolist"><input id="delpicsfromsystem" name="delpicsfromsystem" value="4" type="checkbox"><label for="delpicsfromsystem">Favicon and logotypes</label></li>
				</ul>
				<hr class="space">
				<h4> In addition to the selected parameters, the following will be deleted: </ h4>
				<ul>
				<li> All registration codes </li>
				<li> User's IP history </li>
				<li> Changes to standard system's settings </li>
				<li> Company's / System's Name </li>
				<li> System's email </li>
				<li> Information about the number of documents created </li>
				<li> Lists of executive documents </li>
				</ul>
				<hr class="space">
				<input onclick="return  confirm('Are you sure that you want to reset the system with the selected parameters?')" style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 320px;" name="erasesystemm" type="submit" value="Return the system to its original state">
			</form>
			<? endif; ?>
			
			</div>	
			
			<div id="optiontab" class="tabcontent">
			<?php if (isset($_SESSION['admnoerrors'])) {echo $_SESSION['admnoerrors']; unset($_SESSION['admnoerrors']);}; ?>
				<div class="bigger">
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Основные параметры';} else {echo 'Main settings';}; ?></h2></div>
				<hr class="space">
				<hr>
					
					
				<div class="grayline" style="position: relative; height: 28px;">
					<div class="bold" style="height: 28px; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Название предприятия/системы';} else {echo 'Company\'s / System\'s Name';}; ?>: <span class="coso" style="font-weight: normal;"><?php echo $sitename; ?></span></div>
					<input type="checkbox" id="sitename-trigger" class="sitename-trigger"/><label title="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить название предприятия/системы';} else {echo 'Change Company\'s / System\'s Name';}; ?>" class="changesitenamelabel" for="sitename-trigger">&#160&#160&#160&#160&#160&#160&#160&#160&#160</label>
					<div class="changesitenameinput">
						<form method="POST">
						<input id="newsitenameinp" required minlength="2" maxlength="14" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Новое название';} else {echo 'New name';}; ?>" style="height: 18px; width: 135px;" name="newsitename" type="text"/>
						<input type="submit" style="height: 18px; width: 110px;" name="updatesitename" value="<?php if ($_SESSION['lang'] == "1") {echo 'Обновить';} else {echo 'Update';}; ?>"/>
						</form>
					</div>
				</div>
				<div class="darkline" style="position: relative; height: 28px;">
					<div class="bold" style="height: 28px; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Почта системы';} else {echo 'System\'s email';}; ?>: <span class="coso" style="font-weight: normal;"><?php echo $sitemail; ?></span></div>
					<input type="checkbox" id="sitemail-trigger" class="sitemail-trigger"/>
					<label title="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить почту системы';} else {echo 'Change system\'s email';}; ?>" class="changesitemaillabel" for="sitemail-trigger">&#160&#160&#160&#160&#160&#160&#160&#160&#160</label>
					<div class="changesitemailinput">
						<form method="POST">
						<input id="newsitemailinp" required placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Новая почта';} else {echo 'New email';}; ?>" style="height: 18px; width: 135px;" name="newsitemail" type="email"/>
						<input type="submit" style="height: 18px; width: 110px;" name="updatesitemail" value="<?php if ($_SESSION['lang'] == "1") {echo 'Обновить';} else {echo 'Update';}; ?>"/>
						</form>
					</div>
				</div>
				</div>
				<div class="grayline" style="position: relative; height: 28px;">
				<div class="bold" style="height: 28px; float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Префикс таблиц';} else {echo 'Tables\'s prefix';}; ?>: <span class="coso" style="font-weight: normal;"><?php echo $tableprefix; ?></span></div>
				</div>
				<div class="bigger">
				<hr class="space">
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Изображения';} else {echo 'Images';}; ?></h2></div>
				<hr class="space">
				<hr>
				<div class="darkline" style="position: relative; height: 60px;">
				<span class="bold" style="display: table-cell; vertical-align: middle; height: 50px; float: left; padding-top: 15px;"><?php if ($_SESSION['lang'] == "1") {echo 'Фавикон';} else {echo 'Favicon';}; ?>: </span>
				<img style="outline: 1px dotted gray; float: left; margin-left: 10px;" src="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {echo '../images/userpics/userfavicon.png';} else {echo '../images/favicon.png';}; ?>" height="50px">
				<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {if ($_SESSION['lang'] == "1") {echo '<form action="" method="post"><input class="makedefaultimage" type="submit" name="delfavicon" value=" " title="Вернуть стандартный"/></form>';} else {echo '<form action="" method="post"><input class="makedefaultimage" type="submit" name="delfavicon" value=" " title="Make default"/></form>';}; };?>
				<input type="checkbox" id="favicon-trigger" class="favicon-trigger"/><label title="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить фавикон';} else {echo 'Change favicon';}; ?>" class="changefaviconlabel" for="favicon-trigger">&#160&#160&#160&#160&#160&#160&#160&#160&#160</label>
				<div class="changesitefaviconinput">
						<form method="POST" enctype="multipart/form-data">
						<input id="newsitefaviconinp" required style="height: 21px; width: 221px;" name="newsitefavicon" type="file" accept="image/*"/>
						<input type="submit" style="height: 21px; width: 110px;" name="updatesitefavicon" value="<?php if ($_SESSION['lang'] == "1") {echo 'Обновить';} else {echo 'Update';}; ?>"/>
						</form>
				</div>
				</div>
				<div class="grayline" style="position: relative; height: 60px;">
				<span class="bold" style="display: table-cell; vertical-align: middle; height: 50px; float: left; padding-top: 15px;"><?php if ($_SESSION['lang'] == "1") {echo 'Логотип';} else {echo 'Logotype';}; ?>: </span>
				<img style="outline: 1px dotted gray; float: left; margin-left: 10px;" src="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogo.png'))) {echo '../images/userpics/userlogo.png';} else {if ($_SESSION['lang'] == "1") {echo '../images/paradocslogo.png';} else {echo '../images/eng_paradocslogo.png';}; }; ?>" height="50px">
				<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogo.png'))) {if ($_SESSION['lang'] == "1") {echo '<form action="" method="post"><input class="makedefaultimage" type="submit" name="dellogo" value=" " title="Вернуть стандартный"/></form>';} else {echo '<form action="" method="post"><input class="makedefaultimage" type="submit" name="dellogo" value=" " title="Make default"/></form>';}; };?>
				<input type="checkbox" id="logo-trigger" class="logo-trigger"/><label title="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить логотип';} else {echo 'Change logotype';}; ?>" class="changelogolabel" for="logo-trigger">&#160&#160&#160&#160&#160&#160&#160&#160&#160</label>
				<div class="changesitelogoinput">
						<form method="POST" enctype="multipart/form-data">
						<input id="newsitelogoinp" required style="height: 21px; width: 221px;" name="newsitelogo" type="file" accept="image/*"/>
						<input type="submit" style="height: 21px; width: 110px;" name="updatesitelogo" value="<?php if ($_SESSION['lang'] == "1") {echo 'Обновить';} else {echo 'Update';}; ?>"/>
						</form>
				</div>
				</div>
				<div class="darkline" style="position: relative; height: 60px;">
				<span class="bold" style="display: table-cell; vertical-align: middle; height: 50px; float: left; padding-top: 15px;"><?php if ($_SESSION['lang'] == "1") {echo 'Малый логотип';} else {echo 'Little logotype';}; ?>: </span>
				<img style="outline: 1px dotted gray; float: left; margin-left: 10px;" src="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogolittle.png'))) {echo '../images/userpics/userlogolittle.png';} else {if ($_SESSION['lang'] == "1") {echo '../images/paradocslogolittle.png';} else {echo '../images/eng_paradocslogolittle.png';}; }; ?>" height="50px">
				<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogolittle.png'))) {if ($_SESSION['lang'] == "1") {echo '<form action="" method="post"><input class="makedefaultimage" type="submit" name="deldoplogo" value=" " title="Вернуть стандартный"/></form>';} else {echo '<form action="" method="post"><input class="makedefaultimage" type="submit" name="deldoplogo" value=" " title="Make default"/></form>';};  };?>
				<input type="checkbox" id="littlelogo-trigger" class="littlelogo-trigger"/><label title="<?php if ($_SESSION['lang'] == "1") {echo 'Изменить дополнительный логотип';} else {echo 'Change additional logotype';}; ?>" class="changelittlelogolabel" for="littlelogo-trigger">&#160&#160&#160&#160&#160&#160&#160&#160&#160</label>
				<div class="changesitelittlelogoinput">
						<form method="POST" enctype="multipart/form-data">
						<input id="newsitelittlelogoinp" required style="height: 21px; width: 221px;" name="newsitelittlelogo" type="file" accept="image/*"/>
						<input type="submit" style="height: 21px; width: 110px;" name="updatesitelittlelogo" value="<?php if ($_SESSION['lang'] == "1") {echo 'Обновить';} else {echo 'Update';}; ?>"/>
						</form>
				</div>
				</div>
				</div>
				<div class="bigger">
				<hr class="space">
				<hr class="space">
				<div style=" display: table; margin: 0 auto; float: left; background: rgba(0,0,150,0.20); font-family: yanonereg; border: 2px dashed black; border-radius: 0 10px 10px 0 ; padding: 4px 6px;"><h2><?php if ($_SESSION['lang'] == "1") {echo 'Опции';} else {echo 'Options';}; ?></h2></div>
				<hr class="space">
				<hr>
				<form action="" method="post">
				<div class="grayline" style="position: relative; height: 32px;">
				<div class="bold" style="float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Пропускать главную страницу';} else {echo 'Disable main page';}; ?>:</div><div style="float: left; margin-left: 5px;"><input class="admchb" type="checkbox" name="disablemainpage" <?php if ($mainpagestatus == '0') {echo 'checked';} ?> title="<?php if ($_SESSION['lang'] == "1") {echo 'Выключить\\Включить';} else {echo 'OFF\\ON';}; ?>"/></div>
				</div>
				<div class="darkline" style="position: relative; height: 32px;">
				<div class="bold" style="float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Использовать инициалы для авторизации вместо логина';} else {echo 'Use fullname instead of login to authorize';}; ?>:</div><div style="float: left; margin-left: 5px;"><input class="admchb" type="checkbox" name="disableloginauth" <?php if ($loginauth == '0') {echo 'checked';} ?> title="<?php if ($_SESSION['lang'] == "1") {echo 'Выключить\\Включить';} else {echo 'OFF\\ON';}; ?>"/></div>
				</div>
				<div class="grayline" style="position: relative; height: 32px;">
				<div class="bold" style="float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Не использовать фразу восстановления для восстановления доступа к аккаунту';} else {echo 'Do not use the recovery phrase to restore access to account';}; ?>:</div><div style="float: left; margin-left: 5px;"><input class="admchb" type="checkbox" name="disablesecretword" <?php if ($secretwordmethod == '0') {echo 'checked';} ?> title="<?php if ($_SESSION['lang'] == "1") {echo 'Выключить\\Включить';} else {echo 'OFF\\ON';}; ?>"/></div>
				</div>
				<div class="darkline" style="position: relative; height: 32px;">
				<div class="bold" style="float: left;"><?php if ($_SESSION['lang'] == "1") {echo 'Отключить регистрацию по кодам';} else {echo 'Disable registration by codes';}; ?>:</div><div style="float: left; margin-left: 5px;"><input class="admchb" type="checkbox" name="disablecodes" <?php if ($registerbycode == '0') {echo 'checked';} ?> title="<?php if ($_SESSION['lang'] == "1") {echo 'Выключить\\Включить';} else {echo 'OFF\\ON';}; ?>"/></div>
				</div>
				
				<hr class="space">
				<input type="submit" style="background-color:rgba(255,0,4,0.36); margin-left: 3px; height: 26px; width: 216px;" name="save_more_admin" value="<?php if ($_SESSION['lang'] == "1") {echo 'Применить изменения';} else {echo 'Apply changes';}; ?>">
				</form>
				
				</div>
				</div>
	
	</div>
<?php endif; ?>
<script> src="../libs/scripts/autosize/autosize.js"</script>
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/select/select.php')); ?> <!-- Скрипт селектов -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/select2/select2.php')); ?> <!-- Скрипт селектов -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/tabs/defaultopen.php')); ?> <!-- Скрипт вкладок -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/spoiler/spoiler.php')); ?> <!-- Скрипт вкладок -->
</div>
<?php else : ?>
<?php if (empty($_SESSION['lang'])) {$_SESSION['lang'] = $systemlang;}; ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Авторизация';} else {echo 'Log in';}; ?></title>
</head>
<body>
<?php
$account_data=$_POST;
	if(isset($account_data['do_login']))
	{
		$errors = array();
		if ($loginauth == "0") {$user = R::findOne($tableprefix.'_users', 'fio = ?', array($account_data['login']));} else
		{$user = R::findOne($tableprefix.'_users', 'login = ?', array($account_data['login']));}
		if( $user)
		{
			if(password_verify($account_data['password'], $user->password))
			{
				$_SESSION['logged_user'] = $user['login'];
				include("geo/SxGeo.php");
				$SxGeo = new SxGeo('geo/SxGeo.dat');
				$country = $SxGeo->getCityFull($_SERVER['REMOTE_ADDR']);
				$writingip = R::xdispense($tableprefix.'_loginstory');
				$writingip->numip=$_SERVER['REMOTE_ADDR'];
				$writingip->thetime=time();
				$writingip->user=$user['login'];
				if ($_SESSION['lang'] == "1") {$writingip->city=$country['city']['name_ru']; } else {$writingip->city=$country['city']['name_en']; };
				
				R::store($writingip);
				header("Location: ".$_SERVER['HTTP_REFERER']."#ads");
			} else {
				if ($_SESSION['lang'] == "1") {$errors[] = 'Пароль не подходит';} else {$errors[] = 'Wrong password';};
				
			}
		} else
		{
			if ($loginauth == "0") {if ($_SESSION['lang'] == "1") {$errors[] = 'Неправильные инициалы';} else {$errors[] = 'Fullname not valid';}; } else {if ($_SESSION['lang'] == "1") {$errors[] = 'Неправильный логин';} else {$errors[] = 'Login is not valid';}; }
			
		}
		if (!empty($errors)) {
			echo'<div id="errors">'.array_shift($errors).'</div>';
		} 
	}
	?>
<form id="feedback-form" action="" method="POST">
	<div class="changelanginstall">
		<img <?php if ($_SESSION['lang'] == "1") {echo 'style="outline: 1px solid yellow;"';}; ?>  onclick="location.href = '/libs/changelang.php?doing=1'" src="../images/rusflag.jpg"height="30" width="40"> <img <?php if ($_SESSION['lang'] == "2") {echo 'style="outline: 1px solid yellow;"';}; ?> onclick="location.href = '/libs/changelang.php?doing=2'" src="../images/engflag.png"height="30" width="40">
		 <?php if ($_SESSION['lang'] == "1") {echo '<span class="langword">Язык</span>';} else {echo '<span class="langword">Lang</span>';}; ?>
		
</div>
	
	<?php if ($_SESSION['lang'] == "1") : ?>  
<?php if ($mainpagestatus == '1') {echo '<span class="closespan"><a class="close" href="/" title="Вернуться на предыдущую страницу"><img src="../images/close.png" height="30px"></a></span>';} ?>
<? else : ?>
<?php if ($mainpagestatus == '1') {echo '<span class="closespan"><a class="close" href="/" title="Go back"><img src="../images/close.png" height="30px"></a></span>';} ?>
<? endif; ?>
	
	
	<?php if (isset($_SESSION['successrec'])) { 
	echo $_SESSION['successrec'];
	unset($_SESSION['successrec']);} ?>
	<?php if (isset($_SESSION['success'])) {
	echo $_SESSION['success'];
	unset($_SESSION['success']);
	unset($_SESSION['posted']);
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	unset($_SESSION['kod']);
	unset($_SESSION['second_step']);
	unset($_SESSION['word']);
	unset($_SESSION['resend']);
	unset($_SESSION['fio']);
	unset($_SESSION['activatingcode']);} ?>
	<?php if ($_SESSION['lang'] == "1") {echo '<h5 id="formlogo">Авторизация</h5>';} else {echo '<h5 id="formlogo">Log in</h5>';}; ?>
	<hr class="space2"/>
	<?php if ($loginauth == "1") : ?>
	<input pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="inputs" required id="nameFF" title="<?php if ($_SESSION['lang'] == "1") {echo 'Введите логин указанный при регистрации';} else {echo 'Enter login that was specified during registration';}; ?>" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'Логин';} else {echo 'Login';}; ?>" type="text" name="login" value="<?php echo @$account_data['login'];?>">
	<?php else : ?>
	<input pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="inputs" required id="nameFF" title="<?php if ($_SESSION['lang'] == "1") {echo 'Введите ФИО указанные при регистрации';} else {echo 'Enter fullname that was specified during registration';}; ?>" placeholder="<?php if ($_SESSION['lang'] == "1") {echo 'ФИО';} else {echo 'Fullname';}; ?>" type="text" name="login" value="<?php echo @$account_data['login'];?>">
	<?php endif; ?>
	<hr class="space"/>
	<input pattern="^[0-9A-Za-zА-Яа-яЁё\s\S]+$" class="inputs" required id="contactFF" placeholder="****" title="<?php if ($_SESSION['lang'] == "1") {echo 'Введите пароль указанный при регистрации';} else {echo 'Enter password that was specified during registration';}; ?>" type="password" name="password">
	<hr class="space2"/>
	<button id="submitFF" type="submit" name = "do_login"><?php if ($_SESSION['lang'] == "1") {echo 'Войти';} else {echo 'Enter';}; ?></button>
	<hr class="space"/>
	<a id="goreg" href="../signup"><?php if ($_SESSION['lang'] == "1") {echo 'Регистрация';} else {echo 'Register';}; ?></a><a href="recovery.php" id="golost"><?php if ($_SESSION['lang'] == "1") {echo 'Сбросить пароль';} else {echo 'Reset password';}; ?></a>
</form>
<?php endif;  ?>
</body>
</html>