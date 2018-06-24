<?php 
session_start();
?>
<html>
	<head>
		<meta charset="UTF-8" />
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<title>MeinForum</title>
	</head>
<body>

<div id="content">
	<div id="kopf">
		<div id="logo">{logo}</div>
		<div id="ueberschrift">MeinForum</div>
	</div>
	<div id="links">
		<?php
		include '../vorlagen/connect.php';
		include '../vorlagen/mysqlSatz.php';
		include '../klassen/sqlGenerator.php';
		include '../klassen/replace.php';
		include '../klassen/kommentar.php';
		
		$db = new DBVerbindung();
		$sqlAbfrage = new SQLGen($db->dbv);
		$ersetzen = new Ersetzen();
		$kommentar = new Kommentar();
		
		if (isset($_GET["antwort"])) {
			$option = "antwort";
			$kommentAktion = "Ihre Antwort:";
			$zeile = $sqlAbfrage->genKommentSuche("id", $_GET["antwort"]);
			$kommentar->setKommentarDaten($zeile->fetch_array());
			$kommentarText = "";
			$kommentarID = $kommentar->getKommentarID();
			#$sqlAktionKriterium = "parents";
			?>
			<h2>Antwort auf den Kommentar:</h2>
			<p><strong><?php echo $kommentar->getKommentarText(); ?></strong></p>
			<br />
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
				<input type="hidden" name="option" value="<?php echo $option; ?>">
				<input type="hidden" name="id" value="<?php echo $kommentarID; ?>">
				Ihr Kommentar: <br />
				<textarea name="neuerText" cols="50" rows="10"><?php echo htmlspecialchars($kommentarText); ?></textarea>
				<br />
				<input type="submit" value="Senden" />
				<br />
			</form>
			<p><a href="../initTest.php">Zurück zur Startseite</a></p>
			<?php 
		} elseif (isset($_GET["edit"])) {
			$option = "edit";
			$kommentAktion = "Kommentar Bearbeiten:";
			$zeile = $sqlAbfrage->genKommentSuche("id", $_GET["edit"]);
			$kommentar->setKommentarDaten($zeile->fetch_array());
			$kommentarID = $kommentar->getKommentarID();
			?>
			<h2>Kommentar bearbeiten:</h2>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
				<input type="hidden" name="option" value="<?php echo $option; ?>">
				<input type="hidden" name="id" value="<?php echo $kommentarID; ?>">
				Ihr Kommentar: <br />
				<textarea name="neuerText" cols="50" rows="10"><?php echo htmlspecialchars($kommentar->getKommentarText()); ?></textarea>
				<br />
				<input type="submit" value="Senden" />
				<br />
			</form>
			<p><a href="../initTest.php">Zurück zur Startseite</a></p>
			<?php 
		}
		?>

		<?php
		if (isset($_POST["neuerText"]) and !empty($_SESSION["logname"])) {
			$logname = $_SESSION["logname"];
			$text = htmlspecialchars($_POST["neuerText"]);
			$zeit = date('Y-d-m G:i:s');
			$kommentarID = $_POST["id"];
			if ($_POST["option"] == "edit") {
				$updateText = "UPDATE buch SET logname='$logname', text='$text', zeit='$zeit' WHERE id='$kommentarID'";
				if ($db->dbv->query($updateText)) {
					echo "Ihr Kommentar wurde gespeichert!";
					echo " [Zeit: ".$zeit."] [Parents: ".$kommentarID."] [Benutzer: ".$logname."]";
				} else {
					echo "Fehler beim Update: " . $db->dbv->error;
				}
			} elseif ($_POST["option"] == "antwort") {
				$status = "0";
				$insert = $db->dbv->prepare("INSERT INTO buch
						(logname, text,	zeit, status, parents)
						VALUES(?, ?, ?, ?, ?)");
				$insert->bind_param("sssss", $logname, $text, $zeit, $status, $kommentarID);
				if ($ergebnis = $insert->execute()) {
					echo "Ihr Kommentar wurde gespeichert!";
					echo " [Zeit: ".$zeit."] [Parents: ".$kommentarID."] [Benutzer: ".$logname."]";
				} else {
					echo "Fehler bei der DB-Verbindung: <br />" . $db->dbv->error;
				}
			}
			#$host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
			#$uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
			#$extra = "initTest.php";
			#header("Location: http://$host$uri/$extra");
			#header('Location: http://localhost/dimas-test/GB_Version_14/initTest.php');
		}
		?>
	</div>	
</div>
</body>
</html>