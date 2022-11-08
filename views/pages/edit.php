<?php
    require "../../model/model.php";
    $requeste = new ModelUser();
    if (isset($_GET['id'])){
        $id=($_GET['id']);
        $user = $requeste->getUser($id);
/*         var_dump($user);
 */    }
    if (isset($_POST['nom'],$_POST['prenom'],$_POST['email'])) {

                                

            $nom = $_POST['nom'];
            $prenom =$_POST['prenom'];
            $email=$_POST['email'];
            $id = $_POST['matricule'];
            $requeste->edit($nom,$prenom,$email,$id, $user['email']);
            
            
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/nInscriptionpm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>modifie</title>
</head>

<body>


    <div class="container d-flex justify-content-center mt-4">
        <div class="col-md-8  mt-4">
            <br>
            <nav class="navbar navbar-dark bg-success mt-4">
                <div class="container-fluid d-flex justify-content-center">
                    <a class="navbar-brand pe-none" href="#">
                        <b>Modification</b>
                    </a>
                </div>
            </nav>
            <form id="form" class="row g-3 d-flex justify-content-center no-wrap m-2  bg-light needs-validation" novalidate action="" method="post">
                <div class="col-md-6 input-control">
                    <label for="input1" class="form-label">Nom<span style="color: red;">*</span></label>
                    <input type='text' name='nom' placeholder="nom" value="<?=$user['nom'] ?? null?>" class="form-control border-dark p-3" id="nom">
                    <div class="invalid-feedback d-none" id="erreur_nom"> Nom est obligatoire</div>
                </div>
                <div class="col-md-6 input-control">
                    <label for="input2" class="form-label">Prenom<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-3" value="<?=$user['prenom'] ?? null?>" name="prenom" placeholder="prenom" id="prenom">
                    <div class="invalid-feedback d-none" id="erreur_prenom">Prenom est obligatoire</div>
                </div>

                <div class="col-md-6 input-control">
                    <label for="input3" class="form-label">Email<span style="color: red;">*</span></label>
                    <input type="text" class="form-control border-dark p-3" value="<?=$user['email'] ?? null?>" name="email" placeholder="email" id="email">
                    <div class="invalid-feedback d-none" id="erreur_email">Email est obligatoire</div>
                    <div class="invalid-feedback d-none" id="erreur_email2">entrez un format valide</div>
                </div>
                <input type="hidden" name="matricule" value="<?=$user['matricule'] ?? null?>">
                <div class="row d-flex justify-content-center mt-2">
                    <button type="submit" name="id" class="btn btn-success col-3" id="submit">
                        enregistré
                    </button>
                </div>
            </form>


        </div>
    </div>

     <script src="edit.js"></script>
 

</body>

</html>