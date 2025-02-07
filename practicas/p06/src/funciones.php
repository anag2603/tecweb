<?php
function esMultiploDe5y7($numero) {
    return $numero % 5 === 0 && $numero % 7 === 0;
}

function generarSecuenciaImparParImpar() {
    $matriz = [];
    $iteraciones = 0;
    $numerosGenerados = 0;

    do {
        $fila = [
            rand(100, 999),
            rand(100, 999),
            rand(100, 999)
        ];

        $numerosGenerados += 3;
        $iteraciones++;

        if ($fila[0] % 2 !== 0 && $fila[1] % 2 === 0 && $fila[2] % 2 !== 0) {
            $matriz[] = $fila;
            break;
        }
    } while (true);

    return [
        'matriz' => $matriz,
        'iteraciones' => $iteraciones,
        'numerosGenerados' => $numerosGenerados
    ];
}
?>