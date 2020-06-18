<?php

require_once( __DIR__ . '/DAO.php');

class HinderDAO extends DAO {

  public function selectAllSituations() {
    $sql = "SELECT * FROM `situations`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllExperiencesWithFilters($userid = false, $situation = false, $sort = false) {
    $bindValues = array();
    
    $sql = "SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
            LEFT OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`";
  
    if ($userid) {
      $sql .= " WHERE `experiences`.`user_id` = :userid";
      $bindValues[':userid'] = $userid;
    }

    if ($situation && !$userid) {
      $sql .= " WHERE `situations`.`id` = :situation";
      $bindValues[':situation'] = $situation;
    } else if ($situation && $userid) {
      $sql .= " AND `situations`.`id` = :situation";
      $bindValues[':situation'] = $situation;
    }
              
    $sql .= " GROUP BY `reviews`.`experience_id`";

    if (!empty($sort)) {
      if ($sort == false || $sort == "recent") {
        $sql .= " ORDER BY `experiences`.`date` DESC";
      } else if ($sort == "popularity") {
        $sql .= " ORDER BY `experiences`.`likes` DESC";
      } else if ($sort == "mostreviews") {
        $sql .= " ORDER BY `review_count` DESC";
      } else if ($sort == "bestreviews") {
        $sql .= " ORDER BY `rating_average` DESC";
      }
    }
  
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($bindValues);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectAllExperiencesByUserId($id) {
    $sql = "SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`likes`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
            LEFT OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
            WHERE `experiences`.`user_id` = :id
            GROUP BY `reviews`.`experience_id`
            ORDER BY `experiences`.`date` DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectExperienceById($id) {
    $sql = "SELECT `experiences`.`id`, `experiences`.`date`, `experiences`.`video`, `experiences`.`title`, `experiences`.`description`, `experiences`.`likes`, `users`.`id` AS `user_id`, `users`.`name` AS `user_name`, `situations`.`name` AS `situation_name`, COUNT(`reviews`.`id`) AS `review_count`, AVG(`reviews`.`rating`) AS `rating_average`
            FROM `experiences`
            INNER JOIN `users` ON `experiences`.`user_id` = `users`.`id`
            INNER JOIN `situations` ON `experiences`.`situation_id` = `situations`.`id`
            LEFT OUTER JOIN `reviews` ON `experiences`.`id` = `reviews`.`experience_id`
            WHERE `experiences`.`id` = :id
            GROUP BY `reviews`.`experience_id`";
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
            LEFT OUTER JOIN `experiences` ON `experiences`.`user_id` = `users`.`id`
            WHERE `users`.`id` = :id
            GROUP BY `users`.`id`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function updateLike($data) {
    $sql = "UPDATE `experiences` SET `likes`= :likes
            WHERE `id` = :experience_id"; 
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':likes', $data['likes']);
    $stmt->bindValue(':experience_id', $data['experience_id']);
    
    if($stmt->execute()){
      return $this->selectExperienceById($data['experience_id']);
    }
  }

  public function insertExperience($data) {
    $sql = "INSERT INTO `experiences`(`title`, `description`, `video`, `user_id`, `situation_id`) VALUES (:title, :description, :video, :user_id, :situation_id)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':title', $data['title']);
    $stmt->bindValue(':description', $data['description']);
    $stmt->bindValue(':video', $data['video']);
    $stmt->bindValue(':user_id', $data['user_id']);
    $stmt->bindValue(':situation_id', $data['situation_id']);
    
    if($stmt->execute()){
      return $this->selectExperienceById($this->pdo->lastInsertId());
    }
  }

  public function insertReview($data) {
    $sql = "INSERT INTO `reviews`(`rating`, `review`, `experience_id`, `user_id`) VALUES (:rating, :review, :experience_id, :user_id)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':rating', $data['rating']);
    $stmt->bindValue(':review', $data['review']);
    $stmt->bindValue(':experience_id', $data['experience_id']);
    $stmt->bindValue(':user_id', $data['user_id']);
    
    if($stmt->execute()){
      return $this->selectExperienceById($data['experience_id']);
    }
  }

  
}
