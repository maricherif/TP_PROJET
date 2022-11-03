<?php

require "../../model/model.php";

$requeste = new ModelUser();
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $requeste->change($id);
}

?>