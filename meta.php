<?php

$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);

$query = "https://hanlab.pythonanywhere.com/linkerregions/get_meta?id=$id";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$output = curl_exec($ch);
curl_close($ch);

$meta_data = json_decode($output);
$gene_tree = $meta_data->gene_tree;
$gene_id = $meta_data->gene_id;
$gene_name = $meta_data->gene_name;
$transcripts = $meta_data->transcripts;
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $id; ?> : Query Results</title>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet"> 
	<link href="/linkerregions/main.css" rel="stylesheet">
</head>


<body>
	<a href="/linkerregions" class="fancy-link">Home</a><br>
	<?php
		include 'match_id.php';
	?>
	<h1>Query Results&nbsp</h1>
	<h2>"<?php echo $id; ?>"</h2><br>
	
	<p><b>Query using REST API:</b></p>
	<?php echo "<code>$query</code>"; ?>
	<hr>

	<?php
		echo "<h2>Gene Name: $gene_name</h2>";
		echo "<h2>Gene ID: $gene_id</h2>";
		echo "<h2>Gene Tree: $gene_tree</h2>";
	?>


</body>