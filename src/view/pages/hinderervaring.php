<section class="experiencedetail">
  <h2 class="hidden">Hinderervaring details</h2>
  <a href="index.php?page=hinderoverzicht" class="back">Terug naar alle ervaringen</a>
  <div>
    <p><?php echo $experience['situation_name']; ?></p>
    <p><?php echo $experience['user_name']; ?></p>
    <p>2 uur geleden</p>
  </div>
  <div>
    <img src="" alt="">
    <p><?php echo $experience['title']; ?></p>
    <p><?php echo $experience['description']; ?></p>
  </div>
  <div class="reviews">
    <div class="experience__stats">
      <p><?php echo $experience['likes']; ?></p>
      <p><?php echo $experience['likes']; ?></p>
      <p><?php echo $experience['likes']; ?></p>
    </div>
    <div class="reviews__container">
      <?php foreach ($reviews as $review): ?>
        <div class="review">
          <p><?php echo $review['name']; ?></p>
          <p><?php echo $review['rating']; ?></p>
          <p><?php echo $review['review']; ?></p>
          
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>