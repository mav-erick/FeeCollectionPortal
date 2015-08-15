<?php
	function show_header() {
		echo '<div id="header">
				<img src="images/logo.jpg" style ="height:135px; width:155px; margin-left:275px; display: inline-block;"/>
				<img src="images/header.jpg" style ="height:135px; width:645px; margin-left:-5px; display: inline-block;" />
			</div>';
	}
	
	function show_menu(){
	
		echo '<ul class="ca-menu" >
				<li>
					<a href="?pg=payfees">
					   <span class="ca-icon">A</span>
					   <div class="ca-content">
							<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Pay Fees</p>
						</div>
					</a>
				</li>
				<li>
					<a href="?pg=view_records">
						<span class="ca-icon">I</span>
						<div class="ca-content">
							<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">View Records</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="ca-icon">C</span>
						<div class="ca-content">
							<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px; ">My Transactions</p>
						</div>
					</a>
				</li>
				<li>
						<a href="#">
							<span class="ca-icon">S</span>
							<div class="ca-content">
								<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">My Profile</p>
							</div>
						</a>
				</li>
				<li>
						<a href="#">
							<span class="ca-icon">F</span>
							<div class="ca-content">
								<p class="ca-main" style="font-size:20px; margin-left:-20px; margin-top:-2px;">Statistics</p>
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
	
	function show_footer(){
		echo' <div id="footer_left">Copyright © Abhishek Menon </div>
			   <div id="footer_right">
				 <strong>QUICK CONTACT</strong><br />
				   Tel: 7752965396 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mobile: 8547105739<br />
				   Fax: 77529653960<br />
				   Email: abhishek.mv1995@gmail.com<br />
			   </div>';
	}
?>