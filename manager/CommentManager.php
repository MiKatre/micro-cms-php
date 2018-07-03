<?php

require_once("manager/Manager.php");
require_once("model/Comment.php");

class CommentManager extends Manager {
  private $_db;

  public function __construct(){
    $db = $this->dbConnect();
    $this->_db = $db;
  }

  public function getComments($postId) {
    $comments = [];
    $query = $this->_db->prepare('SELECT id,author,content,responseId,date FROM comment WHERE postId = ? AND approved = 1 ORDER BY date DESC');
    $query->execute(array($postId));
  
    while($commentData = $query->fetch()){
      $comment = new Comment();
      $comment->hydrate($commentData);
      $comments[] = $comment;
    }

    return $comments;
  }
  
  public function postComment($postId, $author, $content, $responseId = null ) {
    $comments = $this->_db->prepare('INSERT INTO comment(postId, author, content,responseId, date) VALUES(?,?,?,?,NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $content, $responseId));
  
    return $affectedLines;
  }
}
