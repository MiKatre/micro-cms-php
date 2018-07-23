<?php
require('controller/frontend.php');
require('controller/backend.php');

try {
  $action = (isset($_GET['action']) ? $_GET['action'] : 'justShowHome' );
  switch ($action) {
    case "listPosts":
      $frontendController = new FrontendController; 
      $frontendController->listPosts();
      break;
    case "post":
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        $frontendController = new FrontendController; 
        $frontendController->post();
      } else {
        throw new Exception('Missing id');
      }
      break;
    case "showBlog":
      $frontendController = new FrontendController; 
      if(isset($_GET['page'])) {
        $frontendController->showBlog($_GET['page']);
      } else {
        $frontendController->showBlog();
      }
      break;
    case "showAbout":
      $frontendController = new FrontendController; 
      $frontendController->showAbout();
      break;
    case "addComment":
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['author']) && !empty($_POST['content'])&& !empty($_POST['email'])) {
          $frontendController = new FrontendController; 
          $frontendController->addComment($_GET['id'], $_POST['author'],$_POST['email'], $_POST['content'], $_POST['responseId']);
        }
        else {
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
      }
      else {
        throw new Exception('Aucun identifiant de billet envoyé');
      }
      break;
    case "flagComment":
      if (isset($_GET['commentId']) && isset($_GET['postId']) && isset($_GET['status']) && $_GET['commentId'] > 0 &&  $_GET['postId'] > 0 ){
        $frontendController = new FrontendController; 
        $frontendController->flagComment($_GET['commentId'], $_GET['postId'], $_GET['status'] );
      } else {
        throw new Exception('Impossible de signaler ce commentaire');
      }
      break;
    case "showLogin":
      showLogin();
      break;
    case "login":
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
      break;
    case "showDashboard":
      showDashboard();
      break;
    case "showDashboardPosts":
      if(isset($_GET['page'])) {
        showPaginatedPosts($_GET['page']);
      } else {
        showPaginatedPosts();
      }
      break;
    case "showDashboardComments":
      if(isset($_GET['page'])) {
        showPaginatedComments($_GET['page']);
      } else {
        showPaginatedComments();
      }
      break;
    case "updateComment":
      if (isset($_GET['commentId']) && isset($_GET['status']) && isset($_GET['url'])) {
        updateComment($_GET['commentId'], $_GET['status'], $_GET['url']);
      }
      break;
    case "updatePost":
      if (isset($_GET['status']) && isset($_GET['postId']) &&  $_GET['postId'] > 0 ){
        updatePostStatus($_GET['postId'], $_GET['status'], $_GET['return'] );
      } elseif(isset($_GET['id']) && isset($_POST['title']) && isset($_POST['content']) && $_GET['id'] > 0) {
        updatePostContent($_GET['id'], $_POST['title'], $_POST['content']);
      } elseif(isset($_POST['title']) && isset($_POST['content'])) {
        addPost($_POST['title'], $_POST['content']);
      } else {
        throw new Exception('Impossible de publier cet article');
      }
      break;
    case "showEditor":
      showEditor($_GET['id']);
      break;
    case "logout":
      logout();
      break;
    default:
      $frontendController = new FrontendController; 
      $frontendController->listPosts();
      break;
  }
} catch (Exception $e) {
  $errorMessage = $e->getMessage();
  require('view/errorView.php');
}
