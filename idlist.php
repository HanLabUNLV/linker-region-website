<!DOCTYPE html>
<html>
<head>
	<title>Gene Tree IDs</title>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet"> 
	<link href="/linkerregions/main.css" rel="stylesheet">
</head>


<body>
	<h1>Gene Tree IDs</h1>
	<ul>
		<?php
		$fh = fopen("data/idlist.txt", "r");
		while ($line = fgets($fh)) {
			$id = trim($line);
			echo '<li><a href="/linkerregions/query.php?id=' . $id . '">' . $id . '</a></li>';
		}


		?>



	</ul>


</body>
