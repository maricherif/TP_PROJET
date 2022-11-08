<?php
    require "../../model/model.php";
    session_start();
    $db = new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;', 'root', '');
if (isset($_GET['recherche'])) {

    $recherche = htmlspecialchars($_GET['recherche']);

    $utilisateur = "";
    $req = $db->prepare('SELECT `id`, `matricule`, `nom`, `prenom`, `email`, `roles`, `passwords`, `photo`, `date_inscription`, `date_modification`, `date_archivage`, `role_etat`, `etat` FROM `utilisateur` WHERE `etat`= 0 and `matricule` = "' . $recherche . '"');
    $req->execute(['matricule' => $recherche]);
    $utilisateur = $req->fetch();
 
    $existe = true;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>desarchiver</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-success p-4 d-flex">
            <div class="container-fluid d-flex">
            <div>
                    <img src="../img/user.png" alt="">
                    <span class="text-light" ><b><?=$_SESSION['nom'] ?></span></b>&nbsp;
                    <span class="text-light"><b><?=$_SESSION['prenom'] ?></span></b>
                </div>
                <div class="m-2 ">
                <span class="text-light"><b><?=$_SESSION['matricule'] ?></span></b>

                </div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="deconect.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/deconect.png" alt="deconnecter" width="30">Deconnecter</button></a>
                        </li>
                        
                    </ul>
                    <form class="d-flex" action="desar.php" method="get">
                        <input class="form-control me-2" type="search" name="recherche" placeholder="recherche par matricule" aria-label="Search">
                        <button class="btn btn-outline-light " type="submit">rechercher</button>
                     
                    </form>
                    <ul class="nav-item ">
                <?php    
                    if (isset($existe) && $existe) {
                       echo '<a href="desar.php">
                       <button type="button" class="btn btn-outline-danger mt-3 border-0">Quitter </button>
                   </a>';
                    }
                ?>
            </ul>
                </div>
            </div>
        </nav>
    </header>
<div class="tab-pane" id="test">
        <div class="col-md-12">
        <table class="table ">
                <thead class="border border-dark">
                    <tr class="border border-dark">
                        <th scope="col">NOM</th>
                        <th scope="col">PRENOM</th>
                        <th scope="col">MATRICULE</th>
                        <th scope="col">date_archivage</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">

                    <?php
                   
                    $sql = $db->prepare('SELECT * FROM utilisateur where etat =0');
                    $sql->execute();

                    if (isset($existe ,$utilisateur) && $existe) {

                       if (!empty($utilisateur)) {
                        $etat = $utilisateur['etat'];
                        $matricule = $utilisateur['matricule'];
                        $nom = $utilisateur['nom'];
                        $prenom = $utilisateur['prenom'];
                        $id = $utilisateur['id'];
                        $date_archivage = $utilisateur['date_archivage'];

                            echo '<tr>
                            <td>' . $nom . '</td>
                            <th>' . $prenom . '</th>
                            <td>' . $matricule . '</td>
                            <td>' . $date_archivage . '</td>
                            <td>
                            <form action="mod_employer.php" method="post">
                            <input type="hidden" name="id_emd" value="'.$matricule.'">
                            <button type="submit" onclick = "return confirm(\'voulez vous vraiment désarchiver?\')"name="'.$matricule.'" class="btn btn-outline-success">
                                <img src="../img/desarchiv.png" alt="" width="30" height="20"
                            </button>
                            </td>
                            </tr>';

                       } else {
                        echo ' 
                        <span id="ok" class="w-75 h-25 mb-2 h1 d-flex justify-content-center border-none t  text-danger">
                                Le matricule recherché n\'est attribuer à aucun utilisateur  !
                        </span>

                    ';
                        
                       }
                       
                    } else {
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                            $nom = $row['nom'];
                            $prenom = $row['prenom'];
                            $matricule =  $row['matricule'];
                            $date_archivage = $row['date_archivage'];
                            $id =  $row['id'];
                            echo '<tr>
                            <td>' . $nom . '</td>
                            <th>' . $prenom . '</th>
                            <td>' . $matricule . '</td>
                            <td>' . $date_archivage . '</td>

                            <td>
                        <form action="mod_employer.php" method="post">
                        <input type="hidden" name="id_emd" value="'.$matricule.'">
                        <button type="submit" onclick = "return confirm(\'voulez vous vraiment désarchiver?\')"name="'.$matricule.'" class="btn btn-outline-success">
                            <img src="../img/desarchiv.png" alt="" width="30" height="20"
                        </button>
                        </td>
                        </tr>';
                        }
                    }


                    ?>

                </tbody>
                
            </table>
                    <ul class="nav-item">
                            <a href="admin.php">
                                <button type="button" class="btn btn-outline-success mb-auto">Retour </button></a>
                        </ul>
             
        </div>
      </div>
</body>
</html>