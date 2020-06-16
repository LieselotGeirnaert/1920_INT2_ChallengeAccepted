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

  public function selectAllExperiencesByUserId($id) {
    $sql = "SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
            WHERE `experiences`.`user_id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectExperienceById($id) {
    $sql = "SELECT `experiences`.`id`, `experiences`.`title`, `experiences`.`description`, `experiences`.`video`, `experiences`.`likes`, `situations`.`name` AS `situation_name`, `users`.`name`AS `user_name`, `users`.`id`AS `user_id`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id` 
            WHERE `experiences`.`id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function selectAllReviewsByExperienceId($id) {
    $sql = "SELECT `reviews`.`rating`, `reviews`.`review`, `users`.`name`
            FROM `reviews`
            INNER JOIN `users` ON `reviews`.`user_id` = `users`.`id`
            WHERE `reviews`.`experience_id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectUserById($id) {
    $sql = "SELECT `users`.`name`, `users`.`email`, COUNT(`experiences`.`id`) AS `experiences_count`, SUM(`experiences`.`likes`) AS `likes_count`
            FROM `users`
            INNER JOIN `experiences` ON `experiences`.`user_id` = `users`.`id`
            WHERE `users`.`id` = :id
            GROUP BY `users`.`id`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insertReview($data) {
    $sql = "INSERT INTO `reviews`(`rating`, `review`, `experience_id`, `user_id`) VALUES (:rating, :review, :experience_id, :user_id)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':rating', $data['rating']);
    $stmt->bindValue(':review', $data['review']);
    $stmt->bindValue(':experience_id', $data['experience_id']);
    $stmt->bindValue(':user_id', $data['user_id']);
    if($stmt->execute()){
      return $this->selectExperienceById($this->pdo->lastInsertId());
    }
  }

  
}
