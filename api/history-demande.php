<?php
        require_once './database.php';
       
        $tableDemande = [];
        $requette = "SELECT prenom,nom,email,telephone,typeDemande from Demandeur,Demande where Demandeur.idDemandeur = Demande.idDemandeur";
        
        if ($reponse=mysqli_query($bdd,$requette)) {
            $i=0;
            while ($donnees = $reponse->fetch()) {
                $tableDemande[$i]['prenom'] = $donnees['prenom'];
                $tableDemande[$i]['nom'] = $donnees['nom'];
                $tableDemande[$i]['email'] = $donnees['email'];
                $tableDemande[$i]['telephone'] = $donnees['telephone'];
                $tableDemande[$i]['typeDemande'] = $donnees['typeDemande'];
                $i++;
            }
            echo json_encode($tableDemande);
            
        } else {
            echo http_response_code(404);
        }
?>