<section class="auth">
  <h2 class="auth__subtitle">Maak een account</h2>
  <a href="index.php?page=login" class="auth__link">Ik heb al een account</a>
  
  <form action="index.php?page=registreer" method="post" class="auth__form">
    <div class="form__row">
      <label class="form__label" for="registerName">Volledige naam</label>
      <div class="form__inputcontainer">
        <input
          type="text"
          name="name"
          id="registerName"
          class="form__input"
          placeholder="Geef jouw voornaam en achternaam..."
          value="<?php if(!empty($_POST['name'])) echo $_POST['name'];?>"
        />
        <?php if(!empty($errors['name'])) echo '<div class="form__error">' . $errors['name'] . '</div>'; ?>
      </div>
    </div>

    <div class="form__row">
      <label class="form__label" for="registerEmail">Emailadres</label>
      <div class="form__inputcontainer">
        <input
          type="email"
          name="email"
          id="registerEmail"
          class="form__input"
          placeholder="Geef jouw emailadres..."
          value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>"
        />
        <?php if(!empty($errors['email'])) echo '<div class="form__error">' . $errors['email'] . '</div>'; ?>
      </div>
    </div>

    <div class="form__row">
      <label class="form__label" for="registerPassword">Passwoord</label>
      <div class="form__inputcontainer">
        <input
          type="password"
          name="password"
          id="registerPassword"
          placeholder="Geef jouw paswoord..."
          class="form__input"
        />
        <?php if(!empty($errors['password'])) echo '<div class="form__error">' . $errors['password'] . '</div>'; ?>
      </div>
    </div>

    <div class="form__row">
      <label class="form__label" for="registerConfirmPassword">Herhaal passwoord</label>
      <div class="form__inputcontainer">
        <input
          type="password"
          name="confirm_password"
          id="registerConfirmPassword"
          placeholder="Herhaal paswoord..."
          class="form__input"
        />
        <?php if(!empty($errors['confirm_password'])) echo '<div class="form__error">' . $errors['confirm_password'] . '</div>'; ?>
      </div>
    </div>

    <input type="submit" value="Registreren" class="btn btn--sticker">
  </form>
</section>
