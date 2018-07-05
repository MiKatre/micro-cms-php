<?php

require_once("model/manager/Manager.php");
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
      $comments[] = new Comment($commentData);
    }

    return $comments;
  }
  
  public function postComment(Comment $comment) {
    $comments = $this->_db->prepare('INSERT INTO comment(postId, author, email, content,responseId, date) VALUES(?,?,?,?,?,NOW())');
    $affectedLines = $comments->execute(array($comment->postId(), $comment->author(), $comment->email(), $comment->content(), $comment->responseId()));
  
    return $affectedLines;
  }

  public function flag($commentId) {
    $comment = $this->_db->prepare('UPDATE comment SET flagged = 1 WHERE id = ?');

    $affectedLines = $comment->execute(array($commentId));

    return $affectedLines;
  }

  public function delete(Comment $comment){}
}
