<?php

$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $id; ?> : Linker Region Query Results</title>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet"> 
	<link href="/linkerregions/main.css" rel="stylesheet">
</head>


<body>
	<?php
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "https://hanlab.pythonanywhere.com/linkerregions/pfamid?pfam=".$id);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        $pfam_data = json_decode($output);
        $gene_trees = $pfam_data->gene_trees;

        foreach ($gene_trees as $gt) {
        	print_r($gt . '<br>');
        }

        #print_r($output);  
	?>




</body>