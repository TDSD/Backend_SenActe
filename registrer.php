<?php
    //ce fichier permet la création de comptes utilisateur
    include_once("database.php");
    $datas = file_get_contents("php://input");
    $request = json_decode($datas);
    if(isset($datas))
    {
        $prenom = htmlentities($request->prenom);
        $nom = htmlentities($request->nom);
        $email = htmlentities($request->email);
        $password = htmlentities($request->password);
        $password = password_hash($password, DEFAULT_PASSWORD);
        $dateNaiss = htmlentities($request->dateNaiss);
        $lieuNaiss = htmlentities($request->lieuNaiss);
        $numRegistre = htmlentities($request->numRegistre);
        $numTel = htmlentities($request->numTel);
        $adresse = htmlentities($request->adresse);
        $sql = $bdd->prepare('SELECT * FROM ActeNaissance');
        $donnees = $sql->fetch();
        if($donnees['nom'] === $nom && $donnees['prenom'] === $prenom && $donnees['dateNaissance'] === $dateNaiss && $donnees['lieuNaissance '] === $lieuNaiss && $donnees['numeroRegistre'] === $numRegistre)
        {
            $insert1 = $bdd->prepare('INSERT INTO CompteUtilisateur(login,mdp) VALUES(:login, :mdp)');
            $insert1->execute(array(
                'login' => $email,
                'mdp' => $password
            ));
            echo json_encode($insert1);

            $req = $bdd->prepare('select id from CompteUtilisateur where login = ?');
            $req->execute(array(
                $email
            ));
    
            $donneesId = $req->fetch();

            $insert2 = $bdd->prepare('INSERT INTO Demandeur(userId,nom,prenom,email,telephone,dateNaissance) VALUES(:userId,:nom,:prenom,:email,:telephone,:dateNaissance)');
            $insert2->execute(array(
                'userId' => $donneesId['id'],
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'telephone' => $numTel,
                'dateNaissance' => $dateNaiss 
            ));
            //Creation du compte
            echo json_encode($insert2);
        }
        else
        {
            //erreur avec les champs
            http_response_code(404);
        }
    }
?>