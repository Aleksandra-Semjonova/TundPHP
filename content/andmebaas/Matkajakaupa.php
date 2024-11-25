<?php
require ('cont.php');

//Kustuta osaleja
global $yhendus;
if(isset($_REQUEST["kustuta"])) {
    $kask = $yhendus->prepare("DELETE FROM osalejad WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustuta"]);
    $kask->execute();
}

// Uue osaleja lisamine
if(isset($_REQUEST['uusosaleja']) && !empty($_REQUEST['nimi'])){
    global $yhendus;
    $paring=$yhendus->prepare("INSERT INTO osalejad(nimi, telefon, pilt, synniaeg)VALUES (?, ?, ?, ?)");
    $paring->bind_param("ssss", $_REQUEST['nimi'], $_REQUEST['telefon'], $_REQUEST['pilt'], $_REQUEST['synniaeg']);
    $paring->execute();
}
?>
<!doctype html>
<html lang="et">
<head>
    <title>Matkaja</title>
    <link rel="stylesheet" href="matkajastyle.css">
</head>
<body>
<h1>Matkaja</h1>
<div id="meny">
    <ul>
        <?php
        // Hankige andmebaasist osalejate loend
        global $yhendus;
        $paring=$yhendus->prepare("SELECT id, nimi, telefon, pilt, synniaeg FROM osalejad");
        $paring->bind_result($id, $nimi, $telefon, $pilt, $synniaeg);
        $paring->execute();

        while($paring->fetch()){
            echo "<li><a href='?osaleja_id=$id' ><img src='$pilt' alt='pilt'>"."</a></li>";
        }
        ?>
    </ul>
    <?php
    echo "<a href='?lisamine=jah'>LISA...</a>";
    ?>
</div>
<div id="sisu">
    <?php
    // Kui klõpsate osaleja pildel, kuvage üksikasjad
    if(isset($_REQUEST["osaleja_id"])){
        $paring=$yhendus->prepare("SELECT id, nimi, telefon, pilt, synniaeg FROM osalejad WHERE id=?");
        $paring->bind_result($id, $nimi, $telefon, $pilt, $synniaeg);
        $paring->bind_param("i", $_REQUEST["osaleja_id"]);
        $paring->execute();

        if($paring->fetch()){
            // Vanuse arvutamine
            $dateOfBirth = new DateTime($synniaeg);
            $currentDate = new DateTime();
            $age = $currentDate->diff($dateOfBirth)->y; // Вычисляем разницу в годах

            echo "<div>";
            echo "<h2>".$nimi."</h2>";
            echo "<br>Telefon: ".$telefon;
            echo "<br>Sünnikuupäev: ".$synniaeg;
            echo "<br>Vanus: ".$age." aastat";  // Отображаем возраст
            echo "<br><img src='$pilt' width='100px' alt='Pilt'>";
            echo "<br><a href='?kustuta=$id'>Kustuta</a>";
            echo "</div>";
        }
    }
    ?>
</div>

<?php
// Uue osaleja lisamise vorm
if(isset($_REQUEST["lisamine"])){
    ?>
    <form action="?" method="post">
        <input type="hidden" value="jah" name="uusosaleja">
        <label for="nimi">Nimi</label>
        <input type="text" id="nimi" name="nimi">
        <br>
        <label for="telefon">Telefon</label>
        <input type="text" id="telefon" name="telefon">
        <br>
        <label for="synniaeg">Sünniaeg</label>
        <input type="date" id="synniaeg" name="synniaeg">
        <br>
        <label for="pilt">Pilt</label>
        <textarea name="pilt" id="pilt" cols="30" rows="10">Sisesta pildi link</textarea>
        <br>
        <input type="submit" value="OK">
    </form>
    <?php
}
?>

</body>
</html>

