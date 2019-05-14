<?php
$page = "stats";
define("CONFIG_NO_DIRECT", "");
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
    <?php include("components/header.php"); ?>
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
				<div id="genreChart"></div>
			</div>
		</div>
	</div>
	<?php include("components/footer.php"); ?>
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

        <?php
		$genre_data = getGenreData();
		$genre_data_print = "";
		foreach ($genre_data as $data) {
            if ($data[0] == -1) {
                $genre_data_print .= "['N/A',{$data[1]}], ";
            } else {
                $genre_data_print .= "['{$genres[$data[0]]}',{$data[1]}], ";
            }
		}
		$genre_data_print = substr($genre_data_print, 0, -2);;
		?>
		// Create the data table.
		var genre_chart_data = new google.visualization.DataTable();
		genre_chart_data.addColumn('string', 'Genre');
		genre_chart_data.addColumn('number', '# of books read');
		genre_chart_data.addRows([<?= $genre_data_print ?>]);
		var genre_chart_options = {
			'title': 'Genres',
			width: '100%',
			height: 700,
  		    colors: ['#b7cbff', '#8cabff','#5b87ff', '#3269ff'],
		};
		var genre_chart = new google.visualization.ColumnChart(document.getElementById('genreChart'));
		genre_chart.draw(genre_chart_data, genre_chart_options);
 	}
	</script>
</body>
</html>
