<?php

require_once dirname(__FILE__)."/../bibliothequeServices/autheurServices.php";
require_once dirname(__FILE__)."/../entities/autheur.php";

class AutheurPresentation
{
  public function viewAutheurs()
  {
    echo "\nafficher list des autheurs\n";

    $autheurService = new AutheursServices();
    $autheurs =  $autheurService->getListAutheurs();
    // var_dump( $autheurs);
    if (!empty($autheurs)) {
      foreach ($autheurs as $autheur) {
        echo "---------------------------------\n";
        echo "NOM: " . $autheur->getName() . "\n";
        echo "email: " .$autheur->getEmail() . "\n";
        echo "list des livres: \n";
        foreach( $autheur->getLivres() as $livre){
            echo "              ".$livre."\n";
        }


      }
    } else {
      echo "No autheurs available.\n";
    }
    echo "---------------------------------\n\n";
  }

  public function ajoutAutheur()
  {
    echo "\nAjouter nouveau autheur\n";
    $nom = askQuestion("Enter le nom de l'autheur (or type 'back' to go back): ");
    if (strtolower($nom) === "back") {
      return;
    }

    $email = askQuestion("Enter l'email de l'autheur (or type 'back' to go back): ");
    if (strtolower($email) === "back") {
      return;
    }
    $livres = askQuestion("Enter list de livres siparité avec (,) (or type 'back' to go back): ");
    if (strtolower($livres) === "back") {
      return;
    }else{
        $listLivres = explode(",", $livres);
    }

    $nouveauAuth = new Autheur($nom , $email,$listLivres);
    $AuthService = new AutheursServices();
    $AuthService->ajouteAutheur($nouveauAuth);
    echo "autheur ajouter avec success \n\n";
  }
}



?>