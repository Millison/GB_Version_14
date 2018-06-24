<?php

class Ersetzen {
	
	private $neuerInhalt = "";
	
	function replace($wasStelle, $wodurch, $woDatei="") {
		if (!empty($woDatei)) {
			$dateiInhalt = fopen($woDatei, "r");
			$this->neuerInhalt = fread($dateiInhalt, filesize($woDatei));
			fclose($dateiInhalt);
			$this->neuerInhalt = str_replace("{".$wasStelle."}", $wodurch, $this->neuerInhalt);
		} else {
			$this->neuerInhalt = str_replace("{".$wasStelle."}", $wodurch, $this->neuerInhalt);
		}
	}
	
	public function getInhalt() {
		return $this->neuerInhalt;
	}
}

?>