<?php
	class CMS{
		function home(){
			echo '<ul class="ca-menu" >
					<li>
						<a href="?pg=scholarships">
						   <span class="ca-icon">A</span>
						   <div class="ca-content">
								<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Scholarships <br><br>& Grants</p>
							</div>
						</a>
					</li>
					<li>
						<a href="?pg=change_fees">
							<span class="ca-icon">I</span>
							<div class="ca-content">
								<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Fee Structure</p>
							</div>
						</a>
					</li>
					<li>
						<a href="?pg=cashier_stats">
							<span class="ca-icon">C</span>
							<div class="ca-content">
								<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px; ">Cashier Statistics</p>
							</div>
						</a>
					</li>
					<li>
							<a href="?pg=payment_stats">
								<span class="ca-icon">S</span>
								<div class="ca-content">
									<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Payment Statistics</p>
								</div>
							</a>
					</li>
					<li>
							<a href="?pg=student_changes">
								<span class="ca-icon">F</span>
								<div class="ca-content">
									<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Change Student<br><br>Records</p>
								</div>
							</a>
					</li>
					<li>
							<a href="?pg=logout">
								<span class="ca-icon">d</span>
								<div class="ca-content">
									<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Logout</p>
									
								</div>
							</a>
					</li>
				</ul>';
		}
		
		function basic() {
			echo '<h1> Admin Console</h1>
				<img src="images/bot.jpg"/>
				<h2>Welcome Admin Dubey <h2>
				<h3>Last Login</h3>
				<p>IP Address: 172.31.1.4
				<br> Time : 10 PM @ 07.11.2014</p>';
		}
		
		function change_fees(){
			$this->show_right_header();
			echo'<div style="float:right;">
				<h2>View Current Fee Structure</h2>
				<form method="post" action="?pg=view_fees" style="float:right;">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>
				</div>
				<h2>Download Current Fee Structure</h2>
				<form method="post" action="?pg=fees_export">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>
				<div class="ui horizontal divider"></div>';
			echo'<center><h2>Upload Modified Fee Structure</h2>
				<form method="post" action="?pg=fees_import">
					<input type="file" name="file" id = "file" size="20" tabindex="1">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>';
		}	
		
		function view_fees(){
			$this->show_right_header();
			echo '<h2 style="font-size:18px;"><center><b> View Fee Structure</center></b></h2>';
			echo'<center>
					<form method="post" action="?pg=fees_show">
						<label><b>Enter The Class:</b></label><br>
						<select name="value" tabindex="2" id="value">
							<option value="">..</option>
							<option value="1">I</option>
							<option value="2">II</option>
							<option value="2">III</option>
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
						<br><br><br>
						<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
					</form>			
				</center>';
		}
		
		function cashier_stats() {
			$this->show_right_header();
			echo'<div style="float:right;">
				<h2>View Current Cashier List</h2>
				<form method="post" action="?pg=view_cashiers" style="float:right;">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>
				</div>
				<h2>Download Current Cashier List</h2>
				<form method="post" action="?pg=cashiers_export">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>
				<div class="ui horizontal divider"></div>';
			echo'<center><h2>Upload Modified Cashier List</h2>
				<form method="post" action="?pg=cashiers_import">
					<input type="text" name="file" id = "file" size="20" tabindex="1">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form></center>';
		}
		
		function view_cashiers() {
			$this->show_right_header();
			echo'<h2>List of Current Cashiers</h2>
				<div>
					<ul class="mh-menu">';
			try {
				$dbh = initDb();
				$i = 1;
				$j = 0;
				do {
					$sql = 'SELECT * FROM tbl_cashier WHERE id="'.$i.'"';
					$stmt= $dbh->prepare($sql);
					$stmt->execute();
					$res = $stmt->fetch(PDO::FETCH_NUM);
					if (!($res)) {
						break;
					}
					$position[$j] = $res[4];
					$name[$j] = $res[1];
					$id[$j] = $res[0];
					$transactions[$j] = $res[2];
					$total[$j] = $res[3];
					$j++;
					$i++;
				} while (1);
				
				$j = 0;
				while ($j < ($i - 1)) {
					echo'<li>
						<a href="#"><span style="color: #1367A3;">'.$position[$j].'</span> <span>'.$name[$j].'</span></a>
						<div>
							<center>
							<p> Cashier ID: '.$id[$j].'</p>
							<p> Total no. of Transactions: '.$transactions[$j].'</p>
							<p> Total Collection: Rs '.$total[$j].'</p>
							</center>
						</div>
					</li>';
					$j++;
				}
				
				echo'</ul></div>';
			} catch(PDOException $e) {}
			$dbh = null;
		}
		
		function payment_stats() {
			$this->show_right_header();
			echo'<h2>Payment Statistics</h2>
				<div >
					<ul class="tabs" data-persist="true">
						<li><a href="#view1">Session Wise Stats</a></li>
						<li><a href="#view2">Class Wise Stats</a></li>
						<li><a href="#view3">Defaulters List</a></li>
					</ul>
					<div id="view1">
						<table class="container1">
							<thead>
								<tr>
									<th><h1>Sites</h1></th>
									<th><h1>Views</h1></th>
									<th><h1>Clicks</h1></th>
									<th><h1>Average</h1></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Google</td>
									<td>9518</td>
									<td>6369</td>
									<td>01:32:50</td>
								</tr>
								<tr>
									<td>Twitter</td>
									<td>7326</td>
									<td>10437</td>
									<td>00:51:22</td>
								</tr>
								<tr>
									<td>Amazon</td>
									<td>4162</td>
									<td>5327</td>
									<td>00:24:34</td>
								</tr>
							<tr>
									<td>LinkedIn</td>
									<td>3654</td>
									<td>2961</td>
									<td>00:12:10</td>
								</tr>
							<tr>
									<td>CodePen</td>
									<td>2002</td>
									<td>4135</td>
									<td>00:46:19</td>
								</tr>
							<tr>
									<td>GitHub</td>
									<td>4623</td>
									<td>3486</td>
									<td>00:31:52</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="view2">
						<b>Switch to other templates</b>
						<p>Open this page with Notepad, and update the CSS link to:</P>
						<p>template1 ~ 6.</p>                
					</div>
					<div id="view3">
						<b>Advanced</b>
						<p>If you expect a more feature-rich version of the tabber, you can use the advanced version of the script, 
							<a href="http://www.menucool.com/jquery-tabs">McTabs - jQuery Tabs</a>:</p>
						<ul>
							<li>URL support: a hash id in the URL can select a tab</li>
							<li>Bookmark support: select a tab via bookmark anchor</li>
							<li>Select tabs by mouse over</li>
							<li>Auto advance</li>
							<li>Smooth transitional effect</li>
							<li>Content can retrieved from other documents or pages through Ajax</li>
							<li>... and more</li>     
						</ul>
					</div>
					
				</div>';
		}	
		
		function fees_show(){
			$value = san($_POST["value"]);
			$this->show_right_header();
			echo'<h2>Existing Fee Structure of Class'.$value.'</h2>
				<ul class="tabs" data-persist="true">
					<li><a href="#view1">One Time Fees</a></li>
					<li><a href="#view2">Session Fees</a></li>
					<li><a href="#view3">Late Fee Scheme</a></li>
				</ul>
				<div id="view1">';
			try {
				
				$pg = san($_GET["pg"]);	
				$pg = $pg.'value='.$value;
				$dbh = initDb();
				$sql = 'SELECT * FROM tbl_fees WHERE class="'.$value.'"';
				$stmt= $dbh->prepare($sql);
				$stmt->execute();
				$res = $stmt->fetch(PDO::FETCH_NUM);
			} catch(PDOException $e) {}
			$dbh=null;
			echo'<p><center>Admission Fees: Rs.'.$res[1].'</p>';
			echo'</div>
				<div id="view2">
					<p>Examination Fees : Rs. '.$res[0].'</p>
					<p>Tuition Fees : Rs. '.$res[2].'</p>
					<p>Infrastructure Fees : Rs. '.$res[3].'</p>                
				</div>
				<div id="view3">
					<p> Deadline Day : 14</p>
					<p> Penalty per Day : Rs. '.$res[4].'</p>
				</div>';
			echo'<form method="post" action="?pg=edit_fees">
					<input class="ui black button" name="submit" id="submit" value="Edit Manually" type="submit">
				</form>
				<div class="ui horizontal divider"> OR </div>
				Upload A File :
				<form method="post" action="?pg=fees_file">
					<input type="text" name="file" id = "file" size="20" tabindex="1">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>';
		}
		
		function edit_fees(){
			$value = san($_POST["value"]);
			$this->show_right_header();
			echo'<h2>Change Fee Structure of Class'.$value.'</h2>
			<form method="post" action="?pg=fees_changed">
				<fieldset>
					<center>
					<legend>Enter Details:</legend>
					<label><b>Type:</b></label>
					<select name="type" tabindex="2" id="type">
						<option value="admission">Admission Fees</option>
						<option value="exam">Examination Fees</option>
						<option value="tuition">Tuition Fees</option>
						<option value="late">Late Fees</option>
					</select>
					<!--<b>Fee Type:</b> <input type="text" name="type" id = "type" size="20" tabindex="1" required="">-->
					<center>
						<b>New Fee:</b> <input type="text" name="fee" id = "fee" size="20" tabindex="1" required="">
						<b>Class:</b>
						<!--<select name="class" tabindex="2" id="class">
							<option value="">..</option>
							<option value="1">I</option>
							<option value="2">II</option>
							<option value="2">III</option>
							<option value="4">IV</option>
							<option value="5">V</option>
							<option value="6">VI</option>
							<option value="7">VII</option>
							<option value="8">VIII</option>
							<option value="9">IX</option>
							<option value="10">X</option>
							<option value="11">XI</option>
							<option value="12">XII</option>
						</select>-->
						<input type="text" name="class" id = "class" size="20" tabindex="1">
					</center>
					<div class="ui horizontal divider">
					</div>
					<input class="ui black button" name="submit" id="submit" value="Edit" type="submit">
					</form>';
		}
		
		function fees_changed(){
			try {	
				$class = san($_POST["class"]);
				$type = san($_POST["type"]);
				$fee = san($_POST["fee"]);
				
				var_dump($type);
				var_dump($fee);
				var_dump( $class);
				$dbh = initDb();
				$sql = 'UPDATE tbl_fees SET '.$type.'="'.$fee.'" WHERE class="'.$class.'"';
				echo $sql;
				$stmt= $dbh->prepare($sql);
				$stmt->execute();
			} catch(PDOException $e) {
			}
			$dbh = null;				
			$this->show_right_header();
			echo'successful';	
		}
		
		function fees_file() {
			$file_name =san($_POST["file"]);
			$row = 1;
			if (($handle = fopen($file_name, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					echo "<p> $num fields in line $row: <br /></p>\n";
					if ($row == 1) {
						$field = $data;
					}
					$j = 0;
					while ($j < $num) {
						switch($field[$j]){
							case "Admission": {
								$admission = $j;
								break;
							}
							case "Exam": {
								$exam = $j;
								break;
							}
							case "Tuition": {
								$tuition = $j;
								break;
							}
							case "Infrastructure": {
								$infrastructure = $j;
								break;
							}
							case "Fid":{
								$fid = $j;
								break;
							}
							case "Late": { 
								$late = $j;
								break;
							}
							case "Class": {
								$class = $j;
								break;
							}
						}
						$j++;
					}
					$row++;
					if ($row == 2) {
						$row++;
					} else {
						$dbh = initDb();
						try {
							$sql = 'INSERT INTO tbl_fees VALUES("'.$data[$exam].'","'.$data[$admission].'","'.$data[$tuition].'","'.$data[$infrastructure].'","'.$data[$late].'","'.$data[$fid].'","'.$data[$class].'")';
							echo $sql;
							$dbh->beginTransaction();
							$stmt = $dbh->prepare($sql);
							$stmt->execute();
							$dbh->commit();
						} catch (PDOException $e) {
							$dbh->rollBack();
							echo '<div id="warn">Failed</div>';
							echo $e;
						}
						$dbh = null;
					}
				}
				fclose($handle);
			} else {
				echo "Couldn't Open File";
			}
		}

		function scholarships() {
			$this->show_right_header();
			echo'<h2><center> View and Grant Current Scholarship Schemes</h2></center>';
			echo'<div style="float:right;">
				<form method="post" action="?pg=view_scholarship">
					<label><b>View Scholarship Schemes</b></label><br>
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>	</div>
				
				<form method="post" action="?pg=students_scholarship">
					<label><b>View Scholarship Winners</b></label><br>
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>';
			
			echo'<div class="ui horizontal divider">OR</div>
				<br>
				<h2><center> Update The Scholarship Schemes </center></h2>';		
		}
		
		function view_scholarship(){
			$this->show_right_header();
			echo'<h2><center>Current Scholarship Schemes</h2></center>';
			
			try {
				$dbh = initDb();
				$i = 1;
				$j = 0;
				do {
					$sql = 'SELECT * FROM tbl_scholarship WHERE sid="'.$i.'"';
					$stmt= $dbh->prepare($sql);
					$stmt->execute();
					$res = $stmt->fetch(PDO::FETCH_NUM);
					if (!($res)) {
						break;
					}
					$description[$j] = $res[3];
					$name[$j] = $res[1];
					$id[$j] = $res[0];
					$discount[$j] = $res[2];
					$j++;
					$i++;
				} while (1);
				$j = 0;
				echo'<ul class="tabs" data-persist="true">';
				while ($j < ($i - 1)) {
					echo'<li><a href="#view'.($j + 1).'">'.$name[$j].'</a></li>';
					$j++;
				}
				echo'</ul>';
				$j = 0;
				while ($j < ($i - 1)) {
					echo'<div id="view'.($j + 1).'">
					<p>Total Discount per Quarter : Rs. '.$discount[$j].'</p>
					<p>Scholarship ID : '.$id[$j].'</p>
					<p>'.$description[$j].'</p>                
				</div>';
					$j++;
				}
				echo'</ul>';
			} catch(PDOException $e) {}
			$dbh = null;
		}
		
		function students_scholarship(){
			$this->show_right_header();
			echo'<table style="overflow-y:auto;">
					<thead>
						<tr>
							<th><h1>Admission No.</h1></th>
							<th><h1>Name</h1></th>
							<th><h1>Class(Sec)</h1></th>
							<th><h1>Scholarship ID</h1></th>
						</tr>
					</thead>
					<tbody>';
			try {
				$class = 1;
				while($class < 13) {
					$dbh = initDb();
					$sql = 'SELECT * FROM tbl_students WHERE class="'.$class.'" AND sid <> "0"';
					$stmt= $dbh->prepare($sql);
					$stmt->execute();
					while($res = $stmt->fetch(PDO::FETCH_NUM)){
						echo'<tr>
								<td><center>'.$res[1].'</center></td>
								<td><center>'.$res[0].'</td></center>
								<td><center>'.$res[3].'('.$res[4].')</center></td>
								<td><center>'.$res[11].'</td></center>
							</tr>';
					}
					$class++;
				}
				echo'</tbody></table>';
			} catch(PDOException $e) {}

		}
		
		function student_changes() {
			$this->show_right_header();
			echo'<center><h2>View Students List</h2>';
		
			echo'<center>
				<form method="post" action="?pg=show_students_list">
					<label><b>View List of All Students</b></label><br>
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>	
				<br><br>
				<form method="post" action="?pg=download_student_list">
					<label><b>Download List of All Students</b></label><br>
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form></center>';
			
			echo'<div class="ui horizontal divider"> OR </div>
				<h2><center>Update Students List</h2>
				Upload A File :
				<form method="post" action="?pg=students_file_import">
					<input type="text" name="file" id = "file" size="20" tabindex="1">
					<input class="ui black button" name="submit" id="submit" value="Submit" type="submit">
				</form>';	
			
		}
		
		function show_students_list(){
			
			echo'<table style="overflow-y:auto;">
					<thead>
						<tr>
							<th><h1>Admission No.</h1></th>
							<th><h1>Name</h1></th>
							<th><h1>Class(Sec)</h1></th>
							<th><h1>Roll</h1></th>
						</tr>
					</thead>
					<tbody>';
			try {
				$class = 1;
				while($class < 13) {
					$dbh = initDb();
					$sql = 'SELECT * FROM tbl_students WHERE class="'.$class.'"';
					$stmt= $dbh->prepare($sql);
					$stmt->execute();
					while($res = $stmt->fetch(PDO::FETCH_NUM)){
						echo'<tr>
								<td><center>'.$res[1].'</td></center>
								<td><center>'.$res[0].'</td></center>
								<td><center>'.$res[3].'('.$res[4].')</center></td>
								<td><center>'.$res[11].'</td></center>
							</tr>';
					}
					$class++;
				}
				echo'</tbody></table>';
			} catch(PDOException $e) {}
	}
		
		function students_file_import(){
			$file_name =san($_POST["file"]);
			$row = 1;
			if (($handle = fopen($file_name, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					echo "<p>$num fields in line $row: <br /></p>\n";
					if ($row == 1) {
						$field = $data;
					}
					$j = 0;
					while ($j < $num) {
						switch($field[$j]){
							case "Admission No": {
								$admno = $j;
								break;
							}
							case "Name": {
								$name = $j;
								break;
							}
							case "Roll No": {
								$roll = $j;
								break;
							}
							case "Class": {
								$class = $j;
								break;
							}
							case "Fid":{
								$fid = $j;
								break;
							}
							case "Section": { 
								$section = $j;
								break;
							}
							case "q1": {
								$q1 = $j;
								break;
							}
							case "q2": {
								$q2 = $j;
								break;
							}
							case "q3": {
								$q3 = $j;
								break;
							}
							case "q4": {
								$q4 = $j;
								break;
							}
							case "Scholarship ID": {
								$sid = $j;
								break;
							}
							case "Sex": {
								$sex = $j;
								break;
							}
							case "Admission" : {
								$admission = $j;
								break;
							}
						}
						$j++;
					}
					$row++;
					if ($row == 2) {
						$row++;
					} else {
						$dbh = initDb();
						try {
							$sql = 'INSERT INTO tbl_students VALUES("'.$data[$name].'","'.$data[$admno].'","'.$data[$roll].'","'.$data[$class].'","'.$data[$section].'","'.$data[$sex].'","'.$data[$q1].'","'.$data[$q2].'","'.$data[$q3].'","'.$data[$q4].'","'.$data[$fid].'","'.$data[$sid].'","'.$data[$admission].'")';
							echo $sql;
							$dbh->beginTransaction();
							$stmt = $dbh->prepare($sql);
							$stmt->execute();
							$dbh->commit();
						} catch (PDOException $e) {
							$dbh->rollBack();
							echo '<div id="warn">Failed</div>';
							echo $e;
						}
						$dbh = null;
					}
				}
				fclose($handle);
			} else {
				echo "Couldn't Open File";
			}
		}
				
		function show_right_header(){
			echo'<center><table><tr><td><div class="ui black button"><a href="cms.php">CMS Home</a> </div></td>
				<td><div class="ui black button"><a href=?pg=news>Publish</a> </div></td>
				<td><div class="ui black button"><a href=?pg=news&send=1>Send Newsletter</a> </div></td><td></tr></table>
				<h1>Admin Console</h1></center>';
		}
		
	}
?>