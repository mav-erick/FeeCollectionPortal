<?php
	date_default_timezone_set ('Asia/Calcutta');
	function initDb() {
		$db = new PDO('mysql:host=localhost;dbname=drdo;charset=utf8', 'drdo', 'FnEntaznEdyAKVhL');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return $db;
	}
	
	function get_uid_details($arr) {
		try {
			$dbh = initDb();
			$sql = 'SELECT ';
			for ($loop1 = 0; $loop1 < count($arr) - 1; ++$loop1) {
				$sql .= $arr[$loop1].', ';
			}
			$sql .= $arr[$loop1].' FROM tbl_details WHERE uid = '.$_SESSION["uid"];
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_NUM);
		} catch(PDOException $e) {}
		$dbh = null;
		return $res;
	}
	
	function get_last_login() {
		try {
			$sql = 'SELECT ip_addr, DATE_FORMAT(uptime,\'%b %d %Y %h:%i %p\') as time FROM tbl_login WHERE id='.$_SESSION["uid"];
			$dbh = initDb();
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			while ($res = $stmt->fetch(PDO::FETCH_NUM)) {
				echo '<p><strong>IP Address:</strong> '.$res[0].'</p><p><strong>Time: </strong>'.$res[1].'</p>';
			}
		} catch(PDOException $e){}
		$dbh = null;
	}
	
	function sec_session_start() 
	{
        $session_name = 'sec_session_ieee'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure); 
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(); // regenerated the session, delete the old one.  
	}
	
	function adc_attack() 
	{
		/*Checking for cross-site attacks*/
		if (isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER'];
		else $ref = '';
		$ref = preg_replace("/http:\/\//i", "", $ref);
		$ref = preg_replace("/^www\./i", "", $ref );
		$ref = preg_replace("/\/.*/i", "", $ref );
		$domain = $_SERVER['HTTP_HOST'];
		$referer = $ref ;
		if ($referer == $domain) return true;
		else return false;
	}
	
	function san($var)
	{
		$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		$var = trim($var);
		return $var;
	}
	
	function jump($url)
	{
		header('Location: '.$url);
		exit(0);
	}
	
	function get_client_ip() {
		 $ipaddress = '';
		 if (getenv('HTTP_CLIENT_IP'))
			 $ipaddress = getenv('HTTP_CLIENT_IP');
		 else if(getenv('HTTP_X_FORWARDED_FOR'))
			 $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		 else if(getenv('HTTP_X_FORWARDED'))
			 $ipaddress = getenv('HTTP_X_FORWARDED');
		 else if(getenv('HTTP_FORWARDED_FOR'))
			 $ipaddress = getenv('HTTP_FORWARDED_FOR');
		 else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		 else if(getenv('REMOTE_ADDR'))
			 $ipaddress = getenv('REMOTE_ADDR');
		 else
			 $ipaddress = 'UNKNOWN';

		 return $ipaddress; 
	}
	
	function check_exist($column, $value, $db, $table)
	{
		$sql = "SELECT `id` FROM `$table` WHERE `$column` = \"$value\"";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_NUM);
		if ($row) return $row[0];
		else return "";
	}
	
	function get_title($pg) {
		$dbh = initDb();
		$sql = 'SELECT `title` FROM `page_title` WHERE `page` = "'.$pg.'";';
		try {
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_NUM);
		} catch (PDOException $e) {
			$db = null;
			jump('index.php');	
		}
		$db = null;
		return $res[0];
	}
	
	function get_visit_count($pg) {
		$dbh = initDb();
		$sql = 'SELECT `hits` FROM `page_title` WHERE `page` = "'.$pg.'";';
		try {
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_NUM);
			$hits = $res[0] + 1;
			$stmt = null;
			$stmt = $dbh->prepare('UPDATE `page_title` SET `hits` = "'.$hits.'" WHERE `page` = "'.$pg.'";');
			$stmt->execute();
		} catch (PDOException $e) {
			$db = null;
			jump('index.php');	
		}
		$db = null;
		return $hits;
	}
	
	function generate_hash($pwd) {
		$options = [
			'cost' => 11,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		return password_hash($pwd, PASSWORD_BCRYPT, $options);
	}
	
	function check_admin() {
		if (isset($_SESSION["uid"]) && isset($_SESSION["uadmin"]) && $_SESSION["uadmin"] == 1) {
			return true;
		} else {
			jump('inner.php');
		}
	}
?>
