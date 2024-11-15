<?php

$autod = simplexml_load_file("autod.xml");


function otsingAutonumbriJargi($paring){
    global $autod;
    $paringVastus = array();

    // Search through each car in the XML
    foreach ($autod->auto as $auto) {
        if (strpos(strtolower($auto->autonumber), strtolower($paring)) === 0) {

            $paringVastus[] = $auto;
        }
    }
    return $paringVastus;
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autode andmed XML failist</title>
</head>
<body>
<h2>Autode andmed xml failist</h2>

<div>Esimene auto andmed:
    <?php

    echo $autod->auto[0]->mark . ", ";
    echo $autod->auto[0]->autonumber . ", ";
    echo $autod->auto[0]->omanik . ", ";
    echo $autod->auto[0]->v_aasta . ", ";
    ?>
</div>

<!-- Search form -->
<form method="post" action="?">
    <label for="otsing">Otsing autonumbri järgi:</label>
    <input type="text" id="otsing" name="otsing" placeholder="autonumber" />
    <input type="submit" value="OK" />
</form>
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 50%;
        border: 1px solid #ddd;
    }

    th, td {
        text-align: left;
        padding: 16px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
<?php

if (!empty($_POST['otsing'])) {
    $paringVastus = otsingAutonumbriJargi($_POST['otsing']);
    if (!empty($paringVastus)) {
        echo "<table border='1'>";
        echo "<tr><th>Mark</th><th>Autonumber</th><th>Omanik</th><th>Väljastamise aasta</th></tr>";

        // Display the search results
        foreach ($paringVastus as $auto) {
            echo "<tr>";
            echo "<td>" . $auto->mark . "</td>";
            echo "<td>" . $auto->autonumber . "</td>";
            echo "<td>" . $auto->omanik . "</td>";
            echo "<td>" . $auto->v_aasta . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } }else {
        echo "<table border='1'>";
        echo "<tr><th>Mark</th><th>Autonumber</th><th>Omanik</th><th>Väljastamise aasta</th></tr>";

        // Display the search results
        foreach ($autod as $auto) {
            echo "<tr>";
            echo "<td>" . $auto->mark . "</td>";
            echo "<td>" . $auto->autonumber . "</td>";
            echo "<td>" . $auto->omanik . "</td>";
            echo "<td>" . $auto->v_aasta . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }


?>
</body>
</html>

