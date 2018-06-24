<?php

include '../vorlagen/connect.php';

if (isset($_GET["loeschen"])) {
	kommentarLoeschen($_GET["loeschen"]);
}

function kommentarLoeschen($kommentarID) {
	
	$komment = "DELETE FROM buch WHERE id = $kommentarID";
	$db = new DBVerbindung();
	$delet = $db->dbv->prepare($komment);
	if ($ergebnis = $delet->execute()) {
		$host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
		$uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
		$extra = "../initTest.php";
		header("Location: http://$host$uri/$extra");
	} else {
		echo "Fehler bei Kommentar löschen: " . mysql_error();
		echo $db->dbv->error;
	}
}

?>
