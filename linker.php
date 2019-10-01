<?php

$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);

$query = "https://hanlab.pythonanywhere.com/linkerregions/linkerid?linker=$id";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$output = curl_exec($ch);
curl_close($ch);

$linker_sequences = json_decode($output);
$gt = substr($id, 0,strpos($id, "Linker")-1);
?>

<!DOCTYPE=html>
<head>
        <title><?php echo $id; ?> : Linker Region Family</title>
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet">
        <link href="/linkerregions/main.css" rel="stylesheet">
</head>
<body>

	<a class="fancy-link" href="/linkerregions">Home</a><br>

	<h1><?php echo $id?></h1>
<?php
	echo "<p>(From gene tree: <a class='fancy-link' href='/linkerregions/query?id=$gt'>$gt</a>)</p>";

	echo "<p><b>Query using REST API:</b></p>";
	echo "<code>$query</code>";


	foreach ($linker_sequences as $linkerId => $seq) {
		echo "<h2>>$linkerId</h2>";
		echo "<code>$seq</code>";
	}

?>


</body>
</html>

