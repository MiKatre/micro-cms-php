<?php 

require_once("model/Manager.php");

class PostManager extends Manager{
  
  public function getPosts() {
    $db = $this->dbConnect();
    $req = $db->query('SELECT id,title,content,published,date FROM post WHERE published = 1 ORDER BY id DESC LIMIT 5');
    
    return $req;
  }
  
  public function getPost($postId) {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id,title,content,date FROM post WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();
    
    return $post;
  }
}