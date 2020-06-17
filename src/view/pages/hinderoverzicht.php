<section class="content content__overview">
  <h2 class="overview__subtitle">Ontdek hoe anderen de wereld al een beetje irritanter maakten!</h2>
  <form method="get" action="index.php?page=hinderoverzicht" class="filters">
    <div class="form__row">
      <label class="form__label" for="registerName">Volledige naam</label>
      <div class="form__inputcontainer">
        <input
          type="text"
          name="name"
          id="registerName"
          class="form__input"
          placeholder="Geef jouw voornaam en achternaam..."
          value="<?php if(!empty($_POST['name'])) echo $_POST['name'];?>"
        />
        <?php if(!empty($errors['name'])) echo '<div class="form__error">' . $errors['name'] . '</div>'; ?>
      </div>
    </div>

    <label for="situation" class="filter">
      <span>Situatie:</span>
      <select name="situation" id="situation" class="filter__select">
        <option value="all">Alle situaties</option>
        <?php foreach ($situations as $situation): ?>
          <option value="<?php echo $situation['id']; ?>"
            <?php
              if(!empty($_GET['id'])){
                if($_GET['id'] == $situations['id']){
                  echo ' selected';
                }
              }
            ?>
          ><?php echo $situation['name']; ?>
        </option>
      <?php endforeach; ?>
      </select>
    </label>

    <label for="sort" class="filter">
      <span>Sorteren op:</span>
      <select name="sort" id="sort" class="filter__select">
          <option value="recent">Recentste</option>
          <option value="popularity">Populairste</option>
          <option value="reviews">Meeste recensies</option>
          <option value="reviews">Beste recensies</option>
      </select>
    </label>

    <input type="submit" value="Toepassen" class="btn btn-sticker">
  </form>

  <div class="experiences-container">
    <a href="index.php?page=hindersituaties" class="experience experience--new">
      <p class="experience__title">Deel jouw eigen ervaring</p>
      <span class="experience__img"></span>
      <div class="experience__stats"></div>
      <span class="experience__link"></span>
    </a>
    
    <?php foreach ($experiences as $experience): ?>
      <article class="experience">
        <h3 class="experience__title"><?php echo $experience['situation_name']; ?></h3>
        <img src="" alt="" class="experience__img">
        <form method="post" action="index.php?page=hinderoverzicht" class="experience__like">
          <input type="hidden" name="likes" value="<?php echo $experience['likes'] ?>">
          <input type="hidden" name="experience_id" value="<?php echo $experience['id'] ?>">
          <input type="hidden" name="action" value="addLike">
          <input class="btn btn--like" type="submit" value="" />
        </form>
        <div class="experience__stats">
          <p class="stats__icon stats__icon--likes"><?php echo $experience['likes']; ?></p>
          <p class="stats__icon stats__icon--reviews"><?php echo $experience['review_count']; ?></p>
          <p class="stats__icon stats__icon--rating"><?php echo round($experience['rating_average'], 1); ?></p>
        </div>
        <div class="experience__details">
          <p class="experience__user"><?php echo $experience['user_name']; ?></p>
          <p class="experience__time">2 uur geleden</p>
        </div>
        <a href="index.php?page=hinderervaring&id=<?php echo $experience['id']; ?>" class="experience__link"><span class="hidden">Details</span></a>
      </article>
    <?php endforeach; ?>
  </div>
</section>