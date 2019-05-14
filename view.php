<?php
$page = "view";
define("CONFIG_NO_DIRECT", "");
include_once("functions.php");
$record = getRecord($_GET["id"])[0];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reading Record - View Record</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("components/header.php"); ?>
	<div class="container">
		<h1>View record</h1>
		<?php
		if (!empty($errormsg)) {
			echo '<div class="error-msg">'.$errormsg.'</div>';
		}
		?>
		<div class="box">
			<a href="index.php" class="back-link">< Back</a>
			<span class="field-key">Book name</span>
			<span class="field-value"><?= $record[1] ?></span><span class="view-id">(id: <?= $record[0] ?>)</span>
			<span class="field-key">Genre</span>
			<span class="field-value"><?php
                if ($record[2] != -1) {
                    echo $genres[$record[2]];
                }
            ?></span>
			<span class="field-key">My reflection</span>
			<span class="field-value"><?= $record[3] ?></span>
			<span class="field-key">Rating</span>
			<span class="field-value">
				<?php if ($record[4] != -1) {?>
				<div class="large-star">
					<img src="img/<?= $record[4] ?>stars.png">
				</div>
				<?php } ?>
			</span>
			<span class="field-key">Recommended</span>
			<span class="field-value">
				<?php
				switch ($record[5]) {
					case 1:
						echo '<img class="recommend" src="img/tick.png">';
						break;
					case 0:
						echo '<img class="recommend" src="img/cross.png">';
						break;
					default:
						break;
				}
				?>
			</span>
			<span class="field-key">Created on</span>
			<span class="field-value"><?= $record[6] ?></span>
			<span class="field-key">Last edit</span>
			<span class="field-value"><?= $record[7] ?></span>
		</div>
	</div>
	<?php include("components/footer.php"); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>
