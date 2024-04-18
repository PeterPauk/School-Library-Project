<?php
include_once './components/url.php';
include_once './inc/config.php';
?>

<body>
    <?php 
    include_once './components/nav.php'; 
    ?>
    <h1>XML KNIŽNICA</h1>
    <main>
    <?php include_once './components/sidebar.php'; ?>
    <div class="main-books">
    <?php
   

    if ($itemsCheck > 0) {
        while ($row = mysqli_fetch_assoc($itemResults)) {
            echo <<<HTML
            <form class="book" action="product.php" method="GET">
                <a href="product.php"><button class="title-button" type="submit" name="product" value="{$row['adresa']}">
                <img src="{$row['obrazok']}" alt="Image" />
                </button></a>
                <div class="book-content">
                    <h3 class="book-title"><a href="product.php"><button class="title-button" type="submit" name="product" value="{$row['adresa']}">{$row['nazov']}</button></a></h3>
                    <h4 class="book-author">{$row['autor']}</h4>
                    <p class="book-desc">{$row['informacieoknihe']}</p>
                    <h5>{$row['cena']}€</h5>
                </div>
            </form>
        HTML;
        }
    }
    $conn->close();
    if(isset($_GET['submit'])){
    echo '<form class="page-form" action="kategoria" method="GET">';
    $currentURL = $_SERVER['REQUEST_URI'];
    $matches = [];
    $pageNums = [1,2,3];
    for($i = 0; $i <= 2; $i++){
        if (preg_match('/\/(\d+)$/', $currentURL, $matches)) {
            $pageNum = $matches[1];
            if($pageNum == ($i+1)){
                echo '<a class= "active-a" href=kategoria/'.$_GET['submit'].'/'.$pageNums[$i].'>'.$pageNums[$i].'</a>';
            }
            else{
                echo '<a href=kategoria/'.$_GET['submit'].'/'.$pageNums[$i].'>'.$pageNums[$i].'</a>';
            }
        }
    }
    }
    echo '<form>';
    ?>
    
    </div>
    </main>
    
    <script src="./js/functions.js"></script>
    
</body>
</html>