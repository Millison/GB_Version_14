<?php

class Extra {
	/* In abhängigkeit davon, welche Rechte der Bunutzer hat, werden manche Seiten-Ellemente
	 * zusätzlich zum Content erscheinen.
	 * z.B. Links: 'Benutzer löschen', 'Kommentar Löschen', etc.  */
	
	private $pfad = "http://localhost/dimas-test/GB_Version_14/";
	private $fuerWem;	// Für wemm soll die Seite erscheinen (Admin/Gast/Fremde)
	
	public function __construct() {
		if (!empty($_SESSION["log"]) and $_SESSION["rechte"] === 1) {
			$this->fuerWem = "admin";
		} elseif (!empty($_SESSION["log"]) and $_SESSION["rechte"] === 0) {
			$this->fuerWem = "gast";
		} else {
			$this->fuerWem = "fremd";
		}
	}
	
	public function kopfLink() {
		$output = "";
		if ($this->fuerWem === "admin") {
			$linkBenutzerVerwalten = linkH($this->pfad."#", "Benutzer verwalten");
			$linkAusloggen = linkH($this->pfad."aktionen/ausloggen.php", "Ausloggen");
			$output = $linkBenutzerVerwalten." ".$linkAusloggen;
		} elseif ($this->fuerWem === "gast") {
			$linkAusloggen = linkH($this->pfad."aktionen/ausloggen.php", "Ausloggen");
			$output = $linkAusloggen;
		} else { 			// <----- fuerWem == fremd
			$linkAnmelden = linkH($this->pfad."aktionen/anmeldeForm.php", "Anmelden");
			$linkRegistrieren = linkH($this->pfad."#", "Registrieren");
			$output = $linkAnmelden." ".$linkRegistrieren;
		}
		return $output;
	}
	
	public function kommentLink($kommentID, $seinKomment="") {
		$output = "";
		#$this->fuerWem = "gast";
		if ($this->fuerWem === "admin" or !empty($seinKomment)) {
			$linkAntworten = linkH($this->pfad."aktionen/kommentarEdit.php?antwort=".$kommentID, "Antworten", "admin");
			$linkEdit = linkH($this->pfad."aktionen/kommentarEdit.php?edit=".$kommentID, "Editieren", "admin");
			$linkLoeschen = linkH($this->pfad."aktionen/kommentarLoeschen.php?loeschen=".$kommentID, "Löschen", "admin");
			$output = $linkAntworten." ".$linkEdit." ".$linkLoeschen;
		} elseif ($this->fuerWem === "gast") {
			$linkAntworten = linkH("#?antwort=".$kommentID, "Antworten", "gast");
			$output = $linkAntworten;
		}
		return $output;
	}
	
	public function kommentarFeldAmFusszeile() {
		if (!empty($this->fuerWem)) {
			genKommentForm($action, "POST", "Ihr Kommentar:");
		}
	}
	
	public function setFuerWem($user="fremd") {
		$this->fuerWem = $user;
	}
	
	public function getFuerWem() {
		return $this->fuerWem;
	}
}

?>