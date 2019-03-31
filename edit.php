<?php
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
} else {
	$record = getRecord($_GET["id"])[0];
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reading Record - Edit Record</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
	<header>
		<div class="sitename">
			<a href="index.php">My Reading Record</a>
		</div>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="stats.php">Stats</a></li>
			</ul>
		</nav>
		<div class="search">
			<span class="search-input"><input type="text" name="search" placeholder="search">
		</div>
	</header>
	<div class="container">
		<h1>Edit record</h1>
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
				} else {
					echo $record[1];
				}
				?>">
			  <label for="genre">Genre</label>
				<select name="genre" id="genre">
				  <option value=""></option>
					<option value="Action and adventure"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Action and adventure") { echo ' selected'; }} elseif ($record[2] == "Action and adventure") { echo ' selected'; } ?>>Action and adventure</option>
					<option value="Art"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Art") { echo ' selected'; }} elseif ($record[2] == "Art") { echo ' selected'; } ?>>Art</option>
					<option value="Autobiography"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Autobiography") { echo ' selected'; }} elseif ($record[2] == "Autobiography") { echo ' selected'; } ?>>Autobiography</option>
					<option value="Biography"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Biography") { echo ' selected'; }} elseif ($record[2] == "Biography") { echo ' selected'; } ?>>Biography</option>
					<option value="Book review"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Book review") { echo ' selected'; }} elseif ($record[2] == "Book review") { echo ' selected'; } ?>>Book review</option>
					<option value="Cookbook"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Cookbook") { echo ' selected'; }} elseif ($record[2] == "Cookbook") { echo ' selected'; } ?>>Cookbook</option>
					<option value="Comic book"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Comic book") { echo ' selected'; }} elseif ($record[2] == "Comic book") { echo ' selected'; } ?>>Comic book</option>
					<option value="Diary"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Diary") { echo ' selected'; }} elseif ($record[2] == "Diary") { echo ' selected'; } ?>>Diary</option>
					<option value="Dictionary"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Dictionary") { echo ' selected'; }} elseif ($record[2] == "Dictionary") { echo ' selected'; } ?>>Dictionary</option>
					<option value="Crime"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Crime") { echo ' selected'; }} elseif ($record[2] == "Crime") { echo ' selected'; } ?>>Crime</option>
					<option value="Encyclopedia"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Encyclopedia") { echo ' selected'; }} elseif ($record[2] == "Encyclopedia") { echo ' selected'; } ?>>Encyclopedia</option>
					<option value="Drama"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Drama") { echo ' selected'; }} elseif ($record[2] == "Drama") { echo ' selected'; } ?>>Drama</option>
					<option value="Fairytale"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Fairytale") { echo ' selected'; }} elseif ($record[2] == "Fairytale") { echo ' selected'; } ?>>Fairytale</option>
					<option value="Health"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Health") { echo ' selected'; }} elseif ($record[2] == "Health") { echo ' selected'; } ?>>Health</option>
					<option value="Fantasy"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Fantasy") { echo ' selected'; }} elseif ($record[2] == "Fantasy") { echo ' selected'; } ?>>Fantasy</option>
					<option value="History"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "History") { echo ' selected'; }} elseif ($record[2] == "History") { echo ' selected'; } ?>>History</option>
					<option value="Journal"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Journal") { echo ' selected'; }} elseif ($record[2] == "Journal") { echo ' selected'; } ?>>Journal</option>
					<option value="Math"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Math") { echo ' selected'; }} elseif ($record[2] == "Math") { echo ' selected'; } ?>>Math</option>
					<option value="Horror"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Horror") { echo ' selected'; }} elseif ($record[2] == "Horror") { echo ' selected'; } ?>>Horror</option>
					<option value="Mystery"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Mystery") { echo ' selected'; }} elseif ($record[2] == "Mystery") { echo ' selected'; } ?>>Mystery</option>
					<option value="Textbook"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Textbook") { echo ' selected'; }} elseif ($record[2] == "Textbook") { echo ' selected'; } ?>>Textbook</option>
					<option value="Poetry"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Poetry") { echo ' selected'; }} elseif ($record[2] == "Poetry") { echo ' selected'; } ?>>Poetry</option>
					<option value="Review"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Review") { echo ' selected'; }} elseif ($record[2] == "Review") { echo ' selected'; } ?>>Review</option>
					<option value="Science"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Science") { echo ' selected'; }} elseif ($record[2] == "Science") { echo ' selected'; } ?>>Science</option>
					<option value="Romance"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Romance") { echo ' selected'; }} elseif ($record[2] == "Romance") { echo ' selected'; } ?>>Romance</option>
					<option value="Travel"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Travel") { echo ' selected'; }} elseif ($record[2] == "Travel") { echo ' selected'; } ?>>Travel</option>
					<option value="Thriller"<?php if (isset($_POST["genre"])) { if ($_POST["genre"] == "Thriller") { echo ' selected'; }} elseif ($record[2] == "Thriller") { echo ' selected'; } ?>>Thriller</option>
				</select>
				<label for="reflection">My reflection</label>
			  <textarea name="reflection" id="reflection" cols="70" rows="6"><?php
				if (isset($_POST["reflection"])) {
					echo $_POST["reflection"];
				} else {
					echo $record[3];
				}
				?></textarea>
			  <label for="rating">Rating</label>
				<select name="rating" id="rating">
				  <option value="-1"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == -1) { echo ' selected'; }} elseif ($record[4] == -1) { echo ' selected'; } ?>></option>
				  <option value="0"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == 0) { echo ' selected'; }} elseif ($record[4] == 0) { echo ' selected'; } ?>>0</option>
				  <option value="1"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == 1) { echo ' selected'; }} elseif ($record[4] == 1) { echo ' selected'; } ?>>1</option>
				  <option value="2"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == 2) { echo ' selected'; }} elseif ($record[4] == 2) { echo ' selected'; } ?>>2</option>
				  <option value="3"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == 3) { echo ' selected'; }} elseif ($record[4] == 3) { echo ' selected'; } ?>>3</option>
				  <option value="4"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == 4) { echo ' selected'; }} elseif ($record[4] == 4) { echo ' selected'; } ?>>4</option>
				  <option value="5"<?php if (isset($_POST["rating"])) { if ($_POST["rating"] == 5) { echo ' selected'; }} elseif ($record[4] == 5) { echo ' selected'; } ?>>5</option>
				</select>
			  <label for="recommend">Recommended</label>
				<select name="recommend" id="recommend">
				  <option value="-1"<?php if (isset($_POST["recommend"])) { if ($_POST["recommend"] == -1) { echo ' selected'; }} elseif ($record[5] == -1) { echo ' selected'; } ?>></option>
				  <option value="1"<?php if (isset($_POST["recommend"])) { if ($_POST["recommend"] == 1) { echo ' selected'; }} elseif ($record[5] == 1) { echo ' selected'; } ?>>Yes</option>
				  <option value="0"<?php if (isset($_POST["recommend"])) { if ($_POST["recommend"] == 0) { echo ' selected'; }} elseif ($record[5] == 0) { echo ' selected'; } ?>>No</option>
				</select>
			  <input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</div>
	<footer>
		<div class="container">Created by Gabriel (Lee Chi Hong) for SCC130 Term 3 Assessment @ Lancaster University.</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>
