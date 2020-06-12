<section class="filter">
  <h2 class="hidden">Filter</h2>
  <form action="index.php?page=home" method="get">
    <label for="season">
      <span>Selecteer een seizoen</span>
      <select name="season" id="season" class="filter-season">
          <option value="all">-- Alle seizoenen --</option>
        <?php foreach($seasons as $season): ?>
          <option value="<?php echo $season['season']; ?>"
          <?php
            if(!empty($_GET['season'])){
              if($_GET['season'] == $season['season']){
                echo ' selected';
              }
            }
          ?>
          >Seizoen <?php echo $season['season']; ?></option>
        <?php endforeach; ?>
      </select>
    </label>
    <input type="submit" value="Filter" class="filter-button">
  </form>
</section>
<section class="episodes">
  <h2 class="hidden">Episode Guide</h2>
  <ul class="episodes">
    <?php foreach ($episodes as $episode): ?>
      <li class="episodes__episode">
        <a href="index.php?page=detail&id=<?php echo $episode['id']; ?>"><?php echo $episode['title']; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>

