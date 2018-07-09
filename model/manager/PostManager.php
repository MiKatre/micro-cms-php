<?php 

require_once("model/manager/Manager.php");
require_once("model/Post.php");


class PostManager extends Manager{
  private $_db;

  public function __construct(){
    $db = $this->dbConnect();
    $this->_db = $db;
  }

  public function getPosts($status = 1) {
    $posts = [];
    if (is_int($status)) {
      $query = $this->_db->prepare('SELECT id,title,content,status,date FROM post WHERE status = ? ORDER BY id DESC LIMIT 5');
      $query->execute(array($status));
    } else {
      $query = $this->_db->query('SELECT id,title,content,status,date FROM post ORDER BY id DESC LIMIT 5');
    }
    
    while ($postData = $query->fetch()) {
      $posts[] = new Post($postData);
    }

    return $posts;
  }
  
  public function getPost($postId) {
    $req = $this->_db->prepare('SELECT id,title,content,date FROM post WHERE id = ?');
    $req->execute(array($postId));
    $postData = $req->fetch();
    return new Post($postData);
  }
  
  public function update($id, $status){
    $post = $this->_db->prepare('UPDATE post SET status = ? WHERE id = ?');
    $affectedLines = $post->execute(array($status, $id));

    return $affectedLines;
  }

  public function add(Post $post){}
  public function delete(Post $post){}
}