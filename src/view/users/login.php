<section class="auth">
  <h2 class="auth__subtitle">Aanmelden</h2>
  <a href="index.php?page=registreer" class="auth__link">Ik heb nog geen account</a>

  <form method="post" action="index.php?page=login" class="auth__form">
    <div class="form__row">
      <label for="loginFormInputEmail" class="form__label">Emailadres</label>
      <div class="form__inputcontainer">
        <input
          id="loginFormInputEmail"
          class="form__input"
          type="email"
          name="email"
          placeholder="Geef jouw emailadres..."
          value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>"
        />
        <?php if(!empty($errors['email'])) echo '<div class="form__error">' . $errors['email'] . '</div>'; ?>
      </div>
    </div>

    <div class="form__row">
      <label for="loginFormInputPass" class="form__label">Paswoord</label>
      <div class="form__inputcontainer">
        <input
          id="loginFormInputPass"
          class="form__input"
          type="password"
          name="password"
          placeholder="Geef jouw paswoord..."
        />
        <?php if(!empty($errors['password'])) echo '<div class="form__error">' . $errors['password'] . '</div>'; ?>
      </div>
    </div>
  
    <input class="btn" type="submit" value="Aanmelden" />
  </form>
</section>