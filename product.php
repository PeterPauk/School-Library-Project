<?php
include_once './inc/config.php';
include_once './inc/head.php';

if(isset($_POST['product'])){
    $book = $_POST['product'];
    $sqlBook = "SELECT * FROM test_xml WHERE nazov = '".$book."';";
    $bookResults = mysqli_query($conn, $sqlBook);
    $bookCheck = mysqli_num_rows($bookResults);
    
    if ($bookCheck > 0) {
        while ($row = mysqli_fetch_assoc($bookResults)){
            echo <<<HTML
                <img src="{$row['obrazok']}" alt="Image" />
                    <h3>{$row['nazov']}</h3>
                    <h4>{$row['autor']}</h4>
                    <p>{$row['informacieoknihe']}</p>
                    <h5>{$row['cena']}€</h5>
        HTML;
        }
    }
}



?>