<?php

require_once __DIR__ . '/Controller.php';

// require_once __DIR__ . '/../dao/ActivityDAO.php';
// require_once __DIR__ . '/../dao/OrderDAO.php';


class PagesController extends Controller {

  function __construct() {
    // $this->activityDAO = new ActivityDAO();
    // $this->orderDAO = new OrderDAO();
  }

  public function home () {
    $this->set('title', 'Home');
  }

  public function hoehinderen () {
    $this->set('title', 'Hoe hinderen');
  }

  public function hinderoverzicht () {
    $this->set('title', 'Hinderoverzicht');
  }

   public function hinderdetail () {
    $this->set('title', 'Hinderervaring');
  }

  public function profiel () {
    $this->set('title', 'Profiel');
  }

  public function hinderen () {
    $this->set('title', 'Begin met hinderen');
  }

  public function maakervaring () {
    $this->set('title', 'Maak een hinderervaring');
  }
}
