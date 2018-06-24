<?php

class Benutzer {
	
	private $benutzerDaten = array (
			"vorname" => "",
			"nachname" => "",
			"logname" => "",
			"passwort" => "",
			"passTwo" => "",
			"rechte" => "",
			"istEingelogt" => "");
	
	public function setBenutzerDaten($datenSatz) {
		$this->benutzerDaten["vorname"] = $datenSatz["vorname"];
		$this->benutzerDaten["nachname"] = $datenSatz["nachname"];
		$this->benutzerDaten["logname"] = $datenSatz["logname"];
		$this->benutzerDaten["passwort"] = $datenSatz["passwort"];
		#$this->benutzerDaten["passTwo"] = $datenSatz["passTwo"];
		$this->benutzerDaten["rechte"] = $datenSatz["rechte"];
		#$this->benutzerDaten["login"] = $datenSatz["login"];
	}
	
	public function setVorname($vorname) {
		$this->benutzerDaten["vorname"] = $vorname;
	}
	
	public function setNachname($nachname) {
		$this->benutzerDaten["nachname"] = $nachname;	
	}
	
	public function setLogname($logname) {
		$this->benutzerDaten["logname"] = $logname;
	}
	
	public function setPasswort($passwort) {
		$this->benutzerDaten["passwort"] = $passwort;	
	}
	
	public function setRechte($rechte) {
		$this->benutzerDaten["rechte"] = $rechte;	
	}
	
	public function setIstEingelogt($istEingelogt) {
		$this->benutzerDaten["istEingelogt"] = $istEingelogt;	
	}
	
	public function getBenutzerDaten() {
		return $this->benutzerDaten;
	}
	
	public function getBenutzerRechte() {
		return $this->benutzerDaten["rechte"];
	}
}

?>