<?php

require_once("model/Manager.php");

class CommentManager extends Manager {
  public function getComments($postId) {
    $db = $this->dbConnect();
    $comments = $db->prepare('SELECT id,author,content,responseId, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS date_fr FROM comment WHERE postId = ? AND approved = 1 ORDER BY date DESC');
    $comments->execute(array($postId));
  
    return $comments;
  }
  
  public function postComment($postId, $author, $content) {
    $db = $this->dbConnect();
    $comments = $db->prepare('INSERT INTO comment(postId, author, content,responseId, date) VALUES(?,?,?,?,NOW())');
    $affectedLines = $comments->execute(array($postId, $author, $content, null));
  
    return $affectedLines;
  }
}
