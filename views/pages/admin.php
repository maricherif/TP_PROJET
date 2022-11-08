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
                <span>
                   
                    <img src="data:image/jpg;base64 ,<?php echo base64_encode($_SESSION['photo'])?>" class="rounded-circle" height="60" width="60">&nbsp;
                    <em class="text-light"><b><?= $_SESSION['matricule'] ?></em></b>&nbsp;
                </span>
                    
                    <span class="text-light"><b><?= $_SESSION['nom'] ?></span></b>&nbsp;
                    <span class="text-light"><b><?= $_SESSION['prenom'] ?></span></b>&nbsp;
                
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
                    <ul class="nav-item ">
                <?php    
                    if (isset($existe) && $existe) {
                       echo '<a href="admin.php">
                       <button type="button" class="btn btn-outline-danger mt-3 border-0">Quitter </button>
                   </a>';
                    }
                ?>
            </ul>
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
                if(isset($_GET['page']) && !empty($_GET['page'])){
                    $currentPage = (int) strip_tags($_GET['page']);
                }else{
                    $currentPage = 1;
                }

                // On détermine le nombre total d'articles
                $sql = ("SELECT COUNT(*) AS nb_utilisateur FROM utilisateur WHERE etat=1");

                // On prépare la requête
                $query = $db->prepare($sql);

                // On exécute
                $query->execute();

                // On récupère le nombre d'articles
                $result = $query->fetch();

                $nbUtilisateur= (int) $result['nb_utilisateur'];

                // On détermine le nombre d'articles par page
                $parPage = 11;

                // On calcule le nombre de pages total
                $pages = ceil($nbUtilisateur / $parPage);

                // Calcul du 1er article de la page
                $premier = ($currentPage * $parPage) - $parPage;

                $sql = $db->prepare( "SELECT * FROM utilisateur WHERE etat=*& ORDER BY id != :id  LIMIT $premier, $parPage");
                $sql->execute();

                ?>
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
            <nav>
                    <ul class="pagination fixed-bottom justify-content-center">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage - 1 ?>" class="page-link success"><img src="../img/precedent.png" alt="" width="30"  style="color: green;"height="20"></a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage + 1 ?>" class="page-link"><img src="../img/suivant.png" alt="" width="30" height="20"></a>
                        </li>
                    </ul>
                </nav>

        </div>
      
    </main>

</body>

</html>