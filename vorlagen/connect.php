<?php

class DBVerbindung {
	/* Baut eine Verbindung zu DB */

	public $dbv;
	
	public function __construct() {
		$mysqli = new mysqli("localhost", "root", "", "gaestebuch");

		if ($mysqli->connect_error) {
			echo "Fehler bei der Verbundung zur Datenbank: " . mysqli_connect_error();
			exit();
		}

		if (!$mysqli->set_charset("utf8")) {
			echo "Fehler beim Laden von UTF-8 " . $mysqli->error;
		} else {
			$this->dbv = $mysqli;
		}
	}

	public function getConnect() {
		return $this->dbv;
	}
}

?>