<?php 
require_once('model/manager/PostManager.php');
require_once('model/manager/CommentManager.php');
require_once('model/Comment.php');

function listPosts() {
  $postManager = new PostManager();
  $posts = $postManager->getPosts();

  require('view/frontend/listPostsView.php');
}

function post() {
  $postManager = new PostManager();
  $commentManager = new CommentManager();

  $post = $postManager->getPost($_GET['id']);
  $comments = $commentManager->getComments($_GET['id']);

  require('view/frontend/postView.php');
}

function addComment($postId, $author, $email, $content, $responseId) {

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

function flagComment($commentId, $postId, $status) {
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