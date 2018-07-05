<?php

require_once('model/manager/Manager.php');

class UserManager extends Manager {
  private $_db;

  public function __construct(){
    $db = $this->dbConnect();
    $this->_db = $db;
  }

  public function login($email){
    $req = $this->_db->prepare('SELECT * FROM user WHERE email = ?');
    $req->execute(array($email));
    $user = $req->fetch();

    return $user;
  }
}