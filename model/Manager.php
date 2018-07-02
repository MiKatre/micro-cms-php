<?php

class Manager {
  protected function dbConnect() {
    $db = new PDO('mysql:host=localhost;dbname=oc_cours_blog', 'root', 'root');
    return $db;
  }
}