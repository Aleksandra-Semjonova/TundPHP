
<?php
require ('cont.php');

//tabeli sisu kuvamine
global $yhendus;
$paring=$yhendus->prepare("SELECT id, loomanimi, omanik, varv, pilt FROM loomad");
$paring->bind_result($id, $loomanimi, $omanik, $varv, $pilt);
$paring->execute();

?>
    <!doctype html>
    <html lang="et">
    <head>
        <title>Tabeli sisu, mida võetakse andmebaasist</title>
    </head>
    <body>
    <h1>Loomad andmebaasist</h1>
    <table>
        <tr>
            <th>id</th>
            <th>loomanini</th>
            <th>omanik</th>
            <th>varv</th>
            <th>pilt</th>

        </tr>
        <?php
        echo "<tr>";
        echo "<td>".$id . "</td>";
        echo "<td><img src='$pilt' alt='pilt' width='100px'></td>";
        echo "<td>" . htmlspecialchars($loomanimi) . "</td>";
        // htmlspecialchars prevents execution of inserted code
        echo "<td>" . htmlspecialchars($omanik) . "</td>";
        echo "<td>" . htmlspecialchars($varv) . "</td>";
        echo "</tr>";
        ?>
    </table>
    </body>
    </html>

<?php
$yhendus->close();