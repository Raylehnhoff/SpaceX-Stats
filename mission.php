<?php 
include 'php/initialize.php';
$mission = new Mission($_GET['mission_id']);
$missionDetail = $mission->getMission();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Launch <?php echo $missionDetail['mission_id'].' | '.$missionDetail['payload']; ?></title>
		<link rel="stylesheet" href="assets/styles.css" type="text/css" />		

		<link rel="icon" href="favicon.png">
		<!--[if IE]><link rel="shortcut icon" href="favicon.ico"><![endif]-->	

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="assets/jquery-1.9.1.min.js"><\/script>')</script>

		<script src="assets/countdown.js"></script>

		<noscript>
	  		<style>html{display:none;}</style>
	  		<meta http-equiv="refresh" content="0.0;url=nojs.php">
		</noscript>
	</head>
	<body>
	<section class="mission">
		<div class="plaque">
			<a href="index.php" id="homelink"></a>
			<a href="mission.php?mission_id=<?php echo $missionDetail['mission_id'] - 1; ?>" id="backlink"></a>
			<a href="mission.php?mission_id=<?php echo $missionDetail['mission_id'] + 1; ?>" id="forwardlink"></a>

			<?php $stamps = $mission->echoStamps(); ?>

			<header><?php echo $missionDetail['payload']; ?></header>

			<?php if ($missionDetail['complete'] == 1) { ?>
				<article>
					<?php echo $missionDetail['article']; ?>
				</article>
			<?php } else { ?>
			<div class="contents">
			<?php	if (!is_null($missionDetail['launch_date_time'])) {
					$countdown = manipulateDateTime($missionDetail['launch_date_time']);
				?>
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
							<td><?php echo $missionDetail['expected_launch']; ?></td>
						</tr>
						<tr class="unit">
							<td>Expected Launch</td>
						</tr>
					</table>
			<?php } ?>
			</div>
			<?php } ?>

			<footer>
				<?php $table = $mission->generateTable(); ?>
				<p><?php echo $missionDetail['summary']; ?></p>
			</footer>
		</div>
	</section>
	</body>
</html>