<?php
include_once "database.php";
session_start();
    
// User Authentication
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display an error message
    header("Location: login.php");
    exit();
}

// Fetch User Plans
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `user_plan` WHERE `user_id` = $user_id";
$result = mysqli_query($mysqli, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>User Plans</title>
    <style>
    </style>
</head>
<body>
    <div class="container my-5">
       <a class="btn btn-primary my-5" href="userplan.php" role="button">Nova atividade</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id no</th>
                    <th scope="col">Dia</th>
                    <th scope="col">atividade/exercício</th>
                    <th scope="col">repetições</th>
                    <th scope="col">séries</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $day = $row['day'];
                    $activities = $row['activities'];
                    $reps = $row['reps'];
                    $sets = $row['sets'];

                    echo '
                    <tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $day . '</td>
                        <td>' . $activities . '</td>
                        <td>' . $reps . '</td>
                        <td>' . $sets . '</td>
                        <td>
  <a href="updateplan.php?updateid=<?php echo $id; ?>&user_id=<?php echo $user_id; ?>" class="btn btn-primary">Update</a>
  <a href="deleteplan.php?deleteid=<?php echo $id; ?>&user_id=<?php echo $user_id; ?>" class="btn btn-danger">Delete</a>
</td>

                    </tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
