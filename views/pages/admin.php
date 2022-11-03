<?php
require "../../model/model.php";
session_start();
$db = new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;', 'root', '');
if (isset($_GET['recherche'])) {

    $recherche = htmlspecialchars($_GET['recherche']);

    $utilisateur = "";
    $req = $db->prepare('SELECT `id`, `matricule`, `nom`, `prenom`, `email`, `roles`, `passwords`, `photo`, `date_inscription`, `date_modification`, `date_archivage`, `role_etat`, `etat` FROM `utilisateur` WHERE `etat`=1 and `matricule` = "' . $recherche . '"');
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>page admin</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-success p-4 d-flex">
            <div class="container-fluid d-flex">
                <div>
                    <img src="../img/user.png" alt="">
                    <span class="text-light"><b><?= $_SESSION['nom'] ?></span></b>&nbsp;
                    <span class="text-light"><b><?= $_SESSION['prenom'] ?></span></b>
                </div>
                <div class="m-2 ">
                    <span class="text-dark mb-3 "><b><?= $_SESSION['matricule'] ?></span></b>

                </div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="deconect.php">
                                <button type="button" class="btn btn-outline-success"><img src="../img/deconect.png" alt="deconnecter" width="30">Deconnecter</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="desar.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/dearchiv.png" alt="archives" width="30">Liste des archives</button></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="admin.php" method="get">
                        <input class="form-control me-2" type="search"  name="recherche" placeholder="recherche par matricule" required aria-label="Search">
                        <button class="btn btn-outline-light" value='.$id.' type="submit">rechercher</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="m-5">
            <table class="table ">
                <thead class="border border-dark">
                    <tr class="border border-dark">
                        <th scope="col">NOM</th>
                        <th scope="col">PRENOM</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">RÔLE</th>
                        <th scope="col">MATRICULE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">

                    <?php
                   
                    $sql = $db->prepare('SELECT * FROM utilisateur where etat =1');
                    $sql->execute();

                    if (isset($existe ,$utilisateur) && $existe) {

                       if (!empty($utilisateur)) {
                        $etat = $utilisateur['etat'];
                        $matricule = $utilisateur['matricule'];
                        $nom = $utilisateur['nom'];
                        $prenom = $utilisateur['prenom'];
                        $email = $utilisateur['email'];
                        $roles = $utilisateur['roles'];
                        $id = $utilisateur['id'];
                            echo '<tr>
                            <td>' . $nom . '</td>
                            <th>' . $prenom . '</th>
                            <td>' . $email . '</td>
                            <td>' . $roles . '</td>
                            <td>' . $matricule . '</td>
                            <td> <form action="mod_employer.php" method="post"> 
                                        <input  type="hidden" name="matricule" value="' . $matricule . '">
                                        <button type="submit" onclick = "return confirm(\'voulez vous vraiment archiver?\')" class="btn btn-outline-danger"><img src="../img/archiv.png" alt="" width="30" height="20">
                                        </button>
                                        </form>
                                        </td>
                                        <td> <form action="edit.php" method="get"> 
                                        <input type="hidden" name="id" value="' . $matricule . '">
                                        <button type="submit" onclick = "return confirm(\'voulez vous faire des modification? \')" class="btn btn-outline-success"><img src="../img/edit.png" alt="" width="30" height="20">
                                        </button>
                                        </form>
                                        </td>
                                        <td> <form action="change.php" method="get"> 
                                        <input type="hidden" name="id" value="' . $id . '">
                                        <button type="submit" class="btn btn-outline-success"><img src="../img/change.png" alt="" width="30" height="20">
                                        </button>
                                        </form>
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
                            $email = $row['email'];
                            $roles = $row['roles'];
                            $matricule =  $row['matricule'];
                            $id =  $row['id'];
                            echo '<tr>
                            <td>' . $nom . '</td>
                            <th>' . $prenom . '</th>
                            <td>' . $email . '</td>
                            <td>' . $roles . '</td>
                            <td>' . $matricule . '</td>
                            <td> <form action="mod_employer.php" method="post"> 
                                        <input  type="hidden" name="matricule" value="' . $matricule . '">
                                        <button type="submit" onclick = "return confirm(\'voulez vous vraiment archiver?\')" class="btn btn-outline-danger"><img src="../img/archiv.png" alt="" width="30" height="20">
                                        </button>
                                        </form>
                                        </td>
                                        <td> <form action="edit.php" method="get"> 
                                        <input type="hidden" name="id" value="' . $matricule . '">
                                        <button type="submit" onclick = "return confirm(\'voulez vous faire des modification? \')" class="btn btn-outline-success"><img src="../img/edit.png" alt="" width="30" height="20">
                                        </button>
                                        </form>
                                        </td>
                                        <td> <form action="change.php" method="get"> 
                                        <input type="hidden" name="id" value="' . $id . '">
                                        <button type="submit" class="btn btn-outline-success"><img src="../img/change.png" alt="" width="30" height="20">
                                        </button>
                                        </form>
                                        </td>
    
                            </tr>';
                        }
                    }




                    ?>

                </tbody>
                
            </table>
            <ul class="nav-item">
                <?php    
                    if (isset($existe) && $existe) {
                       echo '<a href="admin.php">
                       <button type="button" class="btn btn-outline-success mb-auto">Retour </button>
                   </a>';
                    }
                ?>
            </ul>
        </div>
        <!--  <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                <a class="page-link text-dark" href="#" tabindex="-1" aria-disabled="true"><img src="../img/precedent.png" alt="" width="20"></a>
                </li>
                <li class="page-item"><a class="page-link text-dark text-dark" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                <a class="page-link text-dark" href="#"><img src="../img/suivant.png" alt="" width="20"></a>
                </li>
            </ul>
        </nav> -->
    </main>

</body>

</html>