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
                    <img src="../img/user.png" alt="mama">
                    <span>mammmm</span>
                </div>
                <div class="m-2 "><span>MATRICULE</span></div>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="connexion.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/deconect.png" alt="deconnecter" width="30">Deconnecter</button></a>
                        </li>
                        <li class="nav-item">
                            <a href="connexion.php">

                                <button type="button" class="btn btn-outline-success"> <img src="../img/dearchiv.png" alt="deconnecter" width="30">Liste des archives </button></a>
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
                        <th scope="col">RÔLE</th>
                        <th scope="col">MATRICULE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    <tr>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                           <a href=""><img src="../img/edit.png" alt="" width="30"></a>
                          <a href=""><img src="../img/archiv.png" alt="" width="30"></a>
                           <a href=""><img src="../img/change.png" alt="" width="30"></a>
                        </td>


                    </tr>
                    <tr>
                        <td>Mark</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@mdo</td>
                        <td>
                         <a href="">  <img src="../img/edit.png" alt="" width="30"></a>
                          <a href=""> <img src="../img/archiv.png" alt="" width="30"></a>
                          <a href=""> <img src="../img/change.png" alt="" width="30"></a>
                        </td>

                    </tr>
                    <tr>
                        <td>Mark</td>
                        <td>makk</td>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                        <td>@mdo</td>
                        <td>
                           <a href=""> <img src="../img/edit.png" alt="" width="30"></a>
                            <a href=""><img src="../img/archiv.png" alt="" width="30"></a>
                           <a href=""><img src="../img/change.png" alt="" width="30"></a>
                        </td>
                    

                    </tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link text-dark" href="#" tabindex="-1" aria-disabled="true"><img src="../img/precedent.png" alt="" width="15"></a>
                </li>
                <li class="page-item"><a class="page-link text-dark text-dark" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                <a class="page-link text-dark" href="#"><img src="../img/suivant.png" alt="" width="15"></a>
                </li>
            </ul>
        </nav>
    </main>

    <footer>
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
    </footer>
</body>

</html>