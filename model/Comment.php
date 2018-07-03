<?php 

class Comment {
  private $_id;
  private $_postId;
  private $_author;
  private $_content;
  private $_date;
  private $_responseId;
  private $_approved;

  public function hydrate(array $data) {
    foreach($data as $key => $value) {
      $method = 'set'.ucfirst($key);
      
      if (method_exists($this, $method )) {
        $this->$method($value);
      }
    }
  }

  // getter methods
  public function id(){return $this->_id;}
  public function postId(){return $this->_postId;}
  public function author(){return $this->_author;}
  public function content(){return $this->_content;}
  public function date(){return $this->_date;}
  public function responseId(){return $this->_responseId;}
  public function approved(){return $this->_approved;}

  // setter methods
  public function setId($id){
    $this->_id = $id;
  }
  public function setPostId($_postId){
    $this->_postId = $postId;
  }
  public function setAuthor($author){
    $this->_author = $author;
  }
  public function setContent($content){
    $this->_content = $content;
  }
  public function setDate($date){
    $this->_date = $date;
  }
  public function setResponseId($responseId){
    $this->_responseId = $responseId;
  }
  public function setApproved($approved){
    $this->_approved = $approved;
  }
}