<?php

require_once( __DIR__ . '/DAO.php');

class EpisodeDAO extends DAO {

  public function selectAllEpisodes(){
    $sql = "SELECT * FROM `int2_episodes` ORDER BY `season`,`nr` ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectEpisodesBySeason($season){
    $sql = "SELECT * FROM `int2_episodes` WHERE `season`= :season ORDER BY `nr` ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':season',$season);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectById($id){
    $sql = "SELECT * FROM `int2_episodes` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function selectSeasons(){
    $sql = "SELECT DISTINCT `season` FROM `int2_episodes` ORDER BY `season`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
