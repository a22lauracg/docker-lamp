<?php

function filtraCampo($campo)
{
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function validarCampoTexto($campo)
{
    $campoFiltrado = filtraCampo($campo);
    return (!empty($campoFiltrado) && validarLargoCampo($campoFiltrado, 2));
}

function validarLargoCampo($campo, $longitud)
{
    return (strlen(trim($campo)) > $longitud);
}

function esNumeroValido($campo)
{
    return !empty(filtraCampo($campo)) && is_numeric(filtraCampo($campo));
}
