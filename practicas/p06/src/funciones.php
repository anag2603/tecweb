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

function encontrarMultiploConWhile($multiploDe) {
    $num = rand(1, 1000);
    while ($num % $multiploDe !== 0) {
        $num = rand(1, 1000);
    }
    return $num;
}

function encontrarMultiploConDoWhile($multiploDe) {
    do {
        $num = rand(1, 1000);
    } while ($num % $multiploDe !== 0);
    return $num;
}

function crearArregloAscii() {
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }
    return $arreglo;
}

function validarEdadSexo($edad, $sexo) {
    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        return "Bienvenida, usted está en el rango de edad permitido.";
    } else {
        return "Lo sentimos, no cumple con los requisitos.";
    }
}

function obtenerParqueVehicular() {
    return [
        "ABC1234" => [
            "Auto" => ["marca" => "Toyota", "modelo" => 2020, "tipo" => "sedan"],
            "Propietario" => ["nombre" => "Juan Perez", "ciudad" => "Puebla", "direccion" => "Av. Reforma 123"]
        ],
        "DEF5678" => [
            "Auto" => ["marca" => "Honda", "modelo" => 2019, "tipo" => "hatchback"],
            "Propietario" => ["nombre" => "Maria Lopez", "ciudad" => "Monterrey", "direccion" => "Calle Juarez 45"]
        ],
        // ... Agrega 13 registros adicionales
        "XYZ9876" => [
            "Auto" => ["marca" => "Mazda", "modelo" => 2021, "tipo" => "camioneta"],
            "Propietario" => ["nombre" => "Carlos Sanchez", "ciudad" => "Guadalajara", "direccion" => "Boulevard Hidalgo 99"]
        ]
    ];
}
?>


