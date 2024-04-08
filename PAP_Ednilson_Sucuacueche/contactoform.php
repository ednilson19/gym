<?php include_once 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="x-icon" href="img/man.png">
  <title>Contact and Support</title>
  <style>
    body {
      background-image: linear-gradient(to bottom right, #83bb78, #dcf1d7);
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 50px;
    }

    h1 {
      text-align: center;
    }

    form {
      display: grid;
      gap: 10px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input[type="submit"] {
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 3px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Contacto e suporte</h1>
    <p>Se tiver alguma dúvida ou precisar de ajuda, entre em contato conosco.</p>
    <form action="reminder system/send-email.php" method="POST">
      
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message:</label>
      <textarea id="message" name="message" required></textarea>

      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>
