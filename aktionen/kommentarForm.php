<?php
session_start();

include '../vorlagen/connect.php';
include '../vorlagen/mysqlSatz.php';
include '../klassen/sqlGenerator.php';
include '../klassen/replace.php';

$db = new DBVerbindung();
$sqlAbfrage = new SQLGen($db->dbv);
$ersetzen = new Ersetzen();

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
		<h2>Komentar eintragen</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
			Ihr Kommentar: <br />
			<textarea name="text" cols="50" rows="10"></textarea>
			<br />
			<input type="submit" value="Senden" />
			<br />
		</form>
		<br />
		<p><a href="../initTest.php">Zurück zur Startseite</a></p>
		
		<?php
		
		if (isset($_POST["text"])) {
			$kommentar = htmlspecialchars($_POST["text"]);
			if (isset($_SESSION["logname"])) {
				$zeit = date('Y-d-m G:i:s');
				$status = 0;
				isset($_SESSION["parents"]) ? $parents = $_SESSION["parents"] : $parents = 0;
				$insert = $db->dbv->prepare("INSERT INTO buch
											(logname,
											text,
											zeit,
											status,
											parents)
											VALUES(?, ?, ?, ?, ?)");
				$insert->bind_param("sssss", $_SESSION["logname"],
						$kommentar,
						$zeit,
						$status,
						$parents);
				if ($ergebnis = $insert->execute()) {
					echo "Ihr Kommentar wurde gespeichert.";
					$host  = htmlspecialchars($_SERVER["HTTP_HOST"]);
					$uri   = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
					#$extra = "initTest.php";
					#header("Location: http://$host$uri/$extra");
					#header('Location: http://localhost/dimas-test/GB_Version_12/init.php');
				} else {
					echo "Fehler bei der DB-Verbindung: <br />" . $db->dbv->error;
				}
			}
		}
		?>
		
	</div>	
</div>
</body>
</html>
	


