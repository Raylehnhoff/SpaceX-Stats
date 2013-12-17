<?php
	include 'php/initialize.php';	

	// Return future launches
	$dbh = new Database();
	$dbh->run('SELECT * FROM `missions` WHERE `complete`=1 ORDER BY `mission_id` ASC');
	$completeLaunches = $dbh->resultSet();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Previous Launches</title>
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
	<section id="previous">
		<div class="plaque">
			<a href="index.php" id="homelink"></a>
			<header>Previous</header>
			<a href="index.php" title="Home"><div id="rightchevron" class="chevron"></div></a>	
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
					foreach ($completeLaunches as $completeLaunch) {
						echo '<a href="mission.php?mission_id=1">';
						echo '<tr>';
							if (!empty($completeLaunch['launch_date_time'])) {
								echo '<td class="small">'.manipulateDateTime($completeLaunch['launch_date_time'], false).'</td>';
							} else {
								echo '<td class="small">'.$completeLaunch['expected_launch'].'</td>';
							}
						echo '<td class="small"><a href="mission.php?mission_id='.$completeLaunch['mission_id'].'">'.$completeLaunch['payload'].'</a></td>';
						echo '<td class="small">'.$completeLaunch['vehicle'].'</td>';
						echo '<td class="small">'.$completeLaunch['launch_site'].'</td>';
						echo '<td class="summary">'.$completeLaunch['summary'].'</td>';
						echo '</tr></a>';
					}
					?>
				</table>
			</div>
			<footer>
				<p>So far, SpaceX has completed <?php echo count($completeLaunches); ?> launches of both its Falcon 1 & currently active Falcon 9 rocket.</p>
			</footer>
		</div>
	</section>
	</body>
</html>