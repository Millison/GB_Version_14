<?php
/* Lifert zurück HTML-Quode als String */

function kopf($ueberschrift) {
	$output = "<h2>".$ueberschrift."</h2";
	$output .= "<hr />".PHP_EOL;
	$output .= "<head>".PHP_EOL;
	$output .= "<title>".$seitenTitel."</title>".PHP_EOL;
	$output .= "<meta charset=\"UTF-8\" />".PHP_EOL;
	$output .= "</head>".PHP_EOL;
	$output .= "<body>".PHP_EOL;
	return $output;
}

function div($content, $class="", $id="") {
	$output = "<div";
	if (!empty($id)) {
		$output .= " id=\"".$id."\"";
	}
	if (!empty($class)) {
		$output .= " class=\"".$class."\"";
	}
	$output .= ">".$content."</div>".PHP_EOL;
	return $output;
}

function linkH($zielPfath, $content, $class="", $id="") {
	$output = "<a ";
	if (!empty($id)) {
		$output .= " id=\"".$id."\"";
	} elseif (!empty($class)) {
		$output .= " class=\"".$class."\"";
	}
	$output .= " href=\"".$zielPfath."\"";
	$output .= ">".$content."</a>";
	return $output;
}

function headerH($meta) {
	$output = "<meta charset=\"UTF-8\" />".PHP_EOL;
	return $output;
}

function fuss() {
	$output = "</body>".PHP_EOL."</html>";
	return $output;
}

/**************** FORM-ELEMENTEN ******************/

function label($titel) {
	$output = "<br />".$titel."<br />".PHP_EOL;
	return $output;
}

function verstecktesFeld($name, $value="") {
	$output = "<input type='hidden' name='".$name." value='<?php echo ".$value."; ?>'><br />".PHP_EOL;
	return $output;
}

function textFeld($name, $size="", $maxlength="", $value="") {
	$output = "<input type='text' name='".$name."' size='".$size."' maxlength='".$maxlength."' value='".htmlspecialchars($value)."' /><br />".PHP_EOL;
	return $output;
}

function textareaFeld($name, $cols="50", $rows="10", $text="") {
	$output = "<textarea name=".$name." cols=".$cols." rows=".$rows.">".$text."</textarea>".PHP_EOL;
	return $output;
}

function passwortFeld($size="", $maxlength="", $passwort="") {
	$output = "<input type='password' name='passwort' size='".$size."' maxlength='".$maxlength."' value='".htmlspecialchars($passwort)."' /><br />".PHP_EOL;
	return $output;
}

function radioButtun($name, $value, $label, $check="") {
	$output = "<input type='radio' name=".$name." value=".$value." ".$check."><label>  ".$label."</label><br />".PHP_EOL;
	return $output;
}

function button($value) {
	$output = "<br /><input type='submit' value='".$value."' name='".$value."' /><br />".PHP_EOL;
	return $output;
}


?>

