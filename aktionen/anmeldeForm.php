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
		<?php 
		if (isset($_POST["logname"])) {
			$logname = htmlspecialchars($_POST["logname"]);
			$passwort = htmlspecialchars($_POST["passwort"]);
		} else {
			$logname = "";
			$passwort = "";
		}
		?>
		<h2>Anmelden:</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
			Logginname: <br />
			<input type="text" name="logname" size="20" maxlength="30" value="<?php echo htmlspecialchars($logname); ?>" />
			<br />
			Passwort: <br />
			<input type="password" name="passwort" size="20" maxlength="30" value="<?php echo htmlspecialchars($passwort); ?>" />
			<br />
			<input type="submit" value="Anmelden" name="anmelden" />
			<br />
		</form>
		<br />
		<p><a href="../initTest.php">Zurück zur Startseite</a></p>
		
		<?php
		#echo $_POST["logname"];
		if (isset($_POST["logname"])) {
			$_SESSION["login"] = "";
			$_SESSION["rechte"] = "";
			$benutzer = $sqlAbfrage->genBenutzerSuche("logname", $logname);
			if (!empty($benutzer["logname"])) {
				if (strcmp($benutzer["passwort"], $passwort) == 0) {
					#$_SESSION["login"] = "ok";
					#$_SESSION["rechte"] = $benutzer["rechte"];
					$_SESSION["logname"] = $benutzer["logname"];
					header('Location: http://localhost/dimas-test/GB_Version_14/initTest.php');
					echo "Sie sind angemeldet!";
				} else {
					echo "Passwort ist Falsch!";
				}
			} else {
				echo "Benutzer mit dem Logname <strong>".$_POST["logname"]."</strong> wurde nicht gefunden.";
			}
		}
		?>
		
	</div>	
</div>
</body>
</html>
	


