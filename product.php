<?php
include_once './inc/config.php';
include_once './components/head.php';
include_once './components/nav.php';

if(isset($_GET['product'])){
    $book = $_GET['product'];
    $sqlBook = "SELECT * FROM test_xml WHERE adresa = '".$book."';";
    $bookResults = mysqli_query($conn, $sqlBook);
    $bookCheck = mysqli_num_rows($bookResults);
    
    if ($bookCheck > 0) {
        while ($row = mysqli_fetch_assoc($bookResults)){
            echo <<<HTML
            <main>
                <div class="book-side">
                </div>
                <div class="book-page">
                    <img src="{$row['obrazok']}" alt="Image" />
                    <div>
                        <h3>{$row['nazov']}</h3>
                        <h4>{$row['autor']}</h4>
                        <p>{$row['informacieoknihe']}</p>
                        <span><strong>Pevná väzba s prebalom</strong></span>
                        <h5>{$row['cena']}€</h5>
                        <span>U dodávateľa</span>
                        <span>Posielame do <strong>19 – 24 dní</strong></span>
                    </div>
                </div>
            </main>
        HTML;
        }
    }
}



?>