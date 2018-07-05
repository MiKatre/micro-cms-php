<?php
class User {
  private 
  $_id,
  $_name,
  $_email,
  $_hash;

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
  public function name(){return $this->_name;}
  public function email(){return $this->_email;}
  public function hash(){return $this->_hash;}

  // setter methods
  public function setId(int $id){
    if (!is_int($id)) {
      trigger_error('Wrong id type. Must be an integer', E_USER_WARNING);
      return;
    }
    $this->_id = (int) $id;
  }

  public function setName($name){
    $this->_name = $name;
  }
  public function setEmail($email){
    $this->_email = $email;
  }
  public function setHash($hash){
    $this->_hash = $hash;
  }
}