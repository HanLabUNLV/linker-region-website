<?php

$id = '?';
if (isset($_GET['id']))
	$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $id; ?> : Linker Region Query Results</title>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet"> 
	<link href="/linkerregions/main.css" rel="stylesheet">
</head>


<body>
	<a href="/linkerregions" class="fancy-link">Back</a><br>
	<h1>Query Results</h1>
	<h2><?php echo $id; ?></h2>
	
	<p>Nothing to see here yet :(</p>

	<code>
		<?php
		$fh = fopen('/linkerregions/data/splitty.txt', 'r');
		$n = 0;
		while ($line = fgets($fh)) {
			echo $line;
			$n = $n + 1;
			if ($n > 5)
				break
		}
		fclose($fh)
		?>


	</code>


</body>
</html>
