<?php
session_start();

$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();
header('Location: http://localhost/dimas-test/GB_Version_14/initTest.php');

?>