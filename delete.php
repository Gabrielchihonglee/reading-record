<?php
define("CONFIG_NO_DIRECT", "");
include_once("functions.php");
if (isset($_GET["id"])) {
	delRecord($_GET["id"]);
}
?>
