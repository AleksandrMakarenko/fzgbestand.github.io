<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta name="description" content="Datenbanken und SQL: Erster Lesezugriff auf DB">
<meta name="author" content="Edwin Schicker">
<title>Datenbanken und SQL: Erster Datenbankzugriff</title>
</head>

<body text="#000000" bgcolor="#FFFFEF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<center><h1>Datenbanken und SQL</h1></center>
<center><h3>Edwin Schicker</h3></center>
<p>Dies ist die Datei <i>start.php</i>. Jetzt wird auf die Datenbank zugegriffen.</p>
<p>Einloggen in die Datenbank BIKE mit der entsprechend ausgewählten Datenbank.</p>

<?php
  try
  {
     switch ($_POST['Hersteller'])    // Einloggen in die Datenbank je nach Hersteller
     {
       case "Oracle":     $param1 = "oci:dbname=$_POST[Datenbank]";         
                          echo "<p>Aufbau einer Verbindung zur <b>Oracle</b>-Datenbank BIKE.</p>";
                          break;
       case "SQLServer":  $param1 = "sqlsrv:Server=$_POST[Server];Database=$_POST[Datenbank]";  
                          echo "<p>Aufbau einer Verbindung zur <b>SQL Server</b> Datenbank BIKE.</p>";
                          break;
       case "MySQL":      $param1 = "mysql:host=$_POST[Server];dbname=$_POST[Datenbank]";
                          echo "<p>Aufbau einer Verbindung zur <b>MySQL</b> Datenbank BIKE.</p>";
                          break;
     }
     // Datenbankoptionen festlegen:
     $options = array(PDO::ATTR_AUTOCOMMIT => false,                    // Transaktionsbetrieb
                      PDO::ATTR_PERSISTENT => true,                      // Persistente Datenbankverbindung
                      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // Werfen von Ausnahmen bei Fehlern 
                      PDO::ATTR_CASE => PDO::CASE_UPPER);                // Grossbuchstaben als Attributsrueckgabe

     // neues PDO-Objekt anlegen und mit Datenbank verbinden:
     $conn = new PDO($param1, $_POST['Kennung'], $_POST['Passwort'], $options);

     echo "<p>Die Verbindung zur Datenbank wurde hergestellt.</p>";

     $conn->beginTransaction();                                        // Transaktionsmodus

     // Die Datenbank ist geoeffnet, jetzt wird zugegriffen:
     
     $sql = "Select Name, Ort From Personal Where Persnr = 2";
     $stmt = $conn->query($sql);                          // Ausfuehren des Befehls und speichern der Ergebnisse in $stmt
     
     if ($row = $stmt->fetch())                           // Auslesen der ersten Zeile des Ergebnisses
     {
        // im True-Zweig, also war Auslesen der ersten Zeile erfolgreich:
        echo "<p>Der Mitarbeiter mit der Personalnummer 2 heißt ",    
             "$row[NAME] und wohnt in $row[ORT].</p>";
     } else
     {
        // im False-Zweig, also misslang das Auslesen der ersten Zeile:
        echo "<p>Der Mitarbeiter mit der angegebenen Nummer existiert nicht!</p>";
     }
     
     $conn->commit();                                    // Transaktion abgeschlossen
     $stmt = null; $conn = null;                         // Verbindung beendet, am Programmende automatisch!
     echo "<p>Die Verbindung zur Datenbank wird geschlossen.</p>";
  }
  
  // PDO Fehlerbehandlung
  catch (PDOException $e)
  {
     echo "<p>Datenbankfehler in Zeile ", $e->getLine(), " mit Fehlercode ", $e->getCode(), "<br/>",
          "Fehlertext: ", $e->getMessage(), "</p>";  
  }   

  // Globale Fehlerbehandlung
  catch (Exception $e)
  {
     echo "<p>Fehler in Zeile ", $e->getLine(), " mit Fehlercode ", $e->getCode(), "</p>",
          "<p>Fehlertext: ", $e->getMessage(), "</p>";  
  }   

?>

<hr noshade size="1">

<p><center><a href="index.html">Zurück zur Startseite</a></center></p>
</body>
</html>
