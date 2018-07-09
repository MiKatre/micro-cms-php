<?php
require('controller/frontend.php');
require('controller/backend.php');

try {
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
      listPosts();
    }
    elseif ($_GET['action'] == 'post') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        post();
      } else {
        throw new Exception('Missing id');
      }
    }
    elseif ($_GET['action'] == 'addComment') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author']) && !empty($_POST['content'])&& !empty($_POST['email'])) {
          addComment($_GET['id'], $_POST['author'],$_POST['email'], $_POST['content'], $_POST['responseId']);
        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
      }
      else {
        throw new Exception('Aucun identifiant de billet envoyé');
      }
    }
    elseif ($_GET['action'] == 'flagComment') {
      if (isset($_GET['commentId']) && isset($_GET['postId']) && isset($_GET['status']) && $_GET['commentId'] > 0 &&  $_GET['postId'] > 0 ){
        flagComment($_GET['commentId'], $_GET['postId'], $_GET['status'] );
      } else {
        throw new Exception('Impossible de signaler ce commentaire');
      }
    }
    elseif ($_GET['action'] == 'showLogin') {
      showLogin();
    }
    elseif ($_GET['action'] == 'login') {
      if(isset($_POST['email']) && isset($_POST['password'])) {
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
          $rememberMe = (isset($_POST['rememberMe']) ? true : false );
          login($_POST['email'], $_POST['password'], $rememberMe);
        } else {
          throw new Exception('You should provide both an email and a passord');
        }
      } else {
        throw new Exception('You should provide both an email and a passord');
      }
    }
    elseif ($_GET['action'] == 'showDashboard') {
      showDashboard();
    }
    elseif ($_GET['action'] == 'updateComment') {
      if (isset($_GET['commentId']) && isset($_GET['status'])) {
        updateComment($_GET['commentId'], $_GET['status']);
      }
    }
    elseif ($_GET['action'] == 'logout') {
      logout();
    }
  } else {
    listPosts();
  }
  
} catch (Exception $e) {
  $errorMessage = $e->getMessage();
  require('view/errorView.php');
}
