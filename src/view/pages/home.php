<section class="content content--home">
  <h2 class="hidden">Home</h2>
  <section class="home__intro">
    <h3 class="intro__text">Ben jij klaar om jouw medereizigers de ultieme hinder-ervaring te bezorgen?</h3>
    <p class="intro__title">Hotelhinder</p>
    <div class="intro__images">
      <img src="assets/img/photos/home-1.png" alt="Polaroidfoto van vrienden op het strand" class="intro__img intro__img--left">
      <img src="assets/img/photos/home-1-doodles.png" alt="Polaroidfoto van vrienden op het strand met doodles" class="intro__img intro__img--left intro__img--doodles">
      <img src="assets/img/photos/home-2.png" alt="Polaroidfoto van vrienden op het strand" class="intro__img intro__img--right">
      <img src="assets/img/photos/home-2-doodles.png" alt="Polaroidfoto van vrienden op het strand met doodles" class="intro__img intro__img--right intro__img--doodles">
    </div>
    <img src="assets/img/arrow-lightblue.svg" alt="Pijl naar beneden" class="intro__down">
  </section>

  <section class="imagine">
    <h3 class="imagine__title">Stel je voor, Een wereld zonder frustraties zou toch maar saai zijn, niet?</h3>
    <p class="imagine__text">Haal je innerlijke plaaggeest nog eens boven en maak de reiservaring van je mede-hotelgasten, op jouw eigen
      manier, een beetje interessanter. Kies jouw favoriet plaag-locatie of -situatie en zet het hotel op stelten.
      Krijg jij de meeste recensies van je dankbare slachtoffers?
    </p>
    <img src="assets/img/photos/home-3.png" alt="Vrienden op het strand" class="imagine__img">
    <img src="assets/img/photos/home-3-doodles.png" alt="Vrienden op het strand met doodles" class="imagine__img imagine__img--doodles">
  </section>

  <section class="foryou">
    <h3 class="foryou__title subtitle">Is de hinderwereld iets voor jou?</h3>
    <div class="foryou__reasons">
      <img src="assets/img/photos/home-4.png" alt="Polaroidfoto van een vrouw op het strand" class="reasons__img reasons__img--one">
      <img src="assets/img/photos/home-5.png" alt="Polaroidfoto van een vrouw op het strand" class="reasons__img reasons__img--two">
      <img src="assets/img/photos/home-6.png" alt="Polaroidfoto van een vrouw op het strand" class="reasons__img reasons__img--three">
      <p class="reasons__text reasons__text--one">Kunnen jouw buren, vrienden, familieleden, … wel wat extra frustraties gebruiken? <span class="reasons__text--accent">Maak hun leven terug interessanter en een beetje beter.</span></p>
      <p class="reasons__text reasons__text--two">Wil je die <span class="reasons__text--accent">innerlijke plaaggeest nog eens bovenhalen</span>? Dan is dit het ideale moment!</p>
      <p class="reasons__text reasons__text--three">De hele dag doelloos aan het zwembad liggen is niks voor jou? De animatie is ook niet jouw ding? <span class="reasons__text--accent">HotelHinder zorgt voor het ideale tijdverdrijf.</span></p>
    </div>
    <a href="index.php?page=hindersituaties" class="btn btn--sticker">Begin met hinderen</a>
  </section>

  <section class="spotlight">
    <h3 class="spotlight__title subtitle subtitle--stroke">Hinderervaringen in de kijker</h3>
    <div class="experiences-container">
      <?php foreach ($experiences as $experience): ?>
        <article class="experience">
          <h4 class="experience__title"><?php echo $experience['situation_name']; ?></h4>
          <video controls  alt="Video" class="experience__video">
            <source src="<?php echo $experience['video'] ?>" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <form method="post" action="index.php?page=home" class="experience__like">
            <input type="hidden" name="likes" value="<?php echo $experience['likes'] ?>">
            <input type="hidden" name="experience_id" value="<?php echo $experience['id'] ?>">
            <input type="hidden" name="action" value="addLike">
            <input class="btn btn--like" type="submit" value=""/>
          </form>
          <div class="experience__stats">
            <p class="stats__icon stats__icon--likes"><?php echo $experience['likes']; ?></p>
            <p class="stats__icon stats__icon--reviews"><?php echo (int)$experience['review_count']; ?></p>
            <p class="stats__icon stats__icon--rating"><?php echo round($experience['rating_average'], 1); ?></p>
          </div>
          <div class="experience__details">
            <p class="experience__user"><?php echo $experience['user_name']; ?></p>
            <p class="experience__time"><?php echo date("j F Y", strtotime($experience['date'])); ?></p>
          </div>
          <a href="index.php?page=hinderervaring&id=<?php echo $experience['id']; ?>" class="experience__link"><span class="hidden">Details</span></a>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="spotlight__buttons">
      <a href="index.php?page=hinderoverzicht" class="btn btn--sticker">Meer hinderervaringen</a>
      <a href="index.php?page=hindersituaties" class="btn btn--sticker">Maak jouw eigen ervaring</a>
    </div>
  </section>
</section>