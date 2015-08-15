<?php
	require_once 'functions.php';
	sec_session_start();
	if (isset($_POST["login"]) && adc_attack()) {
		$user = san($_POST["username"]);
		$pwd = san($_POST["password"]);
		echo $user.' '.$pwd;
		if (check_login($user, $pwd)) {
			update_login_record();
			if (isset($_SESSION["fail"])) unset($_SESSION["fail"]);
			if (check_admin) jump('cms.php');
		} else {
			if (isset($_SESSION["fail"])) {
				$_SESSION["fail"][0] = time();
				$_SESSION["fail"][1] ++;
			} else {
				$_SESSION["fail"] = array();
				$_SESSION["fail"][0] = time();
				$_SESSION["fail"][1] = 1;
			}
			$_SESSION["shown"] = 0;
			jump($_SERVER["HTTP_REFERER"]);
		}
	} else {
		jump('index.php');
	}
	
	function check_login($user, $pwd) {
		if (! $user || ! $pwd) return false;
		$flag = false;
		try {
			$dbh = initDb();
			$sql = 'SELECT `id`, `is_admin`, `password` FROM `tbl_login` WHERE email = ? AND status = 1';
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array($user));
			while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//	var_dump($res);
			//	echo $res["password"];
				if (password_verify($pwd, $res["password"])) {
					$_SESSION["uid"] = $res["id"];
					$flag = true;
					if ($res["is_admin"] == 1) $_SESSION["uadmin"] = 1;
					else $_SESSION["uadmin"] = 0;
				}
			}
		} catch (PDOException $e) {}
		
		$dbh = null;
		return $flag;
	}
	
	function update_login_record() {
		try {
			$dbh = initDb();
			$sql = 'UPDATE `tbl_login` SET `ip_addr`="'.get_client_ip().'", `uptime` = NOW() WHERE id='.$_SESSION["uid"];
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
		} catch(PDOException $e) {}
		$dbh = null;
	}
?>