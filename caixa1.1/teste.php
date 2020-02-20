<?php
    $testString = "12.322,11T";
    echo preg_replace("/[^0-9,.]/", "", $testString);
?>