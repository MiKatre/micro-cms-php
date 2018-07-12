<?php
require_once('model/manager/CommentManager.php');
require_once('model/manager/PostManager.php');
require_once('model/manager/UserManager.php');
require_once('model/User.php');
require_once('model/Post.php');


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
  // Whatever non int value will return all posts
  $posts = $postManager->getPosts('all'); 

  // Ask model to fetch all comments ordered by date and send back the objects.
  $commentManager = new CommentManager();
  $comments = $commentManager->getAllComments();

  require('view/backend/dashboardView.php');
}

function showPosts() {
  session_start();

  if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    header('Location:  index.php?action=showLogin&errorMessage=Vous devez vous connecter pour avoir accès à cette page !');
  }

  $postManager = new PostManager();
  $posts = $postManager->getPosts('all'); // A non int value

  require('view/backend/postsView.php');
}


function showPaginatedComments($currentPage = 1) {
  $commentManager = new CommentManager();
  $totalRows = $commentManager->getTotalComments();
  $itemsPerPage = 30;
  $totalPages = ceil($totalRows / $itemsPerPage);
  $currentPage = min($currentPage, $totalPages);
  $offset = ($currentPage - 1) * $itemsPerPage;

  $start = $offset + 1;
  $end = min(($offset + $itemsPerPage), $totalRows);

  $paginationInfo = ' Page ' . $currentPage . ' sur ' . $totalPages . '.  Résultats ' . $start . ' à ' . $end . ' sur un total de ' . $totalRows . ' commentaires ';

  $comments = $commentManager->getAllCommentsPaginated($itemsPerPage, $offset);

  $url = 'index.php?action=showDashboardComments';
  require('view/backend/commentsView.php');
}

function updateComment($commentId, $status, $url) {
  $commentManager = new CommentManager();
  $isSuccessful = $commentManager->status($commentId, $status);
  if($isSuccessful) {
    header('Location:  ' . $url . '&successMessage=Status du commentaire mis à jour !');
  } else {
    header('Location:  ' . $url . '&errorMessage=Impossible de mettre à jour le commentaire !');
  }
}

function updatePostStatus($id, $status, $return) {
  $postManager = new PostManager();
  $isSuccessful = $postManager->update($id, $status, '', '');
  if($isSuccessful) {
    header('Location:  index.php?action=' . $return . '&id=' . $id . '&successMessage=Status modifié !');
  } else {
    header('Location:  index.php?action=' . $return . '&id=' . $id . '&errorMessage=Impossible de modifier le status de l\'article !');
  }
}

function updatePostContent($id, $title, $content) {
  $postManager = new PostManager();
  $isSuccessful = $postManager->update($id, '', $title, htmlspecialchars($content));
  if($isSuccessful) {
    header('Location:  index.php?action=showEditor&id=' . $id . '&successMessage=Article sauvegardé !');
  } else {
    header('Location:  index.php?action=showEditor&id=' . $id .'&errorMessage=Impossible de sauvegarder l\'article !');
  }
}

function addPost($title, $content) {
  $postManager = new PostManager();
  $isSuccessful = $postManager->add($title, htmlspecialchars($content));
  if($isSuccessful) {
    header('Location:  index.php?action=showEditor&id=' . $id . '&successMessage=Article sauvegardé !');
  } else {
    header('Location:  index.php?action=showEditor&id=' . $id .'&errorMessage=Impossible de sauvegarder l\'article !');
  }
}

function showEditor($id) {
  if($id > 0){
    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
  } else {
    $post = new Post(["title" => "Nouveau", "content" =>"<h1>Hello world</h1>"]);
  }
  require('view/backend/editorView.php');
}

