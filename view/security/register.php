<!-- HEADER REGISTER -->
<div class="header-register">
  <h3 class="header-register-center">Register</h3>
</div>

<!-- FORMULAIRE D'INSCRIPTION -->
<div class="registration-container">
  <div class="registration-form">
    <form action="index.php?ctrl=security&action=register" method="POST">
      <!-- Champ d'entrée pour le pseudonyme -->
      <div class="form-group">
        <label for="nickName">Nickname</label>
        <input type="text" name="nickName" id="nickName" required />
      </div>

      <!-- Champ d'entrée pour l'e-mail -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" required />
      </div>

      <!-- Champ d'entrée pour le mot de passe -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
      </div>

      <!-- Champ d'entrée pour la confirmation du mot de passe -->
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required />
      </div>

      <!-- Bouton de soumission du formulaire -->
      <input class="button" type="submit" name="submit" id="submit" value="Register" />
    </form>
  </div>
</div>
