<?php
// form ajax
add_action( 'wp_ajax_form_newsletter', 'form_newsletter' );
add_action( 'wp_ajax_nopriv_form_newsletter', 'form_newsletter' );

function form_newsletter() {

  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $email = htmlspecialchars($_POST['email']);


  $t = array();

  if( $prenom == ""){
    $t['erreurPrenom'] = "<em class='erreur state-error'>Vous devez rentrer votre prenom</em>";
    $erreur = true;
  }

  if( $nom == ""){
    $t['erreurNom'] = "<em class='erreur state-error'>Vous devez rentrer votre nom</em>";
    $erreur = true;
  }

  if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
    $t['erreurEmail'] = "<p class='erreur state-error form-error'>Votre adresse e-mail n'est pas valide</p>";
    $erreur = true;
  }

  if(!isset($erreur)){
    $t['erreur'] = false;
  }elseif($erreur == true){
    $t['erreur'] = true;
    echo json_encode($t);
    die();
  }


  if($t['erreur'] == false){

    // Inject in MC
    include(dirname(dirname(__FILE__)).'/mailchimp.class.php');
    $apiKey = "57bc6csdadcb979ogo5f3dc62sdsd3f85d-us1";
    $listId = "ca418es0df8";
    $mailchimp = new MailChimp($apiKey);
    $result = $mailchimp->call('lists/subscribe', array(
      'id'                => $listId , // id de la liste
      'email'             => array('email'=>$email),
      'merge_vars'        => array('FNAME'=>$prenom, 'LNAME'=>$nom),
      'double_optin'      => false,
      'update_existing'   => true,
      'replace_interests' => false,
      'send_welcome'      => false,
    ));

    if($result['status'] == 'error'){
      $t['erreur'] = true;
      $t['erreurGlobal'] = "<em class='erreur state-error'>Nous n'avons pas réussi à ajouter votre adresse à la liste</em>";
      echo json_encode($t);
    }else{
      $t['successMessage'] = "<p>Inscription réussie</p>";
      echo json_encode($t);
    }


    die();
  }



}

?>
