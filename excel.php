<?php
					require_once '_include/site_modules/class.php';
					require_once '_include/library/functions.php';
					$obj = new Page();
					
						
						try {
							$dbh = initDb();
							$class = san($_GET["class"]);
							$section = san($_GET["section"]);
							if($class == 'all')
							{
								if($section == 'all')
								{
									$sql = 'SELECT * FROM tbl_students';
								} else {
									$sql = "SELECT * FROM tbl_students WHERE section='$section' ";
									}
							} else if($section == 'all')
							{
								$sql = "SELECT * FROM tbl_students WHERE class='$class'";
							} else {
									$sql = "SELECT * FROM tbl_students WHERE class='$class' AND section='$section' ";
							}
								
							//echo $sql;
							$stmt= $dbh->prepare($sql);
							$stmt->execute();
							$res = $stmt->fetch(PDO::FETCH_NUM);
							$result = $dbh->query($sql);
							if (!$result) die('Couldn\'t fetch records');
							
							$fp = fopen('php://output', 'w');
							echo "\n";
							echo "Name\tAdmission No.\tRoll No.\tClass\tSection\tSex\tq1\tq2\tq3\tq4\tfid\tsid\tadmission";
							echo "\n";
							if ($fp && $result) {
								$list = array ();
								// Append results to array
								while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
									array_push($list, array_values($row));
								}
								// Output array into CSV file
								$fp = fopen('php://output', 'w');
								header('Content-Type: text/csv');
								header('Content-Disposition: attachment; filename="export.csv"');
								foreach ($list as $ferow) {
									fputcsv($fp, $ferow);
								};
								}
								else
									die;
						}
					catch(PDOException $e){}
					$dbh = null;
?>