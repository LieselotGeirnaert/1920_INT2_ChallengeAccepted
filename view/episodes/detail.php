<?php
  $id = $_GET['id'];
?>
<section class="prev_next">
  <a class="prev" href="index.php?page=detail&id=<?php echo $id-1;?>"><<- Vorige aflevering</a>
  <a class="next" href="index.php?page=detail&id=<?php echo $id+1;?>">Volgende aflevering ->></a>
</section>
<section class="episode">
  <div class="episode-container">
    <h2 class="episode__title"><?php echo $episode['title']; ?></h2>
    <p class="episode__description"><?php echo $episode['description']; ?></p>
    <ul>
      <li>Seizoen: <?php echo $episode['season']; ?></li>
      <li>Aflevering: <?php echo $episode['nr']; ?></li>
      <li>Auteur: <?php echo $episode['writer']; ?></li>
      <li>Released: <span class="date"><?php echo $episode['released']; ?></span></li>
    </ul>
  </div>
  <article class="nice-to-know">
    <h3 class="hidden">Nice to know</h3>
    <p class="fact"></p>
  </article>
  <article class="quotes">
    <h3 class="quotes__title">Quotes</h3>
    <form action="index.php?page=detail&id=<?php echo $episode['id']; ?>" method="post" class="quote-form">
      <input type="hidden" name="episode_id" value="<?php echo $episode['id'] ?>">
      <input type="hidden" name="action" value="insertQuote">
      <div class="field-wrapper">
        <label for="quote">
          <span class="input-label">Quote</span>
          <span class="error"><?php if(!empty($errors['quote'])){ echo $errors['quote'];} ?></span>
          <input type="text" id="quote" name="quote" class="input" value="<?php if(!empty($_POST['quote'])){ echo $_POST['quote'];} ?>" required  />
        </label>
      </div>
      <div class="field-wrapper">
        <label for="author">
          <span class="input-label">Auteur</span>
          <span class="error"><?php if(!empty($errors['author'])){ $errors['author'];} ?></span>
          <input type="text" id="author" name="author" class="input" value="<?php if(!empty($_POST['author'])){ echo $_POST['author'];} ?>" required  />
        </label>
      </div>
      <input type="submit" class="button" value="toevoegen">
    </form>
    <?php if(empty($quotes)): ?>
      <p>Geen quotes voor deze aflevering</p>
    <?php else: ?>
    <ul>
      <?php foreach($quotes as $quote): ?>
        <li>"<?php echo $quote['quote']; ?>" - <span class="quote__author"><?php echo $quote['author']; ?></span></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </article>
</section>
<script src="js/validate.js"></script>
