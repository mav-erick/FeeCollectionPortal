<?php
	require_once '_include/site_modules/head.php';
	require_once '_include/site_modules/body.php';
	require_once '_include/site_modules/class_cms.php';
	require_once '_include/library/functions.php';
	sec_session_start();
	$_SESSION["pg"] = "cms";
	$_SESSION["rg"] = "";
	check_admin();
	show_head();
	$obj = new CMS();
	show_header();
?>

<body>

<div id="container">
	<div id="content">
		<div id="content_left">
			<?php
				$obj->home();
			?>
		</div>
		<div id="content_right">
			<?php
					if (isset($_GET["pg"])) {
						$pg = san($_GET["pg"]);
						switch ($pg) {
							case "scholarships" : {
								$obj->scholarships();
								break;
							}
							case "cashier_stats" : {
								$obj->cashier_stats();
								break;
							}
							case "view_cashiers" : {
								$obj->view_cashiers();
								break;
							}
							case "payment_stats" : {
								$obj->Payment_stats();
								break;
							}
							case "change_fees" : {
								$obj->change_fees();
								break;
							}
							case "view_fees" : {
								$obj->view_fees();
								break;
							}
							case "fees_show": {
								$obj->fees_show();
								break;
							}
							case "edit_fees" : {
								$obj->edit_fees();
								break;
								}
							case "fees_changed" : {
								$obj->fees_changed();
								break;
							}
							case "fees_file" : {
								$obj->fees_file();
								break;
							}
							case "view_scholarship" : {
								$obj->view_scholarship();
								break;
							}
							case "students_scholarship" : {
								$obj->students_scholarship();
								break;
							}
							case "student_changes" : {
								$obj->student_changes();
								break;
							}
							case"students_file_import" : {
								$obj->students_file_import();
								break;
							}
							case "show_students_list" : {
								$obj->show_students_list();
								break;
							}
							case "logout" : {
								jump('logout.php');
								break;
							}
							default: {
								$obj->basic();
							}
						}
					} else {
						$obj->basic();
					}
			?>
		</div>
    </div>

<div id="footer">
	<?php
		show_footer();
	?>
</div>
</div>
</body>


