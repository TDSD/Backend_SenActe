<?php
    require_once 'database.php';
    $datas = file_get_contents("php://input");
    if(isset($datas) && !empty($datas)){
        //extraction des données
        $request = json_decode($datas);
        //filtration des données
        $numeroRegistre = mysqli_real_escape_string($bdd,trim($request->numeroRegistre));
        $nom = mysqli_real_escape_string($bdd,trim($request->nom));
        $prenom = mysqli_real_escape_string($bdd,trim($request->prenom));
        $dateNaissance = mysqli_real_escape_string($bdd,trim($request->dateNaissance));
        $heureNaissance = mysqli_real_escape_string($bdd,trim($request->heureNaissance));
        $lieuNaisance = mysqli_real_escape_string($bdd,trim($request->lieuNaissance));
        $sexe = mysqli_real_escape_string($bdd,trim($request->sexe));
        $prenomMere = mysqli_real_escape_string($bdd,trim($request->$prenomMere));
        $nomMere = mysqli_real_escape_string($bdd,trim($request->nomMere));
        $prenomPere = mysqli_real_escape_string($bdd,trim($request->$prenomPere));
        $nomPere = mysqli_real_escape_string($bdd,trim($request->nomPere));
        $paysNaissance = mysqli_real_escape_string($bdd,trim($request->paysNaissance));
        //enregistrement des données
        $requette = "INSERT INTO ActeNaissance (numeroRegistre,nom,prenom,dateNaissance,lieuNaissance,heureNaissance,sexe,prenomMere,nomMere,prenomPere,nomPere,paysNaissance) VALUES ('$numeroRegistre','$nom','$prenom','$dateNaissance','$paysNaissance')";
        if(mysqli_query($bdd,$requette)){

            http_response_code(201);
            $acteNaissance = [
                'numeroRegistre'=>$numeroRegistre,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'dateNaissance'=>$dateNaissance,
                'lieuNaissance'=>$lieuNaisance,
                'heureNaissance'=>$heureNaissance,
                'sexe'=>$sexe,
                'prenomMere'=>$prenomMere,
                'nomMere'=>$nomMere,
                'prenomPere'=>$prenomPere,
                'nomPere'=>$nomPere,
                'paysNaissance'=>$paysNaissance
            ];
            echo json_encode($acteNaissance);
        }else{
            http_response_code(422);
        }
    }
?>