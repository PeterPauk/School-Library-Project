<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Test</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Poppins:ital,wght@0,200;0,300;0,400;0,600;1,100&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <h1>XLM KNIŽNICA</h1>
    <main>
    <?php
    $xmldata = simplexml_load_file("https://export.martinus.sk/?a=XmlPartner&cat=6758&q=&z=B7GET5&key=NYtvbkOHAzPzGJNz7qR9Kk");
    foreach($xmldata->channel->item as $book){
        echo '<div>';
        echo $book->title . '</br>';
        echo $book->author . '</br>';
        echo '<img src=" '.$book->image.'"alt="Image" />' . '</br>';
        echo substr($book->description . '</br>', 0, 50);
        echo $book->product_id . '</br>';
        echo $book->price . '</br>';
        echo $book->rating . '</br>';
        echo '</div>';
    }
    ?>
    </main>
    
</body>
</html>