<head>
<title>Linker Regions Query</title>
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:400,700&display=swap" rel="stylesheet"> 
<link href="/linkerregions/main.css" rel="stylesheet">
</head>


<body>
<h1>Linker Regions Query</h1>
<a class="hanlab-link" href="https://hanlabunlv.github.io">Hanlab @ UNLV</a>


<p>In most genes there are several functional domains and non-functional sequences of DNA in between them. Linker regions are the segments of DNA between functional domains that act as a bridge between the different regions of proteins. These regions have been known to have a higher mutation rate than is present in their functional domain counterparts, suggesting that the composition of these regions may be less important than that of other regions and also a unique evolutionary history. Whether it is aiding in the structural analysis of proteins or adding to the base knowledge of protein engineering, the study of linker regions is a rich if understudied subject. This database will not only allow our own research on linker regions to be conducted, but also is made public so that other researchers may study the evolution of linker regions.</p>
  <div style="display:flex;">
    <div style="width:50%;">
    <h2>Enter a new query:</h2>
    <?php
      include 'match_id.php';
    ?>
    </div>
    <div style="width:50%;">
    <h2>Example searches:</h2>
    <p>
      Gene Tree: <span>ENSGT00680000099553_8</span><br>
      Gene ID: <span>ENSG00000007372</span><br>
      PFAM ID: <span>PF00096</span> (This one may take a while to load)<br>

      Linker ID: <span>ENSGT00680000099553_8_Linker_0_1</span><br>
      Domain ID: <span>ENSGT00680000099553_8_Domain_0</span><br>

    </p>
    </div>
  </div>

<hr>
<p>
  You can view the full list of Gene Tree IDs we have here:<br>
  <a class="fancy-link" href="/linkerregions/idlist.php">Gene Tree ID List</a>
</p>

<h2>Large job query:</h2>

<form>
  <p>(Not yet available.)</p>
</form>
</body>
