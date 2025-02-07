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

<h1>Ejercicio 4: Arreglo ASCII de letras</h1>
    <?php
    $arregloAscii = crearArregloAscii();
    echo '<table border="1">';
    echo '<tr><th>Indice</th><th>Valor</th></tr>';
    foreach ($arregloAscii as $indice => $valor) {
        echo "<tr><td>$indice</td><td>$valor</td></tr>";
    }
    echo '</table>';
    ?>

<h1>Ejercicio 5: Validación de Edad y Sexo</h1>
    <form method="post">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required><br>
        
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        echo '<h3>' . validarEdadSexo($edad, $sexo) . '</h3>';
    }
    ?>

<h1>Ejercicio 6: Parque Vehicular</h1>
    <h2>Consulta de Vehículos</h2>
    <form method="post">
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula"><br>
        <button type="submit">Buscar Vehículo</button>
    </form>

    <?php
    $parqueVehicular = obtenerParqueVehicular();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        if (isset($parqueVehicular[$matricula])) {
            echo '<h3>Datos del Vehículo:</h3>';
            echo '<pre>' . print_r($parqueVehicular[$matricula], true) . '</pre>';
        } else {
            echo '<p>No se encontró un vehículo con esa matrícula.</p>';
        }
    }

    echo '<h3>Todos los Vehículos:</h3>';
    echo '<pre>' . print_r($parqueVehicular, true) . '</pre>';
    ?>

</body>
</html>