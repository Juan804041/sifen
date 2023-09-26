<?php

$resultado = calcularDv11A(2278132);

echo $resultado;

function calcularDv11A($p_numero, $p_basemax = 11) {
    /*Calcula Digito Verificador numérico con entrada alfanumérica y basemax 11 */
    $v_total = 0;
    $v_resto = 0;
    $k = 0;
    $v_numero_aux = 0;
    $v_numero_al = '';
    $v_caracter = '';
    $v_digit = 0;

    //Cambia la última letra por su valor ASCII en caso de que la cadena termine en letra
    for ($i = 0; $i < strlen($p_numero); $i++) {
        $v_caracter = strtoupper(substr($p_numero, $i, 1));
        if (ord($v_caracter) < 48 || ord($v_caracter) > 57) { //De 0 a 9
            $v_numero_al .= ord($v_caracter);
        } else {
            $v_numero_al .= $v_caracter;
        }
    }

    //Calcula el DV
    $k = 2;
    $v_total = 0;
    for ($i = strlen($v_numero_al) - 1; $i >= 0; $i--) {
        if ($k > $p_basemax) {
            $k = 2;
        }
        $v_numero_aux = intval(substr($v_numero_al, $i, 1));
        $v_total += $v_numero_aux * $k;
        $k++;
    }

    $v_resto = $v_total % 11;
    if ($v_resto > 1) {
        $v_digit = 11 - $v_resto;
    } else {
        $v_digit = 0;
    }

    return $v_digit;
}
?>