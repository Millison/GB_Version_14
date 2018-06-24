<?php

class SQLGen {
	/* Bildet mit Hilfe 'mysqlSatz.php' die SQL-Befehlsätze
	 * und führt sie hier aus.
	 * Liefert zurück die Daten aus dem Datenbank. */
	
	private $dbv;
	
	public function __construct($dbv) {
		$this->dbv = $dbv;
	}
	
	public function genBenutzerSuche($kriterium, $wert) {
		if ($kriterium === "logname") {
			$sql = selectSQL("*", "benutzer", "logname", $wert);
		} elseif ($kriterium === "id") {
			$sql = selectSQL("*", "benutzer", "benutzer_id", $wert);
		}
		$output = $this->dbv->query($sql);
		return $output->fetch_array();
	}
	
	public function genBenutzerListe() {
		$sql = selectSQL("*", "benutzer");
		$benutzerList = verbindung($sql);
		return $benutzerList;
	}
	
	public function genKommentSuche($kriterium, $wert) {
		if ($kriterium === "logname") {
			$sql = selectSQL("*", "buch", "logname", $wert);
		} elseif ($kriterium === "parents") {
			$sql = selectSQL("*", "buch", "parents", $wert);
		}elseif ($kriterium === "id") {
			$sql = selectSQL("*", "buch", "id", $wert);
		}
		$output = $this->dbv->query($sql);
		/* #$zeile = $verbindung($sql)->fetch_array();
		if ($zeile == NULL) {
			setMeldung("Kommentar ist nicht gefunden!");
		} else {
			setKommentarDaten($zeile);
		}*/
		return $output;
	}
	
	public function genKommentListe() {
		$sql = selectSQL("*", "buch");
		$kommentList = $this->dbv->query($sql);
		return $kommentList;
	}
	
	public function genKommentUpdate() {
		
	}
	
	public function genKommentDelet() {
		
	}
	
	public function genKommentSet() {
		
	}
}

?>