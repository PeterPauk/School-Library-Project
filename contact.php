<?php
include_once './components/url.php';
include_once './inc/config.php';
?>

<body>
    <?php 
    include_once './components/nav.php'; 
    ?>
    <form class="contact" action="" method="post">
        <h3>Kontakt</h3>
        <div>
        <label for="name">Vaše meno:</label>
        <input type="text" name="name"><br>
        </div>
        
        <div>
        <label for="name">Váš email:</label>
        <input type="text" name="email"><br>
        </div>

        <div>
        <label for="name">Vaša správa:</label>
        <textarea name="mytextarea"></textarea>
        </div>
        
        <div class="g-recaptcha" data-sitekey="6Ldbdg0TAAAAAI7KAf72Q6uagbWzWecTeBWmrCpJ"></div>

        <button type="submit">Odoslať</button>
    </form>
</body>