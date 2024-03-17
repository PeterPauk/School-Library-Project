<?php
include_once './inc/config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Test</title>
    <!--<link rel="stylesheet" href="styles/main.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,200;0,300;0,400;0,600;1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <h1>XLM KNIŽNICA</h1>
    <main>
    <?php
    $xmldata = "https://export.martinus.sk/?a=XmlPartner&cat=6758&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmldata1 = "https://export.martinus.sk/?a=XmlPartner&cat=6768&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk";
    $xmlfiles = [$xmldata, $xmldata1];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    foreach ($xmlfiles as $xmlfile) {
        curl_setopt($ch, CURLOPT_URL, $xmlfile);
    
        $data = curl_exec($ch);

        $xml = simplexml_load_string($data);

        $sql = "SELECT * FROM test_xml";
        $result = mysqli_query($conn, $sql);

        foreach ($xml->channel->item as $book) {
                $nazov = $book->title;
                $autor = $book->author;
                $informacieoknihe = $book->description;
                $cena = $book->price;
                $obrazok = $book->enclosure['url'];

                $checkSql = "SELECT * FROM test_xml WHERE nazov = '$nazov' AND autor = '$autor'";
                $checkResult = mysqli_query($conn, $checkSql);
        
                if (mysqli_num_rows($checkResult) == 0) {
                    $insertSql = "INSERT INTO test_xml (nazov, autor, informacieoknihe, cena, obrazok) VALUES ('$nazov', '$autor', '$informacieoknihe', '$cena', '$obrazok')";
                    if ($conn->query($insertSql) === TRUE) {
                        echo "Entry inserted!";
                    } else {
                        echo "Error inserting entry";
                    }
                } else {
                    echo "Entry already exists!";
                }
        }
    }
    curl_close($ch);
    $conn->close();

    /*
    for($i = 0; $i < 2; $i++){
        foreach($xmlfiles[$i]->channel->item as $book){
            echo '<div>';
            echo $title = $book->title . '</br>';
            echo $author = $book->author . '</br>';
            echo '<img src=" '.$book->image.'"alt="Image" />' . '</br>';
            echo substr($book->description . '</br>', 0, 50);
            echo $product_id = $book->product_id . '</br>';
            echo $price = $book->price . '</br>';
            echo $rating = $book->rating . '</br>';
            echo '</div>';
        }
    }
    */
 
    ?>
    </main>
    
</body>
</html>