<?php

$id = '?';
if (isset($_GET['id'])
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
	test page<br>

	<?php
	echo "Hello World!";
	?>


</body>
</html>
