<?php

$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);

$query = "https://hanlab.pythonanywhere.com/linkerregions/domainid?domain=$id";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$output = curl_exec($ch);
curl_close($ch);

$domain_sequences = json_decode($output);
$gt = substr($id, 0,strpos($id, "Domain")-1);
?>

<!DOCTYPE=html>
<head>
        <title><?php echo $id; ?> : Domain Region Family</title>
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet">
        <link href="/linkerregions/main.css" rel="stylesheet">
</head>
<body>

	<a class="fancy-link" href="/linkerregions">Home</a><br>
	<?php
		include 'match_id.php';
	?>
	<h1><?php echo $id?></h1>
<?php
	#$link = "https://www.ebi.ac.uk/interpro/signature/" . $pfamid;
	# use this link once we figure out what the pfam is
	echo "<p>(From gene tree: <a class='fancy-link' href='/linkerregions/query.php?id=$gt'>$gt</a>)</p>";

	echo "<p><b>Query using REST API:</b></p>";
	echo "<code>$query</code>";
	echo "<hr>";

	foreach ($domain_sequences as $protein => $seq) {
		echo "<h2>>$protein</h2> <a class='fancy-link' href='/linkerregions/meta.php?id=$protein'>(view protein)</a>";
		echo "<code>$seq</code>";
	}

?>


</body>
</html>

