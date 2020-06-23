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
  <footer class="footer">
    <div class="footer__top">
      <div>
        <p class="footer__title">Contacteer ons</p>
        <p>Hotelstraat 102, 9000 Gent</p>
        <p>0412 34 56 78</p>
        <p>info@hotelhinder.be</p>
      </div>
      <div>
        <p class="footer__title">Schrijf je in voor onze nieuwsbrief</p>
        <div class="footer__input">
          <input type="text" class="form__input" />
          <button class="btn btn--sticker">Inschrijven</button>
        </div>
      </div>
      <div class="footer__socials">
        <a href="https://www.facebook.com/" class="socials__icon socials__icon--facebook"><span class="hidden">Facebook</span></a>
        <a href="https://www.instagram.com/" class="socials__icon socials__icon--instagram"><span class="hidden">Instagram</span></a>
        <a href="https://www.twitter.com/" class="socials__icon socials__icon--twitter"><span class="hidden">Twitter</span></a>
      </div>
    </div>
    <p class="footer__credits">Lieselot geirnaert - int2 - 2020</p>
  </footer>
  <script src="js/script.js"></script>
  <script src="js/validate.js"></script>
</body>
</html>
