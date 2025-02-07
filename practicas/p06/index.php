<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<body>

<h1>Ejercicio 1: Comprobación de múltiplo de 5 y 7</h1>
<p>Introduce un número en la URL como parámetro usando <code>?numero=valor</code>. Por ejemplo: <code>index.php?numero=35</code></p>

<?php
require_once 'src/funciones.php';

if (isset($_GET['numero'])) {
    $num = $_GET['numero'];

    if (is_numeric($num)) {
        if (esMultiploDe5y7($num)) {
            echo "<h3>El número $num SÍ es múltiplo de 5 y 7.</h3>";
        } else {
            echo "<h3>El número $num NO es múltiplo de 5 y 7.</h3>";
        }
    } else {
        echo '<h3>Por favor ingresa un número válido.</h3>';
    }
}
?>

<h1>Ejercicio 2: Generación de Secuencia Impar-Par-Impar</h1>

    <?php
    $resultado = generarSecuenciaImparParImpar();

    echo '<p>Números generados: ' . $resultado['numerosGenerados'] . '</p>';
    echo '<p>Iteraciones realizadas: ' . $resultado['iteraciones'] . '</p>';
    echo '<table border="1">';
    foreach ($resultado['matriz'] as $fila) {
        echo '<tr>';
        foreach ($fila as $numero) {
            echo '<td>' . $numero . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>

<h1>Ejercicio 3: Encontrar múltiplo aleatorio</h1>

    <h2>Con ciclo while</h2>
    <?php
    if (isset($_GET['multiplo'])) {
        $multiploDe = $_GET['multiplo'];
        if (is_numeric($multiploDe) && $multiploDe > 0) {
            $resultadoWhile = encontrarMultiploConWhile($multiploDe);
            echo "<p>El primer múltiplo de $multiploDe encontrado con while es: $resultadoWhile</p>";
        } else {
            echo '<p>Por favor ingresa un número válido para el múltiplo.</p>';
        }
    }
    ?>

    <h2>Con ciclo do-while</h2>
    <?php
    if (isset($_GET['multiplo'])) {
        if (is_numeric($multiploDe) && $multiploDe > 0) {
            $resultadoDoWhile = encontrarMultiploConDoWhile($multiploDe);
            echo "<p>El primer múltiplo de $multiploDe encontrado con do-while es: $resultadoDoWhile</p>";
        }
    }
    ?>
    
</body>
</html>