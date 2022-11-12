<?php
    require "../../model/model.php";
    session_start();
if(!isset($_SESSION["matricule"])){
    header("location:../../index.php");
    exit;

}

    $db = new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;', 'root', '');
if (isset($_GET['recherche'])) {

    $recherche = htmlspecialchars($_GET['recherche']);

    $utilisateur = "";
    $mat=$_SESSION['matricule'];
    $req = $db->prepare("SELECT `id`, `matricule`, `nom`, `prenom`, `email`, `roles`, `passwords`, `photo`, `date_inscription`, `date_modification`, `date_archivage`, `role_etat`, `etat` FROM `utilisateur` WHERE `etat`=0 and and matricule!='$mat' `matricule` like '%$recherche%' or `email` like '%$recherche%'");
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
<nav class="navbar navbar-expand-lg navbar-light bg-success d-flex p-1">

            <div class="container-fluid d-flex">
                <span class="d-flex flex-column">
                   <?php
                   if(isset($_SESSION['photo']) && $_SESSION['photo']){
                   ?>
                    <img src="data:image/jpg;base64 ,<?php echo base64_encode($_SESSION['photo'])?>" class="rounded-circle" height="60" width="60">&nbsp;
                    <?php
                   }else{
                   
                   echo' <img src="../img/person.png"  alt="image" width="54" height="54">';
                    
                    
                   } ?>
                    <em class="text-light"><b><?= $_SESSION['matricule'] ?></em></b>&nbsp;

                </span>
                    
                    <span class="text-light"><b><?= $_SESSION['nom'] ?></span></b>&nbsp;
                    <span class="text-light"><b><?= $_SESSION['prenom'] ?></span></b>&nbsp;

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="deconect.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/deconect.png" alt="deconnecter" width="30">Deconnecter</button></a>
                        </li>
                        
                    </ul>
                    <form class="d-flex" action="desar.php" method="get">
                        <input class="form-control me-2" type="search" name="recherche" placeholder="recherche par matricule " aria-label="Search">
                        <button class="btn btn-outline-light " type="submit">rechercher</button>
                     
                    </form>
                    <ul class="nav-item ">
                <?php    
                    if (isset($existe) && $existe) {
                       echo '<a href="desar.php">
                       <button type="button" class="btn btn-outline-danger mt-3 p-1 "><img src="../img/quit.png" alt="quitter" width="30"></button>
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
                if(isset($_GET['page']) && !empty($_GET['page'])){
                    $currentPage = (int) strip_tags($_GET['page']);
                }else{
                    $currentPage = 1;
                }

                // On détermine le nombre total d'articles
                $sql = ("SELECT COUNT(*) AS nb_utilisateur FROM utilisateur WHERE etat=0");

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
                $mat=$_SESSION['matricule'];
                $sql = $db->prepare( "SELECT * FROM utilisateur WHERE etat=0 and matricule!='$mat' ORDER BY id   LIMIT $premier, $parPage");
                $sql->execute();

                ?>


                    <?php
                   /* 
                    $sql = $db->prepare('SELECT * FROM utilisateur where etat =0');
                    $sql->execute(); */

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
                            <input type="hidden" name="id" value="'.$matricule.'">
                            <button type="submit" onclick = "return confirm(\'voulez vous vraiment désarchiver?\')"name="'.$matricule.'" class="btn btn-outline-success">
                                <img src="../img/desarchiv.png" alt="" width="30" height="20"
                            </button>
                            </td>
                            </tr>';

                       } else {
                        echo ' 
                        <span id="ok" class="w-75 h-25 mb-2 h1 d-flex justify-content-center border-none t  text-danger">
                        L\'utilisateur recherché ne figure pas sur cette liste !
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
                        <input type="hidden" name="id" value="'.$matricule.'">
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
                                <button type="button" class="btn btn-outline-success mb-auto">Retour</button></a>
                        </ul>
             
                        <nav>
                    <ul class="pagination fixed-bottom justify-content-center">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage - 1 ?>" class="page-link"><img src="../img/precedent.png" alt="" width="30"  style="color: green;"height="20"></a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="?page=<?= $page ?>" class="page-link "><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="?page=<?= $currentPage + 1 ?>" class="page-link"><img src="../img/suivant.png" alt="" width="30" height="20"></a>
                        </li>
                    </ul>
                </nav>
        </div>
        </div>
      </div>
      </main>
</body>
</html>