<?php 
class Comment {
  private $_id,
          $_postId,
          $_author,
          $_content,
          $_email,
          $_date,
          $_responseId,
          $_approved;


  public function __construct($data = null){
    if(!empty($data)) {
      $this->hydrate($data);
    }
  }
  
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
  public function email(){return $this->_email;}
  public function date(){return $this->_date;}
  public function responseId(){return $this->_responseId;}
  public function approved(){return $this->_approved;}

  // setter methods
  public function setId($id){
    // if (!is_int($id)) {
    //   trigger_error('Wrong id type. Must be an integer', E_USER_WARNING);
    //   return;
    // }
    $this->_id = $id;
  }
  public function setPostId(int $postId){
    if (!is_int($postId)) {
      trigger_error('Wrong id type. Must be an integer', E_USER_WARNING);
      return;
    }
    $this->_postId = $postId;
  }
  public function setAuthor($author){
    if(!is_string($author)){
      trigger_error('Wrong author type. Must be a string', E_USER_WARNING);
      return;
    }
    $this->_author = $author;
  }
  public function setContent($content){
    if(!is_string($content)){
      trigger_error('Wrong content type. Must be a string', E_USER_WARNING);
      return;
    }
    $this->_content = $content;
  }
  public function setEmail($email){
    if(!is_string($email)){
      trigger_error('Wrong email type. Must be a string', E_USER_WARNING);
      return;
    }
    $this->_email = $email;
  }
  public function setDate($date){
    if(!is_string($date)){
      trigger_error('Wrong date type. Must be a string', E_USER_WARNING);
      return;
    }
    $this->_date = $date;
  }
  public function setResponseId($responseId){
    if ($responseId == null || (int) $responseId == 0) {
      $this->_responseId = null;
    } elseif(is_int($responseId)){
      $this->_responseId = $responseId;
    } elseif(is_int( (int) $responseId)) {
      $this->_responseId = (int) $responseId;
    } else {
      trigger_error('Wrong ResponseId type. Must be null or int', E_USER_WARNING);
      return;
    }
  }
  public function setApproved($approved){
    $this->_approved = $approved;
  }
}

// Typechecking date