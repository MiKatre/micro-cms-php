<?php

abstract class Manager {
  protected function dbConnect() {
    $db = new PDO('mysql:host=localhost;dbname=projet-3', 'root', 'root');
    return $db;
  }
}