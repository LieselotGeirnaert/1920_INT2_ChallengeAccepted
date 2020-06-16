<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/HinderDAO.php';


class PagesController extends Controller {

  function __construct() {
    $this->hinderDAO = new HinderDAO();
  }

  public function home () {
    $this->set('title', 'Home');
  }

  public function hoehinderen () {
    $this->set('title', 'Hoe hinderen');
  }

  public function hinderoverzicht () {
    $situations = $this->hinderDAO->selectAllSituations();
    $experiences = $this->hinderDAO->selectAllExperiences();

    $this->set('situations', $situations);
    $this->set('experiences', $experiences);
    $this->set('title', 'Hinderoverzicht');
  }

  public function hinderervaring () {
    if(!empty($_GET['id'])){
      $experience = $this->hinderDAO->selectExperienceById($_GET['id']);
      $reviews = $this->hinderDAO->selectAllReviewsByExperienceId($_GET['id']);
    }
    if(empty($experience)){
      header('Location: index.php?page=hinderoverzicht');
      exit();
    }

    if(!empty($_POST['action'])) {
      if($_POST['action'] == 'addReview'){
        if (!empty($_POST)) {
          $errors = array();
        
          if (empty($_POST['rating'])) {
            $errors['rating'] = 'Gelieve een rating in te vullen';
          }
          if (empty($_POST['review'])) {
            $errors['review'] = 'Gelieve een recensie in te vullen';
          }

          if (empty($errors)) {
            $reviewId = $this->hinderDAO->insertReview($_POST);
            if ($reviewId) {
              var_dump($reviewId);
              $_SESSION['info'] = 'Bedankt voor je quote';
              header('Location:index.php?page=hinderervaring&id=' . $_GET['id']);
              exit();
            } else {
              $_SESSION['error'] = 'Oeps, er ging iets mis!';
            }
          }
          $_SESSION['error'] = 'Oeps, er ging iets mis!';
          $this->set('errors', $errors);
        }
      }
    }

    $this->set('experience', $experience);
    $this->set('reviews', $reviews);
    $this->set('title', 'Hinderervaring');
  }

  public function profiel () {
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=login');
    } else {
      $userinfo = $this->hinderDAO->selectUserById(1);
      $experiences = $this->hinderDAO->selectAllExperiencesByUserId(1);
      
      $this->set('userinfo', $userinfo);
      $this->set('experiences', $experiences);
      $this->set('title', 'Profiel');
    }
  }

  public function hindersituaties () {
    $situations = $this->hinderDAO->selectAllSituations();
    $this->set('situations', $situations);
    $this->set('title', 'Begin met hinderen');

  }

  public function maakervaring () {
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=login');
    } else {
      $this->set('title', 'Maak een hinderervaring');
    }
  }

  public function maakrecensie () {
    
  }
}

