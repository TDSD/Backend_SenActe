<?php
    /* Ce fichier gère les demandes d'actes de décès 
  
    */
    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {
        $request = json_decode($datas);
        $numeroRegistre = mysqli_real_escape_string($bdd, trim($request->numeroRegistre));
        $anneeDeces = mysqli_real_escape_string($bdd, trim($request->anneeDeces));
        $nom = mysqli_real_escape_string($bdd, trim($request->nom));
        $prenom = mysqli_real_escape_string($bdd, trim($request->prenom));
        $age = mysqli_real_escape_string($bdd, trim($request->age));
        $lieuNaissance = mysqli_real_escape_string($bdd, trim($request->lieuNaissance));
        $dateDeces = mysqli_real_escape_string($bdd, trim($request->dateDeces));
        $lieuDeces = mysqli_real_escape_string($bdd, trim($request->lieuDeces));
        $profession = mysqli_real_escape_string($bdd, trim($request->profession));
        $sql = $bdd->prepare('SELECT * FROM ActeDeces');
        if($result = mysqli_query($bdd, $sql))
        {
            $donnees = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $donnees[] = $row;
                if($donnees['numeroRegistre'] === $numeroRegistre && $donnees['nom'] === $nom && $donnees['prenom'] === $prenom && $donnees['anneeDeces'] === $anneeDeces && $donnees['lieuNaissance'] === $lieuNaissance && $donnees['lieuDeces'] === $lieuDeces && $donnees['age'] === $age && $donnees['profession'] === $profession && $donnees['dateDeces'] === $dateDeces)
                {
                    $req = "SELECT idDemandeur FROM Demandeur WHERE nom = '$nom' && prenom = '$prenom'";
                    if($rep = mysqli_query($bb, $sql))
                    {
                        while($ligne = mysqli_fetch_assoc($rep))
                        {
                            $id = $ligne['idDemandeur'];
                            $insertDemande = "INSERT INTO Demande(idDemandeur,HeureDemande,DateDemande,typeDemande) VALUES('$id',now(),curdate(),'deces')";
                            if($bdd->query($insertDemande))
                            {
                                $authdata = [
                                    'idDemandeur' => $id,
                                    'typeDemande' => 'deces'
                                ];
                                echo json_encode($authdata);
                            }
                        }
                        
                    }
                }
                else
                {
                    //Toutes les informations ne sont pas conformes
                    http_response_code(404);
                }
            }
        }
    }
?>