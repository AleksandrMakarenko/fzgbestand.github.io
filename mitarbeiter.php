<html>
<head>
<meta http-equiv="content-type" content="text/html" charset="utf-8">
<meta name="description" content="Datenbanken und SQL: Auslesen mehrerer Zeilen">
<meta name="author" content="Edwin Schicker">
<title>Datenbanken und SQL: Auslesen mehrerer Zeilen</title>
</head>

<body text="#000000" bgcolor="#FFFFEF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<center><h1>Datenbanken und SQL</h1></center>
<center><h3>Edwin Schicker</h3></center>
<p>Dies ist die Datei <i>mitarbeiter.php</i>, die beim Klick auf den Weiter-Button wieder selbst
aufgerufen wird.</p>
<p>Diese Seite greift auf die Relation PERSONAL der Datenbank BIKE zu. Bitte geben Sie 
neben den Einlog-Daten einen Suchstring ein. Jeder Mitarbeiter wird dann ausgegeben, der diesen 
Suchstring in seinem Namen enthält. Neben dem Namen wird auch der Wohnort, das Geburtsdatum und
das Gehalt ausgegeben, ebenso ob die Person Vorgesetzte ist.</p>
<p><b>Achtung!</b>Dieser Code ist extrem unsicher. Das Passwort wird sichtbar übertragen! Wir werden
schon beim nächsten Beispiel eine sichere Übertragung wählen.</p>

<form action="mitarbeiter.php" method="post">
  <table cellpadding="10">
   <tr>
    <td>Hersteller: </td>
<?php  
    if ( isset($_POST['Hersteller']) )       // zweiter oder hoeherer Aufruf
    {
       $hersteller = $_POST['Hersteller'];
?>       
    <td><input type="radio" name="Hersteller" value="Oracle"  
                      <?php if ($hersteller == "Oracle") echo "checked"; ?> /> Oracle<br>
        <input type="radio" name="Hersteller" value="OracleUTF8"  
                      <?php if ($hersteller == "OracleUTF8") echo "checked"; ?> /> Oracle, UTF8 kodiert<br>
        <input type="radio" name="Hersteller" value="MySQL"  
                      <?php if ($hersteller == "MySQL") echo "checked"; ?> /> MySQL<br>
        <input type="radio" name="Hersteller" value="SQLServer"  
                      <?php if ($hersteller == "SQLServer") echo "checked"; ?> /> MS SQL Server
    </td>
<?php
    } else {
?>    
    <td><input type="radio" name="Hersteller" value="Oracle"/> Oracle<br>
        <input type="radio" name="Hersteller" value="OracleUTF8" checked/> Oracle, UTF8 kodiert<br>
        <input type="radio" name="Hersteller" value="MySQL"/> MySQL<br>
        <input type="radio" name="Hersteller" value="SQLServer"/> MS SQL Server
    </td>
<?php
   }
?>
   </tr>
   <tr>
    <td>Server: </td>
    <td><input type="Text" name="Server" size="20" maxlength="40"
                value=<?php echo isset($_POST['Server'])?$_POST['Server']:"localhost"; ?>>
        (in Oracle nicht erforderlich)</td>
   </tr>
   <tr>
    <td>Datenbank: </td>
    <td><input type="Text" name="Datenbank" size="40" maxlength="40"
                value=<?php echo isset($_POST['Datenbank'])?$_POST['Datenbank']:""; ?>>
              (Oracle-Remotezugriff: //Server:Port/Datenbank)</td>
   </tr>
   <tr>
    <td>Kennung: </td>
    <td><input type="Text" name="Kennung" size="20" maxlength="20"
                value=<?php echo isset($_POST['Kennung'])?$_POST['Kennung']:"bike"; ?>></td>
   </tr>
   <tr>
    <td>Passwort: </td>
    <td><input type="Password" name="Passwort" size="20" maxlength="20"
                value=<?php echo isset($_POST['Passwort'])?$_POST['Passwort']:""; ?>></td>
   </tr>
   <tr>
    <td align="right">Suchzeichen zur Mitarbeitersuche:</td>
    <td><input type="Text" name="Suchstring" size="30" maxlength="30" 
                value=<?php echo isset($_POST['Suchstring'])?$_POST['Suchstring']:""; ?>></td>
   </tr>
   <tr>
    <td></td>
    <td><input type="Submit" value="Weiter"/></td>
  </table>
</form>
<hr noshade size="1">

<?php
 // Der folgende Code wird nur dann ausgefuehrt, wenn die Post-Variable
 // Kennung bereits einmal uebergeben wurde!
 
 if (isset($_POST['Kennung'])) {
   $suche = trim($_POST['Suchstring']);    // ev. Leerzeichen entfernen
   if ($_POST['Kennung']==null || $_POST['Datenbank']==null) {
     echo "<p>Bitte geben Sie unbedingt erst korrekte Datenbankverbindungsdaten ein.</p>";
   } elseif (strlen($suche) == 0) {
     echo "<p>Es wurde kein Suchbegriff eingegeben.</p>";
   } else {
   try {
     switch ($_POST['Hersteller'])    // Einloggen in die Datenbank je nach Hersteller
     {
       case "Oracle":     $param1 = "oci:dbname=$_POST[Datenbank]";         
                          echo "<p>Aufbau einer Verbindung zur <b>Oracle</b>-Datenbank BIKE.</p>";
                          break;
       case "OracleUTF8": $param1 = "oci:dbname=$_POST[Datenbank];charset=utf8";         
                          echo "<p>Aufbau einer Verbindung zur <b>Oracle</b>-Datenbank BIKE.</p>";
                          break;
       case "SQLServer":  $param1 = "sqlsrv:Server=$_POST[Server];Database=$_POST[Datenbank]";  
                          echo "<p>Aufbau einer Verbindung zur <b>SQL Server</b> Datenbank BIKE.</p>";
                          break;
       case "MySQL":      $param1 = "mysql:host=$_POST[Server];dbname=$_POST[Datenbank]";
                          echo "<p>Aufbau einer Verbindung zur <b>MySQL</b> Datenbank BIKE.</p>";
                          break;
     }
     // neues PDO-Objekt anlegen und mit Datenbank verbinden:
     $conn = new PDO($param1, $_POST['Kennung'], $_POST['Passwort']);

     echo "<p>Die Verbindung zur Datenbank wurde hergestellt.</p>";

     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // ausfuehrliches Fehlerhandling
     $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);             // immer Grossbuchstaben als Attributrueckgabe
     $conn->beginTransaction();                                        // Transaktionsmodus

     echo "<p>Die Verbindung zur Datenbank wurde hergestellt. Es werden jetzt alle Mitarbeiter ",
          "gesucht, die im Namen den Teilstring '$suche' enthalten.</p>";

     // Die Datenbank ist geoeffnet, jetzt wird zugegriffen:
     $sql = "Select Persnr, Name, Ort, GebDatum, Gehalt, Vorgesetzt
             From Personal
             Where Upper(Name) Like Upper('%$suche%')";
     $stmt = $conn->query($sql);                          // Ausfuehren des Befehls und Ablage der Daten in $stmt

     // Ausgeben der gelesenen Daten:
     if (!($row = $stmt->fetch())) {
        echo "<p>Ein Mitarbeiter mit dem gewünschten Teilstring im Namen existiert nicht!</p>";
     } else {
?>
       <!-- Kopfzeile einer Tabelle definieren (mit <th> statt <td>: -->
       <p>Ergebnis:</p>
       <p>
       <table border cellpadding="10">
        <tr>
         <th>Persnr </th>
         <th>Name </th>
         <th>Ort </th>
         <th>GebDatum </th>
         <th>Gehalt </th>
         <th>Vorgesetzter? </th>
        </tr>
<?php
       // In einer Schleife werden die Daten ausgelesen:
       do {
?>
         <tr>
         <!-- Die ausgelesenen Daten werden gleich in die Tabelle uebernommen: -->
          <td> <?php echo $row["PERSNR"]; ?> </td>
          <td> <?php echo $row["NAME"]; ?> </td>
          <td> <?php echo $row["ORT"]; ?> </td>
          <td> <?php echo $row["GEBDATUM"]; ?> </td>
          <td> <?php echo $row["GEHALT"]; ?> </td>
          <td>
           <?php echo ($row["VORGESETZT"] == null)? "Ja" : "Nein";
           ?> </td>
         </tr>
<?php
       } while ($row = $stmt->fetch());

       echo "</table></p>";
     }  // endif $stmt->fetch

     // Die Transaktion wird beendet und die Datenbank wird geschlossen:
	 $conn->commit();
	 $stmt = null; $conn = null;             // Beenden der Verbindung
   }  // endif try
   
   // Fehlerbehandlung zu fehlerhaften Datenbankzugriffen:
   catch (PDOException $e)           // Datenbankfehler:
   {
     echo "<p>Datenbankfehler in Zeile " . $e->getLine() . " mit Fehlercode " . $e->getCode(), " (", $e->errorInfo[1], ")</p>",
          "<p>Fehlertext: " . $e->getMessage() . "</p>";  
     // Rollback wird automatisch durchgefuehrt
   }   
   catch (Exception $e)              // Fehlerbehandlung aller anderen Fehler:
   {
     echo "<p>Fehler in Zeile " . $e->getLine() . " mit Fehlercode " . $e->getCode() . "</p>" .
          "<p>Fehlertext: " . $e->getMessage() . "</p>";  
     // Rollback wird automatisch durchgeführt
   } 
   }  // endif strlen($suche)   
 }  // endif isset
?>

<p><center><a href="index.html">Zurück zur Startseite</a></center></p>
</body>
</html>