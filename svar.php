<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "eksamen"; 

// Opprett forbindelse
$conn = new mysqli($servername, $username, $password, $dbname);

// Sjekk forbindelse
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $henvendelse = $_POST['henvendelser'];
    $beskrivelse = $_POST['beskrivelse'];
    $brukernavn = $_POST['brukernavn'];

    $sql = "INSERT INTO svar (henvendelse, beskrivelse, brukernavn) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $henvendelse, $beskrivelse, $brukernavn);

    if ($stmt->execute()) {
        echo "Nytt svar registrert!";
    } else {
        echo "Feil: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrer Svar</title>
    
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
        font-size: 16px;
        display: block;
        margin-bottom: 12px;
   
       
      }

      input,
      select,
      textarea {
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

      th,
      td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
      }

      th {
        background-color: #f7f7f7;
      }

      a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
      }

      a:hover {
        text-decoration: none;
      }
    </style>
  </head>
  <body>
    <h1>Registrer Svar</h1>
    <form method="POST">
      <label for="henvendelser">Henvendelse:</label>
      <input type="text" name="henvendelser" id="henvendelser" required /><br />
      <label for="beskrivelse">Beskrivelse:</label>
      <input type="text" name="beskrivelse" id="beskrivelse" /><br />
      <label for="brukernavn">Brukernavn:</label>
      <input type="text" name="brukernavn" id="brukernavn" required /><br />
      <button type="submit">Send Inn</button>
    </form>
    <center>
      <button class="button">
        <a href="index.html">Hjem</a> 
    </center>
  </body>
</html>
