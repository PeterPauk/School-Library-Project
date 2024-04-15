<?php
include_once './inc/config.php';
include_once './components/head.php';
$categories = ['Stredné školy', 'Autoškoly', 'Vysoké školy', 'Programovanie', 'Web Dizajn', 'Databázy'];
$values = ['stredné-školy', 'autoškoly', 'vysoké-školy', 'programovanie', 'web-dizajn', 'databázy'];

?>

<nav>
    <h4><a href="index.php">XML Knižnica</a></h4>
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
