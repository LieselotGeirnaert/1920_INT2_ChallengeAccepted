<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>FC De Kampioenen - <?php echo $title;?></title>
</head>
<body>
  <div class="container">
    <header class="header">
      <a href="index.php">
       <h1 class="header__title"><span class="hidden">FC De Kampioenen</span></h1>
      </a>
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
