<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/HinderDAO.php';


class PagesController extends Controller {

  function __construct() {
    $this->hinderDAO = new HinderDAO();
  }

  // pages
  public function home() {
    $this->set('title', 'Home');
  }

  public function hoehinderen() {
    $this->set('title', 'Hoe hinderen');
  }

  public function hinderoverzicht () {
    $situations = $this->hinderDAO->selectAllSituations();
    $experiences = $this->hinderDAO->selectAllExperiences();

    $this->addLike('hinderoverzicht');

    $this->set('situations', $situations);
    $this->set('experiences', $experiences);
    $this->set('title', 'Hinderoverzicht');
  }

  public function hinderervaring() {
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
          if (empty($this->validateReview())) {
            $reviewId = $this->hinderDAO->insertReview($_POST);
            
            if ($reviewId) {
              $_SESSION['info'] = 'Bedankt voor je recensie';
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

    $this->addLike('hinderervaring');

    $this->set('experience', $experience);
    $this->set('reviews', $reviews);
    $this->set('title', 'Hinderervaring');
  }

  public function profiel() {
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=login');
    } else {
      $userinfo = $this->hinderDAO->selectUserById(1);
      $experiences = $this->hinderDAO->selectAllExperiencesByUserId(1);
      
      $this->addLike('profiel');

      $this->set('userinfo', $userinfo);
      $this->set('experiences', $experiences);
      $this->set('title', 'Profiel');
    }
  }

  public function hindersituaties() {
    $situations = $this->hinderDAO->selectAllSituations();

    $this->set('situations', $situations);
    $this->set('title', 'Begin met hinderen');
  }

  public function maakervaring() {
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=login');
    } else {
      $this->set('title', 'Maak een hinderervaring');
    }
  }

  // functions
  public function addLike($page) {
    if(!empty($_POST['action'])) {
      if($_POST['action'] == 'addLike'){
        if (!empty($_POST)) {
          $data = array(
            'likes' => $_POST['likes'] + 1,
            'experience_id' => $_POST['experience_id'],
          );

          $experience = $this->hinderDAO->updateLike($data);
            
          if ($experience) {
            if ($page === 'hinderervaring') {
              header('Location:index.php?page=' . $page . '&id=' . $data['experience_id']);
            } else {
              header('Location:index.php?page=' . $page);
            }
            exit();
          } else {
            $_SESSION['error'] = 'Oeps, er ging iets mis!';
          }
          $_SESSION['error'] = 'Oeps, er ging iets mis!';
        }
      }
    }
  }

  public function validateReview() {
    $errors = array();
        
    if (empty($_POST['rating'])) {
      $errors['rating'] = 'Gelieve een rating in te vullen';
    }
    if (empty($_POST['review'])) {
      $errors['review'] = 'Gelieve een recensie in te vullen';
    }

    return $errors;
  }
}

