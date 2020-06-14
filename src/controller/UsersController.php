<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/UserDAO.php';

class UsersController extends Controller
{

  private $userDAO;

  function __construct() {
    $this->userDAO = new UserDAO();
  }

  public function login() {
    if (!empty($_POST)) {
      $errors = array();

      if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $existing = $this->userDAO->selectByEmail($_POST['email']);
        if (!empty($existing)) {
          if (password_verify($_POST['password'], $existing['password'])) {
            $_SESSION['user'] = $existing;
            $_SESSION['info'] = 'aangemeld';
            header('location:index.php?page=profiel');
            exit();
          } else {
            $errors['email'] = 'Emailadres en/of paswoord kloppen niet';
            $errors['password'] = 'Emailadres en/of paswoord kloppen niet';
          }
        } else {
          $errors['email'] = 'Emailadres en/of paswoord kloppen niet';
          $errors['password'] = 'Emailadres en/of paswoord kloppen niet';
        }
      } else {
        if (empty($_POST['email'])) {
          $errors['email'] = 'Gelieve jouw emailadres in te vullen';
        }
        if (empty($_POST['password'])) {
          $errors['password'] = 'Gelieve jouw wachtwoord in te vullen';
        }
      }

      $_SESSION['error'] = 'Oeps, er ging iets mis!';
      $this->set('errors', $errors);  
    }
  }

  public function logout() {
    if (!empty($_SESSION['user'])) {
      unset($_SESSION['user']);
    }
    $_SESSION['info'] = 'Logged Out';
    header('location:index.php');
    exit();
  }

  public function registreer() {
    if (!empty($_POST)) {
      $errors = array();

      if (empty($_POST['name'])) {
        $errors['name'] = 'Gelieve een naam in te vullen';
      }
      if (empty($_POST['email'])) {
        $errors['email'] = 'Gelieve een emailadres in te vullen';
      } else {
        $existing = $this->userDAO->selectByEmail($_POST['email']);
        if (!empty($existing)) {
          $errors['email'] = 'Sorry, dit emailadres is al in gebruik';
        }
      }
      if (empty($_POST['password'])) {
        $errors['password'] = 'Gelieve een paswoord in te vullen';
      }
      if ($_POST['confirm_password'] != $_POST['password']) {
        $errors['confirm_password'] = 'Paswoorden komen niet overeen';
      }
      if (empty($errors)) {
        $inserteduser = $this->userDAO->insert(array(
          'name' => $_POST['name'],
          'email' => $_POST['email'],
          'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ));
        if (!empty($inserteduser)) {
          $_SESSION['info'] = 'Registratie gelukt!';
          header('location:index.php');
          exit();
        }
      }
      $_SESSION['error'] = 'Oeps, er ging iets mis!';
      $this->set('errors', $errors);
    }
  }
}
