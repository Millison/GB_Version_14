<?php

include '../vorlagen/form.php';
include '../vorlagen/mysqlSatz.php';
include 'benutzer.php';
include 'kommentar.php';
include 'formGenerator.php';
include 'sqlGenerator.php';
include '../vorlagen/htmlTag.php';
include 'replace.php';
include '../vorlagen/connect.php';
include 'speziales.php';

class SeitePraesentation {
	
	public $output;
	
	public function __construct() {
		kopfbereich();
		kommentAusgabe();
		kommentarFeldAmFusszeile();
		fuss();
	}
	
	public function kopfbereich() {
		global $ersetzen, $aktuellerBenutzer;
		$ersetzen->replace("ueberschrift", "MeinForum", "vorlagen/body.html");
		$ersetzen->replace("linksLeiste", $aktuellerBenutzer->kopfLink());
	}
	
	public function kommentAusgabe() {
		global $db, $ersetzen, $sqlAbfrage, $aktuellerBenutzer;
		$stream = "";
		$komments = $sqlAbfrage->genKommentListe($db->dbv); // Die daten aus Datenbank
		// Jeder Kommentar in einem eigenen DIV packen
		while ($zeile = $komments->fetch_array()) {
			$stream .= div("Benutzer: <strong>".$zeile["logname"]."</strong>; Am: ".$zeile["zeit"]."<br />".$zeile["text"],
					"eintrag", $zeile["id"]);
			$stream .= div($aktuellerBenutzer->kommentLink($zeile["id"]), "edit");
			$stream .= "<hr />";
		}
		$ersetzen->replace("einKomment", $stream);
	}
	
	public function kommentarFeldAmFusszeile() {
		global $ersetzen, $form, $aktuellerBenutzer;
		if ($aktuellerBenutzer->getFuerWem() != "fremd") {
	
			$ersetzen->replace("neuKommentForm", $form->genKommentForm($action, "POST", "Ihr Kommentar"));
		}
	}
	
}

?>