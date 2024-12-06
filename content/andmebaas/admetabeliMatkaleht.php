<?php
require ('cont2.php');
global $yhendus;

if(isset($_REQUEST["kustuta"])) {
    $kask=$yhendus->prepare("DELETE FROM osalejad WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}

if(isset($_REQUEST["nimi"]) && !empty($_REQUEST["nimi"])) {

    $paring=$yhendus->prepare("INSERT INTO osalejad(nimi, telefon, pilt, synniaeg) VALUES (?, ?, ?, ?)");

    $paring->bind_param("ssss", $_REQUEST["nimi"], $_REQUEST["telefon"], $_REQUEST["pilt"], $_REQUEST["synniaeg"]);
    $paring->execute();
}

$paring=$yhendus->prepare("SELECT id, nimi, telefon, pilt, synniaeg FROM osalejad");
$paring->bind_result($id, $nimi, $telefon, $pilt, $synniaeg);
$paring->execute();

?>
<!doctype html>
<html lang="et">
<head>
    <link rel="stylesheet" href="andmebaas.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ülesanne 8</title>
    <style>

    </style>
</head>
<body>
<h1>Matka leht</h1>
<table>
    <tr>
        <th> </th>
        <th>id</th>
        <th>nimi</th>
        <th>telefon</th>
        <th>pilt</th>
        <th>sünniaeg</th>
        <th>vanus</th>
    </tr>
    <?php
    while($paring->fetch()) {

        $birthDate = new DateTime($synniaeg);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y;

        echo "<tr>";
        echo "<td><a href='?kustuta=$id'>Delete</a></td>";
        echo "<td>".$id . "</td>";
        echo "<td>" . htmlspecialchars($nimi) . "</td>";
        echo "<td>" . htmlspecialchars($telefon) . "</td>";
        echo "<td><img src='$pilt' alt='Image' class='image-preview'></td>";
        echo "<td>" . htmlspecialchars($synniaeg) . "</td>";
        echo "<td>" . $age . " years</td>";
        echo "</tr>";
    }
    ?>
</table>

<form action="?" method="post">
    <label for="nimi">Nimi:</label>
    <input type="text" id="nimi" name="nimi" required>
    <br><br>
    <label for="telefon">Telefon:</label>
    <input type="text" id="telefon" name="telefon" required>
    <br><br>
    <label for="pilt">Pilt:</label>
    <textarea name="pilt" id="pilt" cols="30" rows="3" placeholder="Sisestage pildi URL"></textarea>
    <br><br>
    <label for="synniaeg">Sünniaeg:</label>
    <input type="date" id="synniaeg" name="synniaeg" required>
    <br><br>
    <input type="submit" value="OK">
</form>
</body>
</html>

<?php
$yhendus->close();
?>
