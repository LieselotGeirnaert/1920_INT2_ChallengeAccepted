<?php
  $id = $_GET['id'];
  
?>

<section class="content content--experience">
  <h2 class="hidden">Hinderervaring details</h2>
  <a href="index.php?page=hinderoverzicht" class="experience__back">Terug naar alle ervaringen</a>
  <div class="experience__container">
    <div class="experience__info">
      <p class="info__situation"><?php echo $experience['situation_name']; ?></p>
      <p class="info__user"><?php echo $experience['user_name']; ?></p>
      <p class="info__time"><?php echo date("j F Y", strtotime($experience['date'])); ?></p>
    </div>
  
    <section class="experience__reviews">
      <h3 class="reviews__title">Recensies</h3>
      <div class="experience__stats">
        <p class="stats__icon stats__icon--likes"><?php echo $experience['likes']; ?></p>
        <p class="stats__icon stats__icon--reviews"><?php echo $experience['review_count']; ?></p>
        <p class="stats__icon stats__icon--rating"><?php echo round($experience['rating_average'], 1); ?></p>
      </div>
      <div class="reviews__container">
        <?php if (count($reviews) == 0): ?>
          <p class="reviews__none">Nog geen recensies</p>
        <?php endif; ?>

        <?php foreach ($reviews as $review): ?>
          <div class="review">
            <p class="review__name"><?php echo $review['name']; ?></p>
            <span>
               <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                  <img src="assets/img/icon-rating-full.svg" alt="Ster icoon">
               <?php endfor; ?>
               <?php for ($i = 0; $i < 5 - $review['rating']; $i++): ?>
                  <img src="assets/img/icon-rating-outline.svg" alt="Ster icoon">
               <?php endfor; ?>
            </span>
            <p class="review__review"><?php echo $review['review']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="reviews__form">
        <p class="reviews__title">Nieuwe recensie</p>
        <?php if (empty($_SESSION['user'])): ?>
          <p>Je moet aangemeld zijn om een recensie te plaatsen</p>
          <a href="index.php?page=login" class="btn btn--sticker">Aanmelden</a>
        <?php else: ?>
         <form method="post" action="index.php?page=hinderervaring&id=<?php echo $id; ?>" class="review__form">
          <input type="hidden" name="experience_id" value="<?php echo $experience['id'] ?>">
          <input type="hidden" name="user_id" value="<?php echo $experience['user_id'] ?>">
          <input type="hidden" name="action" value="addReview">

          <div class="form__row">
            <label for="rating" class="form__label">Aantal sterren</label>
            <div class="form__inputcontainer form__rating">
              <input id="rating5" type="radio" name="rating" value="5">
              <label for="rating5">5</label>
              <input id="rating4" type="radio" name="rating" value="4">
              <label for="rating4">4</label>
              <input id="rating3" type="radio" name="rating" value="3">
              <label for="rating3">3</label>
              <input id="rating2" type="radio" name="rating" value="2">
              <label for="rating2">2</label>
              <input id="rating1" type="radio" name="rating" value="1">
              <label for="rating1">1</label>
              <span class="form__error"><?php if(!empty($errors['rating'])) echo $errors['rating']; ?></span>
            </div>
          </div>
          <div class="form__row">
            <label for="reviewForm" class="form__label">Jouw recensie</label>
            <div class="form__inputcontainer">
              <input
                id="reviewForm"
                class="form__input"
                name="review"
                placeholder="Wat vond je van deze ervaring?"
                value="<?php if(!empty($_POST['review'])) echo $_POST['review'];?>"
                required
              />
              <span class="form__error"><?php if(!empty($errors['review'])) echo $errors['review']; ?></span>
            </div>
          </div>
          <button type="submit" class="btn btn--sticker">Recensie plaatsen</button>
        </form>
        <?php endif; ?>
      </div>
    </section>

    <section class="experience__content">
      <h3 class="hidden">Video</h3>
      <video controls class="content__video">
        <source src="<?php echo $experience['video'] ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <p class="content__title"><?php echo $experience['title']; ?></p>
      <p class="content__descr"><?php echo $experience['description']; ?></p>
      <form method="post" action="index.php?page=hinderervaring&id=<?php echo $id; ?>" class="content__like experience__like">
        <input type="hidden" name="likes" value="<?php echo $experience['likes'] ?>">
        <input type="hidden" name="experience_id" value="<?php echo $experience['id'] ?>">
        <input type="hidden" name="action" value="addLike">
        <input class="btn btn--like" type="submit" value="" />
      </form>
    </section>

  </div>
</section>