<?php
include_once("functions.php");
if (isset($_GET["id"])) {
	delRecord($_GET["id"]);
}
?>
