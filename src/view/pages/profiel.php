<section class="content content--profile">
  <h2 class="hidden">Profiel</h2>
  <section class="profile__header">
    <h3 class="hidden">Profiel info</h3>
    <div class="header__picture">
      <img src="" alt="">
    </div>
    <div class="header__info">
      <p class="info__name"><?php echo $userinfo['name']; ?></p>
      <p class="info__email"><?php echo $userinfo['email']; ?></p>
      <div class="info__stats">
        <span class="stats__item stats__item--experiences"><?php echo $userinfo['likes_count']; ?></span>
        <span class="stats__item stats__item--likes"><?php echo $userinfo['experiences_count']; ?></span>
        <span class="stats__item stats__item--reviews"><?php echo $userinfo['experiences_count']; ?></span>
      </div>
    </div>
    <a href="index.php?page=logout" class="header__logout">Afmelden</a>
  </section>
  
  <section>
    <h3 class="hidden">Hinderervaringen</h3>
    <form method="get" action="index.php?page=profiel" class="filterform">
      <input type="hidden" name="page" value="profiel" />
      <label for="situation" class="filterform__filter">
        <span class="filter__label">Situatie:</span>
        <select name="situation" id="situation" class="filter__select">
          <option value="all">Alle situaties</option>
          <?php foreach ($situations as $situation): ?>
            <option value="<?php echo $situation['id']; ?>"
              <?php
                if (!empty($_GET['situation'])){
                  if ($_GET['situation'] == $situation['id']){
                    echo ' selected';
                  }
                }
              ?>
              ><?php echo $situation['name']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </label>

      <label for="sort" class="filterform__filter">
        <span class="filter__label">Sorteren op:</span>
        <select name="sort" id="sort" class="filter__select">
          <option value="recent"
            <?php
              if (!empty($_GET['sort'])){
                if ($_GET['sort'] == "recent"){
                  echo ' selected';
                }
              }
            ?>
          >Recentste</option>
          <option value="popularity"
            <?php
              if (!empty($_GET['sort'])){
                if ($_GET['sort'] == "popularity"){
                  echo ' selected';
                }
              }
            ?>
          >Populairste</option>
          <option value="mostreviews"
            <?php
              if (!empty($_GET['sort'])){
                if ($_GET['sort'] == "mostreviews"){
                  echo ' selected';
                }
              }
            ?>
          >Meeste recensies</option>
          <option value="bestreviews"
            <?php
              if (!empty($_GET['sort'])){
                if ($_GET['sort'] == "bestreviews"){
                  echo ' selected';
                }
              }
            ?>
          >Beste recensies</option>
        </select>
      </label>

      <input type="submit" value="Toepassen" class="btn btn--sticker">
    </form>

    <div class="experiences-container">
      <a href="index.php?page=hindersituaties" class="experience experience--new">
        <?php if (count($experiences) === 0): ?>
          <p class="experience__title">Deel een eerste ervaring</p>
        <?php else: ?>
          <p class="experience__title">Deel een nieuwe ervaring</p>
        <?php endif; ?>
        <span class="experience__img"></span>
        <span class="experience__stats"></span>
        <span class="experience__link"></span>
      </a>
      <?php foreach ($experiences as $experience): ?>
        <article class="experience">
          <h3 class="experience__title"><?php echo $experience['situation_name']; ?></h3>
          <img src="" alt="" class="experience__img">
          <form method="post" action="index.php?page=profiel" class="experience__like">
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
</section>