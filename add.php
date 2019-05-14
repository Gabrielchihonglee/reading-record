<?php
$page = "add";
define("CONFIG_NO_DIRECT", "");
include_once("functions.php");
if (isset($_POST["submit"])) {
	// form validation
	$haveerror = false;
	$errormsg = "";
	if (empty($_POST["name"])) {
		$haveerror = true;
		$errormsg .= "The 'Book name' field must be filled.<br>";
	}
	if (!empty($_POST["reflection"]) && strlen($_POST["reflection"]) > 600) {
		$haveerror = true;
		$errormsg .= "The 'My reflection' field should not have more than 600 characters, " . strlen($_POST['reflection']) . " currently.<br>";
	}
	if (!empty($_POST["rating"]) && (($_POST["rating"] < -1) || ($_POST["rating"] > 5))) {
		$haveerror = true;
		if ($_POST["rating"] == -1) {
			$ratingtext = "empty";
		} else {
			$ratingtext = $_POST["rating"];
		}
		$errormsg .= "The 'Rating' field should be empty or within 0 - 5, {$ratingtext} currently.<br>";
	}
	if (!empty($_POST["recommend"]) && (($_POST["recommend"] < -1) || ($_POST["recommend"] > 1))) {
		$haveerror = true;
		$errormsg .= "The 'Recommended' field should be empty or yes or no.<br>";
	}

	// if no error, add record to database
	if (!$haveerror) {
		addRecord($_POST["name"], $_POST["genre"], $_POST["reflection"], $_POST["rating"], $_POST["recommend"]);
	}
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reading Record - Add Record</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("components/header.php"); ?>
	<div class="container">
		<h1>Add record</h1>
		<?php
		if (!empty($errormsg)) {
			echo '<div class="error-msg">'.$errormsg.'</div>';
		}
		?>
		<div class="box">
			<a href="index.php" class="back-link">< Back</a>
			<span class="form-reminder">Fields mared with * must be filled in.</span>
			<form method="post">
				<label for="name">Book name *</label>
			  <input type="text" name="name" id="name" value="<?php
				if (isset($_POST["name"])) {
					echo $_POST["name"];
				}
				?>">
			  <label for="genre">Genre</label>
				<select name="genre" id="genre">
				  <option value="-1"></option>
				  <?php
				  foreach($genres as $key => $value):
				  ?>
				  <option value="<?= $key ?>"<?php if (isset($_POST["genre"]) && $_POST["genre"] == $key) { echo ' selected'; } ?>><?= $value ?></option>
				  <?php
			  	  endforeach;
				  ?>
				</select>
				<label for="reflection">My reflection</label>
			  <textarea name="reflection" id="reflection" cols="70" rows="6"><?php
				if (isset($_POST["reflection"])) {
					echo $_POST["reflection"];
				}
				?></textarea>
			  <label for="rating">Rating</label>
				<select name="rating" id="rating">
				  <option value="-1"<?php if (isset($_POST["rating"]) && $_POST["rating"] == -1) { echo ' selected'; } ?>></option>
				  <option value="0"<?php if (isset($_POST["rating"]) && $_POST["rating"] == 0) { echo ' selected'; } ?>>0</option>
				  <option value="1"<?php if (isset($_POST["rating"]) && $_POST["rating"] == 1) { echo ' selected'; } ?>>1</option>
				  <option value="2"<?php if (isset($_POST["rating"]) && $_POST["rating"] == 2) { echo ' selected'; } ?>>2</option>
				  <option value="3"<?php if (isset($_POST["rating"]) && $_POST["rating"] == 3) { echo ' selected'; } ?>>3</option>
				  <option value="4"<?php if (isset($_POST["rating"]) && $_POST["rating"] == 4) { echo ' selected'; } ?>>4</option>
				  <option value="5"<?php if (isset($_POST["rating"]) && $_POST["rating"] == 5) { echo ' selected'; } ?>>5</option>
				</select>
			  <label for="recommend">Recommended</label>
				<select name="recommend" id="recommend">
				  <option value="-1"<?php if (isset($_POST["recommend"]) && $_POST["recommend"] == -1) { echo ' selected'; } ?>></option>
				  <option value="1"<?php if (isset($_POST["recommend"]) && $_POST["recommend"] == 1) { echo ' selected'; } ?>>Yes</option>
				  <option value="0"<?php if (isset($_POST["recommend"]) && $_POST["recommend"] == 0) { echo ' selected'; } ?>>No</option>
				</select>
			  <input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</div>
	<?php include("components/footer.php"); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>
