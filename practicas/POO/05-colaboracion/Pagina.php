<?php
class Pagina {
    private $cabecera;
    private $cuerpo;
    private $pie;

    public function __construct($texto1, $texto2) {
        $this->cabecera = new Cabecera($texto1);
        $this->cuerpo = new Cuerpo;
        $this->pie = new Pie($texto2);
    }

    public function insertar_cuerpo($texto) {
        $this->cuerpo->insertar_parrafo($texto);
    }

    public function graficar() {
        $this->cabecera->graficar();
        $this->cuerpo->graficar();
        $this->pie->graficar();
    }
}

/**
 * Implementar las clases cabecera, cuerpo y pie
 * 
 * 1.- La clase Cabecera tiene las siguientes características:
 *      > Tiene un constructor que recibe un texto que inicializa un
 *        atributo de nombre título.
 *      > Tiene una función graficar, que utiliza un encabezado
 *        de nivel 1, a partir de un texto y un estilo por defecto.
 * 2.- La clase Cuerpo ""
 *      > No tiene constructor, pero tiene un atributo privado que
 *        corresponde a un arreglo de lineas de texto, el atributo
 *        se debe llamar líneas.
 *      > Tiene una función graficar, que recorre el atributo líneas
 *        para mostrar elementos <p> que contirne el texto dentror del
 *        arreglo. 
 * 3.- La clase Pie tiene las siguientes características:
 *      > Tiene un constructor que recibe un texto que inicializa un
 *        atributo de nombre mensaje.
 *      > Tiene una función graficar, que utiliza un encabezado
 *        de nivel 4, a partir de un texto y un estilo por defecto.
 */
?>