<?php
include_once './components/url.php';
include_once './inc/config.php';
include_once './components/head.php';
include_once './components/nav.php';

if(isset($_GET['product'])){
    $book = $_GET['product'];
    $sqlBook = "SELECT * FROM test_xml WHERE adresa = '".$book."';";
    $bookResults = mysqli_query($conn, $sqlBook);
    $bookCheck = mysqli_num_rows($bookResults);

    $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

    
    if ($bookCheck > 0) {
        while ($row = mysqli_fetch_assoc($bookResults)){
            echo "<a href=\"javascript:history.go(-1)\">Späť</a>";
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