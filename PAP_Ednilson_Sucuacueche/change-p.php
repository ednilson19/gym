<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form input
  $old_password = $_POST['op'];
  $new_password = $_POST['np'];
  $confirm_password = $_POST['c_np'];

  // Validate form input
  if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
    $_SESSION['error'] = 'Please fill in all fields.';
    header('Location: change-password.php');
    exit();
  } elseif ($new_password !== $confirm_password) {
    $_SESSION['error'] = 'New passwords do not match.';
    header('Location: change-password.php');
    exit();
  } else {
    // Validate old password against database
    $user_id = 1; // Replace with user ID from database
    $db_password = 'hashed_password'; // Replace with hashed password from database

    if (password_verify($old_password, $db_password)) {
      // Old password is valid, update password in database
      $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT); // Hash new password
      // Update password in database for user with $user_id

      // Redirect user to success page
      $_SESSION['success'] = 'Password successfully changed.';
      header('Location: change-password-success.php');
      exit();
    } else {
      // Old password is invalid
      $_SESSION['error'] = 'Old password is invalid.';
      header('Location: change-password.php');
      exit();
    }
  }
}
