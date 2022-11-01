# TP_PROJET
public function addUser($nom, $prenom, $passwords, $roles, $matricule, $email, $photo)
    {
        $etat = 1;
        try {

            $sql = $this->db->prepare('INSERT INTO `utilisateur` ( `nom`, `prenom`,`passwords`,`roles`,`matricule`,`email`,`etat`,`photo`)
                                            VALUES (:nom,:prenom,:passwords,:roles,:matricule,:email,:etat,:photo)');

            $checkMail = $this->db->prepare('SELECT 1 FROM utilisateur WHERE email=:email');
/*             $checkMail->bindParam(":email", $email);
 */ 
            $checkMail->execute(array('email' => $email));

            $row = $checkMail->fetch(PDO::FETCH_ASSOC);

            if (!$row) {

                $sql->execute(array(

                    'nom' => $nom,
                    'prenom' => $prenom,
                    'passwords' => $passwords,
                    'roles' => $roles,
                    'matricule' => $matricule,
                    'email' => $email,
                    'etat' => $etat,
                    'photo' => $photo
                ));
/*                 var_dump($checkMail);die;
 */ 
/*                  return $sql;
 */ 
        echo ' 
                <span id="erreur" class="d-flex justify-content-center mt-2  text-danger"> Email existe déjà!</span>
                ';
                echo ' 
                        <script>
                             setTimeout(()=>{document.getElementById("erreur").remove()},2000);
                         </script>          
                        ';
                
            } else{
                
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
                                /*  $this->setTimeout($this->redirectUrl("http:connexion.php/"), 3000);
                                 $sql->closeCursor();  */ 
                    /* echo ' 
                    <span id="erreur" class="d-flex justify-content-center mt-2  text-danger"> Email existe déjà!</span>
                ';
                echo ' 
                                            <script>
                                                 setTimeout(()=>{document.getElementById("erreur").remove()},2000);
                                             </script>          
                                            '; */
                                        }
          /*   if ($sql) {

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
                                             $this->setTimeout($this->redirectUrl("http:connexion.php/"), 3000);
                                             $sql->closeCursor();   
                }  */
                


              
            
        }catch (\Throwable $th) {

            echo ' 
                        <div   class="d-flex justify-content-center" role="alert">
                            <span class="badge bg-danger border border-danger">' . $th->getMessage() . '</span>
                        </div>          
                     ';

            $sql->closeCursor();
        }
    }