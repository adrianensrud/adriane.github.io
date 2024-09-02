<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>

</head>
<body>
<?php
	$servernavn = "localhost";
  $brukernavn = "root";
  $passord = "";
  $dbnavn = "eksamen";

    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
<div class="reg-container">
    <form class="form" action="" method="post">
        <h1 class="reg-title">Registrering</h1>
        <input type="text" class="reg-input" name="username" placeholder="Brukernavn" required />
        <input type="text" class="reg-input" name="email" placeholder="Email ">
        <input type="password" class="reg-input" name="password" placeholder="Passord">
        <input type="submit" name="submit" value="Register" class="reg-button">
        <p class='link'>Tryk her for å <a href='login.php'>logge inn</a>.</p>
    </form>
    </div>
<?php
    }
?>
</body>
</html>