<?php
    /*ce fichier gère les demandes d'acte de naissance
    NB: Il faut ajouter dans le fichier demande-naissance.component.html, l'attribut 'value' dans les input de type radio :
    L'input interéssé a pour valeur : interesse
    L'input fils/fille a pour valeur : enfant
    L'input père/mère a pour valeur : parent
    */
    include_once('database.php');
    $datas = file_get_contents("php://input");
    if(isset($datas)) {
        $request = json_decode($datas);
        $optradio = mysqli_real_escap_string($bdd, trim($request->optradio));
        $prenom = mysqli_real_escap_string($bdd, trim($request->prenom));
        $nom = mysqli_real_escap_string($bdd, trim($request->nom));
        $email = mysqli_real_escap_string($bdd, trim($request->email));
        $dateNaiss = mysqli_real_escap_string($bdd, trim($request->dateNaiss));
        $lieuNaiss = mysqli_real_escap_string($bdd, trim($request->lieuNaiss));
        $numRegistre = mysqli_real_escap_string($bdd, trim($request->numRegistre));
        $numTel = mysqli_real_escap_string($bdd, trim($request->numTel));
        $adresse = mysqli_real_escap_string($bdd, trim($request->adresse));
        $sql = "SELECT numeroRegistre,nom,prenom,dateNaissance,lieuNaissance FROM ActeNaissance";
        if($result = mysqli_query($bb, $sql))
        {
            $donnees = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $donnees[] = $row;
                if($donnees['numeroRegistre'] === $numRegistre && $donnees['nom'] === $nom && $donnees['prenom'] === $prenom && $donnees['dateNaissance'] === $dateNaiss && $donnees['lieuNaissance'] === $lieuNaiss)
                {
                    $req = "SELECT idDemandeur FROM Demandeur WHERE nom = '$nom' && prenom = '$prenom' && email = '$email' && telephone = '$numTel && dateNaissance = '$dateNaiss'";
                    if($rep = mysqli_query($bdd, $req))
                    {   
                        while($ligne = mysqli_fetch_assoc($rep))
                        {
                            $id = $ligne['idDemandeur'];
                            $insertDemande = "INSERT INTO Demande(idDemandeur,HeureDemande,DateDemande,typeDemande) VALUES('$id',now(),curdate(),'naissance')";
                            if($bdd->query($insertDemande))
                            {
                            $authdata = [
                                'idDemandeur' => $id,
                                'typeDemande' => 'naissance'
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
            }            
        }     
    }
?>