<?php
if(isset($_GET['submit'])) {
    $submit = $_GET['submit'];

    if(!preg_match('/\/kategoria\/.*/', $_SERVER['REQUEST_URI'])) {
        $new_url = "http://localhost/xmlka/kategoria/$submit";
        header("Location: $new_url");
        exit;
    }
}

?>
