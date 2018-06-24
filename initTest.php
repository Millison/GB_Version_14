<?php 
session_start();
#include 'vorlagen/form.php';
include 'vorlagen/mysqlSatz.php';
include 'klassen/benutzer.php';
include 'klassen/kommentar.php';
include 'klassen/formGenerator.php';
include 'klassen/sqlGenerator.php';
include 'vorlagen/htmlTag.php';
include 'klassen/replace.php';
include 'vorlagen/connect.php';
include 'klassen/speziales.php';

/***********************************************************/
$db = new DBVerbindung();
$ersetzen = new Ersetzen();					// Die gesamte Seite als HTML bleibt in diesem Objekt und wird ständig
											// durch interne Funktion 'replace($wasStelle, $wodurch, $woDatei="")'
											// erweitert bzw. aktualisiert.
$sqlAbfrage = new SQLGen($db->dbv);					// Generiert vollständige SQL-Abfrage als String 
$aktuellerBenutzer = new Extra();			// Aufgrund von Benutzerrechten können Extra-Seiten-Elemente erscheinen
$form = new FormGen();
$benutzer = new Benutzer();

define("PFAD", "http://localhost/dimas-test/GB_Version_14/");

/************************** FALLS EIN LINK ANGECKLICKT WIRD *********************************/

if (!empty($_SESSION["logname"])) {
	#echo "SESSION: ".$_SESSION["logname"];
	$benutzer->setBenutzerDaten($sqlAbfrage->genBenutzerSuche("logname", $_SESSION["logname"]));
	if ($benutzer->getBenutzerRechte() === "0") {
		$aktuellerBenutzer->setFuerWem("gast");
	} else {
		$aktuellerBenutzer->setFuerWem("admin");
	}
} else {
	$aktuellerBenutzer->setFuerWem("fremd");
}



/* ######################## PRÄSENTATION DER SEITE ########################## */
function kopfbereich() {
	global $ersetzen, $aktuellerBenutzer;
	$ersetzen->replace("ueberschrift", "MeinForum", "vorlagen/body.html");
	$ersetzen->replace("linksLeiste", $aktuellerBenutzer->kopfLink());
}

function kommentAusgabe() {
	global $ersetzen, $sqlAbfrage, $aktuellerBenutzer;
	$stream = ""; 
	$komments = $sqlAbfrage->genKommentListe(); // Die daten aus Datenbank
	// Jeder Kommentar in einem eigenen DIV packen
	while ($zeile = $komments->fetch_array()) {
		$stream .= div("Benutzer: <strong>".$zeile["logname"]."</strong>; Am: ".$zeile["zeit"]."<br />".$zeile["text"],
				"eintrag", $zeile["id"]);
		$stream .= div($aktuellerBenutzer->kommentLink($zeile["id"]), "edit");
		$stream .= "<hr />";
	}
	$ersetzen->replace("einKomment", $stream);
}

function kommentarFeldAmFusszeile() {
	global $ersetzen, $form, $aktuellerBenutzer;
	if ($aktuellerBenutzer->getFuerWem() != "fremd") {
		
		$ersetzen->replace("neuKommentForm", $form->genKommentForm($action, "POST", "Ihr Kommentar"));
	}
}

/* ################################################## */




kopfbereich();
kommentAusgabe();
echo $ersetzen->getInhalt();



?>
