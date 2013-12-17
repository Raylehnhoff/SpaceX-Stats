<?php
	include 'php/initialize.php';

	$dbh = new Database();
	// Return statistics
	$dbh->run('SELECT * FROM `statistics`');
	$stats = $dbh->resultSet();

	// Return next launch
	$dbh->run('SELECT * FROM `missions` WHERE `complete`=0 ORDER BY `mission_id` ASC LIMIT 1');
	$nextLaunch = $dbh->single();

	if (!is_null($nextLaunch['launch_date_time'])) {
		$countdown = manipulateDateTime($nextLaunch['launch_date_time']);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>SpaceX Stats</title>
		<link rel="stylesheet" href="assets/styles.css" type="text/css" />	

		<link rel="icon" href="favicon.png">
		<!--[if IE]><link rel="shortcut icon" href="favicon.ico"><![endif]-->	

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/jquery-1.9.1.min.js"><\/script>')</script>

		<script src="assets/quantify.js"></script>
		<script src="assets/sheetswitch.js"></script>	
		<script src="assets/countdown.js"></script>

		<noscript>
	  		<style>html{display:none;}</style>
	  		<meta http-equiv="refresh" content="0.0;url=nojs.php">
		</noscript>
	</head>
	<body>
		<ul id="navigation">
			<li class="page1" data-index="1"><a class="active" href="#1" data-index="1"></a></li>
			<li class="page2" data-index="2"><a href="#2" data-index="2"></a></li>
			<li class="page3" data-index="3"><a href="#3" data-index="3"></a></li>
			<li class="page4" data-index="4"><a href="#4" data-index="4"></a></li>
			<li class="page5" data-index="5"><a href="#5" data-index="5"></a></li>
			<li class="page6" data-index="6"><a href="#6" data-index="6"></a></li>
			<li class="page7" data-index="7"><a href="#7" data-index="7"></a></li>
			<li class="page8" data-index="8"><a href="#8" data-index="8"></a></li>
			<li class="page9" data-index="9"><a href="#9" data-index="9"></a></li>
			<li class="page10" data-index="10"><a href="#10" data-index="10"></a></li>
			<li class="page11" data-index="11"><a href="#11" data-index="11"></a></li>
			<li class="page12" data-index="12"><a href="#12" data-index="12"></a></li>
			<li class="page13" data-index="13"><a href="#13" data-index="13"></a></li>
			<li class="page14" data-index="14"><a href="#14" data-index="14"></a></li>
			<li class="page15" data-index="15"><a href="#15" data-index="15"></a></li>
		</ul>
		<div class="wrapper">
			<div class="main">
				<!-- SECTION 1 - MAIN PAGE -->
				<section class="page1 active" data-index="1">
					<div class="plaque">
						<img id="logo" src="images/logo.png" alt="logo" title="SpaceX Logo" />
						<span id="stats">Stats</span>
						<a href="previous.php" title="Previous Launches"><div id="leftchevron" class="chevron"></div></a>
						<a href="upcoming.php" title="Upcoming Launches"><div id="rightchevron" class="chevron"></div></a>						
						<hr/>
						<p class="quote">"At the beginning of starting SpaceX, I thought that the most likely outcome was failure."</p>
						<hr/>
						<p>SpaceX was founded in 2002 by serial entrepreneur Elon Musk with the initial goal of reinvigorating public attitudes towards space exploration. Since then, it has grown to over 4000 employees, with 2 active rockets, 1 ISS-resupplying spacecraft, and a burgeoning launch manifest. Now, 13 years later SpaceX is pioneering the development of reusable rockets, undertaking planning for their first astronauts, and setting course for Mars.</p>
						<p>Here, you can track SpaceX's progress, countdown to upcoming launches right here, in real time. Scroll down for statistics, or navigate left and right using the white arrows for <a href="previous.php">previous missions</a>, and <a href="upcoming.php"> upcoming missions</a>, respectively. </p>

						<footer>
							<p class="disclaimer">Website developed by Lukas, a SpaceX fan. This website is not in any way associated with SpaceX. All images and graphics &#9400; 2014 Space Exploration Technologies Inc.</p>							
						</footer>
						<div id="bottomchevron" class="chevron"></div>
					</div>
				</section>
				<!-- SECTION 2 - NEXT LAUNCH -->
				<section class="page2" data-index="2">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<a href="mission.php?mission_id=<?php echo $nextLaunch['mission_id']; ?>" id="linkto"></a>
						<div data-sheet="1">
							<header>Next Launch - <?php echo $nextLaunch['payload'] ?></header>
							<div class="contents">
								<?php if (!is_null($nextLaunch['launch_date_time'])) {	?>
									<script>
										$(document).ready(function() {
											$('table#nextlaunch.time').countdown({date : '<?php echo $countdown; ?>'});	
										});	
									</script>
										<table class="time" id="nextlaunch">
											<caption>Counting down to <?php echo $countdown; ?></caption>
											<tr class="metric">
												<td class="days"></td>
												<td class="hours"></td>
												<td class="minutes"></td>
												<td class="seconds"></td>
											</tr>
											<tr class="unit">
												<td class="refDays"></td>
												<td class="refHours"></td>
												<td class="refMinutes"></td>
												<td class="refSeconds"></td>
											</tr>
										</table>
								<?php } else {	?>
										<table class="standard">
											<tr class="widemetric">
												<td><?php echo $nextLaunch['expected_launch']; ?></td>
											</tr>
											<tr class="unit">
												<td>Expected Launch</td>
											</tr>
										</table>
								<?php } ?>
							</div>
							<footer>
								<p><?php echo $nextLaunch['summary']; ?></p>
							</footer>
						</div>	
					</div>				
				</section>
				<!-- SECTION 3 - LAUNCH COUNT -->
				<section class="page3" data-index="3">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">Total</span>
							<ul>
								<li data-sheet="1">Total</li>
								<li data-sheet="2">Falcon 9</li>
								<li data-sheet="3">Falcon Heavy</li>
								<li data-sheet="4">Falcon 1</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header><?php echo $stats[0]['stat_name']; ?></header>
							<div class="contents">					
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[0]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[0]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[0]['comment']; ?></p>
							</footer>
						</div>
						<div data-sheet="2">
							<header><?php echo $stats[1]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[1]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[1]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[1]['comment']; ?></p>
							</footer>
						</div>
						<div data-sheet="3">
							<header><?php echo $stats[2]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[2]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[2]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[2]['comment']; ?></p>
							</footer>
						</div>
						<div data-sheet="4">
							<header><?php echo $stats[3]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[3]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[3]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[3]['comment']; ?></p>
							</footer>
						</div>
					</div>
				</section>
				<!-- SECTION 4 - DRAGON -->
				<section class="page4" data-index="4">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">Missions</span>
							<ul>
								<li data-sheet="1">Missions</li>
								<li data-sheet="2">ISS Resupplies</li>
								<li data-sheet="3">Time In Space</li>
								<li data-sheet="4">Cargo</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header><?php echo $stats[4]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[4]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[4]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[4]['comment']; ?></p>
							</footer>
						</div>
						<div data-sheet="2">
							<header><?php echo $stats[5]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[5]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[5]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[5]['comment']; ?></p>
							</footer>
						</div>
						<div data-sheet="3">
							<header><?php echo $stats[6]['stat_name']; ?></header>
							<div class="contents">
								<?php 
									$timeInSpace = $stats[6]['value'];
									$days = floor($timeInSpace / (60 * 60 * 24));
									$timeInSpace -= ($days * 60 * 60 * 24);

									$hours = floor($timeInSpace / (60 * 60));
									$timeInSpace -= ($hours * 60 * 60);

									$minutes = floor($timeInSpace / 60);
									$timeInSpace -= ($minutes * 60);

									$seconds = $timeInSpace;
								?>
								<table class="time">
									<tr class="metric">
										<td class="days"><?php echo $days; ?></td>
										<td class="hours"><?php echo $hours; ?></td>
										<td class="minutes"><?php echo $minutes; ?></td>
										<td class="seconds"><?php echo $seconds; ?></td>
									</tr>
									<tr class="unit">
										<td class="refDays">Days</td>
										<td class="refHours">Hours</td>
										<td class="refMinutes">Minutes</td>
										<td class="refSeconds">Seconds</td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[6]['comment']; ?></p>
							</footer>
						</div>
						<div data-sheet="4">
							<header>Cargo</header>
							<div class="contents">
								<table class="versus">
									<tr class="widemetric">
										<td><?php echo $stats[29]['value']; ?></td>
										<td><?php echo $stats[30]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td>KG Up</td>
										<td>KG Down</td>
									</tr>
								</table>
							</div>
							<footer>
								<p>NASA's $1.6 billion CRS contract with SpaceX calls for 12 flights delivering a minimum of 20,000kg of cargo up to the station. Dragon remains the only spacecraft in service capable of returning large quantities of cargo from the Station to Earth.</p>
							</footer>
						</div>	
					</div>				
				</section>
				<!-- SECTION 5 - LAUNCH SITES -->
				<section class="page5" data-index="5">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">Florida</span>
							<ul>
								<li data-sheet="1" data-image="images/capeflorida.jpg">Florida</li>
								<li data-sheet="2" data-image="images/california.jpg">California</li>
								<li data-sheet="3" data-image="images/kwaj.jpg">Kwajalein</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header><?php echo $stats[7]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[7]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[7]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[7]['comment']; ?></p>
							</footer>
						</div>	
						<div data-sheet="2">
							<header><?php echo $stats[8]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[8]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[8]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[8]['comment']; ?></p>
							</footer>
						</div>	
						<div data-sheet="3">
							<header><?php echo $stats[9]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[9]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[9]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[9]['comment']; ?></p>
							</footer>
						</div>				
					</div>				
				</section>
				<!-- SECTION 6 - MERLIN 1D -->
				<section class="page6" data-index="6">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">Operating Time</span>
							<ul>
								<li data-sheet="1">Operating Time</li>
								<li data-sheet="2">Success Rate</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header><?php echo $stats[10]['stat_name']; ?></header>
							<div class="contents">
								<?php 
									$operatingTime = $stats[10]['value'];

									$minutes = floor($operatingTime / 60);
									$operatingTime -= ($minutes * 60);

									$seconds = $operatingTime;
								?>
								<table class="time">
								<tr class="metric">
									<td class="minutes"><?php echo $minutes; ?></td>
									<td class="seconds"><?php echo $seconds; ?></td>
								</tr>
								<tr class="unit">
									<td class="refMinutes">Minutes</td>
									<td class="refSeconds">Seconds</td>
								</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[10]['comment']; ?></p>
							</footer>
						</div>	
						<div data-sheet="2">
							<header>Merlin 1D Success Rate</header>
							<div class="contents">
								<?php 
									$merlinSuccesses = $stats[11]['value'];
									$merlinFailures = $stats[12]['value'];

									$successRate = (($merlinSuccesses - $merlinFailures) / $merlinSuccesses) * 100;
								?>
								<table class="standard">
									<tr class="metric">
										<td><?php echo $successRate; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[11]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[11]['comment']; ?></p>
							</footer>
						</div>						
					</div>				
				</section>
				<!-- SECTION 7 - ASTRONAUTS -->
				<section class="page7" data-index="7">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">Current Astronauts</span>
							<ul>
								<li data-sheet="1">Current Astronauts</li>
								<li data-sheet="2">Cumulative Astronauts</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header><?php echo $stats[13]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[13]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[13]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[13]['comment']; ?></p>
							</footer>
						</div>	
						<div data-sheet="2">
							<header><?php echo $stats[14]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[14]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[14]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[14]['comment']; ?></p>
							</footer>
						</div>		
					</div>				
				</section>
				<!-- SECTION 8 - SATELLITES -->
				<section class="page8" data-index="8">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">Primary Satellites</span>
							<ul>
								<li data-sheet="1">Primary Satellites</li>
								<li data-sheet="2">All Satellites</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header>Primary Satellites</header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[16]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[16]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[16]['comment']; ?></p>
							</footer>
						</div>	
						<div data-sheet="2">
							<header>All Satellites</header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[15]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[15]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[15]['comment']; ?></p>
							</footer>
						</div>
					</div>				
				</section>
				<!-- SECTION 9 - ELON MUSK'S BET -->
				<section class="page9" data-index="9">
					<script>
						$(document).ready(function() {
							$('table.time#elonmuskbetexpires').countdown({date : "01 Jan 2026 00:00:00 UTC"});	
						});	
					</script>
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div data-sheet="1">
							<header>Elon Musk's Bet Expires</header>
							<div class="contents">
								<table class="time" id="elonmuskbetexpires">
									<caption>Elon Musk's bet expires at 00:00 1 January 2026 UTC</caption>
									<tr class="metric">
										<td class="days"></td>
										<td class="hours"></td>
										<td class="minutes"></td>
										<td class="seconds"></td>
									</tr>
									<tr class="unit">
										<td class="refDays"></td>
										<td class="refHours"></td>
										<td class="refMinutes"></td>
										<td class="refSeconds"></td>
									</tr>
								</table>
							</div>
							<footer>
								<p>In April 2009, Michael S. Malone revealed, while interviewing Elon Musk, that the two had a bet that SpaceX would put a man on Mars by "2020 or 2025". Musk has continued to reiterate this rough timeframe since.</p>
							</footer>
						</div>	
					</div>				
				</section>
				<!-- SECTION 10 - GRASSHOPPER FLIGHTS -->
				<section class="page10" data-index="10">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div data-sheet="1">
							<header><?php echo $stats[17]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[17]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[17]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[17]['comment']; ?></p>
							</footer>
						</div>
					</div>				
				</section>
				<!-- SECTION 11 - DISTANCE -->
				<section class="page11" data-index="11">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div data-sheet="1">
							<header><?php echo $stats[18]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="widemetric">
										<td><?php echo number_format($stats[18]['value']); ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[18]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[18]['comment']; ?></p>
							</footer>
						</div>
					</div>				
				</section>
				<!-- SECTION 12 - TURNAROUND TIME -->
				<section class="page12" data-index="12">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div data-sheet="1">
							<header><?php echo $stats[28]['stat_name']; ?></header>
							<div class="contents">
								<?php 
									$turnaround = $stats[28]['value'];
									$days = floor($turnaround / (60 * 60 * 24));
									$turnaround -= ($days * 60 * 60 * 24);

									$hours = floor($turnaround / (60 * 60));
									$turnaround -= ($hours * 60 * 60);

									$minutes = floor($turnaround / 60);
									$turnaround -= ($minutes * 60);

									$seconds = $turnaround;
								?>
								<table class="time">
								<tr class="metric">
									<td class="days"><?php echo $days; ?></td>
									<td class="hours"><?php echo $hours; ?></td>
									<td class="minutes"><?php echo $minutes; ?></td>
									<td class="seconds"><?php echo $seconds; ?></td>
								</tr>
								<tr class="unit">
									<td class="refDays">Days</td>
									<td class="refHours">Hours</td>
									<td class="refMinutes">Minutes</td>
									<td class="refSeconds">Seconds</td>
								</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[28]['comment']; ?></p>
							</footer>
						</div>
					</div>				
				</section>
				<!-- SECTION 13 - VEHICLES LANDED -->
				<section class="page13" data-index="13">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div data-sheet="1">
							<header><?php echo $stats[19]['stat_name']; ?></header>
							<div class="contents">
								<table class="standard">
									<tr class="metric">
										<td><?php echo $stats[19]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td><?php echo $stats[19]['unit']; ?></td>
									</tr>
								</table>
							</div>
							<footer>
								<p><?php echo $stats[19]['comment']; ?></p>
							</footer>
						</div>
					</div>				
				</section>
				<!-- SECTION 14 - SPACEX V ULA -->
				<section class="page14" data-index="14">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div class="dropdown">
							<span data-sheet="1">2014</span>
							<ul>
								<li data-sheet="1">2014</li>
								<li data-sheet="2">2013</li>
								<li data-sheet="3">2012</li>
								<li data-sheet="4">All</li>
							</ul>
						</div>
						<div data-sheet="1">
							<header>SpaceX V. ULA - 2014</header>
							<div class="contents">
								<table class="versus">
									<tr class="metric">
										<td><?php echo $stats[20]['value']; ?></td>
										<td><?php echo $stats[21]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td>SpaceX</td>
										<td>ULA</td>
									</tr>
								</table>
							</div>
							<footer>
								<p>This page compares the number of launches that both SpaceX and ULA undertake within a particular year or from all time.</p>
							</footer>
						</div>	
						<div data-sheet="2">
							<header>SpaceX V. ULA - 2013</header>
							<div class="contents">
								<table class="versus">
									<tr class="metric">
										<td><?php echo $stats[22]['value']; ?></td>
										<td><?php echo $stats[23]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td>SpaceX</td>
										<td>ULA</td>
									</tr>
								</table>
							</div>
							<footer>
								<p>This page compares the number of launches that both SpaceX and ULA undertake within a particular year or from all time.</p>
							</footer>
						</div>
						<div data-sheet="3">
							<header>SpaceX V. ULA - 2012</header>
							<div class="contents">
								<table class="versus">
									<tr class="metric">
										<td><?php echo $stats[24]['value']; ?></td>
										<td><?php echo $stats[25]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td>SpaceX</td>
										<td>ULA</td>
									</tr>
								</table>
							</div>
							<footer>
								<p>This page compares the number of launches that both SpaceX and ULA undertake within a particular year or from all time.</p>
							</footer>
						</div>
						<div data-sheet="4">
							<header>SpaceX V. ULA - All Time</header>
							<div class="contents">
								<table class="versus">
									<tr class="metric">
										<td><?php echo $stats[26]['value']; ?></td>
										<td><?php echo $stats[27]['value']; ?></td>
									</tr>
									<tr class="unit">
										<td>SpaceX</td>
										<td>ULA</td>
									</tr>
								</table>
							</div>
							<footer>
								<p>This page compares the number of launches that both SpaceX and ULA undertake within a particular year or from all time.</p>
							</footer>
						</div>
					</div>				
				</section>
				<!-- SECTION 15 - HOURS WORKED -->
				<section class="page15" data-index="15">
					<div class="plaque">
						<a href="index.php" id="homelink"></a>
						<div data-sheet="1">
							<header>Hours Worked</header>
							<div class="contents">
								<table class="standard">
									<tr class="widemetric">
										<td style="font-size:100px;">Countless</td>
									</tr>
								</table>
							</div>
							<footer>
								<p>Since 2002, thousands of SpaceX employees and Elon Musk have worked tirelessly and effortlessly to push the boundaries of engineering and technology, ultimately providing humanity with cheaper, faster, more reliable access to space. Thank you guys. </p>
							</footer>
						</div>
					</div>				
				</section>
			</div>
		</div>
	</body>
</html>