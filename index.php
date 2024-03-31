<?php
include_once './inc/config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($_GET['submit'])){
        echo '<title>XML Test - '.$_GET['submit'].'</title>';
    }
    else{
        echo '<title>XML Test</title>';
    }
    ?>
    <script src="https://kit.fontawesome.com/0a4f5afbb3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,200;0,300;0,400;0,600;1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <h1>XML KNIŽNICA</h1>
    <main>
    <ul>

    <?php
    $xmlSchools = "https://export.martinus.sk/?a=XmlPartner&cat=6758&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlCars = "https://export.martinus.sk/?a=XmlPartner&cat=6768&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlUniversity = "https://export.martinus.sk/?a=XmlPartner&cat=6764&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlProgramming = "https://export.martinus.sk/?a=XmlPartner&cat=6408&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlWeb = "https://export.martinus.sk/?a=XmlPartner&cat=6406&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlDatabases = "https://export.martinus.sk/?a=XmlPartner&cat=6414&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlfiles = [$xmlSchools, $xmlCars, $xmlUniversity, $xmlProgramming, $xmlWeb, $xmlDatabases];

    $categories = ['Stredné školy', 'Autoškoly', 'Vysoké školy', 'Programovanie', 'Web dizajn', 'Databázy'];
    $icons = ['fa-school', 'fa-car', 'fa-building-columns', 'fa-computer', 'fa-desktop', 'fa-database'];
    $activeForm = "";

    for($i = 0; $i < count($categories); $i++){
        if(isset($_GET['submit']) && $_GET['submit'] == $categories[$i]){
            $activeForm = "active";
        }
        else{
            $activeForm = "";
        }
        echo '
        <form class="'.$activeForm.'" action="index.php" method="GET">
        <i class="fa-solid '.$icons[$i].'"></i>
        <li class=book-category>
        <input class="'.$activeForm.'" type="submit" name="submit" value="'.$categories[$i].'">
        </li>
        </form>
        ';    
    }

    for($i = 0; $i < 6; $i++){
        if(isset($_GET['submit']) && $_GET['submit'] == $categories[$i]){

            $xmlfile = $xmlfiles[$i];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_URL, $xmlfile);
        
            $data = curl_exec($ch);

            $xml = simplexml_load_string($data);

            $sql = "SELECT * FROM test_xml";
            $result = mysqli_query($conn, $sql);

            foreach ($xml->channel->item as $book) {
                    $nazov = $conn->real_escape_string($book->title);
                    $autor = $book->author;
                    $informacieoknihe = $book->description;
                    $cena = $book->price;
                    $obrazok = $book->enclosure['url'];

                    $checkSql = "SELECT * FROM test_xml WHERE nazov = '$nazov'";
                    $checkResult = mysqli_query($conn, $checkSql);

                    if (mysqli_num_rows($checkResult) == 0) {
                        $insertSql = "INSERT INTO test_xml (nazov, autor, kategoria, informacieoknihe, cena, obrazok) VALUES ('$nazov', '$autor', '$categories[$i]','$informacieoknihe', '$cena', '$obrazok')";
                        $conn->query($insertSql);
                    }
            }
            curl_close($ch);
        }
    }

    if(isset($_GET['submit'])){
        $category = $_GET['submit'];
        $sqlItems = "SELECT nazov, autor, informacieoknihe, cena, obrazok FROM test_xml WHERE kategoria = '".$category."' LIMIT 50;";
    }
    else{
        $sqlItems = "SELECT nazov, autor, informacieoknihe, cena, obrazok FROM test_xml LIMIT 50;";
    }
    $itemResults = mysqli_query($conn, $sqlItems);
    $itemsCheck = mysqli_num_rows($itemResults);

    ?>
    </ul>
    <div class="main-books">
    <?php

    if ($itemsCheck > 0) {
        while ($row = mysqli_fetch_assoc($itemResults)) {
            echo <<<HTML
            <div class="book">
                <img src="{$row['obrazok']}" alt="Image" />
                <div class="book-content">
                    <h3 class="book-title">{$row['nazov']}</h3>
                    <h4 class="book-author">{$row['autor']}</h4>
                    <p class="book-desc">{$row['informacieoknihe']}</p>
                    <h5>{$row['cena']}€</h5>
                </div>
            </div>
        HTML;
        }
    }
    $conn->close();
    ?>
    </div>
    </main>
    <script src="./js/functions.js"></script>
    
    
    
</body>
</html>