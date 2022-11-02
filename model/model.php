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
                        if ($donnee["roles"] == "administrateur") {  
                           header("location:admin.php");
                           
                        } elseif($donnee["roles"] == "utilisateur"){
                            
                            header("location:employe.php");
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
    public function archiveUser($id){
        try{
            $sql=$this->db->prepare('UPDATE utilisateur SET etat=0 WHERE id=:id');
            $sql->execute(['id'=>$id]);

             
        } catch(\Throwable $th) {

        }
    }
    public function desArchiveUser($id,$date_archivage){
        try{
            $sql=$this->db->prepare('UPDATE utilisateur SET etat=0 WHERE id=:id');
            $sql->execute(['id'=>$id]);

          
        } catch(\Throwable $th) {

        }
    }

 /*    public function inser($nom,$prenom,$passwords,$roles,$matricule,$email){

        try{
            $sql= $this->db->prepare('SELECT * FROM utilisateur');
                    $sql->execute();
        }catch (\Throwable $th) {
            echo $th->getMessage();
        }
        }
    }
 */
  /*   public function getUserById($id){
        try{
                $sql=$this->db->prepare('SELECT * FROM user where id=:id');
                $sql->execute(['id'=>$id]);
        
                return $sql->fetchAll();
        }  catch(\Throwable $th) {
            echo $th->getMessage();
            $sql->closeCursor();
        }
    }

    public function getUserByRole($roles){
        try {
            $sql=$this->db->prepare('SELECT * FROM user WHERE roles =:roles ');
            $sql->execute(array('roles'=>$roles));

            return $sql->fetch();
         
            // return $sql;
        } catch (\Throwable $th) {
            //throw $th;
            $sql->closeCursor();
        }

    } */

    /* public function getClasseByUserId($id){
        try{
            $sql=$this->db->prepare('SELECT * FROM classes where eleve=:id');
            $sql->execute(['id'=>$id]);
    
            return $sql->fetchAll();
        }  catch(\Throwable $th) {
            echo $th->getMessage();
            $sql->closeCursor();
        }
    } */
}

