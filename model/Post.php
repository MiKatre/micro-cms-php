<?php 

class Post {
  private $_id;
  private $_title;
  private $_content;
  private $_date;
  private $_published;

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
  public function published(){return $this->_published;}
  public function date(){return $this->_date;}

  // setter methods
  public function setId($id){
    $this->_id = $id;
  }
  public function setTitle($title){
    $this->_title = $title;
  }
  public function setContent($content){
    $this->_content = $content;
  }
  public function setDate($date){
    $this->_date = $date;
  }
  public function setPublished($published){
    $this->_published = $published;
  }
}