<?php
$serverinimi="d132040.mysql.zonevs.eu";
$kasutaja="d132040_aleksandrasemjonova";
$parool="123iPd0678";
$andmebaas="d132040_baasphp";


$yhendus=new mysqli($serverinimi,$kasutaja,$parool,$andmebaas);
$yhendus->set_charset("utf8");