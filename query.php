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
	$fh = fopen('data/superfamily_sorted_shifted_dict_stratified.json', 'r');
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
			
			foreach ($json_obj as $protein_id => $domains) {
				$src_seq = $sequences[$protein_id];
				$out_seq = "";
				$nextWrap = 60;
				$i = 0;


				echo $protein_id . "<br>";
				
				foreach($domains as $j => $tup) {
					$start = $tup[0];
					$end = $tup[1];
					echo $start . "," . $end . "<br>";

					while ($nextWrap < $start) {
						$out_seq = $out_seq . substr($src_seq, $i, $nextWrap - $i) . "<br>";
						$i = $nextWrap;
						$nextWrap = $nextWrap + 60;
					} 
					$out_seq = $out_seq . substr($src_seq, $i, $start - $i);
					if ($j > 0)
						$out_seq = $out_seq . "</span>";
					$out_seq = $out_seq . "<span class='domain'>";
					$i = $start;

					while ($nextWrap < $end) {
						$out_seq = $out_seq . substr($src_seq, $i, $nextWrap - $i) . "<br>";
						$i = $nextWrap;
						$nextWrap = $nextWrap + 60;
					}
					$out_seq = $out_seq . substr($src_seq, $i, $end - $i) . "</span>";
					$i = $end;
					if ($j < sizeof($domains)-1)
						$out_seq = $out_seq . "<span class='linker'>";


				}
				
				while ($nextWrap < strlen($src_seq)) {
					$out_seq = $out_seq . substr($src_seq, $i, $nextWrap - $i) . "<br>";
					$i = $nextWrap;
					$nextWrap = $nextWrap + 60;
				}
				$out_seq = $out_seq . substr($src_seq, $i);



				//echo '<div class="region-figure">' . $src_seq . '</div><br>';
				echo '<div class="region-figure">' . $out_seq . '</div><br>';
			}	

			echo "<h3 id='" . $line_id . "'>" . $line_id . "</h3>";
			echo "<code>" . $line_json . "</code><br>";	
		}	
	}
	fclose($fh)
	?>

</body>
</html>
