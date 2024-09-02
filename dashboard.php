<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PixelPuls Design</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }

      body {
        background-color: #f7f7f7;
      }

      .modal-container {
        position: fixed;
        height: 100%;
        width: 100%;
      }

      .modal-content {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 380px;
        width: 100%;
        padding: 30px 20px;
        border-radius: 24px;
        background-color: #fff;
        opacity: 1;
        pointer-events: auto;
      }

      .modal-content i {
        font-size: 70px;
        color: #1098ad;
      }

      .modal-content h2 {
        margin-top: 20px;
        font-size: 25px;
        font-weight: 500;
        color: #1098ad;
      }

      .modal-content h3 {
        font-size: 16px;
        font-weight: 400;
        color: #1098ad;
        text-align: center;
      }

      .modal-content .buttons {
        margin-top: 25px;
      }

      .modal-content button {
        font-size: 14px;
        padding: 6px 12px;
        margin: 0 10px;
      }

      .modal-button {
        text-decoration: none;
        font-size: 18px;
        font-weight: 400;
        color: #fff;
        padding: 14px 22px;
        border: none;
        background: #1098ad;
        border-radius: 6px;
        cursor: pointer;
      }

      .modal-button:hover {
        background-color: #0b7b8a;
      }

      a:link {
        color: #fff;
      }

      a:visited {
        color: #fff;
      }

      a:hover {
        color: #fff;
      }

      a:active {
        color: #fff;
      }

      a:link,
      a:visited {
        text-decoration: none;
      }


      a:hover {
      text-decoration: none;
    }

  
    </style>
  </head>
  <body>
  
    
    <div class="modal-container">
      <div class="modal-content">
        <h2>PixelPuls Dashboard</h2>
        <h3>Velg en handling:</h3>
        <div class="buttons">
          <button class="modal-button">
            <a href="registration.php">Registrer ny bruker</a>
            <button class="modal-button">
            <a href="helpdesk.php">Registrer en feil</a>
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
