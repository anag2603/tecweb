<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ejercicios PHP</title>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<?php
    // Ejercicio 1: Variables válidas e inválidas
    echo "<h2>Ejercicio 1: Variables válidas e inválidas</h2>";
    echo "<p>En PHP, los nombres de las variables deben cumplir con ciertas reglas. Las siguientes son variables válidas:</p>";
    echo "<ul>";
    echo "<li>\$_myvar: válida, comienza con un guion bajo seguido de letras o números.</li>";
    echo "<li>\$_7var: válida, comienza con un guion bajo, aunque contiene un número.</li>";
    echo "<li>\$myvar: válida, comienza con una letra seguida de letras o números.</li>";
    echo "<li>\$var7: válida, contiene letras y termina en un número.</li>";
    echo "<li>\$_element1: válida, comienza con guion bajo seguido de letras y números.</li>";
    echo "</ul>";
    echo "<p>Las siguientes son variables inválidas:</p>";
    echo "<ul>";
    echo "<li>myvar: inválida porque no tiene signo \$ inicial.</li>";
    echo "<li>\$house*5: inválida porque contiene caracteres especiales (*).</li>";
    echo "</ul>";

    // Ejercicio 2: Referencias entre variables
    echo "<h2>Ejercicio 2: Referencias entre variables</h2>";
    $a = "ManejadorSQL";
    $b = "MySQL";
    $c = &$a;
    echo "<p>Valores iniciales:</p>";
    echo "<p>a: $a, b: $b, c: $c</p>";

    $a = "PHP server";
    $b = &$a;
    echo "<p>Valores después de reasignación:</p>";
    echo "<p>a: $a, b: $b, c: $c</p>";
    echo "<p>Explicación: \$b y \$c ahora apuntan a \$a debido a las referencias.</p>";

    // Ejercicio 3: Evolución de variables
    echo "<h2>Ejercicio 3: Evolución de variables</h2>";
    $a = "PHP5"; 
    $z[] = &$a; 
    $b = "5a version de PHP"; 
    $c = (int) $b * 10; // El valor de $c será 50 * 10 = 500
    $a .= $b; // $a ahora es "PHP55a version de PHP"
    $b = $c;  // $b toma el valor 500
    $z[0] = "MySQL"; // Cambia indirectamente el valor de $a debido a la referencia
    echo "<pre>";
    print_r([
        'a' => $a, // Ahora $a es "MySQL"
        'b' => $b, // $b es 500
        'c' => $c, // $c es 500
        'z' => $z  // $z[0] es "MySQL"
    ]);
    echo "</pre>";

    // Ejercicio 4: Acceso con \$GLOBALS
    echo "<h2>Ejercicio 4: Acceso con \$GLOBALS</h2>";
    echo "<h3>Valores de las variables en \$GLOBALS:</h3>";
    echo "<pre>";
    print_r([
        'a' => $GLOBALS['a'] ?? 'No definido',
        'b' => $GLOBALS['b'] ?? 'No definido',
        'c' => $GLOBALS['c'] ?? 'No definido',
        'z' => $GLOBALS['z'] ?? 'No definido'
    ]);
    echo "</pre>";

    // Ejercicio 5: Conversión de tipos
    echo "<h2>Ejercicio 5: Conversión de tipos</h2>";
    $a = "7 personas";
    $b = (int) $a; // $b será 7
    $a = "9E3"; // Notación científica
    $c = (double) $a; // $c será 9000
    echo "<pre>";
    print_r([
        'a' => $a,
        'b' => $b,
        'c' => $c
    ]);
    echo "</pre>";

    // Ejercicio 6: Valores booleanos
    echo "<h2>Ejercicio 6: Valores booleanos</h2>";
    $a = '0';
    $b = 'TRUE';
    $c = FALSE;
    $d = ($a or $b);
    $e = ($a and $c);
    $f = ($a xor $b);

    echo "<p>Resultados con var_dump:</p>";
    echo "<p>";
    var_dump($a, $b, $c, $d, $e, $f);
    echo "</p>";

    echo "<p>Transformación a valores visibles:</p>";
    echo "<p>c: " . ($c ? 'true' : 'false') . "</p>";
    echo "<p>e: " . ($e ? 'true' : 'false') . "</p>";

    // Ejercicio 7: Información del servidor
    echo "<h2>Ejercicio 7: Información del servidor</h2>";
    echo "<ul>";
    echo "<li>Versión de Apache y PHP: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'No disponible') . "</li>";
    echo "<li>Nombre del sistema operativo del servidor: " . PHP_OS . "</li>";
    echo "<li>Idioma del navegador: " . ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'No disponible') . "</li>";
    echo "</ul>";
?>
 <p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
    src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
  
</body>
</html>

