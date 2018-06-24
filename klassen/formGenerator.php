<?php

class FormGen {
	/* Lifert vertige Formulare als HTML zurück */
	
	public function genKommentForm($action, $method="POST", $titel="") {
		$output = "<h2>".$titel."</h2>".PHP_EOL;
		$output .= "<form action=\"".$action."\" method=\"".$method."\" >".PHP_EOL;
		$output .= label("Ihr Kommentar:");
		$output .= textareaFeld("text", 50, 10);
		$output .= button("Senden");
		$output .= "</form>".PHP_EOL;
		return $output;
	}
	
	public function genAnmeldenForm($action, $passwort="") {
		$output = "<h2>Anmelden</h2>".PHP_EOL;
		$output .= "<form action=\"".$action."\" method=\"POST\" >".PHP_EOL;
		$output .= label("Logginname:");
		$output .= textFeld("logname", 20, 30);
		$output .= label("Passwort:");
		$output .= passwortFeld(20, 30, htmlspecialchars($passwort));
		$output .= button("Anmelden");
		$output .= "</form>".PHP_EOL;
		return $output;
	}
	
	public function genRegistrierenForm($action, $method="POST", $titel="") {
		$output = "<h2>".$titel."</h2>".PHP_EOL;
		$output .= "<form action=\"".$action."\" method=\"".$method."\" >".PHP_EOL;
		$output .= label("Vorname:");
		$output .= textFeld("vorname", 20, 30);
		$output .= label("Nachname:");
		$output .= textFeld("nachname", 20, 30);
		$output .= label("Logginname:");
		$output .= textFeld("logname", 20, 30);
		$output .= label("Passwort:");
		$output .= passwortFeld(20, 30);
		$output .= label("Wiederholen Sie Ihr Passwort:");
		$output .= passwortFeld(20, 30);
		$output .= radioButtun("rechte", "0", "Benutzer");
		$output .= radioButtun("rechte", "1", "Admin");
		$output .= button("Registrieren");
		$output .= "</form>".PHP_EOL;
		return $output;
	}
	
	/* <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post"> */
}

?>