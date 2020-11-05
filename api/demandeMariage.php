<?php
    //Ce fichier gère les demandes d'actes de mariage

    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {
        $request = json_decode($datas);
        $numeroRegistre = mysqli_real_escape_string($bdd, trim($request->numeroRegistre)); 
        $anneeActe = mysqli_real_escape_string($bdd, trim($request->anneeActe));
        $nomOfficier = mysqli_real_escape_string($bdd, trim($request->nomOfficier));
        $prenomOfficier = mysqli_real_escape_string($bdd, trim($request->prenomOfficier));
        $nomMr = mysqli_real_escape_string($bdd, trim($request->nomMr));
        $prenomMr = mysqli_real_escape_string($bdd, trim($request->prenomMr));
        $prenomMme = mysqli_real_escape_string($bdd, trim($request->prenomMme)); 
        $nomMme = mysqli_real_escape_string($bdd, trim($request->nomMme));
        $sql = "SELECT numeroRegistre,anneeActe,nomOfficier,prenomOfficier,nomMr,prenomMr,prenomMme,nomMme FROM ActeMariage WHERE numeroRegistre = '$numeroRegistre' && anneeActe = '$anneeActe'";
        if($result = mysqli_query($bdd,$sql))
        {
            $donnees = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $donnees[] = $row;
                if($donnees['numeroRegistre'] === $numRegistre && $donnees['anneeActe'] === $anneeActe)
                {
                    $req = "SELECT idDemandeur FROM Demandeur WHERE nom IN ('$nomMr','$nomMme') && prenom IN ('$prenomMr','$prenomMme')";
                    if($rep = mysqli_query($bdd, $req))
                    {   
                        while($ligne = mysqli_fetch_assoc($rep))
                        {
                            $id = $ligne['idDemandeur'];
                            $insertDemande = "INSERT INTO Demande(idDemandeur,HeureDemande,DateDemande,typeDemande) VALUES('$id',now(),curdate(),'mariage')";
                            if($bdd->query($insertDemande))
                            {
                            $authdata = [
                                'numeroRegistre' => $numeroRegistre,
                                'anneeActe' => $anneeActe,
                                'idDemandeur' => $id,
                                'typeDemande' => 'mariage'
                            ];
                            echo json_encode($authdata);
                            }
                        }
                    }    
               }
               else
               {
                   //Les champs ne sont pas bien rempli
                   http_response_code(404);
               }
            }
        }
    }

?>