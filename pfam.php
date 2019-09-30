<?php

$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://hanlab.pythonanywhere.com/linkerregions/pfamid?pfam=".$id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$output = curl_exec($ch);
curl_close($ch);

$pfam_data = json_decode($output);
$gene_trees = $pfam_data->gene_trees;
$linker_neighbors = $pfam_data->linker_neighbors;

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $id; ?> : Linker Region Query Results</title>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet"> 
	<link href="/linkerregions/main.css" rel="stylesheet">
</head>


<body>

	<div style="display:flex;">
		<div>
	    <?php
	        foreach ($gene_trees as $gt) {
	        	print_r($gt . '<br>');
	        }

	        #print_r($output);  
		?>
		</div>

		<div>
	    <?php
	        foreach ($linker_neighbors as $linker) {
	        	print_r($linker . '<br>');
	        }

	        #print_r($output);  
		?>
		</div>
	</div>




</body>