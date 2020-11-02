<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste rendez-vous</title>
</head>
<body>
    <?php
        require_once 'database.php';
        $listRv = [];
        $reponse = $bdd->query('SELECT prenom,nom,email,telephone,dateRv,heureRv from Demandeur d,RendezVous r where r.idDemandeur= d.idDemandeur') or die(print_r($bdd->errorInfo()));
        if ($result=$reponse->fetch()) {
            $i=0;
            while ($donnees = $reponse->fetch()) {
                $listRv[$i]['prenom'] = $donnees['prenom'];
                $listRv[$i]['nom'] = $donnees['nom'];
                $listRv[$i]['email'] = $donnees['email'];
                $listRv[$i]['telephone'] = $donnees['telephone'];
                $listRv[$i]['dateRv'] = $donnees['dateRv'];
                $listRv[$i]['heureRv'] = $donnees['heureRv'];
                $i++;
            }
            echo json_encode($listRv);
            
        } else {
            echo http_response_code(404);
        }
    ?>
</body>
</html>