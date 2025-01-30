<!DOCTYPE html>
<?php
$variable1 = "PHP 5";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Una página llena de scripts PHP</title>
</head>
<body>
    <?php
    echo "<h1> BUENOS DÍAS A TODOS </h1>";
    echo "<h2> Título escrito por PHP </h2>";
    $variable2 = "MySQL";
    ?>
    <p>Vas a descubrir <?= $variable1 ?></p>
    <?php echo "<h2> Buenos días de $variable1 </h2>"; ?>
    <p> Utilización de variables PHP <br /> Vas a descubrir igualmente <?= $variable2; ?> </p>
    <?= "<div><big> Buenos días de $variable2 </big></div>" ?>
</body>
</html>
