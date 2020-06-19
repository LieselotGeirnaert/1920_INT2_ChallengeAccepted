<section class="content content__new">
  <h2 class="hidden">Maak jouw hinderervaring</h2>
  <div class="new__header">
    <a href="index.php?page=hindersituaties" class="experience__back header__back">Terug naar alle situaties</a>
    <p class="header__intro"><?php echo $situation['description']; ?></p>
  </div>

  <form method="post" action="index.php?page=maakervaring&id=<?php echo $situation['id']; ?>" class="new__form" enctype="multipart/form-data">
    <input type="hidden" name="situation_id" value="<?php echo $situation['id'] ?>">
    <input type="hidden" name="action" value="addExperience">
    <div class="form__left">
      <label class="form__fileupload">
        <span class="fileupload__button"></span>
        <input type="file" id="video" name="video" accept="video/mp4, video/quicktime" class="fileupload__hidden">
        <span class="fileupload__title"><?php echo $situation['name'] ?></span>
        <?php if(!empty($errors['video'])) echo '<div class="form__error">' . $errors['video'] . '</div>'; ?>
      </label>
    </div>
    <div class="form__right">
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
          <textarea
            id="description"
            class="form__input"
            name="description"
            placeholder="Geef jouw ervaring een omschrijving..."
            value="<?php if(!empty($_POST['description'])) echo $_POST['description'];?>"
            rows="5" 
          ></textarea>
        </div>
      </div>

      <button class="btn btn--sticker" type="submit">Deel ervaring</button>
    </div>
  </form>
</section>