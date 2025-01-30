<!DOCTYPE html>
<?php
$variable1 = "PHP 5";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Una página que contiene muchas inclusiones <?php echo $variable1; ?></title>
</head>
<body>
    <?php
    $variableext = "Este texto proviene del archivo incluido";
    ?>
    <div>
        <h1 style="border-width:5px; border-style:double; background-color:#ffcc99;">
            Bienvenido en el sitio <?php echo $variable1; ?>
        </h1>
        <h3><?php echo $variableext; ?></h3>
        <?php
        echo "Nombre de archivo ejecutado: " . $_SERVER['PHP_SELF'] . "&nbsp;&nbsp;&nbsp;";
        echo "Nombre del archivo incluido: " . __FILE__;
        ?>
    </div>
</body>
</html>
