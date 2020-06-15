<section class="overview">
  <h2 class="overview__subtitle">Ontdek hoe anderen de wereld al een beetje irritanter maakten!</h2>
  
  <div class="overview__experiences">
    <article class="experience experience--new">
      <h3 class="experience__title">Deel jouw eigen ervaring</h3>
      <span class="experience__img"></span>
      <div class="experience__stats"></div>
      <a href="index.php?page=hindersituaties" class="experience__link"><span class="hidden">Details</span></a>
    </article>
    
    <?php foreach ($experiences as $experience): ?>
      <article class="experience">
        <h3 class="experience__title"><?php echo $experience['situationname']; ?></h3>
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
          <p class="experience__user"><?php echo $experience['username']; ?></p>
          <p class="experience__time">2 uur geleden</p>
        </div>
        <a href="index.php?page=hinderervaring&id=<?php echo $experience['id']; ?>" class="experience__link"><span class="hidden">Details</span></a>
      </article>
    <?php endforeach; ?>
  </div>
</section>


<!--
<form action="index.php" method="get" class="filters">
      <input type="hidden" name="page" value="activiteiten" />
      <label for="type" class="filter">
        <span>Situatie:</span>
        <select name="situation" id="situation" class="filter__select">
          <option value="all">Alles</option>
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

      <label for="date" class="filter">
        <span>Sorteren op:</span>
        <select name="date" id="date" class="filter__select">
            <option value="recent">Recentste</option>
            <option value="popularity">Populariteit</option>
            <option value="reviews">Recensies</option>
        </select>
      </label>

      <input type="submit" value="Toepassen" class="btn">

    </form>