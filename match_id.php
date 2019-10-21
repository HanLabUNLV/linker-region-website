<?php
/* TODO: add these regex checks to python server?
$id = '?';
if (isset($_GET['id']))
	$id = trim($_GET['id']);

if (preg_match('/^ENSGT[0-9]+$/', $id) == 1)
	printf("Matches gene tree");

if (preg_match('/^ENS[A-Z]*P[0-9]+$/', $id) == 1)
	printf("Matches protein");

if (preg_match('/^PF[0-9]+$/', $id) == 1)
	printf("Matches pfam");
*/
?>
<script>
	function redirect() {
		var inp = document.getElementById("idSearchBox").value;
		if (inp.match(/^ENSGT[0-9_]+$/))
			location.href = "/linkerregions/query.php?id="+inp;
		else if (inp.match(/^ENSGT[0-9_]+_Domain_[0-9]+$/))
			location.href = "/linkerregions/domain.php?id="+inp;
		else if (inp.match(/^ENSGT[0-9_]+_Linker_[0-9]+$/))
			location.href = "/linkerregions/linker.php?id="+inp;
		else if (inp.match(/^PF[0-9]+$/))
			location.href = "/linkerregions/pfam.php?id="+inp;
		else if (inp.match(/^ENS[A-Z]*P[0-9]+$/))
			alert("Protein ID not yet supported")
		else
			alert("Invalid id");
	}
</script>

<form action="javascript:redirect();">
	<input id="idSearchBox" type="text" name="id">
	<input type="submit" value="Search">
</form>