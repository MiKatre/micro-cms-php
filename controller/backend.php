<?php
require_once('model/manager/CommentManager.php');
require_once('model/manager/PostManager.php');
require_once('model/manager/UserManager.php');
require_once('model/User.php');


function showLogin(){
  require('view/backend/loginView.php');
}

function login($email, $password, $rememberMe = false) {

  // IF session en course OR valid cookies

  // Send directly to dashboard


  $userManager = new UserManager;

  $userData = $userManager->login($email);

  if($userData == false) {
    header('Location:  index.php?action=showLogin&errorMessage=Mauvais identifiant ou mot de passe !');
  }
  
  $user = new User($userData);
  
  $isUser = password_verify($password, $user->hash());
  
  if(!$isUser) {
    header('Location:  index.php?action=showLogin&errorMessage=Mauvais identifiant ou mot de passe !');
  }

  throw new Exception($isUser . 'User object = ' . $user->hash());

  // Else create user object
  // register session info and redirect to the dashboard
  session_start();
  $_SESSION['id'] = $user->id();
  $_SESSION['name'] = $user->name();
  $_SESSION['email'] = $user->email();
  $_SESSION['hash'] = $user->hash();

  if ($rememberMe) {
    // Set Cookies
    setcookie('name', $user->name(), time() + 365*24*3600, null, null, false, true);
    setcookie('email', $user->email(), time() + 365*24*3600, null, null, false, true);
    setcookie('hash', $user->hash(), time() + 365*24*3600, null, null, false, true);
  }

  // Redirect to dashboard
}