<?php
date_default_timezone_set('America/Sao_Paulo'); //transforma hor�rio do servidor em hor�rio oficial de Bras�lia

function converte_real($dolar){
    $real = $dolar/100;
    $real = number_format($real, 2, ',', '.');
    return $real;
}

function removeVirgulas($str){
    $str = preg_replace("/[.,]/", "", $str);
    return $str;
}
?>