<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayfit</title>
    <link rel="stylesheet" href="estilos/styleheader.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" integrity="..." crossorigin="anonymous" />
</head>
<body>
<header>
    <nav class="custom-navbar">
        <div class="custom-logo">
            <h3><a href="index.php">Stayfit</a></h3>
        </div>
        <ul class="custom-nav-link">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a class="nav-link" href="Planosdetreino.php">Planos de treino</a>
            </li>
            <?php
            if(isset($_SESSION["user_id"])){
                echo "<li> <a href='meuplano.php'>Meu plano</a></li>";
                echo "</li>";
            }
            ?>
             <li>
              <a href="calculadora.php">Nutrição</a> 
            </li>
            <!-- <li>
                <a href="demo.php">Nutrição</a>
            </li> -->
                <?php
                if(isset($_SESSION["user_id"])){
                }else{
                    echo "<li> <a href='Login.php'><i class='fa-solid fa-right-to-bracket'></i> Login</a></li>";
                    // echo "<li> <a href='signin.php'>Registar</a> </li>";
                }
                // Check if user is logged in
                if (isset($_SESSION['user_id'])) {

                    include_once "database.php";
                    // Retrieve user information from the database
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT name FROM user WHERE id = $user_id";
                    $result = $mysqli->query($query);

                    // Check if query was successful
                    if ($result) {
                        $user = $result->fetch_assoc();
                        $username = $user['name'];
                        echo "<li class='custom-dropdown'>";
                        echo "<a class='dropbtn'>Olá, $username <i class='fa-light fa-angle-down'></i></a>";
                        echo "<div class='custom-dropdown-content'>";
                        echo "<a href='profile.php'><i class='fa-solid fa-user-pen'></i> Profile</a>";
                        echo "<a href='contactoform.php'><i class='fa-sharp fa-light fa-headset'></i> Suporte</a>";
                        echo "<a href='logout.php'><i class='fa-solid fa-right-from-bracket'></i> Sair</a>";
                        echo "</div>";
                        echo "</li>";
                    } else {
                        echo "<li> <a href='Login.php'>Login</a> </li>";
                        // echo "<li> <a href='signin.php'>Registar</a> </li>";
                    }
                }
                ?>
            </li>
        </ul>
    </nav>
</header>
</body>
</html>

<!-- Workout Reminders and Scheduling: Enable users to set reminders for their workouts or create a personalized workout schedule within the app. This can help them stay consistent and organized with their fitness routine. -->