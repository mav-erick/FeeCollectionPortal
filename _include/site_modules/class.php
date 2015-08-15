<?php


	class Page {	
		function increase_pg_count($pg) {
			try {
				$sql = 'UPDATE page_title SET hits = hits + 1 WHERE page="'.$pg.'"';
				$dbh = initDb();
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
			} catch (PDOException $e) {}
			$dbh = null;		
		}
		
		function home() {
		echo '<div id="content_right">
		<center>
			Welcome Maan ke lode!!
		</center></div>';
		}
		
		function submit_payfees() {
		
		echo '<div id="content_right">
			<div class="margin_bottom_40"></div>
			<form method="post" action="?pg=payfees" onsubmit="return validate();">
				<fieldset>
					<legend>Details:</legend>
					<center>
						<b>Admission No:</b> <input type="text" name="admno" id = "admno" size="20" tabindex="1">
					</center>
					<div class="ui horizontal divider">
					  Or
					</div>
					<center>
						<label><b>Class:</b></label>
						<select name="Class" tabindex="2" id="class1">
							<option value="">..</option>
							<option value="1">I</option>
							<option value="2">II</option>
							<option value="3">III</option>
							<option value="4">IV</option>
							<option value="5">V</option>
							<option value="6">VI</option>
							<option value="7">VII</option>
							<option value="8">VIII</option>
							<option value="9">IX</option>
							<option value="10">X</option>
							<option value="11">XI</option>
							<option value="12">XII</option>
						</select>
						<label><b>Section:</b></label>
						<select name="Section" tabindex="3" id="section">
							<option value="">..</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
						</select>
						<label> <b>Roll no: </b></label>
						<input type="text" size="5" tabindex="4" id="rollno">
						<div class="margin_bottom_20"></div>
						<input type="hidden" name="submitted" value="1" />
						<input class="ui red button" name="submit" id="submit" value="Submit" type="submit" tabindex="5">
					</center>		
				</fieldset>
			</form>
			<script language="javascript">
				function validate(){
					var value1 = document.getElementById("admno").value;
					var value2 = document.getElementById("class1").value;
					var value3 = document.getElementById("section").value;
					var value4 = document.getElementById("rollno").value;
					if( value1 != "" || (value2 != "" && value3 != "" && value4 != "") ) 
					{
						return true;    
					}
					alert("You must enter either Admission no. OR Class, Section and Roll no.");
					return false;
				}
			</script>
			
		</div> ';

		}
		
		function payfees()
		{
			
			
			if(isset($_POST["submitted"]) && (san($_POST["submitted"]) == 1) && adc_attack())
			{	
				
				echo '<div id="content_right">
				<div class="margin_bottom_40"></div>';
				$this->payee_details();
				echo '</div>';
			}
			else {
					$this->submit_payfees();
				}
			
		}
		
		function payee_details()
		{
			try {
				$admno = san($_POST["admno"]);	
				$pg = san($_GET["pg"]);	
				$dbh = initDb();
				$sql = 'SELECT * FROM tbl_students WHERE admno="'.$admno.'"';
				$stmt= $dbh->prepare($sql);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_NUM);
				} catch(PDOException $e) {}
				$dbh = null;
				echo '<fieldset>
						<ul> <li> <b> Name: </b> '.$res[0].'</li>
						<li> <b> Admission No: </b> '.$res[1].'</li>
						<li> <b> Class: </b> '.$res[3].'</li>
						<li> <b> Section: </b> '.$res[4].'</li>
						<li> <b> Sex: </b> '.$res[5].'</li></ul>';
				
				echo '<form method="post" action="?pg=fee_paid&adm='.$admno.'">
						<center>
				<label><b>Amount to be paid:</b></label>
					<div class="margin_bottom_20"></div>
					<label><b>Quarter:</b></label>
					<select name="quarter" tabindex="1" id="quarter">
							<option value="">..</option>
							<option value="1">Jan-Mar</option>
							<option value="2">Apr-Jun</option>
							<option value="3">Jul-Sep</option>
							<option value="4">Oct-Dec</option>
						</select>
						</center>
						<div class="margin_bottom_20"></div>
					<input type="hidden" name="fee_form" value="1" />
					<center>
					<input class="ui green button" name="pay_fees" id="pay_fees" value="Pay Fees" type="submit" tabindex="3"/>
					</center>
					</form>';
				echo '</fieldset>';
		}
		
		
			
		
		function fee_paid()
		{
		
			try {
				$q = 'q'.san($_POST["quarter"]);
				$admno = san($_GET["adm"]);
				$amnt_paid = san($_POST["amnt_paid"]);
				$dbh = initDb();
				$sql = 'UPDATE tbl_students SET '.$q.'="1" WHERE admno="'.$admno.'"';
				$stmt= $dbh->prepare($sql);
				$stmt->execute();
				echo 'Your fee had been paid successfully!';
				} catch(PDOException $e) {
				}
				$dbh = null;
				
			
		
		}
		
		function view_records()
		{
			echo '<div id="content_right">
				<div class="margin_bottom_40"></div>
			<form method="get" action="excel.php" onsubmit="return validate();">
				<fieldset>
					<legend>Select:</legend>
					<center>
						<label><b>Class:</b></label>
						<select name="class" tabindex="1" required="">
							<option value="">..</option>
							<option value="1">I</option>
							<option value="2">II</option>
							<option value="3">III</option>
							<option value="4">IV</option>
							<option value="5">V</option>
							<option value="6">VI</option>
							<option value="7">VII</option>
							<option value="8">VIII</option>
							<option value="9">IX</option>
							<option value="10">X</option>
							<option value="11">XI</option>
							<option value="12">XII</option>
							<option value="all">All</option>
						</select>
						<label><b>Section:</b></label>
						<select name="section" tabindex="2" required="">
							<option value="">..</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="all">All</option>
						</select>
						<div class="margin_bottom_20"></div>
						<input class="ui red button" name="submit" id="submit" value="view" type="submit" tabindex="3">
					</center>		
				</fieldset>
			</form>
				</div>
				';
		}
		
	}
?>
		