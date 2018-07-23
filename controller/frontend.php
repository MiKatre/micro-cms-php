<?php 
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/Comment.php');
require_once('configConst.php');

class FrontendController {

  public function listPosts() {
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
  
    require('view/frontend/listPostsView.php');
  }
  
  public function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
  
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
  
    require('view/frontend/postView.php');
  }
  
  public function showAbout() {
    require('view/frontend/aboutView.php');
  }
  
  public function showBlog($currentPage = 1) {
    $postManager = new PostManager();
    $totalRows = $postManager->countPublishedPosts();
    $itemsPerPage = POSTS_PER_PAGE_ON_BLOG;
    $totalPages = ceil($totalRows / $itemsPerPage);
    $currentPage = min($currentPage, $totalPages);
    $offset = ($currentPage - 1) * $itemsPerPage;
  
    $start = $offset + 1;
    $end = min(($offset + $itemsPerPage), $totalRows);
  
    $paginationInfo = '<div class="text-muted small"> Page ' . $currentPage . '/' . $totalPages . '.  Articles ' . $start . ' à ' . $end . ' sur ' . $totalRows . ' </div> ';
   
    $posts = $postManager->getPublishedPostsPaginated($itemsPerPage, $offset);
  
    $url = 'index.php?action=showBlog';
    require('view/frontend/blogView.php');
  }
  
  public function addComment($postId, $author, $email, $content, $responseId) {
  
    $commentData = compact('postId', 'author', 'email', 'content', 'responseId');
    $comment = new Comment($commentData);
    $commentManager = new CommentManager();
  
    $affectedLines = $commentManager->postComment($comment); // return int or false
    if ($affectedLines == false) {
      die('impossible d\'ajouter le commentaire !');
      throw new Exception('impossible d\'ajouter le commentaire !');
    } else {
      header('Location:  index.php?action=post&id=' . $postId .'&successMessage=Votre commentaire a été publié');
    }
  }
  
  public function flagComment($commentId, $postId, $status) {
    $commentManager = new CommentManager();
  
    $status = (int) $status;
  
    if ($status == 0) {
      $affectedLines = $commentManager->flag($commentId);
    
      if ($affectedLines == false) {
        die('impossible de signaler le commentaire !');
        throw new Exception('impossible de signaler le commentaire!');
      } else {
        header('Location:  index.php?action=post&id=' . $postId .'&successMessage=Le commentaire a été signalé');
      }
    } else {
      header('Location:  index.php?action=post&id=' . $postId .'&successMessage=Le commentaire a déjà été signalé');
    }
  
  }
  
} 
