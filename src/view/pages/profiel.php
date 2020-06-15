<section class="profile">
  <h2 class="hidden">Profiel</h2>
  <div class="profile__header">
    <div class="header__picture">
      <a href=""></a>
    </div>
    <div class="header__info">
      <p><?php echo $userinfo['name']; ?></p>
      <p><?php echo $userinfo['email']; ?></p>
      <p><?php echo $userinfo['likes_count']; ?></p>
      <p><?php echo $userinfo['experiences_count']; ?></p>
      
    </div>
    <a href="index.php?page=logout" class="header__logout">Afmelden</a>

  </div>
  <section>
    <div class="overview__experiences">
      <?php foreach ($experiences as $experience): ?>
        <article class="experience">
          <h3 class="experience__title"><?php echo $experience['situation_name']; ?></h3>
          <img src="" alt="" class="experience__img">
          <div class="experience__stats">
            <div class="stats__item">
              <img src="assets/img/likes-icon.svg" alt="like icon" class="stats__icon">
              <p><?php echo $experience['likes']; ?></p>
            </div>
            <div class="stats__item">
              <img src="assets/img/reviews-icon.svg" alt="reviews icon" class="stats__icon">
              <p>3</p>
            </div>
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