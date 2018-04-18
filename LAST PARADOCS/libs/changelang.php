<?php
if (session_status() == PHP_SESSION_NONE) {session_start();};
if ($_GET['doing'] == "1") {$_SESSION['lang'] = "1";} else {$_SESSION['lang'] = "2";};
header("Location: ".$_SERVER['HTTP_REFERER']);
 ?> <!-- Важная штука -->