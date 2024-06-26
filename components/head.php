<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($_GET['submit'])) {
        $labels = ['Stredné školy', 'Autoškoly', 'Vysoké školy', 'Programovanie', 'Web Dizajn', 'Databázy'];
        $title = ($_GET['submit']);
        for($i = 0; $i <= 5; $i++){
            if (strtolower(substr($title, 0, 1)) === strtolower(substr($labels[$i], 0, 1))) {
                echo '<title>XML Test - ' . str_replace("-", " ", $labels[$i]) . '</title>';
            }
        }
    } elseif (isset($_GET['product'])) {
        $title = ucwords($_GET['product']);
        echo '<title>XML Test - ' . str_replace("-", " ", $title) . '</title>';
    } else {
        echo '<title>XML Test</title>';
    }
    ?>
    <script src="https://kit.fontawesome.com/0a4f5afbb3.js" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <base href="/xmlka/">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,200;0,300;0,400;0,600;1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>