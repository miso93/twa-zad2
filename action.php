<?php
$page = 'action';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['method'])) {

        $method = $_GET['method'];
        if ($method == "edit") {

            $id_person = $_GET['id_person'];
            $id_um = $_GET['id_um'];

        }
        if ($method == "delete") {

            $id_person = $_GET['id_person'];
        }

        if ($method == "create" && isset($_GET['model']) && $_GET['model'] == "placement") {

            $id_person = $_GET['id_person'];
        }

        if ($method == "delete-placement") {

            $id_um = $_GET['id_um'];
        }
    }
}
if(isset($_POST['method'])){

    $method = $_POST['method'];
    if($method == "edit"){

        $id_person = $_POST['id_person'];
        $id_um = $_POST['id_um'];

    }
    if($method == "delete"){

        $id_person = $_POST['id_person'];
    }



}
require_once "function.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($method) && $method == 'edit') {

        require_once 'edit.php';

    }

    if (isset($method) && $method == 'delete') {

        require_once 'delete.php';

    }
    if (isset($method) && $method == 'create') {

        require_once 'create.php';

    }
}