<!-- FORMULAIRE DE CONNEXION -->
<div class="login-container">
  <div class="login-form">
    <h3>Login</h3>
    <form action="index.php?ctrl=security&action=login" method="post">
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

      <!-- Bouton de soumission du formulaire -->
      <input class="button" type="submit" name="submit" id="submit" value="Login" />
    </form>
  </div>
</div>
