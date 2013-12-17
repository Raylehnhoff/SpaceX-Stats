<?php
	include 'php/initialize.php';	

	// Return future launches
	$dbh = new Database();
	$dbh->run('SELECT * FROM `missions` WHERE `complete`=0 ORDER BY `mission_id` ASC');
	$futureLaunches = $dbh->resultSet();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Upcoming Launches</title>
		<link rel="stylesheet" href="assets/styles.css" type="text/css" />		

		<link rel="icon" href="favicon.png">
		<!--[if IE]><link rel="shortcut icon" href="favicon.ico"><![endif]-->	

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/jquery-1.9.1.min.js"><\/script>')</script>

		<noscript>
	  		<style>html{display:none;}</style>
	  		<meta http-equiv="refresh" content="0.0;url=nojs.php">
		</noscript>
	</head>
	<body>
	<section id="upcoming">
		<div class="plaque">
			<a href="index.php" id="homelink"></a>
			<header>Upcoming</header>
			<a href="index.php" title="Home"><div id="leftchevron" class="chevron"></div></a>
			<div class="contents">
				<table id="launchList">
					<tr>
						<th>Time & Date (UTC)</th>
						<th>Payload</th>
						<th>Vehicle</th>
						<th>Launch Site</th>
						<th>Mission Summary</th>
					</tr>
					<?php
					foreach ($futureLaunches as $futureLaunch) {
						echo '<tr>';
							if (!empty($futureLaunch['launch_date_time'])) {
								echo '<td class="small">'.manipulateDateTime($futureLaunch['launch_date_time'], false).'</td>';
							} else {
								echo '<td class="small">'.$futureLaunch['expected_launch'].'</td>';
							}
						echo '<td class="small"><a href="mission.php?mission_id='.$futureLaunch['mission_id'].'">'.$futureLaunch['payload'].'</a></td>';
						echo '<td class="small">'.$futureLaunch['vehicle'].'</td>';
						echo '<td class="small">'.$futureLaunch['launch_site'].'</td>';
						echo '<td class="summary">'.$futureLaunch['summary'].'</td>';
						echo '</tr>';
					}
					?>
				</table>
			</div>
			<footer>
				<p>Contained here is a list of upcoming launches and milestones that SpaceX will conduct. By November 2013, SpaceX was achieving a production rate of 1 Falcon 9 vehicle per month; and is only at the beginning of its ramp up in production, aiming to produce 40 cores for 24 launch vehicles per year by the end of 2014.</p>
			</footer>
		</div>
	</section>
	</body>
</html>