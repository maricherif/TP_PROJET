<?php

require "../../model/model.php";

$requeste = new ModelUser();
if(isset($_POST['matricule'])) {
    $matricule = $_POST['matricule'];
    $requeste->archiveUser($matricule);

    header("location:admin.php");
exit;
}

$requete = new ModelUser();

if (isset($_POST['id'])) {
    $matricule = $_POST['id'];
    $requete->desarchiveUser($matricule);

}

header("location:desar.php");
exit;


if (isset($_GET['change'])) {
    $id = $_GET['change'];

    
    if ($sql) {
        header("Location:admin.php"); 
        exit;
    }
}
?>