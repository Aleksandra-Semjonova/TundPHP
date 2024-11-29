<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Anekdoot 5</title>
    <link href="styleulesanne2.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
    <div class="nav">
        <ul>
            <li><a href="ulesanne2.php">Avaleht</a></li>
            <li><a href="anekdoot1.php">Anekdoot 1</a></li>

        </ul>
    </div>
</div>

<div class="clear"></div>
<h2>Anekdoot 5</h2>
<p>
    <?php
    $anekdoot = file_get_contents('anekdoot5.txt'); // Loeb anekdoodi failist
    echo nl2br($anekdoot); // Kuvab anekdooti veebilehel
    ?>
</p>

<div class="footer">
    <p>Design by <a href="http://www.mobifreaks.com" target="_blank">Mobifreaks.com</a></p>
</div>
</body>
</html>
