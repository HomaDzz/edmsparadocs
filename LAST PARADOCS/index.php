<html><head>
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userfavicon.png'))) {echo '../images/userpics/userfavicon.png';} else {echo '../images/favicon.png';}; ?>" type="image/x-icon"> <!-- Фавикон сайта -->
<script src="../libs/scripts/js/jquery-3.3.1.js"></script> <!-- Подключение Ajax -->
<script src="../libs/scripts/js/granim.js"></script> <!-- Подключение Granim -->
<link rel="stylesheet" href="../css/index.css" type="text/css"> <!-- Подключение таблицы стилей главной страницы-->
<link rel="stylesheet" href="../css/fonts.css" type="text/css"> <!-- Подключение таблицы стилей шрифтов -->
<link rel="stylesheet" href="../css/install_form.css" type="text/css"> <!-- Подключение таблицы стилей для формы установки -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/preloader/preloader.php')); ?> <!-- Прелоадер -->
<?php include ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/granim/granim2.php'));?> <!-- Граним -->
<?php if (file_exists($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'))) : ?> <!-- Проверка настроена ли система -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php')); ?> <!-- Важная штука -->
<?php if ($mainpagestatus == "0") {header('Location: /system#ads');}; ?>
<?php if (empty($_SESSION['lang'])) {$_SESSION['lang'] = $systemlang;}; ?>
<title><?php echo $sitename; ?> | <?php if ($_SESSION['lang'] == "1") {echo 'Главная';} else {echo 'Main';}; ?></title>
</head>
<body>
	<div id="wrapper">
		<div class="changelang">
		<img <?php if ($_SESSION['lang'] == "1") {echo 'style="outline: 1px solid yellow;"';}; ?>  onclick="location.href = '/libs/changelang.php?doing=1'" src="../images/rusflag.jpg"height="30" width="40"> <img <?php if ($_SESSION['lang'] == "2") {echo 'style="outline: 1px solid yellow;"';}; ?> onclick="location.href = '/libs/changelang.php?doing=2'" src="../images/engflag.png"height="30" width="40">
		 <?php if ($_SESSION['lang'] == "1") {echo '<span class="langword">Язык</span>';} else {echo '<span class="langword">Lang</span>';}; ?>
		
		</div>
		<div id="textbox">
			<?php if ($_SESSION['lang'] == "1") : ?>  
			<p>© 2018 PARADOCS COMPANY<br>Курсовой проект<br>Система разработана @HomaDzz. Все права защищены. <a title="Страница на Github.com" style="color: black; text-decoration: none;" href="https://github.com/HomaDzz/edmsparadocs">(Github)</a><br><?php if (isset ($_SESSION['logged_user'])) { echo '<span id="logged">Вы авторизованы как '.$_SESSION['logged_user'].'.</span>'; }; ?></p>
			<? else : ?>
			<p>© 2018 PARADOCS COMPANY<br>Course project<br>System created by @HomaDzz. All rights reserved. <a title="Page at Github.com" style="color: black; text-decoration: none;" href="https://github.com/HomaDzz/edmsparadocs">(Github)</a><br><?php if (isset ($_SESSION['logged_user'])) { echo '<span id="logged">You are authorized as '.$_SESSION['logged_user'].'.</span>'; }; ?></p>
			<? endif; ?>
		</div>
		<div id="insidewrap">
			<div id="mainbox">
					<div id="insidecon">
					<img id="mainboxpic" src="<?php if ($_SESSION['lang'] == "1") {$dpicpath = '../images/paradocslogo.png';} else {$dpicpath = '../images/eng_paradocslogo.png';}; if (file_exists($_SERVER['DOCUMENT_ROOT'].('/images/userpics/userlogo.png'))) {echo $dpicpath;} else {echo $dpicpath;}; ?>" height="100px"><div id="vrl"></div><div id="thebut"><a href="/system#ads" id="button"/><?php if ($_SESSION['lang'] == "1") {echo 'Войти в систему';} else {echo 'Enter the system';}; ?></a></div>
					</div>
			</div>
		</div>
		<div id="primarybox">
		<a class="links" href="#about"><?php if ($_SESSION['lang'] == "1") {echo 'Система';} else {echo 'System';}; ?></a>   <a class="links" href="#creators"><?php if ($_SESSION['lang'] == "1") {echo 'Разработчики';} else {echo 'Developers';}; ?></a>   <a class="links" href="#help"><?php if ($_SESSION['lang'] == "1") {echo 'Помощь';} else {echo 'Help';}; ?></a>
		</div>
			<div id="about">
				<div id="okno">
					<?php if ($_SESSION['lang'] == "1") {echo '<h1>О системе:</h1>';} else {echo '<h1>About system:</h1>';}; ?>
					<span class="closespan"><a class="close" href="javascript:history.go(-1);" <?php if ($_SESSION['lang'] == "1") {echo 'title="Вернуться на предыдущую страницу"';} else {echo 'title="Back to the last page"';}; ?> ><img src="../images/close.png" height="30px"></a>
					<hr>
					<?php if ($_SESSION['lang'] == "1") : ?>  
					<h1 style="border: none;font-family: yanonereg;">Система управления содержимым «Парадокс»</h1>
					<hr>
					<h2 style="font-family: yanonereg;">СЭД «Парадокс» — это комплексная система управления контентом организации. Позволяет оптимизировать документооборот в организациях разного уровня, величины и формы собственности, а также выполнять множество второстепенных функций упрощающих взаимосвязь между сотрудниками, клиентами и администрацией.<br><br>© 2018 PARADOCS COMPANY</h2>
					<hr class="space">
					<img style="width: 900px; margin: 0 auto;" src="../images/paradocslogo.png">	
					<? else : ?>
					<h1 style="border: none;font-family: yanonereg;">Content management system «Paradocs»</h1>
					<hr>
					<h2 style="font-family: yanonereg;">EDMS «Paradocs» — is a comprehensive content management system for the organization. Allows to optimize the workflow in organizations of different levels, sizes and patterns of ownership, as well as perform many secondary functions simplifying the relationship between employees, customers and administration.<br><br>© 2018 PARADOCS COMPANY</h2>
					<hr class="space">
					<img style="width: 900px; margin: 0 auto;" src="../images/eng_paradocslogo.png">
					<? endif; ?>
					
					</span>
				</div>
			</div>
			<div id="creators">
				<div id="okno1">
					<?php if ($_SESSION['lang'] == "1") {echo '<h1>Команда разработчиков:</h1>';} else {echo '<h1>Team of developers:</h1>';}; ?>
				<span class="closespan"><a class="close" href="javascript:history.go(-1);" <?php if ($_SESSION['lang'] == "1") {echo 'title="Вернуться на предыдущую страницу"';} else {echo 'title="Back to the last page"';}; ?>><img src="../images/close.png" height="30px"></a></span>
					<?php if ($_SESSION['lang'] == "1") : ?>  
					<div id="usblock"> 
						<div id="us1" class="usbox"><img src="../images/almaz.jpg" width="250">
							<p id="names">Асадуллин Алмаз Илгизович</p>
							<p id="rangs"><span style="background-color: gold; padding: 0 5px; border: 2px solid red; border-radius: 5px; margin-bottom:">МЕНЕДЖЕР</span><p>
							<p id="info">Прежде всего руководитель компании, организует работу дружной Команды Парадокс.</p>
						</div>
						<div id="us2" class="usbox"><img src="../images/me.jpg" width="250">
							<p id="names">Осминкин Александр Сергеевич</p>
							<p id="rangs"><span style="background-color: aqua; padding: 0 5px; border: 2px solid red; border-radius: 5px;">ВЕДУЩИЙ ПРОГРАММИСТ</span><p>
							<p id="info">Отвечает за разработку и поддержание работоспособности веб проектов.</p>
						</div>
						<div id="us3" class="usbox"><img src="../images/foma.jpg" width="250">
							<p id="names">Фомкин Александр Тихонович</p>
							<p id="rangs"><span style="background-color: lime; padding: 0 5px; border: 2px solid red; border-radius: 5px;">СПЕЦИАЛИСТ ПО ИБ</span><p>
							<p id="info">Отвечает за программную защиту активных проектов компании.</p>
						</div>
					</div>
					<? else : ?>
					<div id="usblock"> 
						<div id="us1" class="usbox"><img src="../images/almaz.jpg" width="250">
							<p id="names">Asadullin Almaz Ilgizovich</p>
							<p id="rangs"><span style="background-color: gold; padding: 0 5px; border: 2px solid red; border-radius: 5px; margin-bottom:">MANAGER</span><p>
							<p id="info">First of all, the head of the company, organizes the work of the friendly Paradocs Team.</p>
						</div>
						<div id="us2" class="usbox"><img src="../images/me.jpg" width="250">
							<p id="names">Osminkin Aleksandr Sergeevich</p>
							<p id="rangs"><span style="background-color: aqua; padding: 0 5px; border: 2px solid red; border-radius: 5px;">LEAD CODER</span><p>
							<p id="info">Responsible for the development and maintenance of web projects.</p>
						</div>
						<div id="us3" class="usbox"><img src="../images/foma.jpg" width="250">
							<p id="names">Fomkin Aleksandr Tihonovich</p>
							<p id="rangs"><span style="background-color: lime; padding: 0 5px; border: 2px solid red; border-radius: 5px;">SPECIALIST ON IS</span><p>
							<p id="info">Responsible for software protection of active projects of the company.</p>
						</div>
					</div>
					<? endif; ?>
					
				</div>
			</div>
			<div id="help">
				<div id="okno2">
					<?php if ($_SESSION['lang'] == "1") {echo '<h1>Инструкция и помощь:</h1>';} else {echo '<h1>Instructions and help:</h1>';}; ?>
					<span class="closespan"><a class="close" href="javascript:history.go(-1);" <?php if ($_SESSION['lang'] == "1") {echo 'title="Вернуться на предыдущую страницу"';} else {echo 'title="Back to the last page"';}; ?>><img src="../images/close.png" height="30px"></a></span>
					<video width="851" controls poster="../images/prevideo.jpg">
					<?php if ($_SESSION['lang'] == "1") {echo 'Тег Video не поддерживается вашим браузером';} else {echo 'Tag Video not supported in your browser';}; ?>
					<source src="../videos/instruction.mp4"  type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
					</video>
				</div>
			</div>
	</div>
<?php else : ?>
<?php session_start(); ?>
<link rel="stylesheet" href="../css/install_spoiler.css" type="text/css"> <!-- Подключение таблицы стилей шрифтов -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/spoiler/spoiler.php')); ?> <!-- Споилер -->
<?php require ($_SERVER['DOCUMENT_ROOT'].('/libs/scripts/hideslow/hidescript.php')); ?>
<?php if (!isset($_SESSION['lang'])) {$_SESSION['lang'] = "1";}; ?>
<title><?php if ($_SESSION['lang'] == "1") {echo 'ПАРАДОКС | УСТАНОВКА';} else {echo 'PARADOCS | INSTALL';}; ?></title>
</head>
<body>
<div class="changelanginstall">
		<img <?php if ($_SESSION['lang'] == "1") {echo 'style="outline: 1px solid yellow;"';}; ?>  onclick="location.href = '/libs/changelang.php?doing=1'" src="../images/rusflag.jpg"height="30" width="40"> <img <?php if ($_SESSION['lang'] == "2") {echo 'style="outline: 1px solid yellow;"';}; ?> onclick="location.href = '/libs/changelang.php?doing=2'" src="../images/engflag.png"height="30" width="40">
		 <?php if ($_SESSION['lang'] == "1") {echo '<span class="langword">Язык</span>';} else {echo '<span class="langword">Lang</span>';}; ?>
		
	</div>
<?php
$account_data = $_POST;
if (isset($account_data['step_one'])) {
	require ($_SERVER['DOCUMENT_ROOT'].('/libs/rb.php'));
	R::setup('mysql:host='.$account_data['host'].';dbname='.$account_data['name'].'',''.$account_data['user'].'', ''.$account_data['password'].'' );
	$errors = array();
	if (!R::testConnection()) {
		if ($_SESSION['lang'] == "1") {$errors[] = 'Нет подключения к базе данных!';} else {$errors[] = 'No connection to database!';};
		R::close();
	}
	if (!preg_match('|^[A-Za-z0-9]+$|i', $account_data['prefix'])) {
		if ($_SESSION['lang'] == "1") {$errors[] = 'В поле префикса содержатся недопустимые символы. Разрешена только латиница и цифры';} else {$errors[] = '
The prefix field contains invalid characters. Only Latin and numbers are allowed';};
	}
	if (empty($errors)) 
	{
	$_SESSION['pdbhost'] = $account_data['host'];
	$_SESSION['pdbname'] = $account_data['name'];
	$_SESSION['pdbuser'] = $account_data['user'];
	$_SESSION['pdbpass'] = $account_data['password'];
	$_SESSION['pdbpref'] = $account_data['prefix'];
	$_SESSION['checking'] = 1;
	header("Location: ".$_SERVER["REQUEST_URI"]);
	}
	else 
	{
		echo'<div id="errors">'.array_shift($errors).'</div>';
	}
}

if (isset($account_data['step_two'])) {
	require ($_SERVER['DOCUMENT_ROOT'].('/libs/rb.php'));
	if ($account_data['admpassword_2'] !=$account_data['admpassword']) {
		if ($_SESSION['lang'] == "1") {$errors[] = 'Повторный пароль введён неверно';} else {$errors[] = 'Re-entered password is incorrect';};
	}
	if (empty($errors)) 
	{
			R::setup('mysql:host='.$_SESSION['pdbhost'].';dbname='.$_SESSION['pdbname'].'',''.$_SESSION['pdbuser'].'', ''.$_SESSION['pdbpass'].'' );
			R::ext('xdispense', function( $type ){ 
			return R::getRedBean()->dispense( $type ); 
			});
			$connecting = '<?php
			require "rb.php";
			R::setup( \'mysql:host='.$_SESSION['pdbhost'].';dbname='.$_SESSION['pdbname'].'\',\''.$_SESSION['pdbuser'].'\', \''.$_SESSION['pdbpass'].'\' );
			if (session_status() == PHP_SESSION_NONE) {session_start();};
			$tableprefix = \''.$_SESSION['pdbpref'].'\';
			$sitemailopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'sitemail\'));
			$sitemail = $sitemailopt[\'sitevalue\'];
			$sitenameopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'sitename\'));
			$sitename = $sitenameopt[\'sitevalue\'];
			$sitemainpagestatusopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'mainpagestatus\'));
			$mainpagestatus = $sitemainpagestatusopt[\'sitevalue\'];
			$loginauthopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'loginauth\'));
			$loginauth = $loginauthopt[\'sitevalue\'];
			$secretwordmethodopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'secretwordmethod\'));
			$secretwordmethod = $secretwordmethodopt[\'sitevalue\'];
			$registerbycodeopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'registerbycode\'));
			$registerbycode = $registerbycodeopt[\'sitevalue\'];
			$systemlangopt = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'systemlang\'));
			$systemlang = $systemlangopt[\'sitevalue\'];
			$totaldocs = R::findOne($tableprefix.\'_options\', \'siteoption = ?\', array(\'totaldocs\'));
			R::ext(\'xdispense\', function( $type ){ 
			return R::getRedBean()->dispense( $type ); });?>';
			$fp = fopen($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'), 'w');
			$test = fwrite($fp, $connecting);
			fclose($fp);
		
			$siteoptions1 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions1->siteoption="sitename";
			$siteoptions1->sitevalue=$account_data['sitename'];
			R::store($siteoptions1);
		
			$siteoptions2 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions2->siteoption="sitemail";
			$siteoptions2->sitevalue=$account_data['admemail'];
			R::store($siteoptions2);
		
			$siteoptions3 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions3->siteoption="mainpagestatus";
			$siteoptions3->sitevalue=1;
			R::store($siteoptions3);
		
			$siteoptions4 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions4->siteoption="loginauth";
			$siteoptions4->sitevalue=1;
			R::store($siteoptions4);
		
			$siteoptions5 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions5->siteoption="secretwordmethod";
			$siteoptions5->sitevalue=1;
			R::store($siteoptions5);
		
			$siteoptions6 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions6->siteoption="registerbycode";
			$siteoptions6->sitevalue=1;
			R::store($siteoptions6);
			
			$siteoptions7 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions7->siteoption="totaldocs";
			$siteoptions7->sitevalue="0";
			R::store($siteoptions7);
		
			$siteoptions8 = R::xdispense(($_SESSION['pdbpref']).'_options');
			$siteoptions8->siteoption="systemlang";
			$siteoptions8->sitevalue=$_SESSION['lang'];
			R::store($siteoptions8);
		
			$news = R::xdispense($_SESSION['pdbpref'].'_news');
			if ($_SESSION['lang'] == "1") {
			$news->nameofnews="Добро пожаловать";
			$news->dateofnews=date("Y-m-d", time());
			$news->author="Команда Парадокс";
			$news->picofnews="defaultpic";
			$news->mininsideofnews="Здравствуйте, мы рады видеть Вас в нашей системе!<br>Перед началом работы проведите необходимые настройки в панели администратора. Если Вы не задали специальный код, то до тех пор пока не будет изменён режим регистрации или установлен хотя бы один код, пользоваться системой сможете только Вы.<br>Хорошего дня! :)";	
			} else {
			$news->nameofnews="Welcome";
			$news->dateofnews=date("Y-m-d", time());
			$news->author="Paradocs Team";
			$news->picofnews="defaultpic";
			$news->mininsideofnews="Hello, we are glad to see you in our system! <br> Before starting work, make the necessary settings in the admin panel. If you did not specify a special code, then until you change the registration mode or set at least one code, only you can use the system. Have a nice day! :)";
			};
			$news->insideofnews='<img src="../images/sadcat4.png">';
			R::store($news);
		
			$user = R::xdispense(($_SESSION['pdbpref']).'_users');
			$user->login=$account_data['admlogin'];
			$user->fio=$account_data['admlogin'];
			$user->email=$account_data['admemail'];
			$user->group="admin";
			$user->showinco="0";
			$user->password= password_hash($account_data['admpassword'], PASSWORD_DEFAULT);
			$user->join_date=time();
			R::store($user);
		
			if (!empty($account_data['unicode'])) {
			$kod = R::xdispense(($_SESSION['pdbpref']).'_invites');
			$kod->kod=$account_data['unicode'];
			$kod->status=0;
			$kod->type="special";
			R::store($kod);};
			unset($_SESSION['pdbhost']);
			unset($_SESSION['pdbname']);
			unset($_SESSION['pdbuser']);
			unset($_SESSION['pdbpass']);
			unset($_SESSION['pdbpref']);
			unset($_SESSION['checking']);
		
			if (is_uploaded_file($_FILES['favicon']['tmp_name'])) {
			if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'), 0755);};
    		$uploaddir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'));       
    		$prev = $uploaddir.basename('userfavicon.png');
     		copy($_FILES['favicon']['tmp_name'], $prev);
};
			if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
			if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'), 0755);};
    		$uploaddir2 = (($_SERVER['DOCUMENT_ROOT']) . ('/images/userpics/'));       
    		$prev2 = $uploaddir2.basename('userlogo.png');
     		copy($_FILES['logo']['tmp_name'], $prev2);
};
			header("Location: ".$_SERVER["REQUEST_URI"]);
	} else 
	{
		echo'<div id="errors">'.array_shift($errors). '</div>';
	}
};
?>
	
<?php if ($_SESSION['lang'] == "1") : ?>  
	<div class="setupheader"></div>
	<?php if (empty($_SESSION['checking'])) : ?>
	<form id="feedback-form" action=" " method="POST">
	<div id="setupheaderimg"><img align="middle" src="../images/paradocslogo.png" width="410"></div>
	<h5 id="formlogo">Этап 1: Настройка базы данных</h5>
	<hr class="space2">
	<input class="inputs" required placeholder="IP-адрес БД" type="text" name="host">
	<hr class="space"/>
	<input class="inputs" required placeholder="Имя БД" type="text" name="name">
	<hr class="space"/>
	<input class="inputs" required placeholder="Имя пользователя БД" type="text" name="user">
	<hr class="space"/>
	<input class="inputs" required placeholder="Пароль БД" type="password" name="password">
	<hr class="space"/>
	<input class="inputs" required placeholder="Префикс для таблиц в БД" type="text" name="prefix">
	<hr class="space2">
	<button id="submitFF" type="submit" name = "step_one">Продолжить</button>
	</form>
	<?php endif; ?>
	<?php if (!empty($_SESSION['checking'])) : ?>
	<form id="feedback-form" enctype="multipart/form-data" action=" " method="POST" style="min-width: 496px;">
	<div id="setupheaderimg"><img align="middle" src="../images/paradocslogo.png" width="410"></div>
	<h5 id="formlogo">Этап 2: Параметры системы</h5>
	<hr class="space2"/>
	<input class="inputs required" minlength="2" maxlength="14" required placeholder="Название предприятия/системы" title="Будет использоваться в письмах и вкладках" type="text" name="sitename">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Почта системы" title="Адрес который будет указан в системных письмах" type="text" name="admemail">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Логин администратора" type="text" name="admlogin">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Пароль администратора" type="password" name="admpassword_2">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Подтверждение пароля" type="password" name="admpassword">
	<hr class="space2">
	<button id="submitFF" type="submit" name = "step_two">Приступить к работе</button>
	<div class="spoiler-wrapper">
		<div class="spoiler"><a href="javascript:void(0);">Дополнительно*</a></div>
		<div class="spoiler-text">
			<div class="dopblock1"><input class="inputs unicodefield" placeholder="Специальный код" type="text" name="unicode"><a id="what" title="Код по которому можно регистрироваться неограниченное кол-во раз"></a><br><br></div>
			<div class="dopblock" title="Картинка на вкладке"><p>Фавикон:</p>
			<div class="box">
					<input type="file" name="favicon" id="file-1" class="inputfile inputfile-1"/>
					<label for="file-1" class="forfileee"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Выбрать файл</span></label>
			</div>
			</div>
			<div class="dopblock" title="Будет использоваться на некоторых страницах"><p>Логотип:</p>
			<div class="box">
					<input type="file" name="logo" id="file-2" class="inputfile inputfile-1"/>
					<label for="file-2" class="forfileee"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Выбрать файл</span></label>
			</div>
			</div>
			<p style="font-size: 10px;">* - дополнительные параметры не влияют на базовые возможности системы (необязательны)</p>
		</div>
	</div>
	<script src="../libs/scripts/customfileinput/custom-file-input.js"></script>
	</form>
	<?php endif; ?>
<div class="setupfooter"></div>
<? else : ?>
<div class="setupheader"></div>
	<?php if (empty($_SESSION['checking'])) : ?>
	<form id="feedback-form" action=" " method="POST">
	<div id="setupheaderimg"><img align="middle" src="../images/eng_paradocslogo.png" width="410"></div>
	<h5 id="formlogo">Step 1: Configure the database</h5>
	<hr class="space2">
	<input class="inputs" required placeholder="DB's IP-adress" type="text" name="host">
	<hr class="space"/>
	<input class="inputs" required placeholder="DB's name" type="text" name="name">
	<hr class="space"/>
	<input class="inputs" required placeholder="DB's user's name" type="text" name="user">
	<hr class="space"/>
	<input class="inputs" required placeholder="DB's password" type="password" name="password">
	<hr class="space"/>
	<input class="inputs" required placeholder="Prefix for DB's tables" type="text" name="prefix">
	<hr class="space2">
	<button id="submitFF" type="submit" name = "step_one">Continue</button>
	</form>
	<?php endif; ?>
	<?php if (!empty($_SESSION['checking'])) : ?>
	<form id="feedback-form" enctype="multipart/form-data" action=" " method="POST" style="min-width: 496px;">
	<div id="setupheaderimg"><img align="middle" src="../images/eng_paradocslogo.png" width="410"></div>
	<h5 id="formlogo">Step 2: System Settings</h5>
	<hr class="space2"/>
	<input class="inputs required" minlength="2" maxlength="14" required placeholder="Company's / system's name" title="Will be used in letters and tabs" type="text" name="sitename">
	<hr class="space"/>
	<input class="inputs required" required placeholder="System's email" title="The address that will be specified in the system letters" type="text" name="admemail">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Admin's login" type="text" name="admlogin">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Admin's password" type="password" name="admpassword_2">
	<hr class="space"/>
	<input class="inputs required" required placeholder="Repeat password" type="password" name="admpassword">
	<hr class="space2">
	<button id="submitFF" type="submit" name = "step_two">Get to work</button>
	<div class="spoiler-wrapper">
		<div class="spoiler"><a href="javascript:void(0);">Additionally*</a></div>
		<div class="spoiler-text">
			<div class="dopblock1"><input class="inputs unicodefield" placeholder="Special code" type="text" name="unicode"><a id="what" title="The code by which you can register unlimited number of times"></a><br><br></div>
			<div class="dopblock" title="Picture on the tab"><p>Favicon:</p>
			<div class="box">
					<input type="file" name="favicon" id="file-1" class="inputfile inputfile-1"/>
					<label for="file-1" class="forfileee"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Select a file</span></label>
			</div>
			</div>
			<div class="dopblock" title="Will be used on some pages"><p>Logotype:</p>
			<div class="box">
					<input type="file" name="logo" id="file-2" class="inputfile inputfile-1"/>
					<label for="file-2" class="forfileee"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Select a file</span></label>
			</div>
			</div>
			<p style="font-size: 10px;">* - Additional parameters do not affect the basic capabilities of the system (optional)</p>
		</div>
	</div>
	<?php if ($_SESSION['lang'] == "1") : ?>  
	<script src="../libs/scripts/customfileinput/custom-file-input.js"></script>
	<? else : ?>
	<script src="../libs/scripts/customfileinput/eng_custom-file-input.js"></script>
	<? endif; ?>
	</form>
	<?php endif; ?>
<div class="setupfooter"></div>
<? endif; ?>
<?php endif;  ?>
</body>
</html>
