<?php

require_once("manager/Manager.php");

class CommentManager extends Manager {
  public function getComments($postId) {
    $db = $this->dbConnect();
    $comments = $db->prepare('SELECT id,author,content,responseId,date FROM comment WHERE postId = ? AND approved = 1 ORDER BY date DESC');
    $comments->execute(array($postId));
  
    return $comments;
  }
  
  public function postComment($postId, $author, $content, $responseId = null ) {
    $db = $this->dbConnect();
    $comments = $db->prepare('INSERT INTO comment(postId, author, content,responseId, date) VALUES(?,?,?,?,NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $content, $responseId));
  
    return $affectedLines;
  }
}
