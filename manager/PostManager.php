<?php 

require_once("manager/Manager.php");
require_once("model/Post.php");


class PostManager extends Manager{
  private $_db;

  public function __construct(){
    $db = $this->dbConnect();
    $this->_db = $db;
  }

  public function getPosts() {
    $posts = [];
    $query = $this->_db->query('SELECT id,title,content,published,date FROM post WHERE published = 1 ORDER BY id DESC LIMIT 5');
    
    while ($postData = $query->fetch()) {
      $posts[] = new Post($postData);
    }

    return $posts;
  }
  
  public function getPost($postId) {
    $req = $this->_db->prepare('SELECT id,title,content,date FROM post WHERE id = ?');
    $req->execute(array($postId));
    $postData = $req->fetch();
    $post = new Post();
    $post->hydrate($postData);
    return $post;
  }
}