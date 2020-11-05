<?php
        require_once './database.php';
       
        $tableDemande = [];
        $requette = "SELECT prenom,nom,email,telephone,typeDemande from Demandeur,Demande where Demandeur.idDemandeur = Demande.idDemandeur";
        
        if ($reponse = mysqli_query($bdd,$requette)) {
            $i=0;
            while ($row = mysqli_fetch_assoc($reponse)) {
                $tableDemande[$i]['prenom'] = $row['prenom'];
                $tableDemande[$i]['nom'] = $row['nom'];
                $tableDemande[$i]['email'] = $row['email'];
                $tableDemande[$i]['telephone'] = $row['telephone'];
                $tableDemande[$i]['typeDemande'] = $row['typeDemande'];
                $i++;
            }
            echo json_encode($tableDemande);
            
        } else {
            echo http_response_code(404);
        }
?>