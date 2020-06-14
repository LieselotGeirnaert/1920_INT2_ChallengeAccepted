<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/HinderDAO.php';
require_once __DIR__ . '/../dao/EpisodeDAO.php';


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
    $this->set('title', 'Hinderoverzicht');
  }

   public function hinderdetail () {
    $this->set('title', 'Hinderervaring');
  }

  public function profiel () {
    $this->set('title', 'Profiel');
  }

  public function hindersituaties () {
    $situations = $this->hinderDAO->selectAllSituations();
    $this->set('situations', $situations);
    $this->set('title', 'Begin met hinderen');

  }

  public function maakervaring () {
    $this->set('title', 'Maak een hinderervaring');
  }
}
