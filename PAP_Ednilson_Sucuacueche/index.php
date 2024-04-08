<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="img/man.png">
    <title>Stayfit</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .start-button {
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    include_once 'header.php';
    ?>

    <div class="container">
        <h1>Bem-vindo</h1>

        <div class="content">
            <p>
                <h3>Temos o prazer de oferecer uma variedade de recursos e ferramentas para ajudá-lo a atingir suas metas de condicionamento físico.</h3>
            </p>
            <p>
                <h3>Se está apenas começando sua jornada de condicionamento físico ou é um profissional experiente, temos algo para todos.</h3>
            </p>
            <p>
                <h3>Junte-se à nossa comunidade de pessoas que pensam como você e receba apoio e incentivo enquanto trabalha para alcançar seus objetivos.</h3>
            </p>
            <p>
                <h3>Obrigado por visitar nosso site.</h3>
            </p>
            <br>
        </div>

        <a href="Planosdetreino.php"><button class="start-button">Vamos começar</button></a>
    </div>

    <?php
    include_once 'footer.php';
    ?>
</body>

</html>
