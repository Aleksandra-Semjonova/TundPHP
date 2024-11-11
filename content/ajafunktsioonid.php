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

    <div id="hooaeg">
        <h2>Väljasta vastavalt hoojale pilt(kevad/ suvi/ sügis/ talv)</h2>

        <?php
        $today = new DateTime();
        echo "Täna on ".$today->format('d-m-Y');
        // hoaeg punktid - сезон
        $spring = new DateTime("March 20");
        $summer = new DateTime("June 21");
        $fall = new DateTime("September 22");
        $winter = new DateTime("December 22");

        switch(true) {
            //kevad
            case($today >= $spring && $today < $summer):
                echo "Kevad";
                $pildi_aadress = "content/img/kevad.jpg";
                break;
            case($summer <= $today && $today < $fall):
                echo "Suvi";
                $pildi_aadress = "content/img/suvi.jpg";
                break;
            case $fall <= $today && $today < $winter:
                echo "Sügis";
                $pildi_aadress = "content/img/sugis.jpg";
                break;
            default:
                echo "Talv";
                $pildi_aadress = "content/img/talv.webp";
        }
        ?>
        <img src="<?=$pildi_aadress?>" id="pilt" alt="hooja pilt">
        <div id="koolivaheaeg">
            <h2>Mitu päeva on koolivaheajani 23.12.2024</h2>
            <?php
            $kdata=date_create_from_format("d.m.Y", "23.12.2024");
            $date = date_create();
            $diff = date_diff($kdata, $date);
            echo "jaab ".$diff->format("%a")." päeva";
            echo "<br>";
            echo "jääb ".$diff->days." päeva";
            ?>
            <h2>Mitu päeva on minu sünnipäevani 13.11.2024</h2>
            <?php
            $kdata=date_create_from_format("d.m.Y", "13.11.2024");
            $date = date_create();
            $diff = date_diff($kdata, $date);
            echo "jääb ".$diff->days." päeva";
            ?>

        </div>
        <div id="vanus">
            <form method="post">
                Sisesta oma sünnikupäev
                <input type="date" name="synd" placeholder="dd.mm.yyyy">
                <input type="submit" value="OK">
            </form>
            <?php
            if(isset($_POST["synd"])){
                if(empty($_POST["synd"])){
                    echo "Sisesta oma Sünipäeva - kuupäev";
                }
                else {
                    $kdata=date_create($_POST["synd"]);
                    $date = date_create();
                    $diff = date_diff($kdata, $date);
                    echo "Sinu vanus ".$diff->format("%y")." aastat vama";
                }
            }
            ?>
        </div>
        <div>
            Massivi abil näidata kuu nimega tänases kuupäevas
            <?php
            $months = array(
                "jaanuar","veebruar","märts","aprill","mai","juune","juuli","avgust","september","oktoober","november","detsember"
            );
            $kuu = date_create()->format("m");
            echo $kuu.". ".$months[$kuu];

            ?>
        </div>
    </div>