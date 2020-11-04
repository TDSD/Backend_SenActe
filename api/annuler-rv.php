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
        
        $id = ($_POST['id'] !== null && (int)$_POST['id'] > 0)? mysqli_real_escape_string($bdd, (int)$_POST['id']) : false;
        
        if(!$id)
        {
        return http_response_code(400);
        }

        $requette = "DELETE FROM `RendezVous` WHERE `id` ='{$id}' LIMIT 1";

        if(mysqli_query($bdd,$requette))
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