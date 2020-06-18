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
    
    $situation = false;
    if (!empty($_GET['situation'])) {
      if ($_GET['situation'] == 'all') {
        $situation = false;
      } else {
        $situation = $_GET['situation'];
      }
    }

    $sort = false;
    if (!empty($_GET['sort'])){
      $sort = $_GET['sort'];
    }

    $experiences = $this->hinderDAO->selectAllExperiencesWithFilters($userid = false, $situation, $sort);

    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'addLike') {
        $this->addLike('hinderoverzicht');
      }
    }

    $this->set('situations', $situations);
    $this->set('experiences', $experiences);
    $this->set('title', 'Hinderoverzicht');
  }

  public function hinderervaring() {
    if (!empty($_GET['id'])){
      $experience = $this->hinderDAO->selectExperienceById($_GET['id']);
      $reviews = $this->hinderDAO->selectAllReviewsByExperienceId($_GET['id']);

      if (empty($experience)){
        header('Location: index.php?page=hinderoverzicht');
        exit();
      }
    }

    if (!empty($_POST['action'])) {
      if ($_POST['action'] == 'addReview') {
        $this->addReview();
      } else if ($_POST['action'] == 'addLike') {
        $this->addLike('hinderervaring');
      }
    }
    
    $this->set('experience', $experience);
    $this->set('reviews', $reviews);
    $this->set('title', 'Hinderervaring');
  }

  public function profiel() {
    if (empty($_SESSION['user'])) {
      header('location:index.php?page=login');
    } else {
      $userinfo = $this->hinderDAO->selectUserById($_SESSION['user']['id']);
      $situations = $this->hinderDAO->selectAllSituations();

      $situation = false;
      if (!empty($_GET['situation'])) {
        if ($_GET['situation'] == 'all') {
          $situation = false;
        } else {
          $situation = $_GET['situation'];
        }
      }

      $sort = false;
      if (!empty($_GET['sort'])){
        $sort = $_GET['sort'];
      }

      $userid = $_SESSION['user']['id'];
      $experiences = $this->hinderDAO->selectAllExperiencesWithFilters($userid, $situation, $sort);

      if (!empty($_POST['action'])) {
       if ($_POST['action'] == 'addLike') {
          $this->addLike('profiel');
        }
      }

      $this->set('userinfo', $userinfo);
      $this->set('situations', $situations);
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
    }
  }

  public function addReview() {
    if (!empty($_POST)) {
      $errors = $this->validateReview();

      if (empty($errors)) {
        $data = array(
          'rating' => $_POST['rating'],
          'review' => $_POST['review'],
          'user_id' => $_SESSION['user']['id'],
          'experience_id' => $_POST['experience_id'],
        );

        $reviewId = $this->hinderDAO->insertReview($data);
        
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

