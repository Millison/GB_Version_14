<?php

/* 
 * Lifert vollständige SQL-Befehlsätze als String zurück.
 * Die Befehlsätze werden hier nicht ausgeführt!
 * */

function selectSQL($feld, $tabelle, $where="", $bedingung="", $order="") {
	$output = "SELECT ".$feld." FROM ".$tabelle;
	if (!empty($where)) {
			$output .= " WHERE ".$where."='".$bedingung."'";
	} elseif (!empty($order)) {
		$output .= " ORDER BY ".$order;
	}
	$output .= ";";
	return $output;
}


/* 
 * $tabelle: String						in welcher Tabelle
 * $felderNamen: Array					in welchen Feldern sollen die Daten aktualisiert werden
 * 										jeder Feldname soll eigenen Index haben (assoziatives Array)
 * $neueDaten: Array					jeder Feldname soll eigenen Index haben (assoziatives Array)
 * $whereFeld: String					Name des Feldes. Nach welchen Kriterien wird der Datensatz
 * 										für Update in der Tabelle gefunden.
 * $where: 								Wert für $whereFeld */
function updateSQL($tabelle, $felderNamen, $neueDtaen, $whereFeld, $where) {
	$feldNummer = 0;
	$output = "UPDATE ".$tabelle." SET ";
	foreach ($felderNamen as $feld) {
		$output .= "".$feld."='".htmlspecialchars($neueDtaen[$feldNummer])."', "; // LETZTE KOMA MUSS WEG!!!!  SONST SQL-FEHLER
		$feldNummer++;
	}
	$output .= "WHERE ".$whereFeld."='".$where."';";
	return $output;
}


function insertSQL($tabelle, $felderNamen, $neueDaten) {
	$output = "INSERT INTO ".$tabelle."	(";
	foreach ($felderNamen as $feld) {
		$output .= $feld.", "; // LETZTE KOMA MUSS WEG!!!!  SONST SQL-FEHLER
	}
	$output .= ") VALUES (";
	foreach ($neueDaten as $date) {
		$output .= htmlspecialchars($date).", "; // LETZTE KOMA MUSS WEG!!!!  SONST SQL-FEHLER
	}
	$output .= ");";
	return $output;
}

?>