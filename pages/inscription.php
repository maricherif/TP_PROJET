<!DOCTYPE html>
<html lang="en">
<?php
    require "./model.php";



    if (isset($_POST['nom'],$_POST['prenom'],$_POST['age'],$_POST['email'],$_POST['passwords'],
                $_POST['passwords'],$_POST['photo'], $_POST['roles'])) {

                                

            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            $age= trim($_POST['age']);
            $sexe= trim($_POST['email']);
            $username= trim($_POST['passwords']);
            $passwords= trim($_POST['passwords']);
            $email= trim($_POST['photo']);
            $roles= 'employer';

            $requeste = new ModelUser();

            $matricule = $requeste->generateMatricule();

         
            if(!empty($nom)&&!empty($prenom)&& !empty($username) && !empty($lieu_naissance)) {
                $requeste->addUser($nom,$prenom,$age,$sexe,$username,$passwords,$roles,$matricule, $lieu_naissance,$email,$tel);
            }else{
                echo '<script>alert("Tout les champs doivent etre rempli")</script>';
            }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Inscription</title>
</head>
<body>

    <div class="container d-flex justify-content-center mt-4">
        <div class="col-md-8  mt-4">
            <br>
                <nav class="navbar navbar-dark bg-success mt-4">
                    <div class="container-fluid d-flex justify-content-center">
                        <a class="navbar-brand pe-none" href="#">
<!--                         <img src="../img/ecole_reussite.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
 -->                       <b> INSCRIPTION</b>
                        </a>
                    </div>
                </nav>

                <form class="row g-3 d-flex justify-content-center no-wrap m-2  bg-transparent needs-validation" novalidate action="inscription.php" method="post" >
                    <div class="col-md-6 ">
                        <label for="input1" class="form-label">NOM</label>
                        <input type='text' name='nom' placeholder="nom" class="form-control border-dark p-3" id="validationServer01" required>
                        <div class="valid-feedback" id="validationServer01"></div>
                        <div  class="invalid-feedback" id="validationServer01">Champ invalide</div>
                    </div>
                    <div class="col-md-6">
                        <label for="input2" class="form-label">PRENOM</label>
                        <input type="text" class="form-control border-dark p-3" name="prenom" placeholder="prenom" id="validationServer02" required>
                        <div class="valid-feedback"> </div>
                        <div  class="invalid-feedback">Champ invalide</div>
                    </div>
                   
                    <div class="col-md-6">
                        <label for="input3" class="form-label">E-MAIL</label>
                        <input type="email" class="form-control border-dark p-3" name="email" placeholder="email" id="validationServer03" required>
                        <div class="valid-feedback"></div>
                        <div  class="invalid-feedback">Champ invalide</div>
                    </div>
                    <div class="col-md-6">
                        <label for="input6" class="form-label">AJOUTER IMAGE</label>
                        <input type="file" class="form-control border-dark p-3" name="passwords" placeholder="password" id="validationServer06" required>
                        <div class="valid-feedback"></div>
                        <div  class="invalid-feedback">Champ invalide</div>
                    </div>
                    <div class="col-md-6">
                        <label for="input6" class="form-label">MOT de PASSE</label>
                        <input type="password" class="form-control border-dark p-3" name="passwords" placeholder="password" id="validationServer06" required>
                        <div class="valid-feedback"></div>
                        <div  class="invalid-feedback">Champ invalide</div>
                    </div>
                    <div class="col-md-6">
                        <label for="input6" class="form-label">CONFIRME MOT de PASSE</label>
                        <input type="password" class="form-control border-dark p-3" name="passwords" placeholder="password" id="validationServer06" required>
                        <div class="valid-feedback"></div>
                        <div  class="invalid-feedback">Champ invalide</div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="input9" class="form-label">RÔLE</label>
                        <select name="sexe" id="roles" class="form-select is-valid border-dark p-3" id="validationServer10" required>
                            <option selected disabled value="">Choisir...</option>
                            <option value="m" name='dmin'>ADMINISTRATEUR (E)</option>
                            <option value="f" name='employe'>EMPLOYÉ</option>
                        </select>
                    </div>
                   
                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-success col-3" onclick="hideMsg()">
                            <i class="spinOff">S'inscrire</i>
                            <i class="spinOn" style="display: none">
                                <span class="spinner-border spinner-border-sm"  aria-hidden="true"></span>
                                Loading...
                            </i>
                        </button>
                     </div>
        
                    <span class="text text-center mt-2">
                        <p>Vous avez un compte?
                            <a href="connexion.php" style="text-decoration:none;"> connectez-vous</a>
                        </p>
                    </span>
                </form> 

          
            </div>
        </div>

        <script src="js/inscription.js"></script>


</body>
</html>