<?php
class ModelUser
{
    var $db;
    public function __construct()
    {
        try {

            $this->db = new PDO('mysql:host=127.0.0.1;dbname=TPFormulaire;', 'root', '');
        } catch (Exception $e) {
            die("Connection erreur du à " . $e->getMessage());
        }
    }
    function redirectUrl($url)
    {
        echo '<script language="javascript">window.location.href ="' . $url . '"</script>';
    }

    function setTimeout($fn, $timeout)
    {
        sleep(($timeout / 1000));
        $fn();
    }


    function generateMatricule($n = 3)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return 'MAE' . $randomString;
    }



    public function addUser($nom,$prenom,$passwords,$roles,$matricule,$email,$photo){
        $etat = 1;
       
        try {

            $sql=$this->db->prepare('INSERT INTO `utilisateur` ( `nom`, `prenom`, `passwords`,`roles`,`matricule`,`email`,`etat`, `photo`)
                                        VALUES (:nom,:prenom,:passwords,:roles,:matricule,:email,:etat, :photo)');
            
            $checkMail =$this->db->prepare('SELECT email FROM utilisateur WHERE email=:email');
            $checkMail->bindParam(":email",$email);
 
            $checkMail->execute(array('email' => $email));

            $row = $checkMail->fetch(PDO::FETCH_ASSOC);
              
          if (!$row) {
                $sql->bindParam(":nom", $nom);
                $sql->bindParam(":prenom", $prenom);
                $sql->bindParam(":passwords", $passwords);
                $sql->bindParam(":roles", $roles);
                $sql->bindParam(":matricule", $matricule);
                $sql->bindParam(":email", $email);
                $sql->bindParam(":etat", $etat);
                $sql->bindParam(":photo", $photo);
                $sql->execute();

                echo ' 
                <span id="ok" class="w-75 h-25 m-5 d-flex justify-content-center border-none   text-success">
                        Inscription reussie!
                </span>
        
                ';
                 echo ' 
                <script>
                    setTimeout(()=>{document.getElementById("ok").remove()},2000);
                </script> 
        
                '; 
                header("location:../../index.php");
                exit;
/*                           $this->setTimeout($this->redirectUrl("http:index.php/"), 5000);
 */                        
                
            }else {
                
                         echo ' 
                                <span id="erreur" class="d-flex justify-content-center mt-2  text-danger"> Email existe déjà!</span>
                                ';
                        echo ' 
                                <script>
                                     setTimeout(()=>{document.getElementById("erreur").remove()},2000);
                                     </script> ';
            }
        } catch (\Throwable $th) {

            echo ' 
                    <div   class="d-flex justify-content-center" role="alert">
                        <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                    </div>          
                 ';
             
        }
    }

    public function connecter($email, $passwords)
    {
        try {
           
            $sql =$this->db->prepare('SELECT * FROM utilisateur WHERE email=:email');
            $sql->bindParam(":email",$email);
            $sql->execute(array('email' => $email));
            
            $donnee=$sql->fetch(PDO::FETCH_ASSOC);
                if ($donnee["etat"] == 1) {
                    if ($donnee["email"] == $email && $donnee["passwords"] == $passwords) {
                        $_SESSION['nom']=$donnee['nom'];
                        $_SESSION['prenom']=$donnee['prenom'];
                        $_SESSION['matricule']=$donnee['matricule'];
                        $_SESSION['photo']=$donnee['photo'];
                        if ($donnee["roles"] === "administrateur") {  
                           header("location:views/pages/admin.php");
                           
                        } elseif($donnee["roles"] === "utilisateur"){
                            
                            header("location:views/pages/employe.php");
                        } 
                }  else{
                    echo ' 
                <p id="erreur" class="w-75 h-25 mb-5 fixed-top text-center border-none  h2 text-danger">
                        Vous n\'avez pas de compte!
                </p>
    
                ';
                echo ' 
                                <script>
                                     setTimeout(()=>{document.getElementById("erreur").remove()},2000);
                                     </script> ';
                }
            
            }  
        }catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function archiveUser($matricule){
        try{
            
            $date_archivage= date("y-m-d");
            $sql=$this->db->prepare('UPDATE utilisateur SET etat=0 ,date_archivage=:date_archivage WHERE matricule=:matricule');
            $sql->execute(['date_archivage'=>$date_archivage,'matricule'=>$matricule]);
             
        } catch(\Throwable $th) {

        }
    }
    public function desArchiveUser($matricule){
    
        try{
            $sql=$this->db->prepare('UPDATE utilisateur SET etat=1 WHERE matricule=:matricule');
            $sql->execute(['matricule'=>$matricule]);
        } catch(\Throwable $th) {

        }
    }
    public function edit($nom,$prenom,$email,$id, $emailPrecedent){
        try {
            
            $sql=$this->db->prepare('UPDATE  utilisateur SET nom=:nom, prenom=:prenom, email=:email WHERE matricule=:id ');
            $checkMail =$this->db->prepare('SELECT email FROM utilisateur WHERE email=:email AND email!=:emailPrecedent');
            $checkMail->bindParam(":email",$email);
            $checkMail->bindParam(":emailPrecedent",$emailPrecedent);
 
            $checkMail->execute();
            $row = $checkMail->fetch(PDO::FETCH_ASSOC);
              
          if (!$row) {
                $sql->bindParam(":nom", $nom);
                $sql->bindParam(":prenom", $prenom);
                $sql->bindParam(":email", $email);
                $sql->bindParam(":id", $id);
/*                 $sql->bindParam(":etat", $etat);
 *//*                 $sql->bindParam(":photo", $photo);
 */                $sql->execute();
 
            echo ' 
            <span id="okk" class="w-75 h-25 m-5 d-flex justify-content-center border-none   text-success">
                    Modification reussie!
            </span>

            ';
            echo ' 
                <script>
                     setTimeout(()=>{document.getElementById("okk").remove()},2000);
                 </script> 
        
         ';
         header("location:admin.php");
            exit;
          }else {
                
            echo ' 
                   <span id="erreurr" class="d-flex justify-content-center mb-2 text-danger"> Email existe déjà!</span>
                   ';
           echo ' 
                   <script>
                        setTimeout(()=>{document.getElementById("erreurr").remove()},2000);
                        </script> ';
}
             
        } catch (\Throwable $th) {

             echo ' 
                    <div class="d-flex justify-content-center" role="alert">
                        <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                    </div>          
                 ';
                    }
    }

    public function getUser($matricule)
    {
        try {
           
            $sql =$this->db->query("SELECT nom, matricule, prenom, email FROM utilisateur WHERE matricule='$matricule'");
            $sql = $sql->fetch();
            return $sql;
            
        } catch (\Throwable $th) {

            echo ' 
                   <div class="d-flex justify-content-center" role="alert">
                       <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                   </div>          
                ';
                   }   
    }
    public function change($id){

        $sql =$this->db->prepare("SELECT roles FROM utilisateur WHERE id = '$id'");
        $sql->execute();
    
        if ($sql->rowCount()>0) {
            $data = $sql->fetchAll()[0];
            if ($data['roles'] === 'administrateur') {
                $sql = $this->db-> prepare("UPDATE utilisateur SET role_etat = 1, roles = 'utilisateur' WHERE id = '$id'");
                $sql->execute();
            }else{
                $sql = $this->db-> prepare("UPDATE utilisateur SET role_etat = 0, roles = 'administrateur' WHERE id = '$id'");
                $sql->execute();
            }
            if ($sql) {
                header("Location:admin.php"); 
                exit;
            }
        }
    }
   
   /*  public function profil($nom,$prenom,$email,$id, $emailPrecedent,$photo){
        try {
            
            $sql=$this->db->prepare('UPDATE  utilisateur SET nom=:nom, prenom=:prenom, email=:email, photo=:photo WHERE matricule=:id ');
            $checkMail =$this->db->prepare('SELECT email FROM utilisateur WHERE email=:email AND email!=:emailPrecedent');
            $checkMail->bindParam(":email",$email);
            $checkMail->bindParam(":emailPrecedent",$emailPrecedent);
 
            $checkMail->execute();
            $row = $checkMail->fetch(PDO::FETCH_ASSOC);
              
          if (!$row) {
                $sql->bindParam(":nom", $nom);
                $sql->bindParam(":prenom", $prenom);
                $sql->bindParam(":email", $email);
                $sql->bindParam(":photo", $photo);
                $sql->bindParam(":id", $id);
                $sql->execute();
 
            echo ' 
            <span id="okk" class="w-75 h-25 m-5 d-flex justify-content-center border-none   text-success">
                    Modification reussie!
            </span>

            ';
            echo ' 
                <script>
                     setTimeout(()=>{document.getElementById("okk").remove()},2000);
                 </script> 
        
         ';
         header("location:admin.php");
            exit;
          }else {
                
            echo ' 
                   <span id="erreurr" class="d-flex justify-content-center mt-2  text-danger"> Email existe déjà!</span>
                   ';
           echo ' 
                   <script>
                        setTimeout(()=>{document.getElementById("erreurr").remove()},2000);
                        </script> ';
}
             
        } catch (\Throwable $th) {

             echo ' 
                    <div class="d-flex justify-content-center" role="alert">
                        <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                    </div>          
                 ';
                    }
    } */
}