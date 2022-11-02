<?php

require "../../model/model.php";

$requeste = new ModelUser();

if(isset($_POST['id'])) {
    $id = (int) $_POST['id'];
    $requeste->archiveUser($id);

    header("location:admin.php");
exit;
}

$requete = new ModelUser();

if (isset($_POST['id_emd'],$_POST['date_archivage'])) {
    $id = (int) $_POST['id_emd'];
    $date_archivage = $_POST['date_archivage'];

    $requete->desarchiveUser($id,$date_archivage);
}

header("location:desar.php");
exit;

?>