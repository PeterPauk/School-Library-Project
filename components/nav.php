<?php
include_once './inc/config.php';
include_once './components/head.php';
$categories = ['Stredné školy', 'Autoškoly', 'Vysoké školy', 'Programovanie', 'Web dizajn', 'Databázy'];
?>

<nav>
    <h4>XML Knižnica</h4>
    <form action="index.php" method="post">
        <select name="submit">
            <?php
            $selectedValue;
            if (isset($_POST['submit'])) {
                $selectedValue = $_POST["submit"];
            }
            else{
                $selectedValue = '';
            }
            for($i = 0; $i < 6; $i++){
                echo '<option value="' . $categories[$i] . '" ' . (($selectedValue == $categories[$i]) ? 'selected' : '') . '>' . $categories[$i] . '</option>';
            }
            ?>
        </select>
        <button type="submit">Hľadať</button>
    </form>
</nav>
