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
$b = 'MySQL';
$c = &$a;
echo "<p>Valores iniciales:</p>";
echo "a: $a, b: $b, c: $c<br>";

$a = "PHP server";
$b = &$a;
echo "<p>Valores después de reasignación:</p>";
echo "a: $a, b: $b, c: $c<br>";
echo "<p>Explicación: \$b y \$c ahora apuntan a \$a debido a las referencias.</p>";