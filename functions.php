<?php
include_once("../config.php");

function connectDb() {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	return $conn;
}

function addRecord($name, $genre, $reflection, $rating, $recommend) {
	$conn = connectDb();
	$query = "INSERT INTO `readings` (`name`, `genre`, `reflection`, `rating`, `recommend`) VALUES ('{$name}', '{$genre}', '{$reflection}', '{$rating}', '{$recommend}')";
	if (mysqli_query($conn, $query)) {
      echo '<meta http-equiv="refresh" content="0; url=index.php" />';
      die();
  }
}

function listRecords() {
	$conn = connectDb();
	$query = "SELECT * FROM `readings`";
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_all($result);
}

function getRecord($id) {
	$conn = connectDb();
	$query = "SELECT * FROM `readings` WHERE `id` = '{$id}'";
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_all($result);
}

function delRecord($id) {
	$conn = connectDb();
	$query = "DELETE FROM `readings` WHERE `id` = '{$id}'";
	$result = mysqli_query($conn, $query);
	if (mysqli_query($conn, $query)) {
      echo '<meta http-equiv="refresh" content="0; url=index.php" />';
      die();
  }
}
?>
