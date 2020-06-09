<?php

require_once __DIR__ . '/Controller.php';

require_once __DIR__ . '/../dao/EpisodeDAO.php';
require_once __DIR__ . '/../dao/QuoteDAO.php';

class EpisodesController extends Controller {

  function __construct() {
    $this->episodeDAO = new EpisodeDAO();
    $this->quoteDAO = new QuoteDAO();
  }

  public function index() {
    if(empty($_GET['season']) || $_GET['season'] === 'all'){
      $episodes = $this->episodeDAO->selectAllEpisodes();
    }else{
      $episodes = $this->episodeDAO->selectEpisodesBySeason($_GET['season']);
    }

    if(empty($episodes)){
      $episodes = $this->episodeDAO->selectAllEpisodes();
    }

    if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
      echo json_encode($episodes);
      exit();
    }

    $this->set('episodes', $episodes);
    $this->set('seasons',$this->episodeDAO->selectSeasons());
    $this->set('title', 'Home');
  }

  public function detail() {
    if(!empty($_GET['id'])){
      $episode = $this->episodeDAO->selectById($_GET['id']);
    }

    if(empty($episode)){
      $_SESSION['error'] = 'De aflevering werd niet gevonden';
      header('Location:index.php');
      exit();
    }

    if(!empty($_POST['action'])){
      if($_POST['action'] == 'insertQuote'){
        $insertedQuote = $this->quoteDAO->insertQuote($_POST);
        if(!$insertedQuote){
          $errors = $this->quoteDAO->validate($_POST);
          $this->set('errors',$errors);
        }else{
          $_SESSION['info'] = 'Bedankt voor je quote';
          header('Location:index.php?page=detail&id=' . $_GET['id']);
          exit();
        }
      }
    }

    $this->set('episode',$episode);
    $this->set('quotes',$this->quoteDAO->selectQuotesByEpisode($_GET['id']));
    $this->set('title','Details');
  }

}
