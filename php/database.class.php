<?php 
class Database {
	protected $host = 'mysql.spacexstats.com';
	protected $db = 'spacexstats';
	protected $user = 'lukealization';
	protected $pass = 'Skyfall007';

	protected $dbh, $error, $stmt;

	public function __construct() {
		try {		
			// Create new DB Object 
			$this->dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->db,$this->user,$this->pass);

			// Set the error mode
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		} catch(PDOException $e) {	
			// Echo any errors. 
			echo $this->error = $e->getMessage();		
		}		
	}

	// Low level function
	public function run($query, $runType = 'prepare') {
		try {
			$this->stmt = $this->dbh->prepare($query);
		} catch (PDOException $e) {
			echo $this->error = $e->getMessage();
		}
	}

	// Low level function
	public function bind($parameter, $value, $bindType = 'param') {
		try {
			$this->stmt->bindParam($parameter, $value);
		} catch (PDOException $e) {
			echo $this->error = $e->getMessage();
		}
	}

	// Low level function
	public function execute() {
		try {
			return $this->stmt->execute();
		} catch (PDOException $e) {
			echo $this->error = $e->getMessage();
		}
	}

	// Low level function 
	public function rowCount() {
		return $this->stmt->rowCount();
	}

	// Medium level function
	public function resultSet() {
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Medium level function
	public function single() {
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

}

?>