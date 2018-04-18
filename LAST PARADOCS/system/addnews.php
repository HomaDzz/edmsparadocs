<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
$user = R::findOne($tableprefix.'_users', 'login = ?', array($_SESSION['logged_user']));
if (($user['group'] == 'admin') || ($user['group'] == 'moder')) {
	if (is_uploaded_file($_FILES['newspicture']['tmp_name'])) {
			if (!file_exists(($_SERVER['DOCUMENT_ROOT']) . ('/images/newspics/'))) {mkdir(($_SERVER['DOCUMENT_ROOT']) . ('/images/newspics/'), 0755);};
    		$uploaddir = (($_SERVER['DOCUMENT_ROOT']) . ('/images/newspics/'));  
			$picname = md5(rand());
    		$prev = $uploaddir.basename($picname.'.png');
     		copy($_FILES['newspicture']['tmp_name'], $prev);
	} else {$picname = "defaultpic";};
	echo $picname;
$news = R::xdispense($tableprefix.'_news');
$news->nameofnews=$_POST['newsname'];
$news->dateofnews=$_POST['newsdate'];
$news->author=$user['fio'];
$news->picofnews=$picname;
$news->mininsideofnews=$_POST['mininside'];
$news->insideofnews=$_POST['inside'];
R::store($news);
$_SESSION['modersend'] = 3;
if ($_SESSION['lang'] == "1") {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Статья добавлена.</div>';} else {$_SESSION['modnoerrors'] = '<div style="display:block;" id="modnoerrors">Article added.</div>';};
header('Location: http://'.$_SERVER['HTTP_HOST'].'/system/#moderaddnews');
} else {header('Location: http://'.$_SERVER['HTTP_HOST']);};
?>