<?php
    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {
        $request = json_decode($datas);
        $optActe = htmlspecialchars($request->optActe);
        $numeroRegistre = mysqli_real_escape_string($bdd, trim($request->numeroRegistre));
        switch ($optActe) 
        {
            case 'naissance':
                $sql = "DELETE FROM ActeNaissance WHERE numeroRegistre = '$numeroRegistre'";
                if(mysqli_query($bdd, $sql))
                {
                    //Suppression avec succès
                    http_response_code(204);
                }
                else
                {
                    http_response_code(422);
                }
            break;
            case 'mariage':
                $sql = "DELETE FROM ActeMariage WHERE numeroRegistre = '$numeroRegistre'";
                if(mysqli_query($bdd, $sql))
                {
                    //Suppression avec succès
                    http_response_code(204);
                }
                else
                {
                    http_response_code(422);
                }
            break;
            case 'deces':
                $sql = "DELETE FROM ActeDeces WHERE numeroRegistre = '$numeroRegistre'";
                if(mysqli_query($bdd, $sql))
                {
                    //Suppression avec succès
                    http_response_code(204);
                }
                else
                {
                    http_response_code(422);
                }
            break;
        }
    }

?>