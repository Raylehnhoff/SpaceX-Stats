<?php 
class Mission extends Database {
	protected $missionDetails, $mission_id;

	// Construct the mission by grabbing info about the id passed from the database. 
	public function __construct($id) {
		// Check how many entries are present 
		parent::__construct();
		parent::run("SELECT COUNT(*) FROM `missions`");
		$records = parent::single();

		if ($id) {
			if (is_numeric($id)) {
				$id = (int) $id;
				if ($id !== 0 && $id <= $records['COUNT(*)']) {
					// Retrieve information from db
					parent::run("SELECT * FROM `missions` WHERE `mission_id`=:id LIMIT 1");
					parent::bind(':id', $id);

					$this->missionDetails = parent::single();
					$this->mission_id = $id;
				} else {
					$this->headerFlag();
				}
			} else {
				$this->headerFlag();
			}
		} else {
			$this->headerFlag();
		}
	}

	// Call in mission.php to get the mission details
	public function getMission() {
		$this->rocketSpecificFlightCount();
		return $this->missionDetails;
	}

	// Retrieve the rocket specfic count;
	public function rocketSpecificFlightCount() {
		$vehicle = $this->missionDetails['vehicle'];

		if ($vehicle == 'Falcon 9' || $vehicle == 'Falcon 9 + Dragon') {

			$this->missionDetails['specificVehicle'] = 'Falcon 9';
			parent::run("SELECT * FROM `missions` WHERE 
					(`vehicle`='Falcon 9' OR `vehicle`='Falcon 9 + Dragon') 
					AND `mission_id`<=:missionid");

			parent::bind(':missionid', $this->mission_id);

		} else {

			$this->missionDetails['specificVehicle'] = $vehicle;
			parent::run("SELECT * FROM `missions` WHERE `vehicle`=:vehicle AND `mission_id`<=:missionid");
			parent::bind(':vehicle', $vehicle);
			parent::bind(':missionid', $this->mission_id);
				
		} 

		parent::execute();
		$this->missionDetails['specificCount'] = parent::rowCount();;
	}

	// Produce and echo out the stamp on each mission page
	public function echoStamps() {
		$inProgressBool = (bool) $this->missionDetails['in_progress'];

		// Mission is in progress
		if ($inProgressBool === true) {
			echo '<img class="status" src="/images/inprogressstamp.png" />';
			echo $inProgressBool;

		// Mission is not in progress
		} else {
			$completeBool = (bool) $this->missionDetails['complete'];

			// Mission is complete
			if ($completeBool === true) {
				echo '<img class="status" src="/images/completedstamp.png" />';

				$successBool = (bool) $this->missionDetails['success'];

				// Mission was successful
				if ($successBool === true) {
					echo '<img class="outcome" src="/images/successstamp.png" />';

				// Mission was not successful
				} else {
					echo '<img class="outcome" src="/images/failurestamp.png" />';
				}

			// Mission is not complete	
			} else {
				echo '<img class="status" src="/images/upcomingstamp.png" />';
			}
		}
	}

	public function generateTable() {
		$locDetail = $this->missionDetails;
		echo '<table class="missionstatistics"><tr>';
				echo '<td>'.ordinal($locDetail['mission_id']).'</td>';
				echo '<td>'.ordinal($locDetail['specificCount']).'</td>';
				echo '<td>'.($locDetail['launch_date_time'] ? manipulateDateTime($locDetail['launch_date_time'], false) : $locDetail['expected_launch']).'</td>';
				echo '<td>'.$locDetail['payload'].'</td>';
				if ($locDetail['astronauts'] > 0) {
					echo '<td class="optional">'.$locDetail['astronauts'].'</td>';
				}
				if ($locDetail['dragon_up_mass'] > 0) {
					echo '<td class="optional">'.$locDetail['dragon_up_mass'].' kg</td>';
				}
				if ($locDetail['dragon_down_mass'] > 0) {
					echo '<td class="optional">'.$locDetail['dragon_down_mass'].' kg</td>';
				}
				echo '<td>'.$locDetail['destination'].'</td>';
				echo '<td class="optional">'.$locDetail['core'].'</td>';
				echo '<td class="optional">'.$locDetail['launch_site'].'</td>';
				echo '<td></td>';
				echo '<td></td>';
			echo '</tr><tr>';
				echo '<td>SpaceX<br/>Launch</td>';
				echo '<td>'.$locDetail['specificVehicle'].' Launch</td>';
				echo '<td>Time/Date<br/>(UTC)</td>';
				echo '<td>Payload</td>';
				if ($locDetail['astronauts'] > 0) {
					echo '<td class="optional">Astronauts</td>';
				}
				if ($locDetail['dragon_up_mass'] > 0) {
					echo '<td class="optional">Dragon Up Mass</td>';
				}
				if ($locDetail['dragon_down_mass'] > 0) {
					echo '<td class="optional">Dragon Down Mass</td>';
				}
				echo '<td>Destination</td>';
				echo '<td class="optional">Core</td>';
				echo '<td class="optional">Launch Site</td>';
				echo '<td></td>';
				echo '<td></td>';
		echo '</tr></table>';
	}

	private function headerFlag($location = 'index.php') {
		header('Location: '.$location);
		exit();
	}
}
?>