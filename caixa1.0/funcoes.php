<?php
function converte_real($dolar){
    $real = number_format($dolar, 2, ',', '.');
    return $real;
}
?>