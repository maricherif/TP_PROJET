<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-success p-4 d-flex">
            <div class="container-fluid d-flex">
                <div>
                    <img src="./img/user.png" alt="mama">
                    <span>mammmm</span>
                </div>
                <div class="m-2 ">
                    <spa>MATRICULE</span>
                </div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="connexion.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/deconect.png" alt="deconnecter" width="30">Deconnecter</button></a>
                        </li>
                        
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="recherche" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">recherche</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
<div class="tab-pane" id="test">
        <div class="col-md-12">
         
        <table class="table m-2 " >
                    <thead class="thead-dark bg-dark text-light">
                    <tr>
                        <th scope="col">nom</th>
                        <th scope="col">prenom</th>
                        <th scope="col">matricule</th>
                        <th scope="col">date_archivage</th>
                        <th scope="col">Action</th>


                        
                    </tr>
                    </thead>
                    <tbody>

                  <?php
                  
                  $db= new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;','root','');
/*                         $sql=$db->prepare('SELECT * FROM utilisateur');
 */                
                    $sql=$db->query('SELECT * FROM utilisateur WHERE  etat=0 ');

                     $sql->execute();
 
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $nom = $row['nom'];
                        $prenom = $row['prenom'];
                        $matricule =  $row['matricule'];
                        $date_archivage = $row['date_archivage'];
 
                                    echo '<tr>
                        <td>' . $nom . '</td>
                        <th>' . $prenom . '</th>
                        <td>' . $matricule . '</td>
                        <td>' . $date_archivage . '</td>
                        <td><form action="mod_employer.php" method="post">
                        <input type="hidden" name="id_emd" value=".$a["id"].">
                        <button type="submit" class="btn btn-outline-success">desarchiver</button>
                        </td>
                        </tr>';
               
                                                        
                            }
                  
                  ?>

                    </tbody>
                    </table>
                    <ul class="nav-item">
                            <a href="admin.php">

                                <button type="button" class="btn btn-outline-success "> Retour </button></a>
                        </ul>
             
        </div>
      </div>
</body>
</html>