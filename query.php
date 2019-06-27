<?php

$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);

function displayRegions($gene_tree_id, $protein_id, $domains, $src_seq) {
	$out_seq = "";
	$nextWrap = 60;
	$i = 0;

	//sort domains into an ordered list here
	//.........
	//??? jk we're doing this in another script XDDDD!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



	//done sorting


	foreach($domains as $j => $tup) {
		$isLinker = FALSE;
		if (count($tup) == 3)
			$isLinker = TRUE;
		else
			$pfamid = $tup[3];
		$dname = $tup[0];
		$start = $tup[1];
		$end = $tup[2];

		//All newlines before the start
		while ($nextWrap < $start) {
			$out_seq = $out_seq . substr($src_seq, $i, $nextWrap - $i) . "<br>";
			$i = $nextWrap;
			$nextWrap = $nextWrap + 60;
		}

		//Remaining text before the start of the domain
		$out_seq = $out_seq . substr($src_seq, $i, $start - $i);


		//Start the domain
		$full_dname = $gene_tree_id . "_" . $dname;
		if ($isLinker)
			$out_seq = $out_seq . "<a class='linker'><div class='tooltip'>" . $full_dname . " (" . $start . ", " . $end . ")</div>";
		else {
			$link = "https://www.ebi.ac.uk/interpro/signature/" . $pfamid;
			$out_seq = $out_seq . "<a class='domain' href='" . $link . "'><div class='tooltip'>" . $pfamid . " // " . $full_dname . " (" . $start . ", " . $end . ")</div>";
		}
		$i = $start;

		//All newlines before the end of the domain
		while ($nextWrap < $end) {
			$out_seq = $out_seq . substr($src_seq, $i, $nextWrap - $i) . "<br>";
			$i = $nextWrap;
			$nextWrap = $nextWrap + 60;
		}

		//End the domain
		$out_seq = $out_seq . substr($src_seq, $i, $end - $i) . "</a>";
		$i = $end;

	}
	
	while ($nextWrap < strlen($src_seq)) {
		$out_seq = $out_seq . substr($src_seq, $i, $nextWrap - $i) . "<br>";
		$i = $nextWrap;
		$nextWrap = $nextWrap + 60;
	}
	$out_seq = $out_seq . substr($src_seq, $i);

	return $out_seq;
}


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
	<h1>Query Results&nbsp</h1>
	<h2>"<?php echo $id; ?>"</h2><br>
	<p><b>Found:</b><p>
	<ul>
	<?php
	$fh = fopen('data/idlist.txt', 'r');
	$n = 0;
	while ($line = fgets($fh)) {
		$line_id = trim($line);
		if (substr($line_id, 0, strlen($id)) == $id) {
			echo "<li><a href='#" . $line_id . "'>" . $line_id . "</a></li>";
		}	
	}
	fclose($fh)
	?>
	</ul>

	<hr>

	<?php
	$fh = fopen('data/master_dict_stratified.txt', 'r');
	$n = 0;
	while ($line = fgets($fh)) {
		$tab = strpos($line, "\t");
		$line_id = substr($line, 0, $tab);	
		$line_json = substr($line, $tab+1);
		if (substr($line_id, 0, strlen($id)) == $id) {

			//load appropriate fasta file
			$fasta_h = fopen('data/fastas/' . $line_id . '.fasta.fas', 'r');

			$sequences = [];
			$nextSeq = NULL;
			while ($x = fgets($fasta_h)) {
				if (substr($x, 0, 1) == ">") {
					$nextSeq = trim(substr($x,1)) ;
					$sequences[$nextSeq] = "";					
				} else {
					$sequences[$nextSeq] = $sequences[$nextSeq] . trim($x);
				}
			}
			fclose($fasta_h);
			

			$json_obj = json_decode($line_json);
			
			echo "<h3 id='" . $line_id . "'>" . $line_id . "</h3>";

			foreach ($json_obj as $protein_id => $domains) {
				echo $protein_id . "<br>";
				$region_contents = displayRegions($line_id, $protein_id, $domains, $sequences[$protein_id]);
				echo '<div class="region-figure">' . $region_contents . '</div><hr>';
			}	

			
			echo "<code>" . $line_json . "</code><br>";	
		}	
	}
	fclose($fh)
	?>

</body>
</html>
