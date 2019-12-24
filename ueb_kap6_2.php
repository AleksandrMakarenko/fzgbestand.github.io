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
<center><h4>Übungaufgabe 2 zu Kapitel 6</h4></center>

<p>Dies ist die Datei ueb_kap6_2.php.</p>
<p>Diese Übung fordert zur Eingabe einer Mitarbeiternummer ein.
    Nach Eingabe der Nummer und Klick auf den Weiter-Button werden die Daten des Mitarbeiters ausgegeben.
    Existiert der Mitarbeiter nicht, so erfolgt eine Fehlermeldung.
    Die Suche und Ausgabe des Mitarbeiters erfolgt in dieser Datei.</p>

<p>Aufbau einer Verbindung zur Oracle-Datenbank BIKE.</p>

<?php                         
  echo "<p>PHP: Start von PHP</p>";
  try {
      $conn = new PDO("oci:dbname=$_POST[Datenbank]",
          $_POST['Kennung'],
          $_POST['Passwort']);
      echo "<p>Die Verbindung zur Datenbank wurde hergestellt.</p>";
      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
      $conn->beginTransaction();// Transaktionsmodus

      $persnr = $_POST['Mitarbeiternummer'];
   $sql = " Select Name, Ort, Gebdatum, Gehalt From Personal Where Persnr = $persnr";
   $stmt = $conn->query($sql);
    if ($row = $stmt->fetch()) {
        echo "<p>Die Verbindung zur Datenbank wurde hergestellt.</p>";
        echo "<p>Der Mitarbeiter mit der Personalnummer $persnr heißt $row[NAME],
                     wohnt in $row[ORT] ist geboren am $row[GEBDATUM], und verdient $row[GEHALT] Euro.</p>";
        } else {
        echo "<p>Der Mitarbeiter mit dieser Nummer $persnr existiert nicht! </p>";

    }
    $conn->commit();
    $conn = null;
        echo "<p>Die Verbindung zur Datenbank wurde geschlossen. </p>";
    }
    catch (PDOException $e)
    {
        echo "<p>PDO-Fehler in Zeile ", $e->getLine(), "mit Code ", $e->getCode(),"</p>
              <p>Fehlertext: ", $e->getMessage(), "</p>";
    }
    catch (Exception $e)
    {
         echo "<p>Fehler in Zeile ", $e->getLine(), "mit Code ", $e->getCode(),"</p> 
               <p>Fehlertext: ", $e->getMessage(), "</p>";
    }

  /* $server = $_POST['Server'];
     $datenbank = $_POST['Datenbank'];
     $benutzer = $_POST['Kennung'];
     $passwort = $_POST['Passwort'];

     echo "<p>PHP:<br/>
     Server:    $server<br/> 
     Datenbank: $datenbank<br/>
     Kennung:   $benutzer<br/>
     Passwort:  wird nicht verraten</p>";
  */
?> 


<hr noshade size="1">

<p><center><a href="index.html">Zurück zur Startseite</a></center></p>

</body>
</html>
