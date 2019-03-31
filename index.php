<?php
include_once("functions.php");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reading Record</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
	<header>
		<div class="sitename">
			<a href="index.php">My Reading Record</a>
		</div>
		<nav>
			<ul>
				<li><b><a href="index.php">Home</a></b></li>
				<li><a href="stats.php">Stats</a></li>
			</ul>
		</nav>
		<div class="search">
			<span class="search-input"><input type="text" name="search" placeholder="search">
		</div>
	</header>
	<div class="container">
		<a class="add-record" href="add.php">Add record</a>
		<?php
		$records = listRecords();
		if (empty($records)) {
			echo '<div class="no-record-msg">No reading records found.</div>';
		} else {
		?>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Book name</th>
					<th>Genre</th>
					<th>My reflection</th>
					<th>Rating</th>
					<th>Recommended</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($records as $record) {
				?>
				<tr>
					<td><?= $record[0]; ?></td>
					<td><?= $record[1]; ?></td>
					<td><?= $record[2]; ?></td>
					<td><?= $record[3]; ?></td>
					<td class="rating">
						<?php if ($record[4] != -1) {?>
						<span class="rating-num"><?= $record[4]; ?></span>
						<div class="stars star<?= $record[4]; ?>"></div>
						<?php } ?>
					</td>
					<td class="recommend">
					<?php
					switch ($record[5]) {
						case 1:
							echo '<img src="img/tick.png">';
							break;
						case 0:
							echo '<img src="img/cross.png">';
							break;
						default:
							break;
					}
					?>
					</td>
					<td>
						<a href="edit.php?id=<?= $record[0]; ?>">Edit</a>
						<a href="delete.php?id=<?= $record[0]; ?>">Delete</a
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td>#</td>
					<td>Book Name</td>
					<td>Genre</td>
					<td>My Reflection</td>
					<td>Rating</td>
					<td>Recommended</td>
					<td>Actions</td>
				</tr>
			</tfoot>
		</table>
		<?php
		}
		?>
	</div>
	<footer>
		<div class="container">Created by Gabriel (Lee Chi Hong) for SCC130 Term 3 Assessment @ Lancaster University.</div>
	</footer>
</body>
</html>
