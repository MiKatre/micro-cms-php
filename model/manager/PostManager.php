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
      $query = $this->_db->prepare('SELECT id,title,content,status,date FROM post WHERE status != ? ORDER BY id DESC LIMIT 5');
      $query->execute(array(2));
    }
    
    while ($postData = $query->fetch()) {
      $posts[] = new Post($postData);
    }

    return $posts;
  }
  
  public function getTotalPosts(){
    return $this->_db->query('SELECT COUNT(*) FROM post WHERE status != 2')->fetchColumn();
  }

  public function getAllPostsPaginated($itemsPerPage, $offset){
  $query = $this->_db->prepare('SELECT * FROM post WHERE status != 2 ORDER BY date LIMIT :limit OFFSET :offset');

  // Bind the query params
  $query->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
  $query->bindParam(':offset', $offset, PDO::PARAM_INT);
  $query->execute();
  
  $posts = [];
  
  while($postData = $query->fetch()) {
    $posts[] = new Post($postData);
  }
  
  return $posts;
}

  public function getPost($postId) {
    $req = $this->_db->prepare('SELECT id,title,content,date, status FROM post WHERE id = ?');
    $req->execute(array($postId));
    $postData = $req->fetch();
    return new Post($postData);
  }

  
  public function update($id, $status, $title = null, $content = null){
    // Publish, darft or delete
    if (empty($title) && empty($content)) {
      $post = $this->_db->prepare('UPDATE post SET status = ? WHERE id = ?');
      $affectedLines = $post->execute(array($status, $id));
    }
    // Update the content 
    else if (!empty($title) && !empty($content)) {
      $post = $this->_db->prepare('UPDATE post SET title = ?, content = ? WHERE id = ?');
      $affectedLines = $post->execute(array($title, $content, $id));
    }

    return $affectedLines;
  }

  public function add($title, $content){
    $post = $this->_db->prepare('INSERT INTO post (title, content) VALUES(?,?)');
    $affectedLines = $post->execute(array($title, $content));
    
    if($affectedLines) {
      return $this->_db->lastInsertId();
    } else {
      return false;
    }
  }

  public function delete(Post $post){}
}