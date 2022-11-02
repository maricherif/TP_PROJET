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

if (isset($_POST['id_emd'])) {
    $matricule = $_POST['id_emd'];
/*     var_dump($matricule);die;
 */    $requete->desarchiveUser($matricule);

}

header("location:desar.php");
exit;

?>