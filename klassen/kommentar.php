<?php

class Kommentar {
	
	private $kommentarDaten = array(
			"id" => "",
			"logname" => "",
			"text" => "",
			"zeit" => "",
			"status" => "",
			"parents" => "");
		
	public function setKommentarDaten($kommentar) {
		$this->kommentarDaten["id"] = $kommentar["id"];
		$this->kommentarDaten["logname"] = $kommentar["logname"];
		$this->kommentarDaten["text"] = $kommentar["text"];
		$this->kommentarDaten["zeit"] = $kommentar["zeit"];
		$this->kommentarDaten["status"] = $kommentar["status"];
		$this->kommentarDaten["parents"] = $kommentar["parents"];
	}
	
	public function setKommentID($kommentID) {
		$this->kommentarDaten["id"] = $kommentID;
	}
	
	public function setKommentLogname($kommentLogname) {
		$this->kommentarDaten["logname"] = $kommentLogname;
	}
	
	public function setKommentText($kommentText) {
		$this->kommentarDaten["text"] = $kommentText;
	}
	
	public function setKommentZeit($kommentZeit) {
		$this->kommentarDaten["zeit"] = $kommentZeit;
	}
	
	public function setKommentStatus($kommentStatus) {
		$this->kommentarDaten["status"] = $kommentStatus;
	}
	
	public function setKommentParents($kommentParents) {
		$this->kommentarDaten["parents"] = $kommentParents;
	}
	
	public function getKommentarDaten() {
		return $this->kommentarDaten;
	}
	
	public function getKommentarID(){
		return $this->kommentarDaten["id"];
	}
	
	public function getKommentarLogname(){
		return $this->kommentarDaten["logname"];
	}
	
	public function getKommentarText(){
		return $this->kommentarDaten["text"];
	}
	
	public function getKommentarZeit(){
		return $this->kommentarDaten["zeit"];
	}
	
	public function getKommentarStatus(){
		return $this->kommentarDaten["status"];
	}
}

?>