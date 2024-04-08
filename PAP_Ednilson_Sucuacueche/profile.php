<?php
include_once 'header.php';

// Redirect user to login page if not logged in
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

// Connect to database
$mysqli = require __DIR__ . "/database.php";

// Retrieve user information from database
$sql = sprintf("SELECT name, email, password_hash FROM user WHERE id = %d",
               $_SESSION["user_id"]);
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

// Handle password update form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $old_password = $_POST["old_password"];
  $new_password = $_POST["new_password"];
  $confirm_password = $_POST["confirm_password"];

  // Validate password input
  $errors = [];
  if (empty($old_password)) {
    $errors[] = "Old password is required";
  } elseif (!password_verify($old_password, $user['password_hash'])) {
    $errors[] = "Old password is incorrect";
  }
  if (empty($new_password)) {
    $errors[] = "New password is required";
  } elseif (strlen($new_password) < 8) {
    $errors[] = "New password must be at least 8 characters long";
  } elseif ($new_password !== $confirm_password) {
    $errors[] = "New password and confirmation password do not match";
  }

  // Update password in database if input is valid
  if (empty($errors)) {
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = sprintf("UPDATE user SET password_hash = '%s'
                     WHERE id = %d",
                    $mysqli->real_escape_string($hashed_password),
                    $_SESSION["user_id"]);
    $mysqli->query($sql);
    header("Location: profile.php");
    exit;
  }
}

// Handle account deletion form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_account"])) {
  // Delete the user's account from the database
  $sql = sprintf("DELETE FROM user WHERE id = %d",
                 $_SESSION["user_id"]);
  $mysqli->query($sql);

  // Clear session data and redirect to the login page
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit;
}
?>

<html>
<head>
  <title>Profile Page</title>
  <link rel="shortcut icon" type="x-icon" href="img/man.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos/styleprofile.css">
</head>
<body style="background-color: #ccc;">

  <main>
    
    <h1>Profile</h1>
    <p>Name: <?= htmlspecialchars($user["name"]) ?></p>
    <p>Email: <?= htmlspecialchars($user["email"]) ?></p><br>
    <h2>Change Password</h2>
    <?php if (isset($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <form method="post">
      <div>
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required>
      </div>
      <div>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
      </div>
      <div>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
      </div>
      <div>
        <button type="submit">Update Password</button>
      </div>
    </form>

    <h2>Delete Account</h2>
    <form id="deleteForm" method="post">
      <div>
        <button type="button" id="deleteButton" class="apagarconta">Delete Account</button>
      </div>
    </form>
  </main>

  <div id="deleteModal" class="modal">
    <div class="modal-content" style="width: 400px;">
      <h2>Confirmar eliminação da conta</h2>
      <p>Tem certeza de que deseja apagar sua conta? Essa ação não pode ser desfeita.</p>
      <div>
        <button id="confirmDelete" type="submit" class="deleteAccount">Delete Account</button>
        <button id="cancelDelete" type="button" class="cancel">Cancel</button>
      </div>
    </div>
  </div>

  <script>
    // Modal functionality
    var modal = document.getElementById("deleteModal");
    var deleteButton = document.getElementById("deleteButton");
    var cancelDelete = document.getElementById("cancelDelete");
    var confirmDelete = document.getElementById("confirmDelete");

    deleteButton.onclick = function() {
      modal.style.display = "block";
    }

    cancelDelete.onclick = function() {
      modal.style.display = "none";
    }

    confirmDelete.onclick = function() {
      document.getElementById("deleteForm").submit();
    }

    window.onclick = function(event) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>
</html>
