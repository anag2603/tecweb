<?php
    namespace TECWEB\MYAPI;

    use TECWEB\MYAPI\Model as Model;
    require_once __DIR__ . '/../Model/model.php';
    //require_once __DIR__ . '/../View/router.php';

    class Control {
        public function list() {
            $prodObj =  new Model('marketzone');
            $prodObj->list();
            echo $prodObj->getData();
        }

        public function add() {
            $jsonOBJ = json_decode(json_encode($_POST));
            $prodObj = new Model('marketzone');
            $prodObj->add($jsonOBJ);
            echo $prodObj->getData();
        }

        public function delete() {
            $id = $_POST['id'];  
            $prodObj = new Model('marketzone');  
            $prodObj->delete($id);  
            echo $prodObj->getData();  
        }

        public function edit() {
            if (isset($_POST['id'])) {
                $jsonOBJ = json_decode(json_encode($_POST));
                $prodObj = new Model('marketzone');
                $prodObj-> edit($jsonOBJ);
                echo $prodObj->getData();
            }
        }

        public function name() {
            $name = $_POST['nombre'] ?? null;
            $prodObj = new Model('marketzone');
            $prodObj->name($name);
            echo $prodObj->getData();
        }

        public function search() {
            $search = $_GET['search'] ?? null;
            $prodObj = new Model('marketzone');
            $prodObj->search($search);
            echo $prodObj->getData();
        }

        public function single() {
            $id = $_POST['id'] ?? null;
            $prodObj = new Model('marketzone');
            $prodObj->single($id);
            echo $prodObj->getData();
        }

        public function singleByName() {
            $name = $_GET['name'] ?? null;
            $prodObj = new Model('marketzone');
            $prodObj->singleByName($name);
            echo $prodObj->getData();
        }
    }
?>