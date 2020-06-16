<?php
  $id = $_GET['id'];
?>

<section class="content content__experience">
  <h2 class="hidden">Hinderervaring details</h2>
  <a href="index.php?page=hinderoverzicht" class="experience__back">Terug naar alle ervaringen</a>
  <div class="experience__container">
    <div class="experience__info">
      <p class="info__situation"><?php echo $experience['situation_name']; ?></p>
      <p class="info__user"><?php echo $experience['user_name']; ?></p>
      <p class="info__time">2 uur geleden</p>
    </div>
  
    <section class="experience__reviews">
      <h3 class="reviews__title">Recensies</h3>
      <div class="experience__stats">
        <p class="stats__icon stats__icon--likes"><?php echo $experience['likes']; ?></p>
        <p class="stats__icon stats__icon--reviews"><?php echo $experience['likes']; ?></p>
        <p class="stats__icon stats__icon--rating"><?php echo $experience['likes']; ?></p>
      </div>
      <div class="reviews__container">
        <?php if (count($reviews) == 0): ?>
          <p class="reviews__none">Nog geen recensies</p>
        <?php endif; ?>

        <?php foreach ($reviews as $review): ?>
          <div class="review">
            <p class="review__name"><?php echo $review['name']; ?></p>
            <p class="review__rating"><?php echo $review['rating']; ?></p>
            <p class="review__review"><?php echo $review['review']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <form method="post" action="index.php?page=hinderervaring&id=<?php echo $id; ?>" class="review__form">
        <input type="hidden" name="experience_id" value="<?php echo $experience['id'] ?>">
        <input type="hidden" name="user_id" value="<?php echo $experience['user_id'] ?>">
        <input type="hidden" name="action" value="addReview">
        
        <p class="reviews__title">Nieuwe recensie</p>
        <div class="form__row">
          <label for="rating" class="form__label">Aantal sterren</label>
          <div class="form__inputcontainer">
            <label for="one">
              <input type="radio" id="one" name="rating" value="1">
            </label>
            <label for="two">
              <input type="radio" id="two" name="rating" value="2">
            </label>
            <label for="three">
              <input type="radio" id="three" name="rating" value="3">
            </label>
            <label for="four">
              <input type="radio" id="four" name="rating" value="4">
            </label>
            <label for="five">
              <input type="radio" id="five" name="rating" value="5">
            </label>
            <?php if(!empty($errors['rating'])) echo '<div class="form__error">' . $errors['rating'] . '</div>'; ?>
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
            />
            <?php if(!empty($errors['review'])) echo '<div class="form__error">' . $errors['review'] . '</div>'; ?>
          </div>
        </div>
        <input class="btn" type="submit" value="Recensie plaatsen" />
      </form>
    </section>

    <section class="experience__content">
      <h3 class="hidden">Video</h3>
      <img src="" alt="" class="content__video">
      <p class="content__title"><?php echo $experience['title']; ?></p>
      <p class="content__descr"><?php echo $experience['description']; ?></p>
    </section>

  </div>
</section>