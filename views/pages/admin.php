<?php
    require "../../model/model.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>page admin</title>
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
                        <li class="nav-item">
                            <a href="desar.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/dearchiv.png" alt="archives" width="30">Liste des archives </button></a>
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

    <main>
        <div class="m-5">
            <table class="table">
                <thead class="border border-dark bg-dark text-light">
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
                        $db= new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;','root','');
                        $sql=$db->prepare('SELECT * FROM utilisateur');
                    $sql->execute();
 
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $nom = $row['nom'];
                        $prenom = $row['prenom'];
                        $email = $row['email'];
                        $roles = $row['roles'];
                        $matricule =  $row['matricule'];
                                    echo '<tr>
                        <td>' . $nom . '</td>
                        <th>' . $prenom . '</th>
                        <td>' . $email . '</td>
                        <td>' . $roles . '</td>
                        <td>' . $matricule . '</td>
                        <td> <form action="mod_employer.php" method="post"> 
                                    <input type="hidden" name="id" value=".$id.">
                                    <button type="submit" class="btn btn-outline-danger">archiver</button>
                                    </form>
                                    </td>

                        </tr>';
                    }
                  
                  ?>

                    </tbody>
                    </table>

                   <!--  $ok = new ModelUser();

                    $sql= $this->db->prepare('SELECT * FROM utilisateur');
                    $sql->execute();
 
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                        $prenom = $row['prenom'];
                        $nom = $row['nom'];
                        $email = $row['email'];
                        $roles = $row['roles'];
                        $matricule =  $row['matricule'];
/*                         $id = $row['id'];
 */                        $action = $row['action'];

                                    echo '<tr>
                        <th>' . $prenom . '</th>
                        <td>' . $nom . '</td>
                        <td>' . $email . '</td>
                        <td>' . $roles . '</td>
                        <td>' . $matricule . '</td>
                        <td>' . $action . '</td>
                        </tr>';
                    }

                    ?>
            
                </tbody>
            </table> -->
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                <a class="page-link text-dark" href="#" tabindex="-1" aria-disabled="true"><img src="../img/precedent.png" alt="" width="20"></a>
                </li>
                <li class="page-item"><a class="page-link text-dark text-dark" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                <a class="page-link text-dark" href="#"><img src="../img/suivant.png" alt="" width="20"></a>
                </li>
            </ul>
        </nav>
    </main>

</body>

</html>