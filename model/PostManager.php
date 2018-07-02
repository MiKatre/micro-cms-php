<?php 

require_once("model/Manager.php");

class PostManager extends Manager{
  
  public function getPosts() {
    $db = $this->dbConnect();
    $req = $db->query('SELECT id,title,content,published, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i \') AS date_fr FROM post WHERE published = 1 ORDER BY id DESC LIMIT 5');
    
    return $req;
  }
  
  public function getPost($postId) {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id,title,content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i \') AS date_fr FROM post WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();
    
    return $post;
  }
}