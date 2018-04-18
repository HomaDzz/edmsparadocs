<?php
require ($_SERVER['DOCUMENT_ROOT'].('/libs/installed.php'));
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
			};
$kek = R::findOne($tableprefix.'_users', 'login =?', array($_SESSION['logged_user']));
if (($kek['group'] == "moder") || ($kek['group'] == "admin")) {
	if ($_GET['type'] == 1) {$erasedir = (($_SERVER['DOCUMENT_ROOT']).('/templates/'.$_GET['name'].'/'));} else {$erasedir = (($_SERVER['DOCUMENT_ROOT']).('/privatetemplates/'.$_GET['name'].'/'));};
	fullRemove_ff($erasedir,1);
	if ($_SESSION['lang'] == "1") {$_SESSION['noerrct'] = '<div style="display:block;" id="noerrct">ШАБЛОН УДАЛЁН.</div>';} else {$_SESSION['noerrct'] = '<div style="display:block;" id="noerrct">TEMPATE WAS REMOVED.</div>';};
	
	header("Location: ".$_SERVER['HTTP_REFERER'].'#templates');
};
?>