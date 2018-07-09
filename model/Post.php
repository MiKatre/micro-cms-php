<?php 

class Post {
  private $_id,
          $_title,
          $_content,
          $_date,
          $_status;

  public function __construct(array $data = null) {
    if (!empty($data)) {
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
  public function title(){return $this->_title;}
  public function content(){return $this->_content;}
  public function status(){return $this->_status;}
  public function date(){return $this->_date;}
  public function excerpt($startPos = 0, $maxLength= 134){
    $str =$this->_content;
    if(strlen($str) > $maxLength) {
      $excerpt   = substr($str, $startPos, $maxLength);
      $lastSpace = strrpos($excerpt, ' ');
      $excerpt   = substr($excerpt, 0, $lastSpace);
      $excerpt  .= '...';
    } else {
      $excerpt = $str;
    }
    return $excerpt;
  }

  // setter methods
  public function setId(int $id){
    if (!is_int($id)) {
      trigger_error('Wrong id type. Must be an integer', E_USER_WARNING);
      return;
    }
    $this->_id = $id;
  }
  public function setTitle($title){
    if (!is_string($title)) {
      trigger_error('Wrong title type. Must be a string', E_USER_WARNING);
    }
    $this->_title = $title;
  }
  public function setContent($content){
    if (!is_string($content)) {
      trigger_error('Wrong content type. Must be a string', E_USER_WARNING);
    }
    $this->_content = $content;
  }
  public function setDate($date){
    if(!is_string($date)){
      trigger_error('Wrong date format. Must be a string', E_USER_WARNING);
      return;
    }
    $this->_date = $date;
  }
  public function setStatus(int $status){
    if (!is_int($status)) {
      trigger_error('Wrong type (status). Must be an int', E_USER_WARNING);
    }
    $this->_status = $status;
  }
}