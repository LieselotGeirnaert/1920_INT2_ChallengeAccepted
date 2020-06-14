<?php

require_once( __DIR__ . '/DAO.php');

class HinderDAO extends DAO {

  public function selectAllSituations(){
    $sql = "SELECT * FROM `situations`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
