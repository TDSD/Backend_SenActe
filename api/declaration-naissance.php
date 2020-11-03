<?php
    require_once 'database.php';
    $datas = file_get_contents("php://input");
    if(isset($datas) && !empty($datas)){
        //extraction des données
        $request = json_decode($datas);
        $numeroRegistre = htmlentities($request->numeroRegistre);
        $nom = htmlentities($request->nom);
        $prenom = htmlentities($request->prenom);
        $dateNaissance = htmlentities($request->dateNaissance);
        $heureNaissance = htmlentities($request->heureNaissance);
        $lieuNaisance = htmlentities($request->lieuNaissance);
        $sexe = htmlentities($request->sexe);
        $prenomMere = htmlentities($request->$prenomMere);
        $nomMere = htmlentities($request->nomMere);
        $prenomPere = htmlentities($request->$prenomPere);
        $nomPere = htmlentities($request->nomPere);
        $paysNaissance = htmlentities($request->paysNaissance);
        //enregistrement des données
        $requette = $bdd->prepare('INSERT INTO ActeNaissance (numeroRegistre,nom,prenom,dateNaissance,lieuNaissance,heureNaissance,sexe,prenomMere,nomMere,	prenomPere,nomPere,	paysNaissance) VALUES (:numeroRegistre,:nom,:prenom,:dateNaissance,:lieuNaissance,:heureNaissance,:sexe,:prenomMere,:nomMere,:prenomPere,:nomPere,:paysNaissance)');
        $requette->execute(array(
            'numeroRegistre'=> $numeroRegistre,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'dateNaissance'=>$dateNaissance,
            'lieuNaissance'=>$lieuNaisance,
            'heureNaissance' => $heureNaissance,
            'sexe'=>$sexe,
            'prenomMere'=>$prenomMere,
            'nomMere'=>$nomMere,
            'prenomPere'=>$prenomPere,
            'nomPere'=>$nomPere,
            'paysNaissance'=>$paysNaissance
        ));
        $reponse ->closeCursor();
       
    }
?>