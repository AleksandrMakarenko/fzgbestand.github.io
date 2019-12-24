<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">  <!-- wegen ü, ä, usw. -->
    <meta name="description" content="Datenbanken und SQL: Erstes einfaches PHP-Beispiel">
    <meta name="author" content="Edwin Schicker">
    <title>Datenbanken und SQL: Erstes PHP-Beispiel, Ergebnis</title>
</head>

<body text="#000000" bgcolor="#FFFFEF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<center><h1>Datenbanken und SQL</h1></center>
<center><h3>Edwin Schicker</h3></center>
<p>Dies ist die Datei <i>name.php</i> mit der Ausgabe der Ergebnisse.</p>

<!-- Die mit der Methode POST uebergebenenen Daten werden ausgelesen: -->

<?php    // hier beginnt PHP. Die Namensangaben innerhalb des Formtags
         // werden in PHP an assoziative Feldvariablen uebergeben

 $Anrede = $_POST['Anrede'];
 $Name   = $_POST['Name'];

 echo "$Anrede $Name. Sie haben es geschafft!";   // Der Rest der Ausgabe erfolgt in HTML

 // Ende von PHP
?>

Die erste PHP-Seite wurde ausgeführt und erfolgreich interpretiert. Ein Rechtsklick zusammen mit 'Quelltext anzeigen' 
zeigt uns, dass nicht der PHP-Code, sondern nur das HTML-Ergebnis an Ihren Browser weitergereicht wurde.
<p>
Das erste PHP-Beispielprogramm wäre damit erfolgreich bearbeitet. Mit dem folgenden
Link kehren Sie zur Anfangsseite zurück.
<p>
<center><a href="index.html">Zurück zur Startseite</a></center>
</body>
</html>