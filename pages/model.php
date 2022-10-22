<?php
    class ModelUser 
    {
        var $db;
        public function __construct()
        { 
            try
            {

                $this->db= new PDO('mysql:host=localhost;dbname=TPFormulaire;','root','');
            }catch(Exception $e)
            {
                die("Connection erreur du à ".$e->getMessage());
            }
        }

    public function addUser($nom,$prenom,$photo,$passwords,$roles,$matricule,$confpasswords,$email,$date_inscription){
        $etat = 0;
        $date_inscription= date()
        try {

            $sql=$this->db->prepare('INSERT INTO `user` ( `nom`, `prenom`, `photo`, `passwords`,`confpasswords`,`roles`,`matricule`,`email`,`etat`,`date_inscription`)
                                        VALUES (:nom,:prenom,:photo,:passwords,:roles,:matricule,:confpasswords,:email,:etat, :date_inscription)');
            
            $checkMail =$this->db->prepare('SELECT 1 FROM user WHERE email=:email');
            $checkMail->bindParam(":email",$email);

            $checkMail->execute();

            $row = $checkMail->fetch(PDO::FETCH_ASSOC);
        
            if (!$row) {
                
                $sql->execute(array(
                    
                    'nom' =>$nom,
                    'prenom' => $prenom,
                    'photo' => $photo,
                    'passwords' => $passwords,
                    'confpasswords' => $confpasswords,
                    'roles' => $roles,
                    'matricule' => $matricule,
                    'email' => $email,
                    'etat' => $etat,
                    'date_inscription' => $date_inscription
                ));
                // return $sql;
                if ($sql) {
                 
                    echo ' 
                        <div class="w-75 h-25 mb-auto d-flex justify-content-center">
                            <div class="alert alert-primary" role="alert">
                                Inscription reussie!
                            </div>
                        </div>
                        
                         ';
                         $this->setTimeout($this->redirectUrl("http://localhost/ecole_reussite/"),3000);
                    $sql->closeCursor();
                }
            }else {
                echo ' 
                        
                            
                        <script>alert("Email existe déjà!")</script>
                         ';
             

                
                $sql->closeCursor();
            }
            

                
        } catch (\Throwable $th) {

            echo ' 
                    <div   class="d-flex justify-content-center" role="alert">
                        <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                    </div>          
                 ';
             
            $sql->closeCursor();
        }
    }

    function generateMatricule($n=3) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';
    
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        return 'MAE'.$randomString;
    
}
    }