<?php
    require_once 'database.php';
    $datas = file_get_contents("php://input");
    if(isset($datas) && !empty($datas)){
          //extraction des données
          $request = json_decode($datas);
          //filtration des données
          $numeroRegistre = mysqli_real_escape_string($request->numeroRegistre);
          $anneeActe = mysqli_real_escape_string($request->anneeActe);
          $nomOfficier = mysqli_real_escape_string($request->nomOfficier);
          $prenomOfficier = mysqli_real_escape_string($request->prenomOfficier);
          $nomMr = mysqli_real_escape_string($request->nomMr);
          $prenomMr = mysqli_real_escape_string($request->prenomMr);
          $professionMr = mysqli_real_escape_string($request->professionMr);
          $dateNaissanceMr = mysqli_real_escape_string($request->dateNaissanceMr);
          $lieuNaissanceMr = mysqli_real_escape_string($request->lieuNaissanceMr);
          $domicileMr = mysqli_real_escape_string($request->domicileMr);
          $nomPrenomPereMr = mysqli_real_escape_string($request->nomPrenomPereMr);
          $nomPrenomMereMr = mysqli_real_escape_string($request->nomPrenomMereMr);
          $nomMme = mysqli_real_escape_string($request->nomMme);
          $prenomMme = mysqli_real_escape_string($request->prenomMme);
          $professionMme = mysqli_real_escape_string($request->professionMme);
          $dateNaissanceMme = mysqli_real_escape_string($request->dateNaissanceMme);
          $lieuNaissanceMme = mysqli_real_escape_string($request->lieuNaissanceMme);
          $domicileMme = mysqli_real_escape_string($request->domicileMme);
          $nomPrenomPereMme = mysqli_real_escape_string($request->nomPrenomPereMme);
          $nomPrenomMereMme = mysqli_real_escape_string($request->nomPrenomMereMme);
          $dateEnregistreMariage = mysqli_real_escape_string($request->dateEnregistreMariage);
          $dateMariageCoutume = mysqli_real_escape_string($request->dateMariageCoutume);
          $prixDote = mysqli_real_escape_string($request->prixDote);
          $typeMariage = mysqli_real_escape_string($request->typeMariage);
          
          $req = "INSERT INTO ActeMariage (numeroRegistre,anneeActe,nomOfficier,prenomOfficier,nomMr,prenomMr,professionMr,dateNaissanceMr,lieuNaissanceMr,domicileMr,nomPrenomPereMr,nomPrenomMereMr,nomMme,prenomMme,professionMme,dateNaissanceMme,lieuNaissanceMme,domicileMme,nomPrenomPereMme,nomPrenomMereMme,dateEnregistreMariage,dateMariageCoutume,prixDote,typeMariage) VALUES ('$numeroRegistre','$anneeActe','$nomOfficier','$prenomOfficier','$nomMr','$prenomMr','$professionMr','$dateNaissanceMr','$lieuNaissanceMr','$domicileMr','$nomPrenomPereMr','$nomPrenomMereMr','$nomMme','$prenomMme','$professionMme','$dateNaissanceMme','$lieuNaissanceMme','$domicileMme','$nomPrenomPereMme','$nomPrenomMereMme',now(),'$dateMariageCoutume','$prixDote','$typeMariage')";
        if(mysli_query($bdd,$req)){
            $acteMariage=[
                'numeroRegistre'=>$numeroRegistre,
                'anneeActe'=>$anneeActe,
                'nomOfficier'=>$nomOfficier,
                'prenomOfficier'=>$prenomOfficier,
                'nomMr'=>$nomMr,
                'prenomMr'=>$prenomMr,
                'professionMr'=>$professionMr,
                'dateNaissanceMr'=>$dateNaissanceMr,
                'lieuNaissanceMr'=>$lieuNaissanceMr,
                'domicileMr'=>$domicileMr,
                'nomPronomPereMr'=>$nomPronomPereMr,
                'nomPrenomMereMr'=>$nomPrenomMereMr,
                'nomMme'=>$nomMme,
                'prenomMme'=>$prenomMme,
                'professionMme'=>$professionMme,
                'dateNaissanceMme'=>$dateNaissanceMme,
                'lieuNaissanceMme'=>$lieuNaissanceMme,
                'domicileMme'=>$domicileMme,
                'nomPronomPereMme'=>$nomPrenomPereMme,
                'nomPrenomMereMme'=>$nomPrenomMereMme,
                'dateEnregistreMariage'=>$dateEnregistreMariage,
                'dateMariageCoutume'=>$dateMariageCoutume,
                'prixDote'=>$prixDote,
                'typeMariage'=>$typeMariage
            ];
            echo json_encode($acteMariage);
        }else{
            http_response_code(422);
        }
    }
?>