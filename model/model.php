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

            $sql=$this->db->prepare('INSERT INTO `utilisateur` ( `nom`, `prenom`, `passwords`,`roles`,`matricule`,`email`,`etat`,`photo`)
                                        VALUES (:nom,:prenom,:passwords,:roles,:matricule,:email,:etat,:photo)');
            
            $checkMail =$this->db->prepare('SELECT email FROM utilisateur WHERE email=:email');
            $checkMail->bindParam(":email",$email);
 
            $checkMail->execute(array('email' => $email));

            $row = $checkMail->fetch(PDO::FETCH_ASSOC);
/*              var_dump($checkMail);die;
 */          if (!$row) {
                
                $sql->execute(array(
                    
                    'nom' =>$nom,
                    'prenom' => $prenom,
                    'passwords' => $passwords,
                    'roles' => $roles,
                    'matricule' => $matricule,
                    'email' => $email,
                    'etat' => $etat,
                    'photo' => $photo,
                ));

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
                
/*                           $this->setTimeout($this->redirectUrl("http:connexion.php/"), 5000);
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
        session_start();
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
                        if ($donnee["roles"] == "administrateur") {  
                           header("location:views/pages/admin.php");
                           
                        } elseif($donnee["roles"] == "utilisateur"){
                            
                            header("location:views/pages/employe.php");
                        } 
                    }  else{
                        echo ' 
                    <span id="ok" class="w-75 h-25 m-5 d-flex justify-content-center border-none   text-danger">
                            Vous n\'avez pas de compte!
                    </span>

                    ';
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
    public function edit($nom,$prenom,$email,$id){
        try {
            
            $sql=$this->db->prepare('UPDATE  utilisateur SET nom=:nom, prenom=:prenom, email=:email WHERE matricule=:id ');
/*   var_dump($sql);die;         
 */
             $sql->execute(array(
                'nom' =>$nom,
                'prenom' => $prenom,
                'email' => $email,
                'id' =>$id,
            )); 
/*             var_dump($sql);die;
 */            
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
}