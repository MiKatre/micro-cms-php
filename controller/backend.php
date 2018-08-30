<?php
require_once('model/manager/CommentManager.php');
require_once('model/manager/PostManager.php');
require_once('model/manager/UserManager.php');
require_once('model/User.php');
require_once('model/Post.php');
require_once('configConst.php');

class BackendController {
  public function showLogin(){
    session_start();

    if (isset($_COOKIE['name']) && !empty($_COOKIE['name'])) {
      $_SESSION['name'] = $_COOKIE['name'];
      $_SESSION['email'] = $_COOKIE['email'];
      $_SESSION['hash'] = $_COOKIE['hash'];
    }

    if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
      header('Location:  index.php?action=showDashboard');
    }
  
    require('view/backend/loginView.php');
  }
  
  public function login($email, $password, $rememberMe = false) {
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
  
  public function logout() {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 365*24*3600,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
      setcookie("name", "", time()-3600);
      setcookie("email", "", time()-3600);
      setcookie("hash", "", time()-3600);
    }
    session_destroy();
    header('Location:  index.php?');
  }
  
  public function showDashboard() {
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
  
  public function showPosts() {
    session_start();
  
    if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
      header('Location:  index.php?action=showLogin&errorMessage=Vous devez vous connecter pour avoir accès à cette page !');
    }
  
    $postManager = new PostManager();
    $posts = $postManager->getPosts('all'); // A non int value
  
    require('view/backend/postsView.php');
  }
  
  
  public function showPaginatedComments($currentPage = 1) {
    $commentManager = new CommentManager();
    $totalRows = $commentManager->getTotalComments();
    $itemsPerPage = COMMENTS_PER_PAGE_ON_DASHBOARD;
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
  
  public function showPaginatedPosts($currentPage = 1) {
    $postManager = new PostManager();
    $totalRows = $postManager->getTotalPosts();
    $itemsPerPage = POSTS_PER_PAGE_ON_DASHBOARD;
    $totalPages = ceil($totalRows / $itemsPerPage);
    $currentPage = min($currentPage, $totalPages);
    $offset = ($currentPage - 1) * $itemsPerPage;
  
    $start = $offset + 1;
    $end = min(($offset + $itemsPerPage), $totalRows);
  
    $paginationInfo = ' Page ' . $currentPage . ' sur ' . $totalPages . '.  Résultats ' . $start . ' à ' . $end . ' sur un total de ' . $totalRows . ' articles ';
  
    $posts = $postManager->getAllPostsPaginated($itemsPerPage, $offset);
  
    $url = 'index.php?action=showDashboardPosts';
    require('view/backend/postsView.php');
  }
  
  public function updateComment($commentId, $status, $url) {
    $commentManager = new CommentManager();
    $isSuccessful = $commentManager->status($commentId, $status);
    if($isSuccessful) {
      header('Location:  ' . $url . '&successMessage=Status du commentaire mis à jour !');
    } else {
      header('Location:  ' . $url . '&errorMessage=Impossible de mettre à jour le commentaire !');
    }
  }
  
  public function updatePostStatus($id, $status, $return) {
    $postManager = new PostManager();
    $isSuccessful = $postManager->update($id, $status, '', '');
    if($isSuccessful) {
      header('Location:  index.php?action=' . $return . '&id=' . $id . '&successMessage=Status modifié !');
    } else {
      header('Location:  index.php?action=' . $return . '&id=' . $id . '&errorMessage=Impossible de modifier le status de l\'article !');
    }
  }
  
  public function updatePostContent($id, $title, $content) {
    $postManager = new PostManager();
    $isSuccessful = $postManager->update($id, '', $title, htmlspecialchars($content));
    if($isSuccessful) {
      header('Location:  index.php?action=showEditor&id=' . $id . '&successMessage=Article sauvegardé !');
    } else {
      header('Location:  index.php?action=showEditor&id=' . $id .'&errorMessage=Impossible de sauvegarder l\'article !');
    }
  }
  
  public function addPost($title, $content) {
    $postManager = new PostManager();
    $postId = $postManager->add($title, htmlspecialchars($content));
    
    if($postId) {
      header('Location:  index.php?action=showEditor&id=' . $postId . '&successMessage=Article sauvegardé !');
    } else {
      header('Location:  index.php?action=showEditor&id=' . $postId .'&errorMessage=Impossible de sauvegarder l\'article !');
    }
  }

  public function deletePost($id, $return) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $isSuccessful = $postManager->delete($id);
    // If query is successful delete all associated comments
    if($isSuccessful) {
      $isCommentSuccessful = $commentManager->delete($id);
      if ($isCommentSuccessful) {
        header('Location:  index.php?action=' . $return . '&id=' . $id . '&successMessage=L\'article a été supprimé !');
      } else {
        header('Location:  index.php?action=' . $return . '&id=' . $id . '&errorMessage=Impossible de supprimer les commentaires associés à cet article.');
      }
    } else {
      header('Location:  index.php?action=' . $return . '&id=' . $id . '&errorMessage=Impossible de supprimer cet article !');
    }
  }
  
  public function showEditor($id) {
    if($id > 0){
      $postManager = new PostManager();
      $post = $postManager->getPost($_GET['id']);
    } else {
      $post = new Post(["title" => "Nouveau", "content" =>"<h1>Hello world</h1>"]);
    }
    require('view/backend/editorView.php');
  }

}  
