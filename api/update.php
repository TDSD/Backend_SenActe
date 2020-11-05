<?php
    //Ce fichier permet d'opérer des mises à jours
    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {
        $request = json_decode($datas);
        $optActe = htmlspecialchars($request->optActe); //Type d'acte choisi
        $numeroRegistre = mysqli_real_escape_string($bdd, trim($request->numeroRegistre));
        $nom = mysqli_real_escape_string($bdd, trim($request->nom));
        $prenom = mysqli_real_escape_string($bdd, trim($request->prenom));
        switch ($optActe) 
        {
            case 'naissance':
                $sql = "UPDATE ActeNaissance SET nom = '$nom', prenom = '$prenom' WHERE numeroRegistre = '$numeroRegistre'";
                if(mysqli_query($bdd, $sql))
                {
                    //LA mise à jour est effectuée avec succès
                    http_response_code(204);
                }
                else
                {
                    //Erreur de mise à jour
                    http_response_code(422);
                }
            break;
            case 'deces':
                $sql = "UPDATE ActeDeces SET nom = '$nom', prenom = '$prenom' WHERE numeroRegistre = '$numeroRegistre'";
                if(mysqli_query($bdd, $sql))
                {
                    //La mise à jour est effectuée avec succès
                    http_response_code(204);
                }
                else
                {
                    //Erreur de mise à jour
                    http_response_code(422);
                }
            break;
            case 'mariage':
                $sql = "UPDATE ActeMariage SET nomMr = '$nom', prenomMr = '$prenom' WHERE numeroRegistre = '$numeroRegistre'";
                if(mysqli_query($bdd, $sql))
                {
                    //La mise à jour est effectuée avec succès
                    http_response_code(204);
                }
                else
                {
                    //Erreur de mise à jour
                    http_response_code(422);
                }
            break;
        }
    }
?>