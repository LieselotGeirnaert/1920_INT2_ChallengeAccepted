<section class="content content__new">
  <h2 class="hidden">Maak jouw hinderervaring</h2>
  <div class="new__header">
    <a href="index.php?page=hindersituaties" class="experience__back">Terug naar alle situaties</a>
    <p class="header__intro"><?php echo $situation['description']; ?></p>
  </div>

  <form method="post" action="index.php?page=maakervaring&id=<?php echo $situation['description']; ?>" class="review__form" enctype="multipart/form-data">
    <input type="hidden" name="situation_id" value="<?php echo $situation['id'] ?>">
    <input type="hidden" name="action" value="addExperience">
    <div class="form__row">
      <input type="file" id="video" name="video" accept="video/mp4, video/quicktime">
    </div>
    <div class="form__row">
      <label for="title" class="form__label">Titel</label>
      <div class="form__inputcontainer">
        <input
          id="title"
          class="form__input"
          name="title"
          placeholder="Geef jouw ervaring een titel..."
          value="<?php if(!empty($_POST['title'])) echo $_POST['title'];?>"
        />
        <?php if(!empty($errors['title'])) echo '<div class="form__error">' . $errors['title'] . '</div>'; ?>
      </div>
    </div>

    <div class="form__row">
      <label for="title" class="form__label">Korte omschrijving <span class="form__label--small">(optioneel)</span></label>
      <div class="form__inputcontainer">
        <input
          id="description"
          class="form__input"
          name="description"
          placeholder="Geef jouw ervaring een omschrijving..."
          value="<?php if(!empty($_POST['description'])) echo $_POST['description'];?>"
        />
        <?php if(!empty($errors['description'])) echo '<div class="form__error">' . $errors['description'] . '</div>'; ?>
      </div>
    </div>

    <input class="btn btn--sticker" type="submit" value="Recensie plaatsen" />
  </form>
</section>