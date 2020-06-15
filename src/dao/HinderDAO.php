<?php

require_once( __DIR__ . '/DAO.php');

class HinderDAO extends DAO {

  public function selectAllSituations() {
    $sql = "SELECT * FROM `situations`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllExperiences() {
    $sql = "SELECT experiences.id, experiences.date, experiences.video, experiences.likes, users.name as username, situations.name as situationname
            FROM `experiences`
            INNER JOIN `users` ON experiences.user_id = users.id
            INNER JOIN `situations` ON experiences.situation_id = situations.id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
