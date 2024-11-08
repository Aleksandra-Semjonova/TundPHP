<?php
echo "Mõistatus. Euroopa riik";
// 6 подсказок при промощи текстовых функций
// выводить списком <ul> / <ol>

//str_replace()

$Riik = "Poola";
$otsi = 'o';
$asenda = 'e';
echo "<ol>";
echo "<br><li>Viimane täht on - ".$Riik[4]."</li>";
echo "<br><li>Viimased 2 tähte - ".substr($Riik, 3, 2)."</li>";
echo "<br><li>Kui eemalda mitu tähted siis: ".trim($Riik, "E, st")."</li>";
echo "<br><li>Õige tähe asemel seisab 'e' - ".str_replace($otsi, $asenda, $Riik)."</li>";
echo "<br><li>Esimine täht on - ".$Riik[0]."</li>";
echo "<br><li>Selle riigi nimes on nii palju tähti - ".strlen($Riik)."</li>";

echo "</ol>";
