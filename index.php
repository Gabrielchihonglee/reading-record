<?php
$page = "index";
define("CONFIG_NO_DIRECT", "");
include_once("functions.php");

$total_count = getRecordCount();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reading Record</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("components/header.php"); ?>
	<div class="container">
		<a class="add-record" href="add.php">Add record</a>
		<?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
		$records = listRecords($page);
		if (empty($records)) {
			echo '<div class="no-record-msg">No reading records found.</div>';
		} else {
		?>
		<table>
			<thead>
				<tr>
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
					<td><?= $record[1]; ?></td>
					<td><?php
                        if ($record[2] != -1) {
                            echo $genres[$record[2]];
                        }
                    ?></td>
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
						<a href="view.php?id=<?= $record[0]; ?>">View</a>
						<a href="edit.php?id=<?= $record[0]; ?>">Edit</a>
						<a href="delete.php?id=<?= $record[0]; ?>">Delete</a
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<?php
		}
		?>
        <div class="pagination">
            <span><?= $page * 10 - 9 ?> - <?= ($total_count <= $page * 10)?$total_count:$page * 10 ?> of <?= $total_count ?> records</span>
            <a href="<?php if ($page > 1) { echo "?page=". ($page - 1); } ?>" class="left<?php
            if ($page == 1) {
                echo " disabled";
            }
            ?>"><</a>
            <a href="<?php if ($total_count > $page * 10) { echo "?page=". ($page + 1); } ?>" class="right<?php
            if ($total_count <= $page * 10) {
                echo " disabled";
            }
            ?>">></a>
        </div>
	</div>
	<?php include("components/footer.php"); ?>
</body>
</html>
