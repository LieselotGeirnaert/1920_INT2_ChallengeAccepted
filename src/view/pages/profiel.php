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
    <div class="experiences-container">
      <a href="index.php?page=hindersituaties" class="experience experience--new">
        <p class="experience__title">Deel een nieuwe ervaring</p>
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
            <p class="stats__icon stats__icon--reviews"><?php echo $experience['likes']; ?></p>
            <p class="stats__icon stats__icon--rating"><?php echo $experience['likes']; ?></p>
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