<?php
if (!file_exists("../config.php")) {
	exit("../config.php not found, you should define DB_HOST, DB_USER, DB_PASSWORD and DB_NAME in ../config.php.");
}
include_once("../config.php");

function connectDb() {
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	return $conn;
}

function addRecord($name, $genre, $reflection, $rating, $recommend) {
	$conn = connectDb();
	$query = "INSERT INTO `readings` (`name`, `genre`, `reflection`, `rating`, `recommend`, `created`, `modified`) VALUES ('{$name}', '{$genre}', '{$reflection}', '{$rating}', '{$recommend}', NOW(), NOW())";
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

function editRecord($id, $name, $genre, $reflection, $rating, $recommend) {
	$conn = connectDb();
	$query = "UPDATE `readings` SET `name` = '{$name}', `genre` = '{$genre}', `reflection` = '{$reflection}', `rating` = '{$rating}', `recommend` = '{$recommend}', `modified` = NOW() WHERE `id` = '{$id}'";
	if (mysqli_query($conn, $query)) {
      	echo '<meta http-equiv="refresh" content="0; url=index.php" />';
      	die();
  }
}

function getRatingData() {
	$conn = connectDb();
	$query = "SELECT rating, COUNT('rating') FROM `readings` GROUP BY rating";
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_all($result);
}

function getRecommendData() {
	$conn = connectDb();
	$query = "SELECT recommend, COUNT('recommend') FROM `readings` GROUP BY recommend";
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_all($result);
}

function getGenreData() {
	$conn = connectDb();
	$query = "SELECT genre, COUNT('genre') FROM `readings` GROUP BY genre";
	$result = mysqli_query($conn, $query);
	return mysqli_fetch_all($result);
}
?>
