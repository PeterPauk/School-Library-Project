<?php
include_once './inc/config.php';
include_once './components/head.php';
$categories = ['Stredné školy', 'Autoškoly', 'Vysoké školy', 'Programovanie', 'Web Dizajn', 'Databázy'];
$values = ['stredne-skoly', 'autoskoly', 'vysoke-skoly', 'programovanie', 'web-dizajn', 'databazy'];

?>

<nav>
    <div>
    <h4><a href="kategoria.php">XML Knižnica</a></h4>
    <h5><a href="index.php">Úvod</a></h5>
    </div>
    <form action="kategoria.php" method="GET">
        <select name="submit">
            <?php
            $selectedValue;
            if (isset($_GET['submit'])) {
                $selectedValue = $_GET["submit"];
            }
            else{
                $selectedValue = '';
            }
            for($i = 0; $i < 6; $i++){
                echo '<option value="' . $values[$i] . '" ' . (($selectedValue == $values[$i]) ? 'selected' : '') . '>' . $categories[$i] . '</option>';
            }
            ?>
        </select>
        <button type="submit">Hľadať</button>
    </form>
</nav>
