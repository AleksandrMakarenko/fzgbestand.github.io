<html>
<head>
<meta http-equiv="content-type" content="text/html"; charset="utf-8">
<meta name="description" content="Datenbanken und SQL: Demo der Formulardatenübergabe">
<meta name="author" content="Edwin Schicker">
<title>Datenbanken und SQL: Datenweitergabe mit Formularen</title>
</head>

<body text="#000000" bgcolor="#FFFFEF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<center><h1>Datenbanken und SQL</h1></center>
<center><h3>Edwin Schicker</h3></center>

<h3>Ausgabe von Formulardaten </h3>
<p>Dies ist die Datei <i>formulare.php</i>.</p>
<p>HTML: Wir geben die Variablen aus:</p>

<?php                         
  echo "<p>PHP: Start von PHP</p>";

  $server = $_POST['Server'];  	
  $datenbank = $_POST['Datenbank'];
  $benutzer = $_POST['Kennung'];    
  $passwort = $_POST['Passwort'];

  echo "<p>PHP:<br/>
     Server:    $server<br/> 
     Datenbank: $datenbank<br/>
     Kennung:   $benutzer<br/>
     Passwort:  wird nicht verraten</p>";
?> 
<p>HTML: Ende</p>

<hr noshade size="1">

<p><center><a href="index.html">Zurück zur Startseite</a></center></p>

</body>
</html>
