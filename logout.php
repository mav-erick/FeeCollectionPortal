<?php
	require_once '_include/library/functions.php';
    sec_session_start();
	$url = "index.php";
    $_SESSION = array();
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
	unset($_SESSION["uid"]);
    session_destroy();
	jump($url);
?>