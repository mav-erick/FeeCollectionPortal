<?php
	require_once '_include/site_modules/head.php';
	require_once '_include/site_modules/body.php';
	require_once '_include/site_modules/class.php';
	require_once '_include/library/functions.php';
	show_head();
	sec_session_start();
	if(!isset($_SESSION["uid"]))
	{
		jump('index.php');
	}
	$obj = new Page();
?>

<body>
<?php
	show_header();
?>
<div id="container">
	<div id="content">
		<div id="content_left">
			<?php
				show_menu();
			?>
		</div>
			<?php
				if (isset($_GET["pg"])) {
					$pg = san($_GET["pg"]);
					switch ($pg) {
						case "payfees" : {
							$obj->payfees();
							break;
						}
						case "fee_paid" : {
							$obj->fee_paid();
							break;
						}
						case "view_records" : {
							$obj->view_records();
							break;
						}
						
						case "generate_excel" : {
							$obj->generate_excel();
							break;
						}
						
						case "logout" : {
							jump ('logout.php');
							break;
						}
						
						default: {
							$obj->home();
						}
					}
				} else {
					$obj->home();
				}
			?> 
		
</div>

<div id="footer">
       <?php
			show_footer();
		?>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
</body>
</html>