
<?php
require ('cont.php');
global $yhendus;

if(isset($_REQUEST["kustuta"])) {
    $kask=$yhendus->prepare("DELETE FROM loomad WHERE id=?");
    $kask->blind_param("i",$_REQUEST["kustuta"]);
    $kask->execute();
}
//kustutamine

//tabeli andmete lisamine
if(isset($_REQUEST["loomanini"]) && !empty($_REQUEST["loomanini"])){

    $paring=$yhendus->prepare("INSERT INTO loomad(loomanimi, varv) VALUES (?, ?, ?, ?)");

    $paring->bind_param("ssss", $loomani["loomanimi"], $varv["varv"], $varv["omanik"], $varv["pilt"]);
}


//tabeli sisu kuvamine

$paring=$yhendus->prepare("SELECT id, loomanimi, omanik, varv, pilt FROM loomad");
$paring->bind_result($id, $loomanimi, $omanik, $varv, $pilt);
$paring->execute();

?>
    <!doctype html>
    <html lang="et">
    <head>
        <title>Tabeli sisu, mida võetakse andmebaasist</title>
    </head>
    </html>
    <body>
    <h1>Loomad andmebaasist</h1>
    <table>
        <tr>
            <th> </th>
            <th>id</th>
            <th>pilt</th>
            <th>loomanimi</th>
            <th>omanik</th>
            <th>varv</th>


        </tr>
        <?php
        while($paring->fetch()) {
            echo "<tr>";
            echo "<td><a href='?kustuta=$id'>Kustuta</a><td/>";
            echo "<td>".$id . "</td>";
            echo "<td bgcolor='$varv'>" . htmlspecialchars($loomanimi) . "</td>";
            // htmlspecialchars prevents execution of inserted code
            echo "<td>" . htmlspecialchars($omanik) . "</td>";
            echo "<td >" . htmlspecialchars($varv) . "</td>";
            echo "<td><img src='$pilt' alt='pilt' width='100px'></td>";
            echo "</tr>";
        }
        ?>
    </table>


    <form action="?" method="post">
        <label for="loomanimi">Loomanimi:</label>
        <input type="text" id="loomnaimi" name="loomanimi" required>
        <br><br>
        <label for="varv">Värv:</label>
        <input type="color" id="varv" name="varv" required>
        <br><br>
        <label for="omanik">Omanik:</label>
        <input type="text" id="omanik" name="omanik" required>
        <br>
        <label for="pilt">Pilt:</label>
        <br>
        <textarea name="pilt" id="pilt"  cols="30" rows="30">
            siseta pildi link
        </textarea>
        <input type="submit" value="OK">
    </form>
    </body>
    </html>

<?php
$yhendus->close();