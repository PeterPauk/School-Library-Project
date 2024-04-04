<ul>
    <?php
    include_once './inc/config.php';
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
        if(isset($_POST['submit']) && $_POST['submit'] == $categories[$i]){
            $activeForm = "active";
        }
        else{
            $activeForm = "";
        }
        echo '
        <form class="'.$activeForm.'" action="kategoria.php" method="post">
        <i class="fa-solid '.$icons[$i].'"></i>
        <li class=book-category>
        <input class="'.$activeForm.'" type="submit" name="submit" value="'.$categories[$i].'">
        </li>
        </form>
        ';    
    }

    for($i = 0; $i < 6; $i++){
        if(isset($_POST['submit']) && $_POST['submit'] == $categories[$i]){

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
    if(isset($_POST['submit'])){
        $category = $_POST['submit'];
        $sqlItems = "SELECT nazov, autor, informacieoknihe, cena, obrazok FROM test_xml WHERE kategoria = '".$category."' LIMIT 50;";
    }
    else{
        $sqlItems = "SELECT nazov, autor, informacieoknihe, cena, obrazok FROM test_xml LIMIT 50;";
    }
    $itemResults = mysqli_query($conn, $sqlItems);
    $itemsCheck = mysqli_num_rows($itemResults);

    ?>
    </ul>