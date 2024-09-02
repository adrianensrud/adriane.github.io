<?php
include("auth_session.php");
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registrer Henvendelser</title>
    <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f7f7f7ff;
      margin: 20px;
    }
 
    h1 {
      text-align: center;
      color: #1098ad;
    }
 
    form {
      max-width: 400px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
 
    label {
      display: block;
      margin-bottom: 12px;
      color: #1098ad;
      font-size: 14px;
    }
 
    input, select, textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      box-sizing: border-box;
      border: 2px solid #1098ad;
      border-radius: 6px;
      font-size: 14px;
    }
 
    button {
      background-color: #1098ad;
      color: #fff;
      padding: 12px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
 
    button:hover {
      color: #fff;
      background-color: #0b7b8a;
    }
 
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
 
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: left;
    }
 
    th {
      background-color: #f7f7f7;
    }
 
    a {
      color: #1098ad;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
    }
 
    a:hover {
      text-decoration: none;
    }

    .buttons {
  display: flex;
  justify-content: center; /* Justerer innholdet til midten horisontalt */
  margin-top: 20px; /* Legger til litt avstand over knappene */
  margin-right: 30px;
}

.space-right {
  margin-right: 10px;
}

.modal-button button {
  background-color: #1098ad;
  color: #fff;
  padding: 12px 16px;
 
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 16px;
}

.modal-button button:hover {
  color: #fff;
  background-color: #0b7b8a;
}

.modal-button a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  font-size: 16px;
}

.modal-button a:hover {
  text-decoration: none;
}

  </style>
</head>
<body>



 
    <h1>Hei, <?php echo $_SESSION['username']; ?>!</h1>
    <h1>Registrer Henvendelser</h1><br>
    <form action="" method="post">
        Hva gjelder:
        <select name="henvendelser" id="henvendelser" required>
            <option value="Printerfeil">Printerfeil</option>
            <option value="Nettverksproblem">Nettverksproblem</option>
            <option value="Maskinvarefeil">Maskinvarefeil</option>
            <option value="Programvarefeil">Programvarefeil</option>
        </select><br><br>
       
        Beskriv henvendelsen:<textarea name="beskrivelse" id="beskrivelse" rows="5" cols="50" required></textarea><br><br>
        <button type="submit" name="submit">Send inn</button><br><br>
    </form>
 
    <center>
    <div class="buttons">
          <button class="modal-button space-right ">
            <a href="index.html">Hjem</a>
            <button class="modal-button space-right ">
            <a href="svar.php">Svar</a> 
          
  </center>
      
    <?php
    $servernavn = "localhost";
    $brukernavn = "root";
    $passord = "";
    $dbnavn = "eksamen";
   
    $tilkobling = new mysqli($servernavn, $brukernavn, $passord, $dbnavn);
   
    if ($tilkobling->connect_error) {
        die("Noe gikk galt: " . $tilkobling->connect_error);
    }
    $tilkobling->set_charset("utf8");
 
   
    if (isset($_POST["submit"])) {
        $henvendelser = $tilkobling->real_escape_string($_POST["henvendelser"]);
        $beskrivelse = $tilkobling->real_escape_string($_POST["beskrivelse"]);
        $create_datetime = date("Y-m-d H:i:s");
        $brukernavn = $_SESSION['username'];
 
        $sql = "INSERT INTO registrering (henvendelser, beskrivelse, create_datetime, brukernavn) VALUES ('$henvendelser', '$beskrivelse', '$create_datetime', '$brukernavn')";
       
        if ($tilkobling->query($sql) === TRUE) {
            echo "Spørringen ble gjennomført.";
        } else {
            echo "Noe gikk galt med spørringen: " . $sql . " (" . $tilkobling->error . ")";
        }
    }
 
    $brukernavn = $_SESSION['username'];
    $sql2 = "SELECT id, henvendelser, create_datetime, beskrivelse FROM registrering WHERE brukernavn='$brukernavn' ORDER BY create_datetime DESC";
    $datasett = $tilkobling->query($sql2);
    ?>
 
    <table>
        <tr>
            <th>ID</th>
            <th>Hva gjelder</th>
            <th>Dato</th>
            <th>Henvendelse</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        if ($datasett->num_rows > 0) {
            while ($rad = $datasett->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $rad["id"]; ?></td>
                    <td><?php echo $rad["henvendelser"]; ?></td>
                    <td><?php echo $rad["create_datetime"]; ?></td>
                    <td><?php echo $rad["beskrivelse"]; ?></td>
                    <td><a href="?slettID=<?php echo $rad["id"]; ?>">Slett</a></td>
                    <td><a href="oppdater.php?oppdaterID=<?php echo $rad["id"]; ?>">Oppdater</a></td>
                </tr>
        <?php }
        } else {
            echo "<tr><td colspan='6'>Ingen registreringer funnet</td></tr>";
        }
        ?>
    </table>
 
    <p><a href="login.php">Logg ut</a></p>
 
    <?php
    if (isset($_GET['slettID'])) {
        $slettID = $tilkobling->real_escape_string($_GET['slettID']);
        // Slett bare hvis slettID er satt
        $sql_slett = "DELETE FROM registrering WHERE id='$slettID' AND brukernavn='$brukernavn'";
        if ($tilkobling->query($sql_slett) === TRUE) {
            echo "Registreringen ble slettet.";
            // Videresend etter sletting (du kan velge å fjerne dette hvis du ikke vil videresende)
          
        } else {
            echo "Noe gikk galt med slettingen: " . $tilkobling->error;
        }
    }
    ?>
 
</body>
</html>