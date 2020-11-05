<?php
    //ce fichier permet la création de comptes utilisateur
    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {   
        $request = json_decode($datas);
        $prenom = mysqli_real_escape_string($bdd, trim($request->prenom));
        $nom = mysqli_real_escape_string($bdd, trim($request->nom));
        $email = mysqli_real_escape_string($bdd, trim($request->email));
        $password = mysqli_real_escape_string($bdd, trim($request->password));
        $password = password_hash($password, DEFAULT_PASSWORD);
        $dateNaiss = mysqli_real_escape_string($bdd, trim($request->dateNaiss));
        $lieuNaiss = mysqli_real_escape_string($bdd, trim($request->lieuNaiss));
        $numRegistre = mysqli_real_escape_string($bdd, trim($request->numRegistre));
        $numTel = mysqli_real_escape_string($bdd, trim($request->numTel));
        $adresse = mysqli_real_escape_string($bdd, trim($request->adresse));
        $sql = "SELECT * FROM ActeNaissance";
        if($result = mysqli_query($bdd, $sql))
        {
            $donnees = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $donnees[] = $row;
                if($donnees['nom'] === $nom && $donnees['prenom'] === $prenom && $donnees['dateNaissance'] === $dateNaiss && $donnees['lieuNaissance '] === $lieuNaiss && $donnees['numeroRegistre'] === $numRegistre)
                {
                    $insert1 = "INSERT INTO CompteUtilisateur(login,mdp) VALUES('$email', '$password')";
                    if ($mysqli->query($insert1)) 
                    {
                        $authdata = [
                            'login' => $email,
                            'mdp' => '',
                            'email' => $email,
                            'id' => mysqli_insert_id($bdd)
                        ];
                        echo json_encode($authdata);
                    }
                }
            }
        }
        else
        {
            //Tous les champs ne sont pas bien rempli
            http_response_code(404);
        }
        $req = "select id from CompteUtilisateur where login ='$email' ";
        if($rep = mysqli_query($bdd, $req))
        {
            $rows = array();
            while($row = mysqli_fetch_assoc($rep))
            {
                $rows[] = $row;
                $id = $rows['id'];
                $insert2 = "INSERT INTO Demandeur(userId,nom,prenom,email,telephone,dateNaissance) VALUES('$id','$nom','$prenom','$email','$numTel','$dateNaiss')";
                if ($mysqli->query($insert1)) 
                {
                    $authdata = [
                        'userId' => $donneesId['id'],
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'email' => $email,
                        'telephone' => $numTel,
                        'dateNaissance' => $dateNaiss 
                    ];
                     //Creation du compte
                     echo json_encode($authdata);
                }       
            }
        }
        else
        {
            
            http_response_code(404);
        }                         
    }
?>
