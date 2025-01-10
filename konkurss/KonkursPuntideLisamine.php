<?php

global $yhendus;
require ('cont.php');


//Konkurssi lisamine
if (!empty($_REQUEST["uusKonkurss"])) {
    $paring = $yhendus -> prepare("insert into konkurss (konkursiNimi, lisamisAeg) values (?,now())");
    $paring ->bind_param('s', $_REQUEST["uusKonkurss"]);
    $paring -> execute();
    header("Location:$_SERVER[PHP_SELF]");
}
//kommentaaride lisamine
if(isset($_REQUEST["uusKomment"])){
    $paring=$yhendus ->prepare("update konkurss
set kommentaarid=concat(kommentaarid,?)where id =?");
    $kommentLisa="\n".$_REQUEST["komment"];
    $paring ->bind_param('si', $kommentLisa, $_REQUEST["uusKomment"]);
    $paring -> execute();
}

// tabeli uuendamine + 1 punkt
if (isset($_REQUEST["hea_konkurss_id"])) {
    $paring = $yhendus -> prepare("UPDATE konkurss set punktid = punktid+1
where id = ?");
    $paring -> bind_param("i", $_REQUEST["hea_konkurss_id"]);
    $paring -> execute();
    header("Location:$_SERVER[PHP_SELF]");
}

// tabeli uuendamine -1 punkt
if (isset($_REQUEST["halb_konkurss_id"])) {
    $paring = $yhendus -> prepare("UPDATE konkurss set punktid = punktid-1
where id = ?");
    $paring -> bind_param("i", $_REQUEST["halb_konkurss_id"]);
    $paring -> execute();
    header("Location:$_SERVER[PHP_SELF]");
}
if (isset($_REQUEST["kustuta"])) {
    $kask = $yhendus->prepare("DELETE FROM konkurss WHERE id = ?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>TARpv23 jõulu konkursid</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<h1>TARpv23 jõulu konkursid</h1>


<form action="?">
    <label for="uusKonkurss">Lisa konkursi nimi</label>
    <input type="text" name="uusKonkurss" id="uusKonkurss">
    <input type="submit" value="OK">
</form>

<table border="1">

    <tr>
        <th>KonkursiNimi</th>
        <th>LisamisAeg</th>
        <th>Punktid</th>
        <th colspan="4">Kommentaar</th>
        <th colspan="4">Haldus</th>
    </tr>
    <?php
    //tabeli sisu kuvamine
    $paring = $yhendus -> prepare("Select id, konkursiNimi, lisamisAeg, kommentaarid, punktid from konkurss");
    $paring -> bind_result($id ,$konkurssnimi, $lisamisaeg, $punktid, $kommentaarid);
    $paring -> execute();
    while ($paring -> fetch()) {
        echo "<tr>";
        $konkursid = htmlspecialchars($konkurssnimi);
        echo "<td>".$konkurssnimi."</td>";
        echo "<td>".$lisamisaeg."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td>".$kommentaarid."</td>";

        ?>
        <td>
            <form action="?">
                <input type="hidden" name="uusKomment" value="<?=$id?>">
                <input type="text" name="komment" id="komment"">
                <input type="submit" value="Lisa kommentaar"">

            </form>
        </td>
    <?php
        echo "<td><a href='?hea_konkurss_id=$id' class='link-button'>Lisa 1 punkt</a></td>";
        echo "<td><a href='?halb_konkurss_id=$id' class='link-button'>Võtta 1 punkt</a></td>";
        echo "<td><a href='?kustuta=$id'>Kustuta</a></td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
<?php
$yhendus -> close();
?>
