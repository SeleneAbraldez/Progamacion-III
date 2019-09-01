<?php 
//https://www.php.net/manual/en/class.numberformatter.php
$num = rand(20, 60);
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
echo $f->format($num);
?>