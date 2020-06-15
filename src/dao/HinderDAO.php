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
    $sql = "SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` as `user_name`, `situations`.`name` as `situation_name`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectUserById($id) {
    $sql = "SELECT `name`, `email`,
	            (SELECT COUNT(`id`) FROM `experiences` WHERE `experiences`.`user_id` = :id) AS `experiences_count`,
              (SELECT SUM(`likes`) FROM `experiences` WHERE `experiences`.`user_id` = :id) AS `likes_count`
            FROM `users`
            WHERE `users`.`id` = :id;";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
