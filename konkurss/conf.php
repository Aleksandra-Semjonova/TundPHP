<?php
$kasutaja="Aleksandra";
$parool="1234567";
$andmebaas="aleksandra";
$serverinimi="localhost";

$yhendus=new mysqli($serverinimi, $kasutaja,$parool,$andmebaas);
$yhendus->set_charset("utf8");