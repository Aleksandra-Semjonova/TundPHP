<?php
echo "<h2>Ajafunktsioonid</h2>";
echo "<div id='kuupaev'>";
echo "Täna on "."<strong>".date("d.m.Y")."</strong><br>";
date_default_timezone_set("Europe/Tallinn");
echo "Tänane Tallinna kuupäev ja kellaaeg on ".
    "<strong>".date("d.m.Y G:i", time())."</strong><br>";
echo "<strong>"."d"."</strong>"." - kuupäev 1-31";
echo "<br>";
echo "<strong>"."m"."</strong>"." - kuu numbrina 1-12";
echo "<br>";
echo "<strong>"."Y"."</strong>"." - aasta neljakohane";
echo "<br>";
echo "<strong>"."G"."</strong>"." - tunniformat 0-23";
echo "<br>";
echo "<strong>"."i"."</strong>"." - minutid 0-59";
echo "</div>";
?>
