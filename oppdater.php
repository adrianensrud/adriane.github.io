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

$row = []; // $row med en tom array

if (isset($_GET["oppdaterID"])) {
    $oppdaterID = $_GET["oppdaterID"];

    // Hent dataen
    $sql = "SELECT * FROM registrering WHERE id = ?";
    $stmt = $tilkobling->prepare($sql);
    $stmt->bind_param("i", $oppdaterID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (isset($_POST["update"])) {
            $henvendelser = $_POST["henvendelser"]; // endret variabelnavnet
            $create_datetime = date("Y-m-d H:i:s");
            $beskrivelse = $_POST["beskrivelse"];

            $updateSql = "UPDATE registrering SET henvendelser = ?, create_datetime = ?, beskrivelse = ? WHERE id = ?";
            $stmt = $tilkobling->prepare($updateSql);
            $stmt->bind_param("sssi", $henvendelser, $create_datetime, $beskrivelse, $oppdaterID);

            if ($stmt->execute()) {
                echo "Oppdateringen ble gjennomført.";
                header("Location: helpdesk.php");
            } else {
                echo "Noe gikk galt med oppdateringen: " . $tilkobling->error;
            }
        }
    } else {
        echo "Ingen data funnet for ID: " . $oppdaterID;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oppdater</title>
    <!-- Include your styles or link to the main CSS file -->
    <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f7f7f7;
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
      font-size: 14px;
    }
 
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
        
    <h1>Oppdater hendvendelse</h1>
    <form action="" method="post">
      Hva gjelder:
      <select name="henvendelser" id="henvendelse" required>
        <option value="Printerfeil">Printerfeil</option>
        <option value="Regristreringsfeil">Regristreringsfeil</option>
        <option value="Programfeil">Programfeil</option>
        <option value="Nettverksfeil">Nettverksfeil</option>
      </select><br><br>
      Beskriv henvendelsen:<input type="text" name="beskrivelse" value="<?php echo isset($row["beskrivelse"]) ? $row["beskrivelse"] : ''; ?>" /><br><br>
    
        <button type="submit" name="update">Oppdater</button><br><br>
    </form>

    <a href="dashboard.php">Tilbake</a>
</body>
</html>
