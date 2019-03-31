<?php
include_once("functions.php");
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>My Reading Record - Stats</title>
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
				<li><b><a href="stats.php">Stats</a></b></li>
			</ul>
		</nav>
		<div class="search">
			<span class="search-input"><input type="text" name="search" placeholder="search">
		</div>
	</header>
	<div class="container">
		<h1>Stats</h1>
		<?php
		if (!empty($errormsg)) {
			echo '<div class="error-msg">'.$errormsg.'</div>';
		}
		?>
		<div class="box">
			<a href="index.php" class="back-link">< Back</a>
			<div class="charts">
				<div id="ratingChart"></div>
				<div id="recommendChart"></div>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">Created by Gabriel (Lee Chi Hong) for SCC130 Term 3 Assessment @ Lancaster University.</div>
	</footer>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		<?php
		$ratingdata = getRatingData();
		$ratingdataprint = "";
		foreach ($ratingdata as $data) {
			if ($data[0] == -1) {
				$ratingdataprint .= "['No rating',{$data[1]}], ";
			} else {
				$ratingdataprint .= "['{$data[0]} stars',{$data[1]}], ";
			}
		}
		$ratingdataprint = substr($ratingdataprint, 0, -2);;
		?>
		// Create the data table.
		var ratingChartData = new google.visualization.DataTable();
		ratingChartData.addColumn('string', 'Rating');
		ratingChartData.addColumn('number', '# given');
		ratingChartData.addRows([<?= $ratingdataprint ?>]);
		var ratingChartOptions = {
			'title': 'Ratings given',
			width: '100%',
			height: 300,
  		colors: ['#b7cbff', '#a3bcff', '#8cabff', '#7096ff', '#5b87ff', '#4677fc', '#3269ff'],
			pieSliceText: 'value'
		};
		var ratingChart = new google.visualization.PieChart(document.getElementById('ratingChart'));
		ratingChart.draw(ratingChartData, ratingChartOptions);

		<?php
		$recommenddata = getRecommendData();
		$recommenddataprint = "";
		foreach ($recommenddata as $data) {
			switch ($data[0]) {
				case -1:
					$recommenddataprint .= "['I don\'t know',{$data[1]}], ";
					break;
				case 1:
					$recommenddataprint .= "['Recommended',{$data[1]}], ";
					break;
				case 0:
					$recommenddataprint .= "['Not recommended',{$data[1]}], ";
					break;
			}
		}
		$recommenddataprint = substr($recommenddataprint, 0, -2);;
		?>
		// Create the data table.
		var recommendChartData = new google.visualization.DataTable();
		recommendChartData.addColumn('string', 'Rating');
		recommendChartData.addColumn('number', '# given');
		recommendChartData.addRows([<?= $recommenddataprint ?>]);
		var recommendChartOptions = {
			'title': 'Recommendation',
			width: '100%',
			height: 300,
  		colors: ['#b7cbff', '#8cabff','#5b87ff', '#3269ff'],
			pieSliceText: 'value'
		};
		var recommendChart = new google.visualization.PieChart(document.getElementById('recommendChart'));
		recommendChart.draw(recommendChartData, recommendChartOptions);
 	}
	</script>
</body>
</html>
