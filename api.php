{
<?php

$id = '?';
if (isset($_GET['id'])) {
	$id = trim($_GET['id']);

	$fh = fopen('data/stratified.txt', 'r');
	$n = 0;
	while ($line = fgets($fh)) {
		$tab = strpos($line, "\t");
		$line_id = substr($line, 0, $tab);	
		$line_json = substr($line, $tab);	
		if (substr($line_id, 0, strlen($id)) == $id) {
			echo '"' . $line_id . '":' . $line_json . ",";
		}	
	}
}
fclose($fh)
?>
}
