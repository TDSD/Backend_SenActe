<?php
    //
    include_once("database.php");
    $datas = file_get_contents("php://input");
    if(isset($datas))
    {
        $request = json_decode($datas);
        $optActe = htmlspecialchars($request->optActe); // cette variable permet de récupérer le type d'acte
        $numeroRegistre = mysqli_real_escape_string($bdd,trim($request->numeroRegistre));
        $nom = mysqli_real_escape_string($bdd, trim($request->nom));
        $prenom = mysqli_real_escape_string($bdd, trim($request->prenom));
        switch ($optActe)
        {
            case 'naissance':
                $sql = "SELECT * FROM ActeNaissance WHERE numeroRegistre = '$numeroRegistre' && nom = '$nom' && prenom = '$prenom'";
                if($result = mysqli_query($bb, $sql))
                {
                    $donnees = array();
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $donnees[] = $row;
                    }
                    echo json_encode($donnees);
                }
                else
                {
                    http_response_code(404);
                }
            break;
            case 'deces':
                $sql = "SELECT * FROM ActeDeces WHERE numeroRegistre = '$numeroRegistre' && nom = '$nom' && prenom = '$prenom'";
                if($result = mysqli_query($bb, $sql))
                {
                    $donnees = array();
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $donnees[] = $row;
                    }
                    echo json_encode($donnees);
                }
                else
                {
                    http_response_code(404);
                }
            break;
            case 'mariage':
                $sql = "SELECT * FROM ActeMariage WHERE numeroRegistre = '$numeroRegistre'";
                if($result = mysqli_query($bb, $sql))
                {
                    $donnees = array();
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $donnees[] = $row;
                    }
                    echo json_encode($donnees);
                }
                else
                {
                    http_response_code(404);
                }
            break;     
        }
    }
?>