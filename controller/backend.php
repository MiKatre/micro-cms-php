<?php
require_once('model/manager/CommentManager.php');
require_once('model/manager/PostManager.php');
require_once('model/manager/UserManager.php');
require_once('model/User.php');


function showLogin(){
  session_start();
  if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
    header('Location:  index.php?action=showDashboard');
  }

  require('view/backend/loginView.php');
}

function login($email, $password, $rememberMe = false) {
  $userManager = new UserManager;

  $userData = $userManager->login($email);

  if($userData == false) {
    header('Location:  index.php?action=showLogin&errorMessage=Mauvais identifiant ou mot de passe !');
    throw new Exception('Mauvais identifiant ou mot de passe');
  }
  
  $user = new User($userData);
  
  $isUser = password_verify($password, $user->hash());

  
  if(!$isUser) {
    header('Location:  index.php?action=showLogin&errorMessage=Mauvais identifiant ou mot de passe !');
    throw new Exception('Mauvais identifiant ou mot de passe');
  }


  session_start();
  $_SESSION['id'] = $user->id();
  $_SESSION['name'] = $user->name();
  $_SESSION['email'] = $user->email();
  $_SESSION['hash'] = $user->hash();

  if ($rememberMe) {
    setcookie('name', $user->name(), time() + 365*24*3600, null, null, false, true);
    setcookie('email', $user->email(), time() + 365*24*3600, null, null, false, true);
    setcookie('hash', $user->hash(), time() + 365*24*3600, null, null, false, true);
  }

  // Redirect to dashboard
  header('Location:  index.php?action=showDashboard');
}

function logout() {
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
  }
  session_destroy();
  header('Location:  index.php?');
}

function showDashboard() {
 
  session_start();

  if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    header('Location:  index.php?action=showLogin&errorMessage=Vous devez vous connecter pour avoir accès à cette page !');
  }

  // Ask model to fetch all Posts ordered by date and send back the objects.
  $postManager = new PostManager();
  $comments = $commentManager->getAllComments();

  // Ask model to fetch all comments ordered by date and send back the objects.
  $commentManager = new CommentManager();
  $comments = $commentManager->getAllComments();

  require('view/backend/dashboardView.php');
}

function updateComment($commentId, $status) {
  $commentManager = new CommentManager();
  $isSuccessful = $commentManager->status($commentId, $status);
  if($isSuccessful) {
    header('Location:  index.php?action=showDashboard&successMessage=Status du commentaire mis à jour !');
  } else {
    header('Location:  index.php?action=showDashboard&errorMessage=Impossible de mettre à jour le commentaire !');
  }
}