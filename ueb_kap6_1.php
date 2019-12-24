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
<p>Dies ist die Datei <i>ueb_kap6_1.php</i>.</p>

<!-- Die mit der Methode POST uebergebenenen Daten werden ausgelesen: -->



Diese Übung beinhaltet das Erstellen eines Formulars.
Nach Eingabe der Daten und Klick auf den Weiter-Button werden die Daten aufbereitet und ausgegeben.
Die Aufbereitung erfolgt in dieser Datei.
<p>
    Folgende Informationen aus dem Formular liegen vor:
</p>
<table border="2" cellspacing="20" rules="none">
    <tbody>
    <?php    // hier beginnt PHP. Die Namensangaben innerhalb des Formtags
    // werden in PHP an assoziative Feldvariablen uebergeben
    $Name = $_POST['Name'];
    $Geschlecht = $_POST['Geschlecht'];
    $Interesse = $_POST['Interesse'];
    $Familienstand = $_POST['select'];
    ?>
     <tr><td><?php echo"Vor- und Zuname:";?></td><td><?php echo "$Name"; ?></td></tr>
     <tr><td><?php echo"Geschlecht:";?></td><td><?php echo "$Geschlecht"; ?></td></tr>
     <tr><td><?php echo"Interesse:";?></td><td><?php echo "$Interesse"; ?></td></tr>
     <tr><td><?php echo"Familienstand:";?></td><td><?php echo "$Familienstand"; ?></td></tr>
    </tbody>
</table>
<hr>

<center><a href="index.html">Zurück zur Startseite</a></center>
</body>
</html>