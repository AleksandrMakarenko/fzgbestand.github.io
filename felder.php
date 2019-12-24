<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta name="description" content="Datenbanken und SQL: Beispiel zu Feldern">
<meta name="author" content="Edwin Schicker">
<title>Datenbanken und SQL: Beispiel zu Feldern</title>
</head>

<body text="#000000" bgcolor="#FFFFEF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<center><h1>Datenbanken und SQL</h1></center>
<center><h3>Edwin Schicker</h3></center>

<p>Dies ist die Datei <i>felder.php</i>.</p>

<p>Es wird mittels 
   <i>$feld = array(0=>0, 2, 4, 6, 8, 10, 10=>20, "test"=>100, 115, "wert"=>"Ende", 6=>12);</i>
   das Feld <i>$feld</i> erzeugt und mit Inhalt belegt.</p>

   <p>Wir geben die Anzahl der Feldelemente und das Feld aus:</p>

<?php
    $feld = array(0=>0, 2, 4, 6, 8, 10, 10=>20, "test"=>100, 115, "wert"=>"Ende", 6=>12);

    echo "<p>Anzahl der Feldelemente: " . count($feld) . "</p><p>Inhalt:</p><p>";


    foreach ($feld as $key => $res)
        echo "feld[$key] = $res<br/>";
    
?>
</p>

<hr noshade size="1">

<p><center><a href="index.html">Zurück zur Startseite</a></center></p>

</body>
</html>
