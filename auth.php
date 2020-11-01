<?php
    /* Ce fichier gere la tâche d'authentification */
    session_start();
    include_once("database.php");
    $datas = file_get_contents("php://input");
    $request = json_decode($datas);
    if(isset($datas))
    {
        $email = htmlentities($request->username);
        $password = htmlentities($request->password);
        //Récupération de l'utilisateur et de son password haché
        $sql = $bdd->prepare('SELECT id,mdp FROM CompteUtilisateur,Demandeur WHERE email = :email AND id=userId');
        $sql->execute(array(
            'email' => $email));

        $result = $sql->fetch();
        //verification du password envoyé depuis le formulaire avec celui présent dans la BD
        $estCorrect = password_verify($password, $result['mdp']);
        if($estCorrect)
        {
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $email;
            //Rediriger vers l'espace utilisateur
        }
        else
        {
            http_response_code(404);
            //Mot de passe ou Login incorrect
        }

    }


?>