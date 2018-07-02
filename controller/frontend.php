<?php 
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

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

function addComment($postId, $author, $comment) {

  $commentManager = new CommentManager();

  $affectedLines = $commentManager->postComment($postId, $author, $comment); // retunr int or false
  if ($affectedLines == false) {
    die('impossible d\'ajouter le commentaire !');
    throw new Exception('impossible d\'ajouter le commentaire !');
  } else {
    header('Location:  index.php?action=post&id=' . $postId);
  }
}