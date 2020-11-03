<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuler rendez-vous</title>
</head>
<body>
    <?php
        require_once 'database.php';
        
        $id = ($_POST['id'] !== null && (int)$_POST['id'] > 0)? mysqli_real_escape_string($con, (int)$_POST['id']) : false;
        //envoie de mail 
       /* ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = $bdd->query('SELECT email FROM Demandeur d,RendezVous r WHERE r.idDemandeur= d.idDemandeur');
        $to = "test@hostinger.fr";
        $subject = "Essai de PHP Mail";
        $message = "Bonjour Mr/Mme votre rendez-vous est annuler veillez choisir une autre date ulterieurement .Nous Nous execusons du desagrement";
        $headers = "De :" . $from;
        mail($to,$subject,$message, $headers);
        echo "L'email a été envoyé.";*/
        //suppression du rv
        if(!$id)
        {
        return http_response_code(400);
        }

        $sql = "DELETE FROM `RendezVous` WHERE `id` ='{$id}' LIMIT 1";

        if($result = $sql->fetch())
        {
            return  http_response_code(204);
        }
        else
        {
            return http_response_code(422);
        }
        

    ?>
</body>
</html>