<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.typekit.net/gpi1ppr.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="favicon.png" type="image/x-icon">
  <title>HotelHinder - <?php echo $title;?></title>
</head>
<body>
  <header class="header">
    <a href="index.php" class="nav__link nav__link--header">
      <h1 class="header__title">HotelHinder</h1>
    </a>

    <nav class="nav">
      <ul class="nav__items">
        <li class="nav__item"><a class="nav__link <?php if ($_GET['page'] === 'home'){ echo ' nav__link--active'; }?>" href="index.php">Home</a></li>
        <li class="nav__item"><a class="nav__link <?php if ($_GET['page'] === 'hoehinderen'){ echo ' nav__link--active'; }?>" href="index.php?page=hoehinderen">Hoe hinderen</a></li>
        <li class="nav__item"><a class="nav__link <?php if ($_GET['page'] === 'hinderoverzicht'){ echo ' nav__link--active'; }?>" href="index.php?page=hinderoverzicht">Hinderoverzicht</a></li>
        <?php if (empty($_SESSION['user'])): ?>
          <li class="nav__item"><a class="nav__link <?php if ($_GET['page'] === 'profiel'){ echo ' nav__link--active'; }?>" href="index.php?page=login">Aanmelden</a></li>
        <?php else: ?>
          <li class="nav__item"><a class="nav__link <?php if ($_GET['page'] === 'profiel'){ echo ' nav__link--active'; }?>" href="index.php?page=profiel">Profiel</a></li>
        <?php endif; ?>
        <li class="nav__item"><a class="nav__link <?php if ($_GET['page'] === 'hindersituaties'){ echo ' nav__link--active'; }?>" href="index.php?page=hindersituaties">Begin met hinderen</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <?php if (!empty($_SESSION['info'])): ?>
      <div class="box info"><?php echo $_SESSION['info']; ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
      <div class="box error"><?php echo $_SESSION['error']; ?></div>
    <?php endif; ?>

    <?php echo $content; ?>
  </main>

  <script src="js/script.js"></script>
</body>
</html>
