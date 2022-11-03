<?php
require "../../model/model.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>page user</title>
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

    <main>
        <div class="m-5">
            <table class="table">
                <thead class="border border-dark">
                    <tr class="border border-dark">
                        <th scope="col">NOM</th>
                        <th scope="col">PRENOM</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">MATRICULE</th>
                        <th scope="col">date inscription</th>
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
                        $matricule =  $row['matricule'];
                        $date_inscription = $row['date_inscription'];

 
                                    echo '<tr>
                        <td>' . $nom . '</td>
                        <th>' . $prenom . '</th>
                        <td>' . $email . '</td>
                        <td>' . $matricule . '</td>
                        <td>' . $date_inscription . '</td>
                        
                        </tr>';
                    }
                  
                  ?>
                    </tbody>
                    </table>
                </tbody>
            </table>
        </div>
      <!--   <nav aria-label="Page navigation example">
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

    <!-- <footer>
        <div class=" bg-success border-0 fixed-bottom p-1">
            <table class="table text-light border-0 p-1">

                <tr>
                    <th class="border-0">CONTACT</th>
                    <th class="border-0">RESEAU SOCIAUX</th>

                </tr>


                <tr>
                    <td class="border-0"> <img src="../img/tel.png" alt="" width="30" height="24"> TEL: 78 422 73 95
                    </td>
                    <td class="border-0"> <a class="text-light" href=""><img src="../img/facebook.png" alt="" width="30" height="24"> FACEBOOK</td></a>

                </tr>
                <tr>
                    <td class="border-0"> <a class="text-light" href=""> <img src="../img/email.png" alt="" width="30" height="24"> EMAIL: mariecherifsow@gmail.com</td></a>
                    <td class="border-0"> <a class="text-light" href=""><img src="../img/linkedin.png" alt="" width="30" height="24"> LINKEDIN</td></a>
                </tr>

            </table>
        </div>
    </footer> -->
</body>

</html>