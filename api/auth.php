<?php
    /* Ce fichier gere la tâche d'authentification */
    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {
        $request = json_decode($datas);
        $email = mysqli_real_escape_string($bdd, trim($request->username));
        $password = mysqli_real_escape_string($bdd, trim($request->password));
        //Récupération de l'utilisateur et de son password haché
        $sql = "SELECT id,mdp,nom,prenom FROM CompteUtilisateur,Demandeur WHERE email = '$email' AND id=userId";
        if($result = mysqli_query($bdd, $sql))
        {
            $rows = array();
            while($row = mysqli_fetch_assoc($result))
            {
                $rows[] = $row;
                //verification du password envoyé depuis le formulaire avec celui présent dans la BD
                $estCorrect = password_verify($password, $rows['mdp']);
                if($estCorrect)
                {
                    echo json_encode($rows);
                }
                else
                {
                    http_response_code(404);
                    //Mot de passe ou Login incorrect
                }

            }
        }
    }



?>
