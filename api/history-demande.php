<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>consulter Historique des demandes</title>
</head>
<body>
    <?php
        require_once './database.php';
       
        $tableau = [];
        $reponse = $bdd -> query('SELECT prenom,nom,email,telephone,typeDemande from Demandeur,Demande where Demandeur.idDemandeur = Demande.idDemandeur') or die(print_r($bdd->errorInfo()));
        if ($result=$reponse->fetch()) {
            $i=0;
            while ($donnees = $reponse->fetch()) {
                $tableau [$i]['prenom']=$donnees['prenom'];
                $tableau [$i]['nom']=$donnees['nom'];
                $tableau [$i]['email']=$donnees['email'];
                $tableau [$i]['telephone']=$donnees['telephone'];
                $tableau [$i]['typeDemande']=$donnees['typeDemande'];
                $i++;
            }
            echo json_encode($tableau);
            
        } else {
            echo http_response_code(404);
        }
    ?>
</body>
</html>