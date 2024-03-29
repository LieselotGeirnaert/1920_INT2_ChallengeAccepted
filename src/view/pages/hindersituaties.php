<section class="content content--situations">
  <h2 class="situations__title">Maak jouw hinderervaring</h2>
  <p class="situations__descr">Kies jouw favoriete hinder-locatie of -situatie en ga ermee aan de slag. Veel hinderplezier!</p>
  
  <div class="situations__slider">
    <?php foreach($situations as $situation): ?>
      <article class="situation">
        <div class="situation__right">
          <img src="assets/img/photos/<?php echo strtolower($situation['name']); ?>.png" alt="Afbeelding <?php echo $situation['name']; ?>" class="situation__img">
          <img src="assets/img/photos/<?php echo strtolower($situation['name']); ?>-doodles.png" alt="Afbeelding <?php echo $situation['name']; ?>" class="situation__img situation__img--doodles">
          <h3 class="situation__title"><?php echo $situation['name']; ?></h3>
          <span class="situation__sticker"></span>
        </div>
        <div class="situation__left">
          <p class="situation__descr"><?php echo $situation['description']; ?></p>
          <a href="index.php?page=maakervaring&id=<?php echo $situation['id']; ?>" class="btn btn--sticker">Deel jouw ervaring</a>
        </div>
      </article>
    <?php endforeach; ?>

    <a class="slider__control slider__control--prev"><span class="hidden">Vorige</span></a>
    <a class="slider__control slider__control--next"><span class="hidden">Volgende</span></a>
  </div>

  <div class="slider__dotcontainer">
    <span class="slider__dot slider__dot--active"></span>
    <span class="slider__dot"></span>
    <span class="slider__dot"></span>
    <span class="slider__dot"></span>
    <span class="slider__dot"></span>
  </div>
</section>