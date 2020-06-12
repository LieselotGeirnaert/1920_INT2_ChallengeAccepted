<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="stylesheet" href="css/reset.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <!-- <link rel="stylesheet" href="css/home.css"> -->
  <title>HotelHinder - <?php echo $title;?></title>
</head>
<body>
  <div class="container">
    <header class="header">
      <a href="index.php">
       <h1 class="header__title">HotelHinder</h1>
      </a>

      <nav class="nav">
        <ul class="nav__items">
          <li class="nav__item"><a class="nav__link" href="index.php">Home</a></li>
          <li class="nav__item"><a class="nav__link" href="index.php?page=hoehinderen">Hoe hinderen</a></li>
          <li class="nav__item"><a class="nav__link" href="index.php?page=hinderoverzicht">Hinderoverzicht</a></li>
          <li class="nav__item"><a class="nav__link" href="index.php?page=profiel">Profiel</a></li>
          <li class="nav__item"><a class="nav__link" href="index.php?page=hinderen">Begin met hinderen</a></li>
        </ul>
      </nav>

      <?php if (!empty($_SESSION['info'])): ?>
        <div class="box info"><?php echo $_SESSION['info']; ?></div>
      <?php endif; ?>
      <?php if (!empty($_SESSION['error'])): ?>
        <div class="box error"><?php echo $_SESSION['error']; ?></div>
      <?php endif; ?>
    </header>

    <main>
      <?php echo $content; ?>
    </main>


  </div>
  <script src="js/script.js"></script>
</body>
</html>
